<?php 

declare(strict_types=1);

use src\core\Application;

/**
 * Class m0001_initial
 */
final class m0001_initial 
{
    public function up(): void
    {
        $db = Application::$app->database;
        $sql = "CREATE TABLE IF NOT EXISTS " . $_ENV["DB_NAME"] . ".users (
            user_id INT AUTO_INCREMENT PRIMARY KEY,
            user_email VARCHAR(255) NOT NULL,
            user_password VARCHAR(512) NOT NULL,
            user_status TINYINT NOT NULL,
            user_created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP 
        ) ENGINE=INNODB;";
    
        $db->pdo->exec($sql);
    }

    public function down(): void 
    {
        $db = Application::$app->database;
        $sql = "DROP TABLE IF EXISTS " . $_ENV["DB_NAME"] . ".users;";

        $db->pdo->exec($sql);
    }
}
