<?php

namespace app\traits;

use app\core\Request;
use app\support\Flash;

trait Validations
{
    public function unique($field, $param)
    {
        $data = Request::input($field);

        $model = new $param();
        $model->setFields('id,firstName,lastName');

        $registerFound = $model->findBy($field, $data);

        if($registerFound) {
            Flash::set($field, "O {$data} já está em uso.");
            return null;
        }

        return strip_tags($data, '<p><b><span>');

    }

    public function email($field)
    {
        if (!filter_input(INPUT_POST, $field, FILTER_VALIDATE_EMAIL)) {
            Flash::set($field, "Esse campo precisa de um email válido");
            return null;
        }

        return strip_tags(Request::input($field), '<p><b><span>');
    }

    public function required($field)
    {
        $data = Request::input($field);

        if(empty($data)) {
            Flash::set($field, "O campo é obrigatório");
            return null;
        }
        return strip_tags($data, '<p><b><ul></ul><span>');
    }

    public function maxLen($field, $param)
    {
        $data = Request::input($field);
        if (strlen($data) > $param) {
            Flash::set($field, "Este campo aceita no máximo {$param} caractéres.");
            return null;
        }

        return strip_tags($data, '<p><b><span>');
    }

}
