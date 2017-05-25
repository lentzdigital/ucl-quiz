<?php
if(!defined('WPINC')) die;

class Routes
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
		$this->add($this->routes, $route, $method, $component, $callback);
	}


	/**
	 * Loops through all routes from routes array and register them
	 */


	public function init()
	{
		foreach($this->routes as $route)
		{
			register_rest_route($this->namespace, $route['route'], [
				'method'   => $route['method'],
				'callback' => [
					$route['component'],
					$route['callback']
				], 
			]);
		}
	}


	/**
	 * Helper method for adding routes to routes array
	 * @param array $routes    Array containing routes
	 * @param string $route     URI for route
	 * @param string $method    HTTP method
	 * @param object $component Instant of class
	 * @param string $callback  Method name from init class
	 */
	

	private function add($routes, $route, $method, $component, $callback)
	{
		$routes[] = [
			'route'     => $route,
			'method'    => $method,
			'component' => $component,
			'callback'  => $callback
		];

		return $routes;
	}
}