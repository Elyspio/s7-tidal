<?php

namespace models;

use models\data\ProductUser;
use models\db\entities\UserEntity;

class Session
{

	/**
	 * @var ProductUser[]
	 */
	private array $basket;
	private UserEntity $user;

	function __construct()
	{
		$this->user = new UserEntity(null, "", "", "", "", "", "");
		$this->basket = [];
	}

	static function get_config(): Session {
		if(!isset($_SESSION["config"])) self::create_annonymous_config();
		return $_SESSION["config"];
	}


	static function create_annonymous_config()
	{
		$_SESSION["config"] = new Session();
	}

	/**
	 * @return ProductUser[]
	 */
	public function get_basket(): array
	{
		return $this->basket;
	}

	/**
	 * @param ProductUser[] $basket
	 */
	public function set_basket(array $basket): void
	{
		$this->basket = $basket;
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


}