<?php

namespace App\controllers;

use App\models\ItemModel;
use App\services\Router;

class ProductsController extends BaseController {
	protected $model;

	public function index() {
		$this->model = new ItemModel();
		$items = $this->model->getAllItems();

	  $this->templateRender('products', compact('items'));
	}

	public function show() {
		$id = Router::getLastUrlPart();

		$this->model = new ItemModel();
		$item = $this->model->getOneItem($id);

		if (!$item) {
			$this->render404();
		} else {
			$this->templateRender('product', compact('item'));
		}
	}
}