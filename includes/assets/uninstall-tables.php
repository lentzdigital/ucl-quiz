<?php
$sql[] = "DROP TABLE IF EXISTS " . $wpdb->prefix . "answers;";
$sql[] = "DROP TABLE IF EXISTS " . $wpdb->prefix . "classes;";
$sql[] = "DROP TABLE IF EXISTS " . $wpdb->prefix . "courses;";
$sql[] = "DROP TABLE IF EXISTS " . $wpdb->prefix . "questions;";
$sql[] = "DROP TABLE IF EXISTS " . $wpdb->prefix . "user_answer;";
$sql[] = "DROP TABLE IF EXISTS " . $wpdb->prefix . "user_course;";
$sql[] = "DROP TABLE IF EXISTS " . $wpdb->prefix . "user_quiz;";
