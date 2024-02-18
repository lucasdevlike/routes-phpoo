<?php

namespace app\controllers;

use app\database\Filters;
use app\database\models\User;

class HomeController extends Controller
{
    public function index()
    {
        $user = new User();
        $userFound = $user->first('id', 'asc');
        dd($userFound);

        $this->view('Home', ['title' => 'Home']);
    }

}
