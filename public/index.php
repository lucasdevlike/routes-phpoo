<?php

use Dotenv\Dotenv;
use app\core\Router;

require '../vendor/autoload.php';

session_start();
$dotenv = Dotenv::createImmutable('../');
$dotenv->load();


Router::run();
