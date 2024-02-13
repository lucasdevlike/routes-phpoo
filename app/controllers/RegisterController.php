<?php

namespace app\controllers;

use app\controllers\Controller;
use League\Plates\Engine;

class RegisterController extends Controller
{
    public function store($params)
    {
        $templates = new Engine('../app/views');

        echo $templates->render('user', ['name' => 'Lucas', 'title' => 'Pagina do User']);
    }
}
