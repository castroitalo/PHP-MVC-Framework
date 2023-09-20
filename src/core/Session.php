<?php 

declare(strict_types=1);

namespace src\core;

/**
 * Class Session 
 * 
 * @package src\core
 */
final class Session 
{
    protected const FLASH_KEY = "flash_messages";

    public function __construct()
    {
        if (!session_id()) {
            session_start();
        }

        $flashMessages = $_SESSION[self::FLASH_KEY] ?? [];

        foreach ($flashMessages as $key => $flashMessage) {
            $flashMessage["removed"] = true;
        }

        $_SESSION[self::FLASH_KEY] = $flashMessages;

        echo "<pre>";
        var_dump($_SESSION[self::FLASH_KEY]);
        echo "</pre>";
    }

    public function setFlash(string $key, string $message): void 
    {
        $_SESSION[self::FLASH_KEY][$key] = [
            "removed" => false,
            "value" => $message
        ];
    }

    public function getFlash(string $key): void 
    {

    }

    public function __destruct()
    {
        // Iterate over marked to be removed flash messages
    }
}
