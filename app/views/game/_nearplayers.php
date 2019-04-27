<?php

if ( count($data) > 0){
    echo 'There are '.count($data).' players nearby';
    echo '<br>';
    foreach ($data as $value) {
        echo Secure::HTML($value->Username).'; ';
    }
} else {
    echo 'Nobody is nearby';
}

