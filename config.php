<?php
    require 'vendor/autoload.php'; // Use an absolute path
    use Dotenv\Dotenv;

    // Load the .env file
    $dotenv = Dotenv::createImmutable(__DIR__);
    $dotenv->load();

    $host = $_ENV["DB_HOST"];
    $username = $_ENV["DB_USERNAME"];
    $password = $_ENV["DB_PASSWORD"];
    $dbname = $_ENV["DB_NAME"];
    $port = $_ENV["DB_PORT"];

?>