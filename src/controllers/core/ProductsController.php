<?php


namespace controllers\core;


use config\Debug;
use controllers\AbstractController;
use controllers\router\DynamicRouter;
use controllers\router\Method;
use models\Session;

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

		if (Session::get_config()->get_user()->getId() !== null) {
			$products = $this->marketService->get_products_for_authenticated_user(Session::get_config()->get_user()->getId());
		} else {
			$products = $this->marketService->get_products_for_anonymous_user();
		}
		print_r($products);
		Debug::log($products);
		$this->render("/products/list", ["products" => $products]);
	}

	public function get_item($item) : void{
		$this->render("/products/item", ["id" => $item[0]]);

	}

}


DynamicRouter::add_route("/", [ProductsController::instance(), "get_products"], Method::$GET);
DynamicRouter::add_route("/products", [ProductsController::instance(), "get_products"], Method::$GET);
DynamicRouter::add_route("/products/:item", [ProductsController::instance(), "get_item"], Method::$GET);