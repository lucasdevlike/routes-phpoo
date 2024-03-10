<?php

namespace app\controllers;

use app\controllers\Controller;
use League\Plates\Engine;

class ProductController extends Controller
{
    public function show($params)
    {
        var_dump($params);
    }
}
