<?php

namespace Phplover\Controllers;

/**
 * Home controller will be used to display the home page
 */
class Home
{

    public function index()
    {
        return view('home');
    }

}