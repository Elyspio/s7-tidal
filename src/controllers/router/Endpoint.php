<?php

namespace controllers\router {


	class Endpoint
	{

		private array $callback;
		private string $route;

		/**
		 * @param string $route
		 * @param array $callback
		 */
		public function __construct(string $route, array $callback)
		{
			$this->callback = $callback;
			$this->route = $route;
		}

		/**
		 * @return array method of the controller that will be called
		 */
		public function get_callback()
		{
			return $this->callback;
		}



		/**
		 * @return string the regex version of this endpoint ':x' are replaced with (.*)
		 */
		public function get_regex(): string
		{

			$search = "";

			$path = explode("/", $this->get_route());

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
		public function get_route(): string
		{
			return $this->route;
		}

	}
}

