<?php

/**
 * FRONT CONTROLLER
 * This is the entry point to the application
 * Every other request is handled via this file
 */

// define the path constants to use throughout the application
define('FCPATH', __DIR__ . '/');
define('ROOTPATH', dirname(FCPATH) . '/');
define('APPPATH', ROOTPATH . 'src/');
define('VIEWSPATH', APPPATH . 'Templates/');
define('CACHEPATH', ROOTPATH . 'cache/');

// composer autoloader
require_once(ROOTPATH . 'vendor/autoload.php');

// check if debugging is enabled
$baseConfig = new \Phplover\Config\Base;
if ($baseConfig->debugging === true) {
    // if debugging is enabled, load tracy debugger
    // tracy is used for debugging the errors in your app
    \Tracy\Debugger::enable(\Tracy\Debugger::DEVELOPMENT);

    // if debugging is enabled, load the .env file
    // .env is used to store sensitive info and environment variables
    $dotenv = Dotenv\Dotenv::createImmutable(ROOTPATH);
    $dotenv->load();
}

// Routing the Requests
$router = new \Phplover\Libraries\Router();
$router->routeAll([
    [
        'url' => '/',
        'controller' => 'Home',
        'method' => 'Index',
    ],
]);