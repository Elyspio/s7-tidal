<?php


namespace controllers\router {
	require_once(__DIR__ . "/Endpoint.php");
	require_once (__DIR__ . "/IRouter.php");
	require_once (__DIR__ . "/../products/ProductsController.php");
	require_once (__DIR__ . "/../errors/ErrorsController.php");

	use controllers\products\ErrorsController;
	use controllers\products\ProductsController;
	use Twig\Environment;


	class DynamicRouter implements IRouter
	{


		/**
		 * @var Endpoint[] dictionnary<uri, Endpoint>
		 */
		private array $routes = [];

		private Environment $twig;

		/**
		 * Router constructor.
		 */
		public function __construct()
		{
			$this->add_route("/", [ProductsController::instance(), "get_products"]);
			$this->add_route("/products", [ProductsController::instance(), "get_products"]);
			$this->add_route("/products/:item", [ProductsController::instance(), "get_item"]);
		}

		public function add_route(string $endpoint, $callback): void
		{
			$this->routes[$endpoint] = new Endpoint($endpoint, $callback);
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
			$routes = $this->routes;

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

}





