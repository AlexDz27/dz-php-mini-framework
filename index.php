<?php
require_once __DIR__ . '/vendor/autoload.php';

use App\services\Config;
use App\services\Router;

use App\bootstrap\Bootstrap;

$config = new Config();
$router = new Router();

$bs = new Bootstrap();