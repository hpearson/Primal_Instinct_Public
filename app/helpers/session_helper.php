<?php

class Session {

    // Session Variables in use
    // 1) _token
    // 2) InformError
    // 3) InformWarning
    // 4) InformInfo
    
    static function init() {
        session_start();
        // Keep changing the session to prevent fixation
        session_regenerate_id(); 
        
        // Set security token
        if (!isset($_SESSION['_token']) || empty($_SESSION['_token'])) {
            Session::set('_token', bin2hex(openssl_random_pseudo_bytes(16)));
        } 
        
    }

    static function set($key, $value) {
        $_SESSION[$key] = $value;
    }

    static function get($key) {
        // Make the session variable if it is empty
        // Prevents an error calling unset variable
        if (!isset($_SESSION[$key])){
            $_SESSION[$key] = [];
        }
        
        return $_SESSION[$key];
    }

    static function destroy() {
        $_SESSION = []; // Clears the $_SESSION variable
        session_destroy();
    }
    
}
