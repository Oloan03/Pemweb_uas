<?php

define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'N70');
define('DB_PASSWORD', 'oloan.030406');
define('DB_NAME', 'pemweb');

$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>