<?php

namespace App\controllers;

use App\models\UserModel;

use App\helpers\StringHelper as sh;

use Respect\Validation\Validator as v;
use Respect\Validation\Exceptions\NestedValidationException;

class UserController extends BaseController {
	protected $model;

	public function __construct() {
	  $this->model = new UserModel();
	}

	public function signUp() {
		$this->redirectIfLogged();

		$errors = [];

		$userCreated = false;

		$username = '';
		$email = '';
		$password = '';

		if (isset($_POST['sign-up'])) {
			$username = sh::sanitize($_POST['username']);
			$email = sh::sanitize($_POST['email']);
			$password = sh::sanitize($_POST['password']);

			$usernameValidator = v::alnum()->length(2)->notEmpty()->setName('Username field');
			$emailValidator = v::email()->notEmpty()->setName('Email field');
			$passwordValidator = v::notEmpty()->length(2)->setName('Password field');
			
			try {
				$usernameValidator->assert($username);
			} catch (NestedValidationException $ex) {
				$errors['username'] = $ex->getMessages();
			}

			try {
				$emailValidator->assert($email);
			} catch (NestedValidationException $ex) {
				$errors['email'] = $ex->getMessages();
			}

			if ($this->model->checkEmailExists($email)) {
				$errors['email'][] = 'A user with such an email already exists';
			}

			try {
				$passwordValidator->assert($password);
			} catch (NestedValidationException $ex) {
				$errors['password'] = $ex->getMessages();
			}
			
			if (empty($errors)) {
				$userCreated = $this->model->createUser($username, $email, $password);

				$getParams = '?userCreated=true';

				$this->redirect('/sign-in' . $getParams);
			}
		}

		$this->templateRender('sign-up', compact(['username', 'email', 'errors', 'userCreated']));
	}
	
	public function signIn() {
		$this->redirectIfLogged();

		$errors = [];

		$username = '';
		$password = '';

		$userData = null;

		if (isset($_POST['sign-in'])) {
			$username = sh::sanitize($_POST['username']);
			$password = sh::sanitize($_POST['password']);

			$usernameValidator = v::alnum()->length(2)->notEmpty()->setName('Username field');
			$passwordValidator = v::notEmpty()->length(2)->setName('Password field');

			try {
				$usernameValidator->assert($username);
			} catch (NestedValidationException $ex) {
				$errors['username'] = $ex->getMessages();
			}

			try {
				$passwordValidator->assert($password);
			} catch (NestedValidationException $ex) {
				$errors['password'] = $ex->getMessages();
			}

			if (empty($errors)) {
				if (!($userData = $this->model->getSignedInUser($username, $password))) {
					$errors['username'][] = 'Wrong username or password. Try again';
				} else {
					$this->model->authenticate($userData);

					$this->redirect('/');
				}
			}
		}

		$this->templateRender('sign-in', compact(['username', 'errors', 'userCreated']));
	}

	public function profile() {
		$this->redirectIfNotLogged();
		
		$userId = (int)$this->getUserData()['id'];

		$errors = [];

		if (isset($_POST['ava'])) {
			$targetFile = 'public/img/uploads/avas/' . basename($_FILES['ava']['name']);

			if (!getimagesize($_FILES['ava']['tmp_name'])) {
				$errors[] = 'File must be only of image type';
			}

//			if (file_exists($targetFile)) {
//				$errors[] = 'Sorry, file already exists.';
//			}

			if ($_FILES['ava']['size'] > 5000000) {
				$errors[] = 'Sorry, your file is larger than 5 MB';
			}

			if (empty($errors)) {
				if (!move_uploaded_file($_FILES['ava']['tmp_name'], $targetFile)) {
					$errors[] = "Error uploading file";
				} else {
					$this->model->uploadAva($targetFile, $userId);
				}
			}
		}

	  $this->templateRender('profile', compact(['errors']));
	}

	public function ajax() {
	  echo 'ajax server response';
	}

	public function logout() {
	  $this->model->logoutUser();

	  $this->redirect('/');
	}
}