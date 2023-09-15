<?php

declare(strict_types=1);

namespace src\core;

/**
 * Class Request 
 * 
 * @package src\core
 */
final class Request
{
    /**
     * Get requested URI
     *
     * @return string
     */
    public function getPath(): string
    {
        return parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
    }

    /**
     * Get HTTP method
     *
     * @return string
     */
    public function getMethod(): string
    {
        return strtolower($_SERVER["REQUEST_METHOD"]);
    }
}
