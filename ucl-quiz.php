<?php
/**
 * Plugin Name: UCL Quiz
 * Version: 0.1.0
 * Author: Team Kickass
 */
if(!defined('WPINC')) die;

require_once plugin_dir_path(__FILE__) . 'includes/UCL_Quiz.php';

$ucl_quiz = new UCL_Quiz;
$ucl_quiz->init();