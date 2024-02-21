<?php

namespace app\controllers;

use app\core\Request;
use app\support\Csrf;

class UserController extends Controller
{
    public function edit($params)
    {
        $this->view('user', ['title' => 'Editar User']);
    }

    public function update($params)
    {
        Csrf::validateToken();
        // $response = Request::only(['password','lastName']);
        // $response = Request::only('firstName');
        // $response = Request::excepts(['firstName', 'lastName']);
        // $response = Request::excepts('firstName');
        // dd($response);
    }


}
