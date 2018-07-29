<?php

namespace App\controllers;

use App\helpers\StringHelper as sh;

use App\models\ProductModel;
use App\models\UserModel;
use Respect\Validation\Validator as v;
use Respect\Validation\Exceptions\NestedValidationException;

class ProductController extends BaseController {
	protected $model;
	protected $userModel;

	public function __construct() {
		$this->model = new ProductModel();
		$this->userModel = new UserModel();
	}

	public function index() {
		$products = $this->model->getAllProducts();

		// test user
		$userData = $this->userModel->getSignedInUser('tst', '123');
		$this->userModel->authenticate($userData);

		$this->templateRender('products', compact(['products']));
	}

	public function prikol() {
	  echo 'qwe';
	}

	public function add() {
		$this->redirectIfNotLogged();

		$errors = [];

		$image = null;
		$title = '';
		$text = '';

		$userId = (int)$this->getUserData()['id'];

		if (isset($_POST['prod'])) {
			// Inputs specific
			$title = sh::sanitize($_POST['add-title']);
			$text = sh::sanitize($_POST['text']);

			$titleValidator = v::alnum()->length(2)->notEmpty()->setName('Title field');
			$textValidator = v::alnum()->length(5)->notEmpty()->setName('Text field');

			try {
				$titleValidator->assert($title);
			} catch (NestedValidationException $ex) {
				$errors['title'] = $ex->getMessages();
			}

			try {
				$textValidator->assert($text);
			} catch (NestedValidationException $ex) {
				$errors['text'] = $ex->getMessages();
			}

			// File specific
			$targetImg = 'public/img/uploads/products/' . basename($_FILES['product-img']['name']);
			$imgName = basename($_FILES['product-img']['name']);

			if (!getimagesize($_FILES['product-img']['tmp_name'])) {
				$errors['image'][] = 'File must be only of image type';
			}

//			if (file_exists($targetFile)) {
//				$errors[] = 'Sorry, file already exists.';
//			}

			if ($_FILES['product-img']['size'] > 5000000) {
				$errors[] = 'Sorry, your file is larger than 5 MB';
			}

			if (empty($errors)) {
				if (!move_uploaded_file($_FILES['product-img']['tmp_name'], $targetImg)) {
					$errors[] = "Error uploading file";
				} else {
					$lastInsertId = (int)$this->model->add($title, $text, $userId);
					$this->model->addImage($imgName, $lastInsertId, $userId);

					$this->redirect('/');
				}
			}
		}

	  $this->templateRender('add-product', compact(['errors', 'title', 'text']));
	}

	public function show() {
	  echo 'tbd' . '<br>';
	  echo '<a href="/">Back</a>';
	}
}