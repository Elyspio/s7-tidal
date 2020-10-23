<?php

session_start();

use controllers\router\Router;

require_once(__DIR__ . "/../models/db/UserRepository.php");
require_once(__DIR__ . "/./router/Router.php");


$c = new Router();
return $c->route();




// /api



