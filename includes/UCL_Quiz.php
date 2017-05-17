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

	}



	/**
	 * Method to load dependencies
	 */
	

	private function load_dependencies()
	{

	}


	/**
	 * Method to init plugin
	 */
	

	public function init()
	{
		$this->loader->init();
	}


	/**
	 * Method to retrieve plugin version number
	 * @return string Plugin version number
	 */
	

	public function get_verison()
	{
		return $this->version;
	}
}