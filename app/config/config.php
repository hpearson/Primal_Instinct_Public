<?php

ini_set('memory_limit','2560M');

// Prevents javascript XSS attacks aimed to steal the session ID
ini_set('session.cookie_httponly', 1);

// **PREVENTING SESSION FIXATION**
// Session ID cannot be passed through URLs
ini_set('session.use_only_cookies', 1);

// Uses a secure connection (HTTPS) if possible
//ini_set('session.cookie_secure', 1);

// DB Params
define('DB_HOST','sqlsrv:Server=MSSQL,1433;');
define('DB_NAME','Database=TestDB');
define('DB_USER','UnsecureAccount');
define('DB_PASS','VW5zZWN1cmVBY2NvdW50');

define('DEBUG', true);

// App Root
define('APPROOT', dirname(dirname(__FILE__)).'\\');
	
// URL Root
define('URLROOT','http://10.0.0.119/');

// Site Name
define('SITENAME','🦖 Primal Instinct 🦖 DEV');

//Site Version
define('VERSION','0.0.1');

// Check unsafe PHP data in one location
// Sanitize POST data
define('POSTDATA', $_POST); 
//print_r(POSTDATA);

// Sanitize GET data
define('GETDATA', $_GET);  
//print_r(GETDATA);

//echo '<pre>';
//print_r($_SERVER);
//echo '</pre>';

// Sanitize POST/GET indicator
define('ACTION', filter_var($_SERVER['REQUEST_METHOD'], FILTER_SANITIZE_STRING));

// Sanitize the URL
define('URI', filter_var($_SERVER['REQUEST_URI'], FILTER_SANITIZE_STRING));