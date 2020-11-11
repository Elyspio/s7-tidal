<?php


namespace models\db\entities {


	class BasketEntity
	{
		private ?int $id;
		private int $user_id;
		private int $product_id;
		private int $quantity;

		/**
		 * BasketEntity constructor.
		 * @param int|null $id
		 * @param int $user_id
		 * @param int $product_id
		 * @param int $quantity
		 */
		public function __construct(?int $id, int $user_id, int $product_id, int $quantity)
		{
			$this->id = $id;
			$this->user_id = $user_id;
			$this->product_id = $product_id;
			$this->quantity = $quantity;
		}

		/**
		 * @return int|null
		 */
		public function getId(): ?int
		{
			return $this->id;
		}

		/**
		 * @param int|null $id
		 */
		public function setId(?int $id): void
		{
			$this->id = $id;
		}

		/**
		 * @return int
		 */
		public function getUserId(): int
		{
			return $this->user_id;
		}

		/**
		 * @param int $user_id
		 */
		public function setUserId(int $user_id): void
		{
			$this->user_id = $user_id;
		}

		/**
		 * @return int
		 */
		public function getProductId(): int
		{
			return $this->product_id;
		}

		/**
		 * @param int $product_id
		 */
		public function setProductId(int $product_id): void
		{
			$this->product_id = $product_id;
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
}