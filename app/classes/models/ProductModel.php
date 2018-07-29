<?php

namespace App\models;

use App\exceptions\DbException;

class ProductModel extends BaseModel {
	public static $table = 'products';
	
	public function getAllProducts() {
		$q = "SELECT p.id ,p.title, p.description, DATE_FORMAT(p.date_added, '%D %M %H:%i') AS dt_created, pi.path, u.username FROM
 products p
LEFT JOIN product_images pi ON pi.product_id = p.id
INNER JOIN users u ON p.user_id = u.id ORDER BY dt_created DESC";

		$stmt = $this->db->prepare($q);
		$stmt->setFetchMode(\PDO::FETCH_ASSOC);

		try {
			if (!$stmt->execute()) {
				throw new DbException('Query to db returned false');
			}
		} catch (DbException $e) {
			$e->getDebugInfo();
		}

		$items = $stmt->fetchAll();
		return $items;
	}

	public function add($title, $description, $userId) {
		$q = "INSERT INTO " . static::$table . "(title, description, user_id) VALUES (:title,
		 :description, :user_id)";

		$stmt = $this->db->prepare($q);
		$stmt->bindParam(':title', $title, \PDO::PARAM_STR);
		$stmt->bindParam(':description', $description, \PDO::PARAM_STR);
		$stmt->bindParam(':user_id', $userId, \PDO::PARAM_INT);

		try {
			if (!$stmt->execute()) {
				$errInfo = $stmt->errorInfo();
				var_dump($errInfo);
				throw new DbException('Statement execution returned false - product not added.');
			}
		} catch (DbException $ex) {
			$ex->getDebugInfo();
		}

		return $this->db->lastInsertId();
	}
	
	public function addImage($path, $prodId, $userId) {
	  $q = "INSERT INTO product_images (path, product_id, user_id) VALUES (:path, :product_id, :user_id)";

	  $stmt = $this->db->prepare($q);
		$stmt->bindParam(':path', $path, \PDO::PARAM_STR);
		$stmt->bindParam(':product_id', $prodId, \PDO::PARAM_INT);
		$stmt->bindParam(':user_id', $userId, \PDO::PARAM_INT);

		try {
			if (!$stmt->execute()) {
				$errInfo = $stmt->errorInfo();
				throw new DbException('Statement execution returned false - product image not added');
			}
		} catch (DbException $ex) {
			$ex->getDebugInfo();
		}
	}
}