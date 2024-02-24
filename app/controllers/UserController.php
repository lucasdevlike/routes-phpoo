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
        $validated = $validate->validate([
            'firstName' => 'required',
            'lastName' => 'required',
            'email' => 'required|email',
            'password' => 'maxLen:10|required',
        ]);

        if (!$validated) {
            return redirect('/user/12');
        }
        dd($validated);

    }

}
