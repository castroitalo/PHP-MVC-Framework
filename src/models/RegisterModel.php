<?php

declare(strict_types=1);

namespace src\models;

use src\core\BaseModel;

/**
 * Class RegisterModel
 * 
 * @package src\models
 */
final class RegisterModel extends BaseModel
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

    public function register()
    {
    }
}
