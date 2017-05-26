<?php

if(!defined('WPINC')) die;

class Auth {
	public function login($request) {
		if (!$request->get_param('username') || !$request->get_param('password')) {
			return "No login info";
		}

		$nonce = wp_create_nonce("wp_rest");
		$user = wp_signon([
			'user_login' => $_POST['username'], 
			'user_password' => $_POST['password'], 
			"rememberme" => true
		], false);

		if (is_wp_error($user)) {
			return $user;
		}

		return [
			'user' => $user,
			'nonce' => $nonce
		];
	}

	public function logout() {
		
	}
}
