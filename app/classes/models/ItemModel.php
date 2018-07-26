<?php

namespace App\models;

use App\exceptions\DbException;

class ItemModel extends BaseModel {
	public function getAllItems() {
	  $q = "SELECT * FROM items";

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

	public function getOneItem($id) {
	  $q = "SELECT * FROM items WHERE id = :itemId";

	  $stmt = $this->db->prepare($q);
	  $stmt->bindParam(':itemId', $id, \PDO::PARAM_INT);
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