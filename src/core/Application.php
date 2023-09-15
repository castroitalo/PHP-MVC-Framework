<?php

declare(strict_types=1);

namespace src\core;

/**
 * Class Application
 * 
 * @package src\core
 */
final class Application
{
    /**
     * Project's root direcotry
     *
     * @var string
     */
    public static string $ROOT_DIR;

    /**
     * HTTP request
     *
     * @var Request
     */
    public Request $request;

    /**
     * App's router
     *
     * @var Router
     */
    public Router $router;

    /**
     * Application constructor
     *
     * @param Router $router
     */
    public function __construct(string $rootPath)
    {
        self::$ROOT_DIR = $rootPath;

        $this->request = new Request();
        $this->router = new Router($this->request);
    }

    /**
     * Execute requested URI
     *
     * @return void
     */
    public function run(): void
    {
        echo $this->router->resolve();
    }
}
