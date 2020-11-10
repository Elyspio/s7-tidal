<?php


namespace controllers\router {

	require_once (__DIR__ . "/IRouter.php");


	class StaticRouter implements IRouter
	{
		/** Only css / js files are considered as static files
		 * @param string $uri
		 * @return bool
		 */
		public function is_static_file(string $uri): bool
		{
			$data = pathinfo($uri);
			if (array_key_exists("extension", $data)) {
				require_once(__DIR__ . "/../../config/router.php");
				/** @noinspection PhpUndefinedVariableInspection */
				return (in_array($data["extension"], $servable_files, true));
			}
			return false;
			$ae = [];
		}

		public function route(string $uri = null): void
		{
			$data = pathinfo($uri);
			if ($data["extension"] === "css") {
				header('content-type: text/css');
			}

			echo file_get_contents(__DIR__ . "/../../views/public" . $uri);
		}
	}
}


