<?php
namespace todoApp\classes;
use todoApp\classes\Validate;
require_once 'Validate.php';
class Required implements Validate
{
    public function check($inputName, $value)
    {
        if (empty($value)) {
            return "$inputName is required";
        } else {
            return false;
        }
    }
}