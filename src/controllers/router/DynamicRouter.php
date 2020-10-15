<?php


namespace controllers\router {
	require_once(__DIR__ . "/Endpoint.php");
	require_once (__DIR__ . "/IRouter.php");

	use Twig\Environment;
	use Twig\Loader\FilesystemLoader;


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
			$this->add_route("/", "test");
			$this->add_route("/products", "products/list");
			$this->add_route("/products/:item", "products/item", ["item"]);

			$loader = new FilesystemLoader(__DIR__ . "/../../views/template", __DIR__ . "/../../views/template");
			$this->twig = new Environment($loader);


		}

		/**
		 * @param string $endpoint
		 * @param string $template
		 * @param string[] $params mapping of URI parameter to be used in template
		 */
		public function add_route(string $endpoint, string $template, array $params = []): void
		{
			$this->routes[$endpoint] = new Endpoint($endpoint, $template, $params);
		}

		public function route(string $uri = null): void
		{
			$endpoint = $this->get_endpoint($uri);
			error_log("endpoint: " . $endpoint->getTemplate());

			$this->get_params($uri, $endpoint);

			$this->twig->display($endpoint->getTemplate(), $endpoint->getParams());
		}


		/**
		 * @param string $uri
		 * @param Endpoint $endpoint
		 * @return mixed[]
		 */
		private function get_params(string $uri, Endpoint $endpoint): array {
			$regex =  $endpoint->getRegex();
			$res = [];
			preg_match_all( $regex, $uri,$res);
			return $res;

		}

		private function get_endpoint(string  $uri): Endpoint
		{

			$routes = $this->routes;

			usort($routes, static function(Endpoint $a, Endpoint $b) {
				return strlen($a->getRoute()) > strlen($b->getRoute()) ? -1 : 1;
			});

			foreach ($routes as $endpoint) {
				$regex = $endpoint->getRegex();
				echo "REGEX=" . $regex . " for " . $endpoint->getTemplate() . "\n";
				if(count(preg_grep($regex, [$uri])) > 0) {
					return $endpoint;
				}
			}

			return new Endpoint("error/404", "errors/404",);


		}



		private function containsParams(string $uri): bool
		{
			return strpos($uri, ":") !== false;
		}



	}

}





