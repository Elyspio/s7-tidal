<?php

namespace config;

class Debug
{

	/**
	 * Will only log public property
	 * @param $any
	 */
	static function log($any)
	{
		echo "<script>console.log(" . json_encode($any) . ")</script>";
	}
}