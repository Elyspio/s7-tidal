<?php


namespace controllers {

    use controllers\router\Endpoint;
    use Twig\Environment;
	use Twig\Error\LoaderError;
	use Twig\Error\RuntimeError;
	use Twig\Error\SyntaxError;
	use Twig\Loader\FilesystemLoader;

	class AbstractController
	{


		private static Environment $twig;

		private static function get_template_engine(): Environment {
			if(!isset(self::$twig)) {
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