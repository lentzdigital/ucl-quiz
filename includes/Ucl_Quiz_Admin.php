<?php

if(!defined('WPINC')) die;

require_once 'Database_Handler.php';

class Ucl_Quiz_Admin 
{
	protected $db;

	public function __construct() 
	{
		add_action('add_meta_boxes', [$this, 'add_meta_boxes']);
		add_action('admin_enqueue_scripts', [$this, 'add_scripts_and_styles']);
		add_action('save_post', [$this, 'save_quiz'], 10, 3);

		$this->db = new Database_Handler;
	}

	public function add_scripts_and_styles() 
	{
		wp_register_script('handlebars', 'https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/4.0.10/handlebars.min.js');
		wp_register_script('ucl_quiz_admin_js', plugins_url('assets/scripts/ucl-quiz_admin.js', __FILE__), ['jquery']);
		wp_enqueue_style('ucl_quiz_admin_css', plugins_url('/assets/style/ucl-quiz_admin.css', __FILE__));
	}

	public function add_meta_boxes() 
	{
		add_meta_box(
			'quiz_info', 
			'Quiz info', 
			[$this, 'display_quiz_info_meta'], 
			'quiz', 
			'side'
		);

		add_meta_box(
			'questions', 
			'Questions', 
			[$this, 'display_questions_meta'], 
			'quiz', 
			'normal'
		);
	}

	public function display_quiz_info_meta() 
	{
		$meta = $this->db->get_quiz_meta(get_the_ID());
		$courses = $this->db->get_courses();
		$levels = [1 => "Let", 2 => "Middel", 3 => "Svær"];

		require __DIR__ . '/../views/quiz-info_meta.php';
	}

	public function display_questions_meta() 
	{
		wp_enqueue_script('handlebars');
		wp_enqueue_script('jquery-ui-sortable');
		$questions = $this->db->get_questions(get_the_ID());
		wp_localize_script('ucl_quiz_admin_js', 'question_data', $questions);
		wp_enqueue_script('ucl_quiz_admin_js');

		require __DIR__ . '/../views/questions_meta.php';
	}

	public function save_quiz($post_id, $post, $update) 
	{
		if (!isset($_POST) || count($_POST) == 0 || get_post_type($post_id) != 'quiz') return;

		if (isset($_POST['uq_course']) && is_numeric($_POST['uq_course'])) 
		{
            update_post_meta($post_id, 'uq_course', $_POST['uq_course']);
        }

		if (isset($_POST['uq_level']) && is_numeric($_POST['uq_course'])) 
		{
            update_post_meta($post_id, 'uq_level', $_POST['uq_level']);
        }

		if (isset($_POST['uq_name'])) 
		{
			$this->db->delete_questions($post_id);

			for ($i = 0; $i < count($_POST['uq_name']); $i++) 
			{
				$question = sanitize_text_field($_POST['uq_name'][$i]);
				$hint = sanitize_text_field($_POST['uq_hint'][$i]);

				$question_id = $this->db->save_question($post_id, $question, $hint);

				if (!isset($_POST['uq_answers'][$i])) 
				{
					continue;
				}

				for ($j = 0; $j < count($_POST['uq_answers'][$i]); $j++) 
				{
					$answer = sanitize_text_field($_POST['uq_answers'][$i][$j]['name']);
					$correct = isset($_POST['uq_answers'][$i][$j]['correct']) ? 1 : 0;

					$this->db->save_answer($question_id, $answer, $correct);
				}
			}
		}
	}
}
