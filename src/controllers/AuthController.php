<?php

declare(strict_types=1);

namespace src\controllers;

use src\core\Application;
use src\core\BaseController;
use src\models\LoginFormModel;
use src\models\UserModel;

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
        // Renders page
        $loginFormModel = new LoginFormModel();
        $viewData = [
            "title" => "Login",
            "model" => $loginFormModel
        ];

        if (Application::$app->request->getMethod() === "POST") {
            $loginFormModel->loadData(Application::$app->request->getBody());

            if ($loginFormModel->login()) {
                Application::$app->session->setFlash("success", "Login successfully.");
                Application::$app->response->redirect("/");
            }
        }

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
        $errors = [];
        $userModel = new UserModel();
        $viewData = [
            "title" => "Register",
            "model" => $userModel
        ];

        if (Application::$app->request->getMethod() === "POST") {
            $userModel->loadData(Application::$app->request->getBody());

            if ($userModel->register()) {
                Application::$app->session->setFlash("success", "Thanks for registering.");
                Application::$app->response->redirect("/");
            }

            return $this->renderPage("register", $viewData);
        }

        return $this->renderPage("register", $viewData);
    }
}
