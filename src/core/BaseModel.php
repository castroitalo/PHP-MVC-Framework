<?php

declare(strict_types=1);

namespace src\core;

/**
 * Class BaseModel
 * 
 * @package src\core
 */
abstract class BaseModel
{
    public const RULE_REQUIRED = "required";
    public const RULE_VALID_USER_EMAIL = "userValidUserEmail";
    public const RULE_MIN_LEN = "minLen";
    public const RULE_MAX_LEN = "maxLen";
    public array $errors = [];

    abstract public function rules(): array;

    public function loadData(array $data): void
    {
        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                $this->{$key} = $value;
            }
        }
    }

    public function errorMessages(): array
    {
        return [
            self::RULE_REQUIRED => "This field is required.",
            self::RULE_VALID_USER_EMAIL => "Invalid email.",
            self::RULE_MIN_LEN => "Min length of this field must be {min}",
            self::RULE_MAX_LEN => "Max length of this field must be {max}"
        ];
    }

    public function addError(string $attribute, string $ruleName, array $params = []): void
    {
        $message = $this->errorMessages()[$ruleName] ?? "";

        foreach ($params as $key => $value) {
            $message = str_replace("{{$key}}", (string)$value, $message);
        }

        $this->errors[$attribute][] = $message;
    }

    public function validate(): bool
    {
        foreach ($this->rules() as $attribute => $rules) {
            $value = $this->{$attribute};

            foreach ($rules as $rule) {
                $ruleName = $rule;

                // Validate rule name
                if (!is_string($ruleName)) {
                    $ruleName = $rule[0];
                }

                // Validate required fields
                if ($ruleName === self::RULE_REQUIRED && !$value) {
                    $this->addError($attribute, self::RULE_REQUIRED);
                }

                // Validate email
                if (
                    $ruleName === SELF::RULE_VALID_USER_EMAIL &&
                    filter_var($value, FILTER_VALIDATE_EMAIL)
                ) {
                    $this->addError($attribute, self::RULE_VALID_USER_EMAIL);
                }

                // Validate password minimun length
                if (
                    $ruleName === self::RULE_MIN_LEN &&
                    mb_strlen($value) < $rule["minLen"]
                ) {
                    $this->addError($attribute, self::RULE_MIN_LEN, $rule);
                }

                // Validate password maximum length
                if (
                    $ruleName === self::RULE_MAX_LEN &&
                    mb_strlen($value) < $rule["maxLen"]
                ) {
                    $this->addError($attribute, self::RULE_MAX_LEN, $rule);
                }
            }
        }

        return empty($this->errors);
    }
}
