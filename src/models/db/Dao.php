<?php






class Dao
{
	protected static PDO $bdd;


	public function __construct()
	{
		require_once(__DIR__ . "/../../config/db.php");

		if (!isset(self::$bdd)) {
			self::$bdd = new PDO("mysql:host=" . $DB_HOST . ";dbname=" . $DB_NAME, $DB_USER, $DB_PASSWORD);
		}
	}


}

?>