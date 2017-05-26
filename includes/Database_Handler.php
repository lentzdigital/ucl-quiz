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

	public function get_quizzes() {
		return get_posts(['post_type' => 'quiz']);
	}

	public function get_quiz($id) {
		return get_post($id);
	}

	public function get_questions($quiz_id, $with_correct = true) {
		$questions = $this->db->get_results("SELECT * FROM {$this->db->prefix}questions WHERE quiz_id={$quiz_id}");
		$question_ids = implode(', ', array_column($questions, 'id'));
		$answers = $this->db->get_results("SELECT * FROM {$this->db->prefix}answers WHERE question_id IN ({$question_ids})");

		array_walk($questions, function(&$question) use($answers, $with_correct) 
		{
			$question->answers = array_values(array_filter($answers, function($answer) use ($question) 
			{
				return $answer->question_id == $question->id;
			}));

			//Remove the correct key if $with_correct is false
			if (!$with_correct) 
			{
				$question->answers = array_map(function($answer)
				{
					unset($answer->correct);

					return $answer;
				}, $question->answers);
			}
		});

		return $questions;
	}

	public function get_correct_answer($question_id) {
		return $this->db->get_row("SELECT * FROM {$this->db->prefix}answers WHERE question_id={$question_id} AND correct=1");
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

	public function save_user_quiz($user_id, $quiz_id, $time) 
	{
		$this->db->insert("{$this->db->prefix}user_quiz", [
			'user_id' => $user_id,
			'quiz_id' => $quiz_id,
			'time' => $time
		], ['%d', '%d', '%d']);

		return $this->db->insert_id;
	}

	public function save_user_answer($user_quiz_id, $answer) 
	{
		$this->db->insert("{$this->db->prefix}user_answer", [
			'user_quiz_id' => $user_quiz_id,
			'answer_id' => $answer
		], ['%d', '%s']);

		return $this->db->insert_id;
	}
}
