<?php

namespace controllers\router {
	class Endpoint
	{

		private string $template;
		private array $params;
		private string $route;

		/**
		 * Endpoint constructor.
		 * @param string $template
		 * @param array $params
		 * @param string $route
		 */
		public function __construct(string $route, string $template, array $params = [])
		{
			$this->template = $template;
			$this->params = $params;
			$this->route = $route;
		}

		/**
		 * @return string
		 */
		public function getTemplate(): string
		{
			return $this->template . ".twig";
		}

		/**
		 * @return string[]
		 */
		public function getParams(): array
		{
			return $this->params;
		}

		/**
		 * @return string the regex version of this endpoint ':x' are replaced with (.*)
		 */
		public function getRegex(): string
		{

			$search = "";

			$path = explode("/", $this->getRoute());

			$path = array_filter($path, static function ($a) {
				return $a !== '';
			});

			if (count($path) === 0) {
				$search = "\/";
			}

			foreach ($path as $item) {
				$search .= "\/" . ((strpos($item, ":") !== false) ? "([^\/]+)" : $item);
			}
			return "/^" . $search . "$/";
		}

		/**
		 * @return string
		 */
		public function getRoute(): string
		{
			return $this->route;
		}

	}
}

