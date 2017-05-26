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

		if (is_admin()) {
			require_once 'Ucl_Quiz_Admin.php';

			new Ucl_Quiz_Admin;
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
		$quiz = new Quiz;
		$this->routing->add_route('/quiz/', 'GET', $quiz, 'index');
		$this->routing->add_route('/quiz/((?P<id>\d+))', 'GET', $quiz, 'show');

		$userquiz = new User_Quiz;
		$this->routing->add_route('/user/quiz/((?P<id>\d+))', 'POST', $userquiz, 'store');

		$auth = new Auth;
		$this->routing->add_route('/user/login', 'POST', $auth, 'login');
		$this->routing->add_route('/user/logout', 'POST', $auth, 'logout');

		$leaderboard = new Leaderboard;
		$this->routing->add_route('/leaderboard/((?P<id>\d+))', 'GET', $leaderboard, 'show');
	}

	/**
	 * Method to load dependencies
	 */
	

	private function load_dependencies()
	{
		$dependencies = [
			'Routing',
			'Loader',
			'Base',
		];

		foreach($dependencies as $file)
		{
			require_once plugin_dir_path(__FILE__) . $file . '.php';
		}
	}


	private function load_api_dependencies()
	{
		$dependecies = [
			'Quiz',
			'User_Quiz',
			'Auth',
			'Leaderboard',
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
