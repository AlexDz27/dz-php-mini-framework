<?php

namespace App\services;

class Db {
	private static $instance;
	
	private $con;

	private function __construct() {
		$this->con = $this->connectToDb();
	}

	public static function getInstance() {
		if (!self::$instance) {
			self::$instance = new self();
		}

		return self::$instance;
	}
	
	public function getCon() {
	  return $this->con;
	}

	public function connectToDb() {
		$dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME;
		$con = null;

		try {
			$con = new \PDO($dsn, DB_USER, DB_PASS);
		} catch (\PDOException $e) {
			echo 'PDO Exception error: ' . $e->getMessage();
		}

		return $con;
	}
}