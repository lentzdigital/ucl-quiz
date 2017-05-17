<?php
if(!defined('WPINC')) die;

class Loader
{


	/**
	 * Array containing all actions
	 * @var array
	 */
	

	protected $actions;


	/**
	 * Array container all filters
	 * @var array
	 */
	

	protected $filters;


	/**
	 * Declare protected properties actions and filters as empty arrays.
	 */
	

	public function __construct()
	{
		$this->actions = [];
		$this->filters = [];
	}


	/**
	 * Add's an action to the actions array
	 * @param string $hook      Hook where method is executed
	 * @param object $component Instant of class
	 * @param string $callback  Method name
	 */
	

	public function add_action($hook, $component, $callback)
	{
		$this->actions = $this->add($this->actions, $hook, $component, $callback);
	}


	/**
	 * Add's a filter to the filters array
	 * @param string $hook      Hook where method is executed
	 * @param object $component Instant of class
	 * @param string $callback  Method name
	 */
	

	public function add_filter($hook, $component, $callback)
	{
		$this->filters = $this->add($this->filters, $hook, $component, $callback);
	}


	/**
	 * Executes all actions and filters
	 */
	

	public function init()
	{
		foreach($this->filters as $hook)
		{
			add_filter($hook['hook'], [$hook['component'], $hook['callback']]);
		}

		foreach($this->actions as $hook)
		{
			add_filter($hook['hook'], [$hook['component'], $hook['callback']]);
		}
	}


	/**
	 * Adds an action or a filter to actions or filters array
	 * @param array $hooks     	Array where hook is added
	 * @param string $hook      Hook where method is executed
	 * @param object $component Instant of class
	 * @param string $callback  Method name
	 */
	

	private function add($hooks, $hook, $component, $callback)
	{
		$hooks[] = [
			'hook'      => $hook,
			'component' => $component,
			'callback'  => $callback,
		];

		return $hooks;
	}
}