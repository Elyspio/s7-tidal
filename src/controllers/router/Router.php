<?php


namespace controllers\router {

	require_once(__DIR__ . "/Endpoint.php");
	require_once(__DIR__ . "/StaticRouter.php");
	require_once(__DIR__ . "/DynamicRouter.php");
	require_once(__DIR__ . "/IRouter.php");

	class Router implements IRouter
	{
		private DynamicRouter $dynamic_router;
		private StaticRouter  $static_router;

		/**
		 * Router constructor.
		 */
		public function __construct()
		{

			$this->dynamic_router = new DynamicRouter();
			$this->static_router = new StaticRouter();

		}

		public function route(string $null = null): void
		{
			$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
			$this->static_router->is_static_file($uri) ? $this->static_router->route($uri) : $this->dynamic_router->route($uri);
		}
	}

}





