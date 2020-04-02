<?php
error_reporting(-1);

use vendor\core\Router;

define('ROOT', dirname(__DIR__));
define('APP', dirname(__DIR__) . '/app');

spl_autoload_register(function($class) {

    $file = ROOT . '/' . str_replace('\\', '/', $class) . '.php'; // для Linux;
    if (file_exists($file)) {
        require_once $file;
    }
});

$query = rtrim($_SERVER['QUERY_STRING'], '/');
$router = new Router();

Router::add('^$', ['controller' => 'Main', 'action' => 'index']);
Router::add('^(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$');

Router::dispatch($query);


