<?php
include_once ('database/databaseAPI.php');
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER["REQUEST_METHOD"]=="POST"){
    if (isset($_POST['user']) && isset($_POST['password'])){
        if (adminLogin($_POST['user'], $_POST['password'])){
            $_SESSION['admin'] = $_POST['user'];
            header('location: admin_viewCustomers.php');
            die();
        }
    }
}
$_SESSION['errorMsg'] = "Failed to login.";
header('location: admin_login.php');
die();
 ?>
