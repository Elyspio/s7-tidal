<?php

use config\Debug;
use controllers\router\Router;
use models\Session;

$hasSession = !session_start();
if (!$hasSession) {
	Session::create_annonymous_config();
}
//require_once(__DIR__ . "/./router/Router.php");
$c = new Router();
$c->route();
Debug::log($_SESSION);
die();

