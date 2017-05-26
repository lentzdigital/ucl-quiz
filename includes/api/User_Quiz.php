<?php

if(!defined('WPINC')) die;

require_once plugin_dir_path(__FILE__) . '/../Database_Handler.php';

class User_Quiz {
	private $db;

	public function __construct() {
		$this->db = new Database_Handler;
	}


	/**
	 * Saves a users quiz result
	 * 
	 * @return array list of correct answers for the quiz
	 */


	public function store($request) {
		$user = 1;
		$data = $request->get_params();

		if (!key_exists('time', $data) || !key_exists('answers', $data)) {
			return ["error" => "Not valid data provided"];
		}

		$user_quiz_id = $this->db->save_user_quiz($user, $data['id'], $data['time']);
		$response = [];

		foreach ($data['answers'] as $answer) {
			if (!key_exists('answer_id', $answer)) {
				return "No answer_id on answer";
			}

			$this->db->save_user_answer($user_quiz_id, $answer['answer_id']);

			$response[] = [
				'id' => $this->db->get_correct_answer($answer['question_id'])->id,
				'question_id' => $answer['question_id']
			];
		}

		return $response;
	}
}
