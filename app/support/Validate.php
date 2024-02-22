<?php

namespace app\support;

use Exception;
use app\traits\Validations;

class Validate
{
    use Validations;

    public function validate(array $validationsFields)
    {
        foreach ($validationsFields as $field => $validation) {

            $havePipes = str_contains($validation, '|');

            if (!$havePipes) {
                $param = '';
                if (substr_count($validation, ':') == 1) {
                    list($validation, $param) = explode(":", $validation);
                }
                if (!method_exists($this, $validation)) {
                    throw new Exception("A validação {$validation} não existe");
                }
                $this->$validation($param);
                // dd($methodValidation, $param);

            }

        }
    }

}
