<?php

if ( count($data) > 0){
    foreach ($data as $value) {
        echo 'There are '.count($data).' players nearby';
        echo '<br>';
        echo $value->Username.'; ';
    }
} else {
    echo 'nobody is nearby';
}

