<?php

declare(strict_types=1);

namespace src\core;

use PDOStatement;

/**
 * Class DBModel
 * 
 * @package src\core
 */
abstract class DBModel extends BaseModel
{
    /**
     * Gets de model's table name
     *
     * @return string
     */
    abstract function tableName(): string;

    abstract public function attributes(): array;

    public function rules(): array
    {
        return [];
    }

    public static function prepare(string $sql): PDOStatement|false
    {
        return Application::$app->database->pdo->prepare($sql);
    }

    public function save(): bool
    {
        $tableName = $this->tableName();
        $attributes = $this->attributes();
        $params = array_map(fn ($attribute) => ":{$attribute}", $attributes);
        $statement = self::prepare(
            "INSERT INTO {$tableName} (
                " . implode(", ", $attributes) . "
            ) VALUES (
                " . implode(", ", $params) . "
            )"
        );

        foreach ($attributes as $attribute) {
            $statement->bindValue(":{$attribute}", $this->{$attribute});
        }

        $statement->execute();
    
        return true;
    }
}
