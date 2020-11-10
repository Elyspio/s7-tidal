<?php


namespace controllers\core;


use controllers\AbstractController;
use controllers\router\DynamicRouter;
use controllers\router\Method;

require_once(__DIR__ . "/../AbstractController.php");
require_once(__DIR__ . "/../../controllers/router/DynamicRouter.php");
require_once(__DIR__ . "/../../controllers/router/Method.php");
DynamicRouter::add_route("/login", [LoginController::instance(), "get_login_page"], Method::$GET);
DynamicRouter::add_route("/login/add", [LoginController::instance(), "get_login_add"], Method::$GET);
DynamicRouter::add_route("/api/login/verify", [LoginController::instance(), "verify_identity"], Method::$GET);
DynamicRouter::add_route("/api/login/create", [LoginController::instance(), "create_account"], Method::$POST);

class LoginController extends AbstractController
{
	private static LoginController $instance;


	public static function instance(): self
	{
		if (!isset(self::$instance)) {
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

	public function verify_identity(): void
	{

		echo "\nverify";
	}

	public function create_account(): void
	{
		$this->loginService->create_account();
	}
}
