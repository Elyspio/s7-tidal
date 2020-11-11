<?php


namespace models\services;

use models\data\ProductUser;
use models\Session;

class MarketService extends Service
{
	/**
	 * @param int $user_id
	 * @param string|null $name_filter
	 * @return ProductUser[]
	 */
	public function get_products_for_authenticated_user(int $user_id, ?string $name_filter = null): array
	{
		$products = $this->productRepository->get_products($name_filter);
		$basket = $this->basketRepository->get_basket_for_user($user_id);
		$user = $this->userRepository->get_user_by_id($user_id);
		$productUsers = [];
		foreach ($products as $product) {
			$quantity = 0;
			foreach ($basket as $value) {
				if ($value->get_product_id() === $product->getId()) {
					$quantity = $value->get_quantity();
				}
			}
			array_push($productUsers, new ProductUser($product, $user, $quantity));
		}
		Session::get_config()->set_basket($productUsers);
		return $productUsers;
	}

	/**
	 * @param string|null $name_filter
	 * @return ProductUser[]
	 */
	public function get_products_for_anonymous_user(string $name_filter = null): array
	{
		$products = $this->productRepository->get_products($name_filter);
		$config = Session::get_config();
		$productUsers = [];
		foreach ($products as $product) {
			$quantity = 0;
			foreach ($config->get_basket() as $product_user) {

				if ($product_user->getProduct()->getId() === $product->getId()) {
					$quantity = $product_user->getQuantity();
				}
			}
			array_push($productUsers, new ProductUser($product, $config->get_user(), $quantity));
		}
		return $productUsers;
	}

}