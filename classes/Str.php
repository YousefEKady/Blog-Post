<?php
namespace todoApp\classes;
use todoApp\classes\Validate;
require_once 'Validate.php';
class Str implements Validate
{
    public function check($inputName, $value)
    {
        if (is_numeric($value)) {
            return "$inputName must be a string";
        } else {
            return false;
        }
    }
}