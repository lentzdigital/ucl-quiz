<?php
/**
 * Plugin Name: UCL Quiz
 * Version: 0.1.0
 * Author: Team Kickass
 */
if(!defined('WPINC')) die;

require_once plugin_dir_path(__FILE__) . 'includes/UCL_Quiz.php';
require_once plugin_dir_path(__FILE__) . 'includes/Base.php';

register_activation_hook(__FILE__, ['Base', 'activation']);
register_uninstall_hook(__FILE__, ['Base', 'uninstall']);

$ucl_quiz = new UCL_Quiz;
$ucl_quiz->init();
