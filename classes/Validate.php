<?php
namespace todoApp\classes;

interface Validate
{
    public function check($inputName, $value);
}