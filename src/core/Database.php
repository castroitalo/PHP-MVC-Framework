<?php

declare(strict_types=1);

namespace src\core;

use PDO;

/**
 * Class Database
 * 
 * @package src\core
 */
final class Database
{
    /**
     * PDO database connection
     *
     * @var PDO
     */
    public PDO $pdo;

    /**
     * Database constructor
     */
    public function __construct(array $config)
    {
        $dsn = $config["dsn"] ?? "";
        $user = $config["user"] ?? "";
        $password = $config["password"] ?? "";
        $this->pdo = new PDO(
            $dsn,
            $user,
            $password,
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ]
        );
    }

    protected function log(string $message): void 
    {
        echo "[" . date("Y-m-d H:i:s") . "] - {$message}" . PHP_EOL;
    }

    public function createMigrationsTable(): void
    {
        $this->pdo->exec(
            "CREATE TABLE IF NOT EXISTS " . $_ENV["DB_NAME"] . ".migrations (
                migration_id INT AUTO_INCREMENT PRIMARY KEY,
                migration VARCHAR(255),
                migration_created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            ) ENGINE=INNODB;"
        );
    }

    public function getAppliedMigrations(): array|false 
    {
        $statement = $this->pdo->prepare(
            "SELECT migration 
            FROM migrations;"
        );

        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_COLUMN);
    }

    public function saveMigrations(array $migrations): void
    {
        $newMigrations = implode(", ", array_map(fn ($migration) => "('{$migration}')", $migrations));
        $statement = $this->pdo->prepare(
            "INSERT INTO " . $_ENV["DB_NAME"] . ".migrations (
                migration
            ) VALUES (
                {$newMigrations}       
            );"
        );

        $statement->execute();
    }

    public function applyMigrations(): void
    {
        $this->createMigrationsTable();

        $newMigrations = [];
        $appliedMigrations = $this->getAppliedMigrations();
        $migrationFiles = scandir(Application::$ROOT_DIR . "/src/migrations");
        $toApplyMigrations = array_diff($migrationFiles, $appliedMigrations);

        foreach ($toApplyMigrations as $migration) {
            if ($migration === "." || $migration === "..") {
                continue;
            }

            require_once Application::$ROOT_DIR . "/src/migrations/{$migration}";

            $className = pathinfo($migration, PATHINFO_FILENAME);
            $newClass = new $className();
            
            $this->log("Applying migration {$migration}");
            
            $newClass->up();

            $newMigrations[] = $migration;
        }

        if (!empty($newMigrations)) {
            $this->saveMigrations($newMigrations);
        } else {
            $this->log("All migrations were applied.");
        }
    }
}
