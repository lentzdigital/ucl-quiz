<?php

if(!defined('WPINC')) die;

require_once plugin_dir_path(__FILE__) . '/../Database_Handler.php';

class Leaderboard 
{
	public function __construct() 
	{
		$this->db = new Database_Handler;
	}


	/**
	 * Returns leaderboard for a specific quiz
	 */


	public function show($request) 
	{
		$quiz_id = $request->get_param('id');
		$leaderboard =  $this->db->get_leaderboard($quiz_id);
		$count = $this->db->get_question_count($quiz_id);

		array_walk($leaderboard, function(&$board) 
		{
			$board->correct_answers_count = $this->db->get_correct_count($board->id) ?: 0;
		});

		usort($leaderboard, function ($item1, $item2) 
		{
			if (($item2['correct_answers_count'] <=> $item1['correct_answers_count']) == 0) 
			{
				return $item1['time_seconds'] <=> $item2['time_seconds'];
			}
			return $item2['correct_answers_count'] <=> $item1['correct_answers_count'];
		});

		$user_id = $request->get_param('user_id') ?: get_current_user_id();
		$user_key = array_search($user_id, array_column($leaderboard, 'user_id'));

		return [
			'quiz_id' => $request->get_param('id'),
			'question_count' => $count,
			'leaderboard' => array_slice($leaderboard, 0, $user_key < 5 ? 6 : 5, true),
			'average_time' => array_sum(array_column($leaderboard, 'time_seconds')) / count($leaderboard),
			'average_score' => array_sum(array_column($leaderboard, 'correct_answers_count')) / count($leaderboard),
			'user_result' => $leaderboard[$user_key],
		];
	}
}
