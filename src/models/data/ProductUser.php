<?php

namespace models\data;
use models\db\entities\ProductEntity;
use models\db\entities\UserEntity;

class ProductUser
{
	private ProductEntity $product;
	private UserEntity $user;
	private int $quantity;

	/**
	 * ProductUser constructor.
	 * @param ProductEntity $product
	 * @param UserEntity $user
	 * @param int $quantity
	 */
	public function __construct(ProductEntity $product, UserEntity $user, int $quantity = 0)
	{
		$this->product = $product;
		$this->user = $user;
		$this->quantity = $quantity;
	}

	/**
	 * @return ProductEntity
	 */
	public function get_product(): ProductEntity
	{
		return $this->product;
	}

	/**
	 * @param ProductEntity $product
	 */
	public function set_product(ProductEntity $product): void
	{
		$this->product = $product;
	}

	/**
	 * @return UserEntity
	 */
	public function get_user(): UserEntity
	{
		return $this->user;
	}

	/**
	 * @param UserEntity $user
	 */
	public function set_user(UserEntity $user): void
	{
		$this->user = $user;
	}

	/**
	 * @return int
	 */
	public function get_quantity(): int
	{
		return $this->quantity;
	}

	/**
	 * @param int $quantity
	 */
	public function set_quantity(int $quantity): void
	{
		$this->quantity = $quantity;
	}


}