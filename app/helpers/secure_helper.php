<?php

class Secure {

    static function HTML($input) {
        // If data is an array secure all values
        if (is_array($input)){
            foreach ($input as $key => $val) {
                $input[$key] = htmlspecialchars($val, ENT_QUOTES);
            }            
        }
        // If data is a string secure its text
        if (is_string($input)){
            $input = htmlspecialchars($input, ENT_QUOTES);
        }
        return $input;
    }

}
