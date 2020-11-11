<?php

namespace models\db\repositories;

use models\db\entities\BasketEntity;

class BasketRepository extends Repository
{

	private function dbToEntity($db): BasketEntity
	{
		return new BasketEntity($db["id"], $db["customer"], $db["product"], $db["quantity"]);
	}

	/**
	 * @param int $userId
	 * @return BasketEntity[]
	 */
	public function get_basket_for_user(int $userId): array
	{
		$query = "select * from basket where customer = :userId";
		$smt = parent::$bdd->prepare($query);
		$smt->execute([":user_id" => $userId]);
		$results = $smt->fetchAll();
		if (count($results) === 0) {
			return array();
		}
		return array_map(array($this, "dbToEntity"), $results);
	}

}


