<?php

require(__DIR__ . "/Dao.php");





class UserDao extends Dao
{

	private string $name;


	/**
	 * @return UserDao[]
	 */
	public static function getUsers(): array
	{
		$c = self::$bdd->query('select * from  customers');
		print_r($c->fetchAll());
	}
}


?>