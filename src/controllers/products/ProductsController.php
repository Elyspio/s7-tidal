<?php


namespace controllers\products;


use controllers\AbstractController;

require_once (__DIR__ . "/../AbstractController.php");


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