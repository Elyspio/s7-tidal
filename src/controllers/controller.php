<?php

session_start();

use controllers\router\Router;

require(__DIR__ . "/../models/db/UserRepository.php");
require(__DIR__ . "/./router/Router.php");


$c = new Router();
return $c->route();




// /api



