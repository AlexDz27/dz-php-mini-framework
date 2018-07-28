<?php

namespace App\controllers;

use App\exceptions\ViewsException;

class BaseController {
	public function redirectIfLogged() {
	  if (!empty($_SESSION['user'])) {
	  	if (isset($_SERVER['HTTP_REFERER'])) {
			  $this->redirect($_SERVER['HTTP_REFERER']);
		  } else {
	  		$this->redirect('/');
		  }
	  }
	}

	public function redirectIfNotLogged() {
		if (empty($_SESSION['user'])) {
			if (isset($_SERVER['HTTP_REFERER'])) {
				$this->redirect($_SERVER['HTTP_REFERER']);
			} else {
				$this->redirect('/');
			}
		}
	}
	
	public function getUserData() {
	  return $_SESSION['user'];
	}
	
	public function redirect($path) {
	  header('Location: ' . $path);
	}

	public function render404() {
	  header('HTTP/1.1 404 Not Found');

	  $this->templateRender('404');
	}

	public function templateRender(string $fileName, array $vars = []) {
		$userData = null;

		if (!empty($_SESSION['user'])) {
			$userData = $_SESSION['user'];
		}

		$vars['userData'] = $userData;

		$this->render('layouts/header', compact('userData'));
		$this->render('templates/' . $fileName, $vars);
		$this->render('layouts/footer', compact('userData'));
	}
	
	public function render(string $fileName, array $vars = [], bool $doEcho = true) {
		$fileName = VIEWS_PATH . $fileName . '.php';
		$output = '';

		try {
			if (!file_exists($fileName)) {
				throw new ViewsException('No views file found - ' . $fileName);
			}
		} catch (ViewsException $e) {
			$e->getDebugInfo();
		}

		ob_start();

		extract($vars);

		require_once($fileName);

		$output = ob_get_clean();

		if ($doEcho) {
			echo $output;
		} else {
			return $output;
		}
	}
}