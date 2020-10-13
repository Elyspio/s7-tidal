<?php


namespace controllers\router {
	require_once(__DIR__ . "/Endpoint.php");

	use Twig\Environment;
	use Twig\Loader\FilesystemLoader;

	class Router
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
			$this->add_route("/products", "product/list");
			$this->add_route("/products/:item", "product/item", ["item"]);

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
			$extracted = $this->extract($endpoint);

			$this->routes[$endpoint] = new Endpoint($template, $params);
		}

		/**
		 * @param string $endpoint
		 * @return array[
		 *  'action' => string,
		 *  'type' => "param" | "raw"
		 * ]
		 */
		private function extract(string $endpoint): array
		{
			$splited = explode("/", $endpoint);

			return array_map(function ($p) {
				$isParam = $this->containsParams($p);
				return [
					"name" => $isParam ? substr($p, 1) : $p,
					"type" => $isParam ? "param" : "raw"
				];

			}, array_slice($splited, 1));
		}

		private function containsParams(string $uri): bool
		{
			return strpos($uri, ":") !== false;
		}

		public function route(): void
		{
			$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

			if($this->is_static_file($uri)) {
				$this->serve_static_files($uri);
			}
			else {
				$endpoint = $this->get_endpoint();
				$this->twig->display($endpoint->getTemplate(), $endpoint->getParams());
			}
		}

		private function get_endpoint(): Endpoint
		{
			$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
			$extracted = $this->extract($uri);

			$search = "";
			foreach ($extracted as $item) {
				if ($item["type"] === "param") {
					$search .= preg_quote("/", "/") . "(.+)";
				} else {
					$search .= preg_quote("/", "/")  . $item["name"];
				}
			}

			$search = "/^" . $search . "$/";

			foreach (array_keys($this->routes) as $endpoint) {
				echo "<script>console.log(" . json_encode(["regex" => $search, "endpoint" => $endpoint]). ")</script>";
				if (preg_grep($search, [$endpoint]) !== false) {
					echo "<script>console.log(true)</script>";
					return $this->routes[$endpoint];
				}
			}

			return new Endpoint("errors/404");

		}

		private function serve_static_files(string $uri): void
		{
			$data = pathinfo($uri);
			if($data["extension"] === "css") {
				header('content-type: text/css');
			}

			echo file_get_contents (__DIR__ . "/../.." . $uri);
		}

		/** Only css / js files are considered as static files
		 * @param string $uri
		 * @return bool
		 */
		private function is_static_file(string $uri): bool
		{
			$data = pathinfo($uri);
			if(array_key_exists("extension", $data)) {
				require_once (__DIR__ . "/../../config/router.php");
				/** @noinspection PhpUndefinedVariableInspection */
				return (in_array($data["extension"], $servable_files, true));
			}
			return false;
		}

	}

}





