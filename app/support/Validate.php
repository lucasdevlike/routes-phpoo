<?php

namespace app\support;

use Exception;
use app\traits\Validations;

class Validate
{
    use Validations;

    public function validate(array $validationsFields)
    {

        $inputValidation = [];

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

                $inputValidation[$field] = $this->$validation($field, $param);
                // dd($methodValidation, $param);

            } else {
                $validations =  explode('|', $validation);
                $param = '';
                foreach ($validations as $validation) {
                    if (substr_count($validation, ':') == 1) {
                        list($validation, $param) = explode(":", $validation);
                    }

                    if (!method_exists($this, $validation)) {
                        throw new Exception("O método {$validation} não existe na validação");
                    }

                    $inputValidation[$field] = $this->$validation($field, $param);

                    // var_dump($inputValidation[$field]);

                    if(empty($inputValidation[$field])) {
                        break;
                    }

                }
            }

        }
    }

}
