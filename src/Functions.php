<?php

/**
 * This is a file containing all the functions that we are going to use throughout the application
 */

// URL related functions
function base_url (string $path = ''): string
{
    return (new \Phplover\Config\Base)->base_url . $path;
}

function redirect (string $path, int $statusCode = null)
{

    if ($statusCode !== null)
    {
        http_response_code($statusCode);
    }

    header('Location: ' . base_url($path));
    exit;

}

// View related functions
function view (string $template, array $data = [], int $statusCode = 200)
{

    // load the views library to use
    $viewsLibrary = new \Phplover\Libraries\Views;

    // render the view
    return $viewsLibrary->render($template, $data, $statusCode);

}

// JSON related functions
function jsonResponse (array $data, int $statusCode = 200)
{

    // load the json library to use
    $jsonLibrary = new \Phplover\Libraries\JsonResponse;

    // render the json
    return $jsonLibrary->response($data, $statusCode);

}