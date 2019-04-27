<?php

// Load Config
require_once 'config/config.php';

// Load Vendor Libraries
require_once 'vendor/autoload.php';

// Load Libraries
require_once 'libraries/Router.php';
require_once 'libraries/Controller.php';
require_once 'libraries/database.php';
require_once 'libraries/RuleLookup.php';

// Load Helpers
require_once 'helpers/inform_helper.php';
require_once 'helpers/secure_helper.php';
require_once 'helpers/session_helper.php';
require_once 'helpers/url_helper.php';


//$password = 'secret';
//$hash = password_hash($password, PASSWORD_BCRYPT, [12]);
//echo $hash;
//echo '<br>';
//Will read the password crypt type and complexity to decode against a password
//if (password_verify($password, $hash)) { TODO
//    echo 'yes';
//} else {
//    echo 'No';
//}





