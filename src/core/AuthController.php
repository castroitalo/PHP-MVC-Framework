<?php 

declare(strict_types=1);

namespace src\core;

/**
 * Class AuthController
 * 
 * @package src\core
 */
final class AuthController 
{
    use BaseController;

    /**
     * Login user with submitted data if HTTP request method is POST, if it's not
     * renders the login page
     *
     * @return string
     */
    public function login(): string 
    {
        // Login user
        if (Application::$app->request->getMethod() === "POST") {
            return "Handling submitted data";
        } 

        // Renders page
        $viewData = [
            "title" => "Login"
        ];

        return $this->renderPage("login", $viewData);
    }

    /**
     * Register user with submitted data if HTTP request method is POST, if it's not
     * renders the register page
     *
     * @return string
     */
    public function register(): string 
    {
        // Register user
        if (Application::$app->request->getMethod() === "POST") {
            return "Handling submitted data";
        } 

        // Render page
        $viewData = [
            "title" => "Register"
        ];

        return $this->renderPage("register", $viewData);
    }
}
