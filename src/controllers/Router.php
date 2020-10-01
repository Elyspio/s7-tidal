<?php


namespace controllers;




class Router
{
	public function move() {

		$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
		$uri = explode( '/', $uri );

		// all of our endpoints start with /person
		// everything else results in a 404 Not Found



		print_r($uri);
	}
}