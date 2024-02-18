<?php

namespace app\controllers;

use app\database\Filters;
use app\database\models\User;

class HomeController extends Controller
{
    public function index()
    {
        $filters = new Filters();
        $filters->where('id', '>', 50);
        $filters->orderBy("id", "desc");
        $filters->limit(5);

        $user = new User();
        $user->setFilters($filters);
        $user->fetchAll();

        // $filters->dump();

        $this->view('Home', ['title' => 'Home']);
    }

}
