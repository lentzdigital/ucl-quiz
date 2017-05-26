<?php

class Database_Handler {
	private $db;

	public function __construct() {
		global $wpdb;

		$this->db = $wpdb;
	}

	public function get_quiz_meta($quiz_id) {
		return [
			'course' => get_post_meta($quiz_id, 'uq_course', true),
			'level' => get_post_meta($quiz_id, 'uq_level', true),
		];
	}

	public function get_courses() {
		return get_posts(['post_type' => 'course']);
	}

	public function get_questions($quiz_id) {
		$questions = $this->db->get_results("SELECT * FROM {$this->db->prefix}questions WHERE quiz_id={$quiz_id}");
		$question_ids = implode(', ', array_column($questions, 'id'));
		$answers = $this->db->get_results("SELECT * FROM {$this->db->prefix}answers WHERE question_id IN ({$question_ids})");

		array_walk($questions, function(&$question) use($answers) {
			$question->answers = array_values(array_filter($answers, function($answer) use ($question) {
				return $answer->question_id == $question->id;
			}));
		});

		return $questions;
	}

	public function delete_questions($quiz_id) {
		$question_ids = implode(', ', $this->db->get_col("SELECT id FROM {$this->db->prefix}questions WHERE quiz_id=$quiz_id"));

		$this->db->query("DELETE FROM {$this->db->prefix}answers WHERE question_id IN ($question_ids)");
		$this->db->delete("{$this->db->prefix}questions", ['quiz_id' => $quiz_id]);
	}

	public function save_question($quiz_id, $question, $hint) {
		$this->db->insert("{$this->db->prefix}questions", [
			'quiz_id' => $quiz_id, 
			'question' => $question, 
			'hint' => $hint
		], ['%d', '%s', '%s']);

		return $this->db->insert_id;
	}

	public function save_answer($question_id, $answer, $correct) {
		$this->db->insert("{$this->db->prefix}answers", [
			'question_id' => $question_id, 
			'answer' => $answer, 
			'correct' => $correct
		], ['%d', '%s', '%d']);

		return $this->db->insert_id;
	}
}
