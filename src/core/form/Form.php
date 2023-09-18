<?php

declare(strict_types=1);

namespace src\core\form;

use src\core\BaseModel;

/**
 * Class Form 
 * 
 * @package src\form
 */
final class Form
{
    public static function begin(string $action, string $method): Form
    {
        echo sprintf("<form action='%s' method='%s'>", $action, $method);

        return new Form();
    }

    public function field(BaseModel $model, string $attribute): Field 
    {
        return new Field($model, $attribute);
    }

    public static function end(): void
    {
        echo "</form>";
    }
}
