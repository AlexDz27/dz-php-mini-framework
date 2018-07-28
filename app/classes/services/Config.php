<?php

namespace App\services;

class Config {
	public function __construct() {
		$this->defineApp();
		// can be 'dev' or 'prod'
		$this->defineEnvironment('dev');
		$this->defineDbConfig();
		$this->defineSession();
		$this->definePaths();
	}

	private function defineSession() {
		session_set_cookie_params(36000,"/");
		session_start();
	}

	private function defineApp() {
		define('APP_NAME', 'BuyFromMe');
		define('APP_TITLE', 'Buy From Me - Best merchant shop');
	}

	private function defineDbConfig() {
		define('DB_HOST', 'localhost');
		define('DB_NAME', 'buyfromme');
		define('DB_USER', 'root');
		define('DB_PASS', '');
	}

	private function defineEnvironment($envStatus = 'dev') {
		define('ENVIRONMENT', $envStatus);

		switch (ENVIRONMENT) {
			case 'dev':
				ini_set('display_errors', 1);
				error_reporting(E_ALL);
				break;
			default:
			case 'prod':
				error_reporting(0);
				ini_set('display_errors', 0);
				break;
		}
	}

	private function definePaths() {
		define('ROOT', $_SERVER['DOCUMENT_ROOT']);
		define('APP', ROOT . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR);
		define('VIEWS_PATH', APP . 'views' . DIRECTORY_SEPARATOR);
	}
}