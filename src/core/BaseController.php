<?php 

declare(strict_types=1);

namespace src\core;

/**
 * Trait BaseController
 * 
 * @package src\core;
 */
trait BaseController 
{
    /**
     * Call the renderView method com router
     *
     * @param string $viewPath
     * @param array $viewData
     * @return string
     */
    public function renderPage(string $viewPath, array $viewData): string 
    {
        return Application::$app->router->renderView($viewPath, $viewData);
    }

    /**
     * Get data from request GET/POST
     *
     * @return array
     */
    public function getDataFromRequest(): array 
    {
        return Application::$app->request->getBody();
    }
}
