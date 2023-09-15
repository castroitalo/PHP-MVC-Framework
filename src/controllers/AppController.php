<?php 

declare(strict_types=1);

namespace src\controllers;

use src\core\BaseController;

/**
 * Class AppController
 * 
 * @package src\controller
 */
final class AppController
{
    use BaseController;

    /**
     * Renders home page
     *
     * @return string
     */
    public function homePage(): string 
    {
        $viewData = [
            "title" => "Home",
        ];

        return $this->renderPage("home", $viewData);
    }

    /**
     * Renders contact page
     *
     * @return string
     */
    public function contactPage(): string 
    {
        $viewData = [
            "title" => "Contact Page"
        ];

        return $this->renderPage("contact", $viewData);
    }

    /**
     * Handles contact data
     *
     * @return void
     */
    public function handleContact(): void
    {
        $data = $this->getDataFromRequest();

        echo "<pre>";
        var_dump($data);
        echo "</pre>";
        exit();
    }
}
