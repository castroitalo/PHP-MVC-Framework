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
     * HTTP response
     *
     * @var Response
     */
    public Response $response;

    /**
     * App's router
     *
     * @var Router
     */
    public Router $router;

    /**
     * Global Application instance
     *
     * @var Application
     */
    public static Application $app;

    /**
     * Application constructor
     *
     * @param Router $router
     */
    public function __construct(string $rootPath)
    {
        self::$ROOT_DIR = $rootPath;
        self::$app = $this;

        $this->request = new Request();
        $this->response = new Response();
        $this->router = new Router();
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
