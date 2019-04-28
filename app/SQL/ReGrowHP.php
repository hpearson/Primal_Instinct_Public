<?php

// DB Params
define('DB_HOST', 'sqlsrv:Server=MSSQL,1433;');
define('DB_NAME', 'Database=TestDB');
define('DB_USER', 'UnsecureAccount');
define('DB_PASS', 'VW5zZWN1cmVBY2NvdW50');
$dsn = DB_HOST . DB_NAME;
$options = array(
    PDO::ATTR_EMULATE_PREPARES => false,
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
);

// Create PDO instance
$dbh = new PDO($dsn, DB_USER, DB_PASS, $options);
$stmt = $dbh->query("
        UPDATE Player SET HP = HP + 1 WHERE HP < 100 AND RespawnTime IS NULL
        ");
?>