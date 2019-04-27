<?php

class Secure {

    static function HTML($input) {
        foreach ($input as $key => $val) {
            $input[$key] = htmlspecialchars($val, ENT_QUOTES);
        }
        return $input;
    }

}
