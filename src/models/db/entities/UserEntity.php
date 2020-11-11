<?php


namespace models\db\entities {


	class UserEntity
	{
		private ?int $id;
		private string $first_name;
		private string $family_name;
		private string $address;
		private string $username;
		/**
		 * @var string stored as raw
		 */
		private string $password;
		private string $mail;

		/**
		 * UserEntity constructor.
		 * @param int|null $id
		 * @param string $first_name
		 * @param string $family_name
		 * @param string $address
		 * @param string $username
		 * @param string $password
		 * @param string $mail
		 */
		public function __construct(?int $id, string $first_name, string $family_name, string $address, string $username, string $password, string $mail)
		{
			$this->id = $id;
			$this->first_name = $first_name;
			$this->family_name = $family_name;
			$this->address = $address;
			$this->username = $username;
			$this->password = $password;
			$this->mail = $mail;
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
		 * @return string
		 */
		public function getFirstName(): string
		{
			return $this->first_name;
		}

		/**
		 * @param string $first_name
		 */
		public function setFirstName(string $first_name): void
		{
			$this->first_name = $first_name;
		}

		/**
		 * @return string
		 */
		public function getFamilyName(): string
		{
			return $this->family_name;
		}

		/**
		 * @param string $family_name
		 */
		public function setFamilyName(string $family_name): void
		{
			$this->family_name = $family_name;
		}

		/**
		 * @return string
		 */
		public function getAddress(): string
		{
			return $this->address;
		}

		/**
		 * @param string $address
		 */
		public function setAddress(string $address): void
		{
			$this->address = $address;
		}

		/**
		 * @return string
		 */
		public function getUsername(): string
		{
			return $this->username;
		}

		/**
		 * @param string $username
		 */
		public function setUsername(string $username): void
		{
			$this->username = $username;
		}

		/**
		 * @return string
		 */
		public function getPassword(): string
		{
			return $this->password;
		}

		/**
		 * @param string $password
		 */
		public function setPassword(string $password): void
		{
			$this->password = $password;
		}

		/**
		 * @return string
		 */
		public function getMail(): string
		{
			return $this->mail;
		}

		/**
		 * @param string $mail
		 */
		public function setMail(string $mail): void
		{
			$this->mail = $mail;
		}


	}
}