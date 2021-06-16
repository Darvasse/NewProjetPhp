<?php
namespace web;
use App\Src\Autoloader;

define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(__FILE__) . DS . '..' . DS);

require_once __DIR__ . '/../App/Src/Autoloader.php';
Autoloader::register();

$app = require_once __DIR__ . '/../App/bootstrap.php';
$app->run();