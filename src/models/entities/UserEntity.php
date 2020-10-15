<?php


namespace models\entities {


	class UserEntity
	{
		private int $id;
		private string $first_name;
		private string $family_name;
		private string $address;
		private string $username;
		/**
		 * @var string stored as md5
		 */
		private string $password;

		/**
		 * UserEntity constructor.
		 * @param int|null $id
		 * @param string $first_name
		 * @param string $family_name
		 * @param string $address
		 * @param string $username
		 * @param string $password
		 */
		public function __construct(?int $id, string $first_name, string $family_name, string $address, string $username, string $password)
		{
			$this->id = $id;
			$this->first_name = $first_name;
			$this->family_name = $family_name;
			$this->address = $address;
			$this->username = $username;
			$this->password = $password;
		}


		public function get_id(): int
		{
			return $this->id;
		}

		public function get_first_name(): string
		{
			return $this->first_name;
		}


		public function get_family_name(): string
		{
			return $this->family_name;
		}


		public function get_address(): string
		{
			return $this->address;
		}


		public function get_username(): string
		{
			return $this->username;
		}

		public function get_password(): string
		{
			return $this->password;
		}

	}
}