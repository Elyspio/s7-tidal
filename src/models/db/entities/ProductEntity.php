<?php


namespace models\db\entities {


	class ProductEntity
	{
		private ?int $id;
		private string $description;
		private string $name;
		private float $price;
		private string $imagePath;

		/**
		 * ProductEntity constructor.
		 * @param int|null $id
		 * @param string $name
		 * @param string $description
		 * @param float $price
		 * @param string $imagePath
		 */
		public function __construct(?int $id, string $name, string $description, float $price, string $imagePath)
		{
			$this->id = $id;
			$this->description = $description;
			$this->name = $name;
			$this->price = $price;
			$this->imagePath = $imagePath;

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
		public function setId(?int $id)
		{
			$this->id = $id;
		}

		/**
		 * @return string
		 */
		public function getDescription(): string
		{
			return $this->description;
		}

		/**
		 * @param string $description
		 */
		public function setDescription(string $description): void
		{
			$this->description = $description;
		}

		/**
		 * @return string
		 */
		public function getName(): string
		{
			return $this->name;
		}

		/**
		 * @param string $name
		 */
		public function setName(string $name): void
		{
			$this->name = $name;
		}

		/**
		 * @return float
		 */
		public function getPrice(): float
		{
			return $this->price;
		}

		/**
		 * @param float $price
		 */
		public function setPrice(float $price): void
		{
			$this->price = $price;
		}

		/**
		 * @return string
		 */
		public function getImagePath(): string
		{
			return $this->imagePath;
		}

		/**
		 * @param string $imagePath
		 */
		public function setImagePath(string $imagePath): void
		{
			$this->imagePath = $imagePath;
		}

	}
}