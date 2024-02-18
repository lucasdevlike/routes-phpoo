<?php

namespace app\controllers;

use app\database\Filters;
use app\database\models\User;

class HomeController extends Controller
{
    public function index()
    {
        $filters = new Filters();
        $filters->where('id', '>', 3);

        $user = new User();
        $user->setFilters($filters);
        $userFound = $user->count();
        dd($userFound);

        $this->view('Home', ['title' => 'Home']);
    }

}
