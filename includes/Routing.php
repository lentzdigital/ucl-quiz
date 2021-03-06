<?php
if(!defined('WPINC')) die;

class Routing
{


	/**
	 * Array containing all routes
	 * @var array
	 */
	

	private $routes;


	/**
	 * String containing namespace for plugin
	 * @var string
	 */
	

	private $namespace;


	/**
	 * Declare routes as empty array and set namespace
	 */
	

	public function __construct()
	{
		$this->routes    = [];
		$this->namespace = 'ucl-quiz/v1';
	}


	/**
	 * Add a route to the routes array
	 * @param string $route     URI for route
	 * @param string $method    HTTP method
	 * @param object $component Instant of class
	 * @param string $callback  Method from init class
	 */
	

	public function add_route($route, $method, $component, $callback)
	{
		$this->routes[] = [
			'route'     => $route,
			'method'    => $method,
			'component' => $component,
			'callback'  => $callback
		];

		return $this->routes;
	}


	/**
	 * Loops through all routes from routes array and register them
	 */


	public function init()
	{
		if (count($this->routes) == 0) {
			return;
		}

		add_action('rest_api_init', function()
		{
			foreach($this->routes as $rest)
			{
				register_rest_route($this->namespace, $rest['route'], [
					'methods'  => $rest['method'],
					'callback' => [
						$rest['component'],
						$rest['callback']
					] 
				]);
			}
		});
	}

}
