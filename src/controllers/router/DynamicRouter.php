<?php


namespace controllers\router {
	require_once(__DIR__ . "/Endpoint.php");
	require_once (__DIR__ . "/IRouter.php");
	require_once (__DIR__ . "/../errors/ErrorsController.php");
	require_once (__DIR__ . "/../../models/db/RepositoryExceptionCode.php");

	use controllers\core\ErrorsController;
	use models\db\RepositoryExceptionCode;


	class DynamicRouter implements IRouter
	{


		/**
		 * @var Endpoint[] dictionnary<uri, Endpoint>
		 */
		private static array $routes = [];


		public static function add_route(string $endpoint, $callback, string $method): void
		{
			self::$routes[$endpoint] = new Endpoint($endpoint, $callback, $method);
		}

		public function route(string $uri = null): void
		{
			RepositoryExceptionCode::add_error_codes_to_js();

			$endpoint = $this->get_endpoint($uri);
			call_user_func($endpoint->get_callback(), $this->get_params($uri, $endpoint));
		}


		/**
		 * @param string $uri
		 * @param Endpoint $endpoint
		 * @return mixed[]
		 */
		private function get_params(string $uri, Endpoint $endpoint): array {
			$regex =  $endpoint->get_regex();
			$res = [];
			preg_match_all( $regex, $uri,$res);
			return $res;

		}

		private function get_endpoint(string  $uri): Endpoint
		{
			$routes = self::$routes;

			usort($routes, static function(Endpoint $a, Endpoint $b) {
				return strlen($a->get_route()) > strlen($b->get_route()) ? -1 : 1;
			});

			foreach ($routes as $endpoint) {
				# echo "Method=" . $_SERVER['REQUEST_METHOD'] . "\t";
				if($_SERVER['REQUEST_METHOD'] === $endpoint->get_method()) {
					$regex = $endpoint->get_regex();
					# echo "REGEX=" . $regex . " for " . $endpoint->get_route() . "\n";
					if(count(preg_grep($regex, [$uri])) > 0) {
						return $endpoint;
					}
				}

			}

				return new Endpoint("error/404", call_user_func([ErrorsController::instance(), "get_404"]), Method::$GET);
		}
	}


	require_once (__DIR__ . "/../core/ProductsController.php");
	require_once (__DIR__ . "/../core/LoginController.php");




}





