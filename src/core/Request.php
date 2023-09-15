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
        return $_SERVER["REQUEST_METHOD"];
    }

    /**
     * Get data sent from request
     *
     * @return array
     */
    public function getBody(): array
    {
        $body = [];

        // Sanitize GET data
        if ($this->getMethod() === "GET") {
            foreach ($_GET as $key => $value) {
                $body[$key] = filter_input(
                    INPUT_GET,
                    $key,
                    FILTER_SANITIZE_SPECIAL_CHARS
                );
            }
        }
        
        // Sanitize POST data
        if ($this->getMethod() === "POST") {
            foreach ($_POST as $key => $value) {
                $body[$key] = filter_input(
                    INPUT_POST,
                    $key,
                    FILTER_SANITIZE_SPECIAL_CHARS
                );
            }
        }

        return $body;
    }
}
