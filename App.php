<?php
require_once 'inc/connection.php';
require_once 'classes/Request.php';
require_once 'classes/Session.php';
require_once 'classes/Validation.php';

use todoApp\classes\Request;
use todoApp\classes\Session;
use todoApp\classes\Validation;

$request = new Request;
$session = new Session;
$validation = new Validation;