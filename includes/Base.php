<?php
if(!defined('WPINC')) die;

class Base
{


	/**
	 * Method to init post type methods
	 */


	public function add_post_types()
	{
		$this->add_quiz_post_type();
		$this->add_course_post_type();
	}


	/**
	 * Method for activation
	 */
	

	public static function activation()
	{
		self::set_tables();
	}


	/**
	 * Method for uninstall
	 */
	

	public static function uninstall()
	{
		self::delete_tables();
	}


	/**
	 * Method for creating quiz post type
	 */
	

	private function add_quiz_post_type()
	{
		register_post_type('quiz', [
			'public' => true,
			'label'  => 'Quizzes',
			'supports' => ['title']
		]);
	}

	/**
	 * Method for creating course post type
	 */
	

	private function add_course_post_type()
	{
		register_post_type('course', [
			'public' => true,
			'label'  => 'Courses',
			'supports' => ['title']
		]);
	}


	/**
	 * Method for deleting database tables
	 */
	

	private static function delete_tables()
	{
		global $wpdb;

		require_once __DIR__ . '/assets/uninstall-tables.php';
		require_once ABSPATH . 'wp-admin/includes/upgrade.php';

		foreach ($sql as $query) 
		{
			dbDelta($query);	
		}
	}


	/**
	 * Method for create database tables
	 */


	private static function set_tables() 
	{
	    global $wpdb;

		$charset_collate = $wpdb->get_charset_collate();

		require_once __DIR__ . '/assets/install-tables.php';
		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

		foreach($sql as $query)
		{
			dbDelta($query);
		}
	}
}
