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
        // get the current url
        $currentUrl = $_SERVER['REQUEST_URI'];

        // route found?
        $found = false; # for now

        // check if the current url matches any of the routes
        foreach ($allRoutes as $route) {

            // get the url from the route
            $url = $route['url'];

            // check if the url has any parameters
            if (strpos($url, '{') !== false) {

                // get the parameters from the url
                preg_match_all('/\{([^\}]+)\}/', $url, $matches);

                // get the parameters from the url
                $params = $matches[1];

                // get the parameters from the url
                $url = preg_replace('/\{([^\}]+)\}/', '([^/]+)', $url);

                // get the parameters from the url
                $url = '/^' . str_replace('/', '\/', $url) . '$/';

                // get the parameters from the url
                if (preg_match($url, $currentUrl, $matches)) {

                    // get the parameters from the url
                    $found = true;

                    // get the parameters from the url
                    $params = array_slice($matches, 1);

                    // get the parameters from the url
                    $route['params'] = $params;

                    // get the parameters from the url
                    $this->routeEach($route);
                }
            } elseif($route['url'] === $currentUrl) {
                $found = true;
                $this->routeEach($route);
            }
        }

        // Error Handler
        $error = new \Phplover\Libraries\Error;

        // check if the current url matches any of the urls in $routes
        // if not, throw 404
        if ($found === false) {
            return $error->notFound();
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

        // get the namespace value from array passed
        // if not found, use false as default
        $controllerNamespace = $data['namespace'] ?? false;

        // get the params from array passed
        // if not found, use empty array as default
        $params = $data['params'] ?? [];

        // check if namespace is gicen along with controller name
        if (strpos($controller, '\\') !== false) {
            $controller = $controller;
        } else {
            $controller = 'Phplover\\Controllers\\' . $controller;
        }

        // check if controller exists
        if (class_exists($controller)) {

            // if yes, create a new instance of the controller
            $controller = new $controller;

            // check if method exists
            if (method_exists($controller, $method)) {

                // callback to the method with parameters passed
                if (count($params) > 0) {
                    $controller->$method($params);
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