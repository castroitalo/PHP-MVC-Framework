<?php

use src\controllers\AppController;
use src\controllers\AuthController;
use src\core\Application;

require __DIR__ . "/../vendor/autoload.php";

$app = new Application(dirname(__DIR__));

// Home
$app->router->get("/", [AppController::class, "homePage"]);

// Contact
$app->router->get("/contact", [AppController::class, "contactPage"]);
$app->router->post("/contact", [AppController::class, "handleContact"]);

// Auth
$app->router->get("/login", [AuthController::class, "login"]);
$app->router->post("/login", [AuthController::class, "login"]);
$app->router->get("/register", [AuthController::class, "register"]);
$app->router->post("/register", [AuthController::class, "register"]);

$app->run();
