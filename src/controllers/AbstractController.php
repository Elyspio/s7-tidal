<?php


namespace controllers {

	use Twig\Environment;
	use Twig\Error\LoaderError;
	use Twig\Error\RuntimeError;
	use Twig\Error\SyntaxError;
	use Twig\Loader\FilesystemLoader;

	class AbstractController
	{


		/**
		 * @param string $template
		 * @param string[] $args
		 * @throws LoaderError
		 * @throws RuntimeError
		 * @throws SyntaxError
		 */
		protected function render(string $template, array $args = [] ): void
		{
			$this->twig->display($template . ".twig", $args);
		}

		protected Environment $twig;

		/**
		 * Router constructor.
		 */
		public function __construct()
		{

			$loader = new FilesystemLoader(__DIR__ . "/../views/template", __DIR__ . "/../views/template");
			$this->twig = new Environment($loader);

		}

	}
}