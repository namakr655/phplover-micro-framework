<?php

namespace Phplover\Libraries;

/**
 * This is a very basic router meant to teach newbies
 * how routers actually work
 */
class Router
{

    public function routeAll(array $allRoutes)
    {
        foreach ($allRoutes as $route) {
            $this->routeEach($route);
        }
    }

    public function routeEach(array $data)
    {

        // get the BaseConfig for default controller and method values
        $baseConfig = new \Phplover\Config\Base;
        $default_controller = $baseConfig->default_controller;
        $default_method = $baseConfig->default_method;

        // get the controller name from array passed
        // if not found, use 'Home' as default
        $controller = $data['controller'] ?? $default_controller;

        // get the method name from array passed
        // if not found, use 'Index' as default
        $method = $data['method'] ?? $default_method;

        // get the params from array passed
        // if not found, use empty array as default
        $params = $data['params'] ?? [];

        // set the controller name with full namespace
        $controller = 'Namakr655\\Phplover\\Controllers\\' . $controller;

        // check if controller exists
        if (class_exists($controller)) {

            // if yes, create a new instance of the controller
            $controller = new $controller;

            // check if method exists
            if (method_exists($controller, $method)) {

                // callback to the method with parameters passed
                if (count($params) > 0) {
                    call_user_func_array([$controller, $method], $params);
                } else {
                    $controller->$method();
                }
            } else {
                die('Method does not exist'); # die if method does not exist
            }
        } else {
            die('Controller does not exist'); # die if controller does not exist
        }
    }

}