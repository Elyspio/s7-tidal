<?php


namespace controllers\router {
	require_once(__DIR__ . "/Endpoint.php");
	require_once (__DIR__ . "/IRouter.php");
	require_once (__DIR__ . "/../errors/ErrorsController.php");

	use controllers\core\ErrorsController;
	use Twig\Environment;


	class DynamicRouter implements IRouter
	{


		/**
		 * @var Endpoint[] dictionnary<uri, Endpoint>
		 */
		private static array $routes = [];


		public static function add_route(string $endpoint, $callback): void
		{
			self::$routes[$endpoint] = new Endpoint($endpoint, $callback);
		}

		public function route(string $uri = null): void
		{
			$endpoint = $this->get_endpoint($uri);
			print_r($endpoint->get_route());
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
				$regex = $endpoint->get_regex();
				echo "REGEX=" . $regex . " for " . $endpoint->get_route() . "\n";
				if(count(preg_grep($regex, [$uri])) > 0) {
					return $endpoint;
				}
			}

			return new Endpoint("error/404", call_user_func([ErrorsController::instance(), "get_404"]));
		}
	}


	require_once (__DIR__ . "/../core/ProductsController.php");
	require_once (__DIR__ . "/../core/LoginController.php");

}





