<?php


namespace controllers\core;


use controllers\AbstractController;
use controllers\router\DynamicRouter;

require_once (__DIR__ . "/../AbstractController.php");
require_once (__DIR__ . "/../../controllers/router/DynamicRouter.php");



DynamicRouter::add_route("/login", [LoginController::instance(), "get_login_page"]);
DynamicRouter::add_route("/login/add", [LoginController::instance(), "get_login_add"]);

class LoginController extends AbstractController
{


	private static LoginController $instance;


	public static function instance(): self
	{
		if (!isset(self::$instance) ) {
			self::$instance = new self();
		}
		return self::$instance;
	}



	public function get_login_page(): void
	{
		$this->render("/login/login_page");
	}

	public function get_login_add(): void
	{
		$this->render("/login/login_add");
	}


}