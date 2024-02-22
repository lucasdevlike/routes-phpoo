<?php

namespace app\controllers;

use app\core\Request;
use app\support\Csrf;
use app\support\Validate;

class UserController extends Controller
{
    public function edit($params)
    {
        $this->view('user', ['title' => 'Editar User']);
    }

    public function update($params)
    {

        $validate = new Validate();
        $validate->validate([
            'firstName' => 'maxLen:10',
            'lastName' => 'required',
            'email' => 'required|email',
            'password' => 'required|maxLen:10',
        ]);

    }

}
