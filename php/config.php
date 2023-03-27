<?php

require '../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable('../');
$dotenv->load();

$db_user = $_ENV['DB_USER'];
$db_name = $_ENV['DB_NAME'];
$db_password = $_ENV['DB_PASSWORD'];




?> 
