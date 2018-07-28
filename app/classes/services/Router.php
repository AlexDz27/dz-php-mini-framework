<?php

namespace App\services;

use App\controllers\BaseController;

use App\controllers\PageController;
use App\controllers\ProductsController;
use App\controllers\UserController;

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
			'sign-up' => ['ctrlName' => UserController::class, 'actionName' => 'signUp'],
			'sign-in' => ['ctrlName' => UserController::class, 'actionName' => 'signIn'],
			'profile' => ['ctrlName' => UserController::class, 'actionName' => 'profile'],
			'logout' => ['ctrlName' => UserController::class, 'actionName' => 'logout'],
			'ajax' => ['ctrlName' => UserController::class, 'actionName' => 'ajax'],
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
		$url = strtolower(trim($_SERVER['REQUEST_URI'], '/'));

		return explode('?', $url)[0]; // explode and get first element to allow GET ? params
	}

	public static function getLastUrlPart() {
		$url = static::getUrl();
		$parts = explode('/', $url);
		$lastPart = end($parts);

		return $lastPart;
	}
}