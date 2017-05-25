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
		$this->add_question_post_type();
		$this->add_answer_post_type();
	}


	/**
	 * Method for creating quiz post type
	 */
	

	private function add_quiz_post_type()
	{
		register_post_type('quiz', [
			'public' => true,
			'label'  => 'Quizzes'
		]);
	}


	/**
	 * Method for creating question post type
	 */
	

	private function add_question_post_type()
	{
		register_post_type('question', [
			'public' => true,
			'label'  => 'Questions'
		]);
	}


	/**
	 * Method for creating answer post type
	 */
	
	
	private function add_answer_post_type()
	{
		register_post_type('answer', [
			'public' => true,
			'label'  => 'Answers'
		]);
	}


	/**
	 * Method for activation
	 */
	

	public static function activation()
	{
		self::set_tables();
	}

	/**
	 * Method for deactivation
	 */


	public static function deactivation()
	{

	}


	/**
	 * Method for uninstall
	 */
	

	public static function uninstall()
	{
		require_once __DIR__ . '/assets/uninstall-tables.php';
		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

		foreach ($sql as $q) {
			dbDelta($q);	
		}
	}

	private static function set_tables() {
	    global $wpdb;

		$charset_collate = $wpdb->get_charset_collate();

		require_once __DIR__ . '/DB_Tables.php';
		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

		foreach ($sql as $q) {
			dbDelta($q);	
		}
	}
}
