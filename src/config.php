<?php
    require_once __DIR__ . '/../vendor/autoload.php'; // Adjust path as necessary

    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . "/../"); // Adjust path as necessary
    $dotenv->load();

    $host = $_ENV["DB_HOST"];
    $username = $_ENV["DB_USERNAME"];
    $password = $_ENV["DB_PASSWORD"];
    $dbname = $_ENV["DB_NAME"];
    $port = $_ENV["DB_PORT"];

?>