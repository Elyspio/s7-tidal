<?php

namespace controllers\router {


	class Endpoint
	{

		private array $callback;
		private string $route;
		private string $method;

		/**
		 * @param string $route
		 * @param array $callback
		 * @param string $method
		 */
		public function __construct(string $route, array $callback, string $method)
		{
			$this->callback = $callback;
			$this->route = $route;
			$this->method = $method;
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

		public function get_method(): string
		{
			return $this->method;
		}



	}
}

