<?php


namespace models\services;

use models\data\ProductUser;


class MarketService extends Service
{
	/**
	 * @param string|null $name_filter
	 * @return ProductUser[]
	 */
	public function get_products(?string $name_filter = null): array
	{
		$products = $this->productRepository->get_products($name_filter);

		return $products;
	}
}