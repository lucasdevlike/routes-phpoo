<?php

namespace app\controllers;

use app\database\Filters;
use app\database\models\User;

class HomeController extends Controller
{
    public function index()
    {
        $filters = new Filters();
        $filters->where('id', '>', 0);
        // $filters->orderBy("id", "desc");
        // $filters->limit(5);

        $user = new User();
        // $user->setFilters($filters);
        // $usersFound = $user->fetchAll();
        $user->setFilters($filters);
        $userFound = $user->findBy();

        dd($userFound);
        // $filters->dump();

        $this->view('Home', ['title' => 'Home']);
    }

}
