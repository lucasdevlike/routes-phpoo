<?php

namespace app\controllers;

use app\database\Filters;
use app\database\models\User;

class HomeController extends Controller
{
    public function index()
    {
        // $filters = new Filters();
        // $filters->where('users.id', '>', 2);
        // $filters->join('posts', 'users.id', '=', 'posts.userId', 'left join');

        // $user = new User();
        // $user->setFields('users.id, users.firstName, users.lastName, titlePost');
        // $user->setFilters($filters);
        // $userFound = $user->fetchAll();
        // dd($userFound);


        // $user = new User();
        // $created = $user->create([
        //     'firstName' => 'Alexandre',
        //     'lastName' => 'Cardoso',
        //     'email' => 'xandecar@gmail.com',
        //     'password' => '123456567'
        // ]);

        // $user = new User();
        // $user->update('id', 4, ['firstName' => 'Leticia LELE', 'lastName' => 'Moraes Fregonezi Sacilotto']);

        // dd($user);

        $arr = ['name' => 'alexandre'];
        dd(http_build_query($arr));

        $this->view('Home', ['title' => 'Home']);
    }

}
