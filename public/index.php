<?php

use app\core\Router;

require '../vendor/autoload.php';

session_start();

// dd($_SERVER);

Router::run();
