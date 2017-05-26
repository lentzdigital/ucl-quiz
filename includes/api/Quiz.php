<?php
if(!defined('WPINC')) die;

require_once plugin_dir_path(__FILE__) . '/../Database_Handler.php';

class Quiz
{
	private $db;

	public function __construct() 
	{
		$this->db = new Database_Handler;
	}

	public function index()
	{

		$quizzes = $this->db->get_quizzes();

		return array_map(function(&$quiz) 
		{
			$meta = $this->db->get_quiz_meta($quiz->ID);

			return [
				'id' => $quiz->ID,
				'title' => $quiz->post_title,
				'course_id' => $meta['course'],
				'level' => $meta['level'],
				'questions' => $this->db->get_questions($quiz->ID, false)
			];
		}, $quizzes);
	}

	public function show($data) 
	{
		return "Single quiz";
	}
}
