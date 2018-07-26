<?php

namespace App\services;

use App\controllers\BaseController;

use App\controllers\PageController;
use App\controllers\ProductsController;

class Router {
	private $routes = [];

	public function __construct() {
		$this->routes = $this->getRoutes();
		$this->initialize();
	}

	protected function getRoutes() {
		return [
			'contacts' => ['ctrlName' => PageController::class, 'actionName' => 'contacts'],
			'product/[0-9]+' => ['ctrlName' => ProductsController::class, 'actionName' => 'show'],
			'' => ['ctrlName' => ProductsController::class, 'actionName' => 'index']
		];
	}

	private function initialize() {
		$url = static::getUrl();
		$isCorrectRoute = false;

		foreach ($this->routes as $route => $routeHandlers) {
			if (preg_match("~^$route$~", $url)) {
				$isCorrectRoute = true;

				$ctrlName = $routeHandlers['ctrlName'];
				$actionName = $routeHandlers['actionName'];

				$ctrl = new $ctrlName();
				$ctrl->$actionName();

				break;
			}
		}

		if (!$isCorrectRoute) {
			$ctrl = new BaseController();
			$ctrl->render404();
		}
	}

	public static function getUrl() {
		return strtolower(trim($_SERVER['REQUEST_URI'], '/'));
	}

	public static function getLastUrlPart() {
		$url = static::getUrl();
		$parts = explode('/', $url);
		$lastPart = end($parts);

		return $lastPart;
	}
}