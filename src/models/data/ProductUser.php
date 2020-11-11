<?php

namespace models\data;
use models\db\entities\ProductEntity;
use models\db\entities\UserEntity;

class ProductUser
{
	public ProductEntity $product;
	private UserEntity $user;
	public int $quantity;

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
	public function getProduct(): ProductEntity
	{
		error_log("tes");
		return $this->product;
	}

	/**
	 * @param ProductEntity $product
	 */
	public function setProduct(ProductEntity $product): void
	{
		$this->product = $product;
	}

	/**
	 * @return UserEntity
	 */
	public function getUser(): UserEntity
	{
		return $this->user;
	}

	/**
	 * @param UserEntity $user
	 */
	public function setUser(UserEntity $user): void
	{
		$this->user = $user;
	}

	/**
	 * @return int
	 */
	public function getQuantity(): int
	{
		return $this->quantity;
	}

	/**
	 * @param int $quantity
	 */
	public function setQuantity(int $quantity): void
	{
		$this->quantity = $quantity;
	}


}