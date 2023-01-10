<?php

namespace Phplover\Libraries;

class Error
{

    public function notFound()
    {

        // set 404 response code
        http_response_code(404);

        // show the 404 page
        return view('errors/404', [
            'title' => '404 Not Found',
            'message' => 'The page you are looking for could not be found.'
        ], 404);

    }

}