<?php
function connect()
{
    // This file establishes a connection to the database server
    require('credentials.php');
    $con = mysqli_connect($host, $user, $password, $database);
    $error = mysqli_connect_error();
    if ($error != null) {
        return false;
        $output = "<p>Unable to connect to database!</p>";
        exit($output);
    }else {
        return $con;
    }
}

?>
