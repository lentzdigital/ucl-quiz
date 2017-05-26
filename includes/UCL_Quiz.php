<?php
if(!defined('WPINC')) die;

class UCL_Quiz
{


	/**
	 * Instant of loader class
	 * @var object
	 */
	

	protected $loader;


	/**
	 * Instant of Routes class
	 * @var object
	 */
	

	protected $routing;


	/**
	 * Plugin slug
	 * @var string
	 */
	

	protected $plugin_slug;


	/**
	 * Plugin version number
	 * @var string
	 */
	

	protected $version;


	/**
	 * Declare plugin slug and plugin version
	 * Init dependencies and hooks method
	 */
	

	public function __construct()
	{
		$this->plugin_slug = 'ucl-quiz';
		$this->version     = '0.1.0';

		$this->load_dependencies();
		$this->load_api_dependencies();
		$this->loader  = new Loader;
		$this->routing = new Routing;
		$this->define_routes();
		$this->define_hooks();
	}


	/**
	 * Method where scripts and stylesheets is added
	 */
	

	public function add_resources()
	{
		
	}


	/**
	 * Method to init classes and run method through loader
	 */
	

	public function define_hooks()
	{
		$base = new Base;
		$this->loader->add_action('init', $base, 'add_post_types');
	}

	public function define_routes()
	{
		$quiz = new Quiz;
		$this->routing->add_route('/quiz/getall/', 'GET', $quiz, 'get_all');
	}

	/**
	 * Method to load dependencies
	 */
	

	private function load_dependencies()
	{
		$dependencies = [
			'Routing',
			'Loader',
			'Base'
		];

		foreach($dependencies as $file)
		{
			require_once plugin_dir_path(__FILE__) . $file . '.php';
		}
	}


	private function load_api_dependencies()
	{
		$dependecies = [
			'Quiz'
		];

		foreach($dependecies as $file)
		{
			require_once plugin_dir_path(__FILE__) . 'api/' . $file . '.php';
		}
	}


	/**
	 * Method to init plugin
	 */
	

	public function init()
	{
		$this->loader->init();
		$this->routing->init();
	}


	/**
	 * Method to retrieve plugin version number
	 * @return string Plugin version number
	 */
	

	public function get_version()
	{
		return $this->version;
	}

	public function set_tables()
	{
	
	}
}
