<?php

namespace App\models;

use App\services\Db;

class BaseModel {
	protected $db;

	public function __construct() {
		$this->db = Db::getInstance()->getCon();
	}
}