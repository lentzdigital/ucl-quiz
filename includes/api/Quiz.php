<?php
if(!defined('WPINC')) die;

class Quiz
{
	public function get_all()
	{
		$query = get_posts(['post_type' => 'quiz']);

		$output = [];

		foreach($query as $quiz)
		{
			$data['title'] = $quiz->post_title;

			array_push($output, $data);
		}

		if(!isset($output) || empty($output)) {
			return false;
		}

		return $output;
	}
}