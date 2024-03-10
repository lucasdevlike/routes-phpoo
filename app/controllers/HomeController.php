<?php

namespace app\controllers;

use app\database\Filters;
use app\database\models\User;
use app\database\Pagination;

class HomeController extends Controller
{
    public function index()
    {
        $filters = new Filters();
        $filters->where('users.id', '>', 2);


        $pagination = new Pagination();
        $pagination->setItemsPerPage(5);

        $user = new User();
        $user->setFields('id, firstName, lastName');
        $user->setFilters($filters);
        $user->setPagination($pagination);
        $userFound = $user->fetchAll();
        // $userFound = $user->findBy();


        $this->view('Home', ['title' => 'Home', 'users' => $userFound, 'pagination' => $pagination]);
    }

}
