<?php

use src\controllers\AppController;
use src\controllers\AuthController;
use src\core\Application;

require __DIR__ . "/../vendor/autoload.php";

$dotenv = Dotenv\Dotenv::createMutable(dirname(__DIR__, 1));

$dotenv->load();

$config = [
    "db" => [
        "dsn" => "mysql:host=" . $_ENV["DB_HOST"] . ";dbname=" . $_ENV["DB_NAME"] . ";dbport=" . $_ENV["DB_PORT"],
        "user" => $_ENV["DB_USER"],
        "password" => $_ENV["DB_PASSWORD"]
    ]
];
$app = new Application(dirname(__DIR__), $config);

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
