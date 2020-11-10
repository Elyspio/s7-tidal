<?php


namespace controllers\core;


use controllers\AbstractController;



class ErrorsController extends AbstractController
{


	private static ErrorsController $instance;


	public static function instance(): self
	{
		if (!isset(self::$instance) ) {
			self::$instance = new self();
		}
		return self::$instance;
	}



	public function get_404(): void
	{
		$this->render("/errors/404");
	}

}