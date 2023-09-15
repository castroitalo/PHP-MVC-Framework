<?php

declare(strict_types=1);

namespace src\core;

use Closure;

/**
 * Class Router 
 * 
 * @package src\core
 */
final class Router
{
    /**
     * Defined app's routes
     *
     * @var array
     */
    protected array $routes = [];

    public Request $request;

    /**
     * Router constructor
     *
     * @param Request $request
     */
    public function __construct(Request $request) {
        $this->request = $request;
    }

    /**
     * Add a new get Route
     *
     * @param string $path
     * @param string|Closure $callback
     * @return void
     */
    public function get(string $path, string|Closure $callback): void
    {
        $this->routes["get"][$path] = $callback;
    }

    /**
     * Renders the view's template
     *
     * @return string|false
     */
    protected function layoutContent(): string|false 
    {
        ob_start();
        include_once Application::$ROOT_DIR . "/src/views/layouts/main.view.php";
        return ob_get_clean();
    }

    /**
     * Renders the view only
     *
     * @param string $view
     * @return string|false
     */
    protected function renderOnlyView(string $view): string|false 
    {
        ob_start();
        include_once Application::$ROOT_DIR . "/src/views/{$view}.view.php";
        return ob_get_clean();
    }

    /**
     * Renders request URI's view
     *
     * @param string $view
     * @return string
     */
    public function renderView(string $view): string 
    {
        $layoutContent = $this->layoutContent();
        $viewContent = $this->renderOnlyView($view);

        return str_replace("{{content}}", $viewContent, $layoutContent);
    }

    /**
     * Execute requested URI
     *
     * @return string|null
     */
    public function resolve(): ?string
    {
        $requestedUri = $this->request->getPath();
        $httpMethod = $this->request->getMethod();
        $callback = $this->routes[$httpMethod][$requestedUri] ?? false;

        if ($callback === false) {
            return "Page not found";
        }

        if (is_string($callback)) {
            return $this->renderView($callback);
        }

        return call_user_func($callback);
    }
}
