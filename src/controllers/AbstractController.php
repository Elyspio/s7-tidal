<?php


namespace controllers {

	use models\services\LoginService;
	use models\services\MarketService;
	use Twig\Environment;
	use Twig\Error\LoaderError;
	use Twig\Error\RuntimeError;
	use Twig\Error\SyntaxError;
	use Twig\Loader\FilesystemLoader;

	require_once(__DIR__ . "/../models/services/LoginService.php");
	require_once(__DIR__ . "/../models/services/MarketService.php");


	class AbstractController
	{


		private static Environment $twig;

		protected LoginService $loginService;
		protected MarketService $marketService;

		/**
		 * Service constructor.
		 */
		public function __construct()
		{
			if (!isset($this->loginService)) $this->loginService = new LoginService();
			if (!isset($this->marketService)) $this->marketService = new MarketService();
		}


		private static function get_template_engine(): Environment
		{
			if (!isset(self::$twig)) {
				$loader = new FilesystemLoader(__DIR__ . "/../views/template", __DIR__ . "/../views/template");
				self::$twig = new Environment($loader);
			}
			return self::$twig;
		}

		/**
		 * @param string $template
		 * @param string[] $args
		 * @throws LoaderError
		 * @throws RuntimeError
		 * @throws SyntaxError
		 */
		protected function render(string $template, array $args = [] ): void
		{
			self::get_template_engine()->display($template . ".twig", $args);
		}
	
	}
}