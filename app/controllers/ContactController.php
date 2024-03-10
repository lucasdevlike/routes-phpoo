<?php

namespace app\controllers;

use app\support\Email;
use app\support\Flash;
use app\support\Validate;

class ContactController extends Controller
{
    public function index()
    {
        $this->view('contact', ['title' => 'Contact']);
    }

    public function store()
    {
        $validate = new Validate();
        $validated = $validate->validate([
            'email'   => 'email|required',
            'subject' => 'required',
            'message' => 'required'
        ]);

        if (!$validated) {
            return redirect('/contact');
        }

        $email = new Email();
        // $email->from()->to([''])->template('contact')->message()->subject()->send();
        $sent = $email->from($validated['email'], 'Lucas Moraes')
                      ->to('lucasfregonezi@gmail.com')
                      ->message($validated['message'])
                      ->subject($validated['subject'])
                      ->send();

        if ($sent) {
            Flash::set('sent_success', 'Email enviado com sucesso');
            return redirect('/contact');
        } else {
            Flash::set('sent_error', 'Ocorreu um erro ao enviar o email');
            return redirect('/contact');

        }
        // dd($sent);
    }

}
