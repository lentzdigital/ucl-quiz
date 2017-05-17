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
}