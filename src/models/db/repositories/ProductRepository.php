<?php


namespace models\db\repositories;

use models\db\entities\ProductEntity;

require_once(__DIR__ . "/../entities/ProductEntity.php");

require_once(__DIR__ . "/Repository.php");



class ProductRepository extends Repository
{

	private function dbToEntity($db): ProductEntity {
		return new ProductEntity($db["id"], $db["name"], $db["description"], $db["price"]);
	}

	/**
	 * @param string $name_filter
	 * @return ProductEntity[]
	 */
	public function get_products(string $name_filter): array
	{
		$query = "select * from products where name = :name";
		$smt = parent::$bdd->prepare($query);
		$smt->execute([":name" => $name_filter]);
		$results = $smt->fetchAll();
		error_log("result: " . json_encode($results));

		if(count($results) === 0) {
			return array();
		}




		return array_map(array($this, "dbToEntity"), $results);
	}

}


