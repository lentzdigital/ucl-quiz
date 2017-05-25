<?php 
$sql[] = "CREATE TABLE IF NOT EXISTS " . $wpdb->prefix . "answers (
  id int(11) NOT NULL AUTO_INCREMENT,
  question_id int(11) unsigned NOT NULL,
  answer varchar(200) NOT NULL,
  correct tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY  (id)
) $charset_collate;";

$sql[] = "CREATE TABLE IF NOT EXISTS ". $wpdb->prefix ."classes (
  id int(11) unsigned NOT NULL AUTO_INCREMENT,
  name varchar(255) DEFAULT NULL,
  PRIMARY KEY  (id)
) $charset_collate;";

$sql[] = "CREATE TABLE IF NOT EXISTS ".$wpdb->prefix."courses (
  id int(11) NOT NULL AUTO_INCREMENT,
  name varchar(100) NOT NULL,
  image varchar(255) DEFAULT NULL,
  PRIMARY KEY  (id)
) $charset_collate;";

$sql[] = "CREATE TABLE IF NOT EXISTS ".$wpdb->prefix."questions (
  id int(11) NOT NULL AUTO_INCREMENT,
  quiz_id int(11) unsigned NOT NULL,
  question text NOT NULL,
  type int(11) DEFAULT '1',
  hint varchar(255) DEFAULT NULL,
  PRIMARY KEY  (id)
) $charset_collate;";

$sql[] = "CREATE TABLE IF NOT EXISTS ".$wpdb->prefix."user_answer (
  id int(11) unsigned NOT NULL AUTO_INCREMENT,
  user_quiz_id int(11) DEFAULT NULL,
  user_id int(10) unsigned NOT NULL,
  answer_id int(10) unsigned NOT NULL,
  PRIMARY KEY  (id)
) $charset_collate;";

$sql[] = "CREATE TABLE IF NOT EXISTS ".$wpdb->prefix."user_course (
  id int(11) unsigned NOT NULL AUTO_INCREMENT,
  user_id int(10) unsigned NOT NULL,
  course_id int(10) unsigned NOT NULL,
  PRIMARY KEY  (id)
) $charset_collate;";

$sql[] = "CREATE TABLE IF NOT EXISTS ".$wpdb->prefix."user_quiz (
  id int(11) unsigned NOT NULL AUTO_INCREMENT,
  user_id int(11) unsigned NOT NULL,
  quiz_id int(10) unsigned NOT NULL,
  time int(11) DEFAULT NULL,
  PRIMARY KEY  (id)
) $charset_collate;";
