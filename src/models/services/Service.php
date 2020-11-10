<?php


namespace models\services;


require_once (__DIR__ . "/../db/repositories/ProductRepository.php");
require_once (__DIR__ . "/../db/repositories/UserRepository.php");

use models\db\repositories\ProductRepository;
use models\db\repositories\UserRepository;

class Service
{
	protected ProductRepository $productRepository;
	protected UserRepository $userRepository;

	/**
	 * Service constructor.
	 */
	public function __construct()
	{
		if(!isset($this->productRepository)) $this->productRepository = new ProductRepository();
		if(!isset($this->userRepository)) $this->userRepository = new userRepository();
	}


}