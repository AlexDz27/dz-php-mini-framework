<?php

namespace App\controllers;

class PageController extends BaseController {
	public function contacts() {
	  $this->templateRender('contacts');
	}
}