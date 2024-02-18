<?php

namespace app\controllers;

use app\database\Filters;
use app\database\models\User;

class HomeController extends Controller
{
    public function index()
    {
        $filters = new Filters();
        $filters->where('users.id', '>', 2);
        $filters->join('posts', 'users.id', '=', 'posts.userId', 'left join');

        $user = new User();
        $user->setFields('users.id, users.firstName, users.lastName, titlePost');
        $user->setFilters($filters);
        $userFound = $user->fetchAll();
        dd($userFound);

        $this->view('Home', ['title' => 'Home']);
    }

}
