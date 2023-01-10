<?php

namespace Phplover\Libraries;

/**
 * This is a class that is going to be used to return json responses
 * Best used to build basic apis
 */
class JsonResponse
{

    public function response(array $data, int $statusCode = 200)
    {

        // Set the header to json
        header('Content-Type: application/json');

        // status code
        http_response_code($statusCode);

        // Return the data
        return json_encode($data);

    }

}