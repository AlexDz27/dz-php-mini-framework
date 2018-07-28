<?php

namespace App\models;

use App\exceptions\DbException;

class UserModel extends BaseModel {
	public static $table = 'users';

	public function getAllUsers() {
	  return $this->getAll();
	}

	public function getUserBy(string $what, $value) {
	  return $this->getBy($what, $value);
	}

	public function createUser($username, $email, $password) {
	  $q = "INSERT INTO " . static::$table . " (username, email, password) VALUES (:username, :email, :password)";

	  $hashedPass = password_hash($password, PASSWORD_DEFAULT);

	  $stmt = $this->db->prepare($q);
	  $stmt->bindParam(':username', $username, \PDO::PARAM_STR);
	  $stmt->bindParam(':email', $email, \PDO::PARAM_STR);
	  $stmt->bindParam(':password', $hashedPass, \PDO::PARAM_STR);

	  try {
	  	if (!$stmt->execute()) {
	  		throw new DbException('Statement execution returned false - user not created');
		  }
	  } catch (DbException $ex) {
			$ex->getDebugInfo();
		}
	}
	
	public function checkEmailExists($email) {
		$q = "SELECT COUNT(*) FROM users WHERE email = :email";

		$stmt = $this->db->prepare($q);
		$stmt->bindParam(':email', $email, \PDO::PARAM_STR);
		$stmt->execute();

		return $stmt->fetchColumn() ?: false;
	}

	public function getSignedInUser($username, $password) {
	  $q = "SELECT * FROM users WHERE username = :username";

	  $stmt = $this->db->prepare($q);
	  $stmt->bindParam(':username', $username, \PDO::PARAM_STR);
	  $stmt->setFetchMode(\PDO::FETCH_ASSOC);

		try {
			if (!$stmt->execute()) {
				throw new DbException('Statement execution returned false - user not fetched');
			}
		} catch (DbException $ex) {
			$ex->getDebugInfo();
		}

	  $userData = $stmt->fetch();

		return password_verify($password, $userData['password']) ? $userData : false;
	}

	public function logoutUser() {
	  $_SESSION['user'] = null;
	}

	public function uploadAva($avaPath, $userId) {
		$q = "UPDATE " . static::$table . " SET ava_path = :avaPath WHERE id = :userId";

		$stmt = $this->db->prepare($q);
		$stmt->bindParam(':avaPath', $avaPath, \PDO::PARAM_STR);
		$stmt->bindParam(':userId', $userId, \PDO::PARAM_INT);

		try {
			if (!$stmt->execute()) {
				throw new DbException('Statement execution returned false - image not uploaded');
			}
		} catch (DbException $ex) {
			$ex->getDebugInfo();
			return;
		}

		$_SESSION['user']['ava_path'] = $avaPath;
	}
}