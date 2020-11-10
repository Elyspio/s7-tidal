<?php
session_start();

use controllers\router\Router;



//require_once(__DIR__ . "/./router/Router.php");
$c = new Router();
$c->route();
die();

