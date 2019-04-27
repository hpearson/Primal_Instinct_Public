<?php

// Configure the Error Handler
set_error_handler (
    function($errno, $errstr, $errfile, $errline) {
        throw new ErrorException($errstr, $errno, 0, $errfile, $errline);     
    }
);



// Load in all the files we will need
require_once './app/bootstrap.php';

// Load or Create Session
Session::init();

// Startup the man application and check for errors
try {
    // Init Core Library
    $init = new Router;
} catch (Exception $e) {
    // Catch all of the messages
    if (DEBUG == true) {
        $output = '';
        $output .= $e->getMessage();
        $output .= '<br>';
        $output .= '<b>File: </b>' . $e->getFile();
        $output .= '<br>';
        $output .= '<b>Line: </b>' . $e->getLine();
        Inform::push_error($output);
    }

    // Redirect users to the error page
    redirect('Errors');
}