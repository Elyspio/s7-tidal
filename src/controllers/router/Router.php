<?php


namespace controllers\router {

	require_once(__DIR__ . "/Endpoint.php");
	require_once(__DIR__ . "/StaticRouter.php");
	require_once(__DIR__ . "/DynamicRouter.php");
	require_once(__DIR__ . "/IRouter.php");

	use Twig\Environment;
	use Twig\Loader\FilesystemLoader;


	class Router implements IRouter
	{


		/**
		 * @var Endpoint[] dictionnary<uri, Endpoint>
		 */
		private array $routes = [];

		private DynamicRouter $dynamic_router;
		private StaticRouter  $static_router;

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
			$this->dynamic_router = new DynamicRouter();
			$this->static_router = new StaticRouter();

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

		public function route(string $null = null): void
		{
			$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
			$this->static_router->is_static_file($uri) ? $this->static_router->route($uri) : $this->dynamic_router->route($uri);
		}

	}

}





