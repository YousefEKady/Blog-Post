<?php
namespace todoApp\classes;
require_once 'Required.php';
require_once 'Str.php';

class Validation
{
    private $errors = [];
    public function endValidate($inputName, $value, $rules)
    {
        foreach ($rules as $rule) {
            $rule = "todoApp\classes\\" . $rule; // Namespace
            $obj = new $rule;
            $result = $obj->check($inputName, $value);
            if ($result != false) {
                $this->errors[] = $result;
            }
        }
    }

    public function getError()
    {
        return $this->errors;
    }
}