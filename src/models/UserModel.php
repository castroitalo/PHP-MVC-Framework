<?php

declare(strict_types=1);

namespace src\models;

use src\core\DBModel;

/**
 * Class UserModel
 * 
 * @package src\models
 */
final class UserModel extends DBModel
{
    /**
     * Register user email
     *
     * @var string
     */
    public string $userEmail = "";

    /**
     * Register user password
     *
     * @var string
     */
    public string $userPassword = "";

    public function rules(): array
    {
        return [
            "userEmail" => [
                self::RULE_REQUIRED,
                self::RULE_VALID_USER_EMAIL
            ],
            "userPassword" => [
                self::RULE_REQUIRED,
                [
                    self::RULE_MIN_LEN,
                    "minLen" => 8
                ],
                [
                    self::RULE_MAX_LEN,
                    "maxLen" => 50
                ]
            ]
        ];
    }

    public function tableName(): string
    {
        return $_ENV["DB_NAME"] . ".users";
    }

    public function attributes(): array
    {
        return ["userEmail", "userPassword"];
    }

    public function register()
    {
        $this->userPassword = password_hash(
            $this->userPassword,
            PASSWORD_DEFAULT
        );
        return parent::save();
    }
}
