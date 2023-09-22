<?php

declare(strict_types=1);

namespace src\models;

use src\core\BaseModel;

final class LoginFormModel extends BaseModel
{
    public string $userEmail = "";

    public string $userPassword = "";

    public function rules(): array
    {
        return [
            "userEmail" => [
                self::RULE_REQUIRED,
                self::RULE_VALID_USER_EMAIL
            ],
            "userPassword" => [self::RULE_REQUIRED]
        ];
    }

    public function login(): void 
    {

    }
}
