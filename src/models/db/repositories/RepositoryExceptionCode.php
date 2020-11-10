<?php




namespace models\db\repositories {




	class RepositoryExceptionCode
	{
		public static $violating_unicity_restriction = "UNIQUE";

		public static function add_error_codes_to_js(): void {

			// On donne tous les codes d'erreurs au JS
			echo "<script lang='js'>window.DB_ERROR_CODES = {}; \n";

			$class = new \ReflectionClass('\models\db\repositories\RepositoryExceptionCode');
			$arr = $class->getStaticProperties();
			foreach ($arr as $field => $value) {
				echo "window.DB_ERROR_CODES['$field'] = '$value'\n";
			}
			echo "</script>";
		}
	}



}
