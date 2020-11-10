<?php


namespace models\services;

use models\db\entities\ProductEntity;

require_once (__DIR__ . "\Service.php");

class MarketService extends Service
{
	/**
	 * @param string $name_filter
	 * @return ProductEntity[]
	 */
	public function get_products(string $name_filter): array
	{
		$this->productRepository->get_products($name_filter);
	}
}