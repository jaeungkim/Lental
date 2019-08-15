<?php
// This file has the login credentials for the online database
$remote = $_SERVER["REMOTE_ADDR"] ?? '127.0.0.1';
if ($remote=='127.0.0.1'){
    // server is run locally
    $host = "localhost";
    $database = "lental";
    $user = "root";
    $password = "";
} else {
    // server is run online
    $host = "localhost";
    $database = "db_19831149";
    $user = "19831149";
    $password = "password";
}


 ?>
