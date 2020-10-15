<?php

namespace controllers\router {
	interface IRouter
	{
		public function route(string $uri = null);
	}
}

