<?php

namespace Phplover\Libraries;

class Views
{

    public function render(
        string $template,
        array $data = [],
        int $statusCode = 200
    ) {

        // load league plates engine
        $engine = new \League\Plates\Engine(VIEWSPATH);
        
        // set status code
        http_response_code($statusCode);

        // render template
        echo $engine->render($template, $data);

    }

}