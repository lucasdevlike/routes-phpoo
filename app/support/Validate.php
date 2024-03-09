<?php

namespace app\support;

use Exception;
use app\traits\Validations;

class Validate
{
    use Validations;

    private function getParam($validation, $param)
    {
        if (substr_count($validation, ':') == 1) {
            list($validation, $param) = explode(":", $validation);
        }
        return [$validation, $param];
    }

    private function validationExist($validation)
    {
        if (!method_exists($this, $validation)) {
            throw new Exception("O método {$validation} não existe na validação");
        }
    }

    public function validate(array $validationsFields)
    {

        $inputValidation = [];

        foreach ($validationsFields as $field => $validation) {

            $havePipes = str_contains($validation, '|');

            if (!$havePipes) {
                $param = '';

                [$validation, $param] = $this->getParam($validation, $param);

                $this->validationExist($validation);

                $inputValidation[$field] = $this->$validation($field, $param);

            } else {
                $validations =  explode('|', $validation);
                $param = '';
                foreach ($validations as $validation) {

                    [$validation, $param] = $this->getParam($validation, $param);
                    $this->validationExist($validation);

                    $inputValidation[$field] = $this->$validation($field, $param);

                    if($inputValidation[$field] === null) {
                        break;
                    }
                }
            }
        }
        return $this->returnValidation($inputValidation);

    }

    private function returnValidation($inputValidation)
    {
        Csrf::validateToken();
        if (in_array(null, $inputValidation, true)) {
            return null;
        }

        return $inputValidation;
    }

}
