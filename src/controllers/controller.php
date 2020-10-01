<?php

use controllers\Router;



require(__DIR__ . "/../models/db/UserDao.php");
require(__DIR__ . "/./Router.php");



$c = new Router();
$c->move();
	$c = new UserDao();
	$c->getUsers();




// /api



