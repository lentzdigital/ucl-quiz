<?php

if(!defined('WPINC')) die;

class UclQuizAdmin {
	protected $db;

	public function __construct() {
		add_action('add_meta_boxes', [$this, 'add_meta_boxes']);
		add_action('admin_enqueue_scripts', [$this, 'add_scripts_and_styles']);
		add_action('save_post', [$this, 'save_quiz'], 10, 3);
	}

	public function add_scripts_and_styles() {
		wp_register_script('handlebars', 'https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/4.0.10/handlebars.min.js');
		wp_register_script('ucl_quiz_admin_js', plugins_url('assets/scripts/ucl-quiz_admin.js', __FILE__), ['jquery']);
		wp_enqueue_style('ucl_quiz_admin_css', plugins_url('/assets/style/ucl-quiz_admin.css', __FILE__));
	}

	public function add_meta_boxes() {
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

	public function display_quiz_info_meta() {
		//$meta = $this->db->get_slider_meta(get_the_ID());
		$meta = [];
		$courses = [['id' => 1, 'name' => 'Biologi']];
		$levels = [1 => "Let", 2 => "Middel", 3 => "Svær"];

		require __DIR__ . '/../views/quiz-info_meta.php';
	}

	public function display_questions_meta() {
		wp_enqueue_script('handlebars');
		wp_enqueue_script('jquery-ui-sortable');
		$questions = [
			[
				'id' => 1,
				'question' => 'Test',
				'hint' => 'hej',
				'answers' => [
					[
						'id' => 1,
						'answer' => 'ga',
						'correct' => true
					],
					[
						'id' => 2,
						'answer' => 'to',
						'correct' => false
					]
				]
			],
			[
				'id' => 2,
				'question' => 'Tsfdsest',
				'hint' => 'hdsfdsej',
				'answers' => [
					[
						'id' => 3,
						'answer' => 'gasada',
						'correct' => true
					]
				]
			]
		];

		wp_localize_script('ucl_quiz_admin_js', 'question_data', $questions);
		wp_enqueue_script('ucl_quiz_admin_js');

		require __DIR__ . '/../views/questions_meta.php';
	}

	public function save_quiz($post_id, $post, $update) {
		if (!isset($_POST) || count($_POST) == 0 || get_post_type($post_id) != 'quiz') return;

		echo "<pre>";
		var_dump($_POST);
		die();
	}
}
