<?php

namespace App\bootstrap;

class Bootstrap {
	public function __construct() {
	  $this->initVars();
	}

	private function initVars() {
		return $userData = $_SESSION['user'];
	}
}