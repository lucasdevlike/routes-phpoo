<?php

namespace app\controllers;

use app\core\Request;
use app\support\Csrf;
use app\support\Validate;
use app\database\models\User;

class UserController extends Controller
{
    public function edit($params)
    {
        $this->view('user', ['title' => 'Editar User']);
    }

    public function update($params)
    {

        $validate = new Validate();
        $validated = $validate->validate([
            'firstName' => 'required',
            'lastName' => 'required',
            'email' => 'required|email|unique:'. User::class,
            'password' => 'maxLen:10|required',
        ]);

        if (!$validated) {
            return redirect('/user/12');
        }
        var_dump($validated);

    }

}
