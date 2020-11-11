<?php


namespace models\db\repositories;

use models\db\entities\ProductEntity;

class ProductRepository extends Repository
{

	private function dbToEntity($db): ProductEntity
	{
		return new ProductEntity($db["id"], $db["name"], $db["description"], $db["price"], $db["img_name"]);
	}

	/**
	 * @param string|null $name_filter
	 * @return ProductEntity[]
	 */
	public function get_products(?string $name_filter): array
	{
		$query = "select * from products";
		if ($name_filter != null) {
			$query .= " where name like '%:name%'";
		}
		$smt = parent::$bdd->prepare($query);
		$smt->execute($name_filter !== null ?  [":name" => $name_filter]: null);

		$results = $smt->fetchAll();
		if (count($results) === 0) {
			return array();
		}

		$data = array_map(array($this, "dbToEntity"), $results);
		return $data;
	}

}


