<?php

class Router {

    public function __construct() {
        // Load in the URL Array
        $URL = Router::getURL();
        $Controller = $URL[0];
        $Method = $URL[1];
        $Args = $URL[2];
        
        // Check if the Controller file exists
        if (file_exists('./App/Controllers/' . $Controller . '.php')) {
            // Pull in the controller file
            require_once './App/Controllers/' . $Controller . '.php';
            // Load the controller from controller file
            $CalledController = new $Controller;
            // If users POSTed append _POST to method
            
            if (ACTION == 'POST') {
                $Method .= '_POST';
                // Check if user made the POST
                Router::validateToken(Session::get('_token'), POSTDATA['_token']);
            }
            // Check if method exists in the controller
            if (method_exists($CalledController, $Method)) {
                // Call the method in the controller and give them the Args
                $CalledController->$Method($Args);
            } else {
                Inform::push_error('Cannot find the method');
                redirect('Errors'); die();
            }
        } else {
            Inform::push_error('Cannot find the controller');
            redirect('Errors'); die();
        }
    }

    private function getURL() {
        // Read and split the URL
        $url = explode('/', trim(URI, '/'));

        // Security Check URLS ( should only have 2 backslashes )
        if (count($url) > 3) {
            Inform::push_error('Malformed URL Recieved');
            redirect('Errors'); die();
        }

        // Set default Controller and make sure not null
        if (!isset($url[0]) or empty($url[0])) {
            $url[0] = 'Index';
        }

        // Set default Method and make sure not null
        if (!isset($url[1])) {
            $url[1] = 'Index';
        }

        // Set default Arg and make sure not null
        if (!isset($url[2])) {
            $url[2] = false;
        }
        return $url;
    }

    private function validateToken($sessionToken, $userToken) {
        if ($sessionToken != $userToken) {
            Inform::push_error('Invalid Token');
            redirect('Errors'); die();
        }
    }

}
