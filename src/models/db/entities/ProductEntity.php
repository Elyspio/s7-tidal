<?php


namespace models\db\entities {


	class ProductEntity
	{
		private ?int $id;
		private string $description;
		private string $name;
		private float $price;

		/**
		 * ProductEntity constructor.
		 * @param int|null $id
		 * @param string $name
		 * @param string $description
		 * @param float $price
		 */
		public function __construct(?int $id, string $name,  string $description, float $price)
		{
			$this->id = $id;
			$this->description = $description;
			$this->name = $name;
			$this->price = $price;
		}

		/**
		 * @return int|null
		 */
		public function get_id(): ?int
		{
			return $this->id;
		}

		/**
		 * @param int|null $id
		 */
		public function set_id(?int $id): void
		{
			$this->id = $id;
		}

		/**
		 * @return string
		 */
		public function get_description(): string
		{
			return $this->description;
		}

		/**
		 * @param string $description
		 */
		public function set_description(string $description): void
		{
			$this->description = $description;
		}

		/**
		 * @return string
		 */
		public function get_name(): string
		{
			return $this->name;
		}

		/**
		 * @param string $name
		 */
		public function set_name(string $name): void
		{
			$this->name = $name;
		}

		/**
		 * @return float
		 */
		public function get_price(): float
		{
			return $this->price;
		}

		/**
		 * @param float $price
		 */
		public function set_price(float $price): void
		{
			$this->price = $price;
		}

	}
}