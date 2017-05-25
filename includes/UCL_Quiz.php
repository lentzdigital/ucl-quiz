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
	

	protected $routes;


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
		$this->loader = new Loader;
		$this->routes = new Routes;
		$this->define_hooks();
		$this->define_routes();

		if (is_admin()) {
			require_once 'UclQuizAdmin.php';

			new UclQuizAdmin;
		}
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

	}

	/**
	 * Method to load dependencies
	 */
	

	private function load_dependencies()
	{
		require_once plugin_dir_path(__FILE__) . 'Routes.php';
		require_once plugin_dir_path(__FILE__) . 'Loader.php';
		require_once plugin_dir_path(__FILE__) . 'Base.php';
	}


	/**
	 * Method to init plugin
	 */
	

	public function init()
	{
		$this->loader->init();
		$this->routes->init();
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
