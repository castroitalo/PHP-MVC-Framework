<?php

declare(strict_types=1);

namespace src\core;

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

    /**
     * Add a new route for GET HTTP method
     *
     * @param string $path
     * @param array $callback
     * @return void
     */
    public function get(string $path, array $callback): void
    {
        $this->routes["GET"][$path] = $callback;
    }

    /**
     * Add a new route for POST HTTP method
     *
     * @param string $path
     * @param array $callback
     * @return void
     */
    public function post(string $path, array $callback): void 
    {
        $this->routes["POST"][$path] = $callback;
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
    protected function renderOnlyView(string $view, array $viewData): string|false
    {
        // Evaluates $viewData keys as variables
        foreach ($viewData as $key => $value) {
            $$key = $value;
        }

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
    public function renderView(string $view, array $viewData = []): string
    {
        $layoutContent = $this->layoutContent();
        $viewContent = $this->renderOnlyView($view, $viewData);

        return str_replace("{{content}}", $viewContent, $layoutContent);
    }

    /**
     * Execute requested URI
     *
     * @return string|null
     */
    public function resolve(): ?string
    {
        $requestedUri = Application::$app->request->getPath();
        $httpMethod = Application::$app->request->getMethod();
        $callback = $this->routes[$httpMethod][$requestedUri] ?? false;

        if ($callback === false) {
            Application::$app->response->setStatusCode(404);

            return $this->renderView("404");
        }

        if (is_string($callback)) {
            return $this->renderView($callback);
        }

        if (is_array($callback)) {
            $callback[0] = new $callback[0]();
        }

        return call_user_func($callback);
    }
}
