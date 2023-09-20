<?php

declare(strict_types=1);

namespace src\core;

/**
 * Class Response
 * 
 * @package src\core
 */
final class Response
{
    /**
     * Set a HTTP status code
     *
     * @param integer $statusCode
     * @return void
     */
    public function setStatusCode(int $statusCode): void
    {
        http_response_code($statusCode);
    }

    public function redirect(string $path): void 
    {
        header("Location: " . $path);
        exit();
    }
}
