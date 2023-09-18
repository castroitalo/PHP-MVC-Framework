<?php 

declare(strict_types=1);

namespace src\core\form;

use src\core\BaseModel;

/**
 * Class Field 
 * 
 * @package src\form
 */
final class Field 
{
    public const TYPE_TEXT = "text";
    public const TYPE_PASSWORD = "password";
    public const TYPE_EMAIL = "email";
    public const TYPE_NUMBER = "number";

    public BaseModel $model;

    public string $attribute;

    public string $type;

    public function __construct(BaseModel $model, string $attribute)
    {
        $this->type = self::TYPE_TEXT;
        $this->model = $model;
        $this->attribute = $attribute;
    }

    public function passwordField(): Field 
    {
        $this->type = self::TYPE_PASSWORD;

        return $this;
    }

    public function emailField(): Field
    {
        $this->type = self::TYPE_EMAIL;

        return $this;
    }

    public function __toString()
    {
        return sprintf(
            "
            <div class='input'>
                <label>%s</label>
                <input type='%s' name='%s' value='%s' class='%s'>
            </div> 
            ",
            $this->attribute,
            $this->type,
            $this->attribute,
            $this->model->{$this->attribute}
        );
    }
}
