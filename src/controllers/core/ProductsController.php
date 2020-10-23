<?php


namespace controllers\core;


use controllers\AbstractController;
use controllers\router\DynamicRouter;
use controllers\router\Method;

require_once (__DIR__ . "/../AbstractController.php");
require_once (__DIR__ . "/../router/DynamicRouter.php");
require_once (__DIR__ . "/../../controllers/router/Method.php");


DynamicRouter::add_route("/", [ProductsController::instance(), "get_products"], Method::$GET);
DynamicRouter::add_route("/products", [ProductsController::instance(), "get_products"], Method::$GET);
DynamicRouter::add_route("/products/:item", [ProductsController::instance(), "get_item"], Method::$GET);

class ProductsController extends AbstractController
{


	private static ProductsController $instance;


	public static function instance(): self
	{
		if (!isset(self::$instance) ) {
			self::$instance = new self();
		}
		return self::$instance;
	}



	public function get_products(): void
	{
		$this->render("/products/list");
	}

	public function get_item($item) : void{
		$this->render("/products/item", ["id" => "toto"]);

	}

}