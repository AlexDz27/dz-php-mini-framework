<?php

namespace App\models;

use App\exceptions\DbException;
use App\services\Db;

class BaseModel {
	protected $db;

	public static $table;

	public function __construct() {
		$this->db = Db::getInstance()->getCon();
	}

	public function getAll() {
	  $q = "SELECT * FROM " . static::$table;

		$stmt = $this->db->prepare($q);
		$stmt->setFetchMode(\PDO::FETCH_ASSOC);

		try {
			if (!$stmt->execute()) {
				throw new DbException('Query to db returned false');
			}
		} catch (DbException $e) {
			$e->getDebugInfo();
		}

		$entities = $stmt->fetchAll();
		return $entities;
	}
	
	public function getBy($what, $value) {
		$q = "SELECT * FROM " . static::$table . " WHERE " . $what . " = " . $value;

		$stmt = $this->db->prepare($q);
		$stmt->setFetchMode(\PDO::FETCH_ASSOC);

		try {
			if (!$stmt->execute()) {
				throw new DbException('Query to db returned false');
			}
		} catch (DbException $e) {
			$e->getDebugInfo();
		}

		$item = $stmt->fetch();
		return $item;
	}
}



