<?php

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

$app->database->applyMigrations();
