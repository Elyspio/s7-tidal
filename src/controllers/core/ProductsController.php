<?php


namespace controllers\core;


use controllers\AbstractController;
use controllers\router\DynamicRouter;
use controllers\router\Method;



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
		$this->marketService->get_products();
		$this->render("/products/list");
	}

	public function get_item($item) : void{
		$this->render("/products/item", ["id" => $item[0]]);

	}

}


DynamicRouter::add_route("/", [ProductsController::instance(), "get_products"], Method::$GET);
DynamicRouter::add_route("/products", [ProductsController::instance(), "get_products"], Method::$GET);
DynamicRouter::add_route("/products/:item", [ProductsController::instance(), "get_item"], Method::$GET);