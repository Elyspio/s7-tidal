<?php

namespace controllers\router;

class Endpoint
{

	private string $template;
	private array $params;

	/**
	 * Endpoint constructor.
	 * @param string $template
	 * @param array $params
	 */
	public function __construct(string $template, array $params = [])
	{
		$this->template = $template;
		$this->params = $params;
	}

	/**
	 * @return string
	 */
	public function getTemplate(): string
	{
		return $this->template . ".twig";
	}

	/**
	 * @return array
	 */
	public function getParams(): array
	{
		return $this->params;
	}
}