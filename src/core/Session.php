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

        foreach ($flashMessages as $key => &$flashMessage) {
            $flashMessage["removed"] = true;
        }

        $_SESSION[self::FLASH_KEY] = $flashMessages;
    }

    public function setFlash(string $key, string $message): void 
    {
        $_SESSION[self::FLASH_KEY][$key] = [
            "removed" => false,
            "value" => $message
        ];
    }

    public function getFlash(string $key): string|false
    {
        return $_SESSION[self::FLASH_KEY][$key]["value"] ?? false;
    }

    public function __destruct()
    {
        $flashMessages = $_SESSION[self::FLASH_KEY] ?? [];

        foreach ($flashMessages as $key => $flashMessage) {
            if ($flashMessage["removed"] === true) {
                unset($flashMessages[$key]);
            }
        }

        $_SESSION[self::FLASH_KEY] = $flashMessages;
    }
}
