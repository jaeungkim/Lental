<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include('admin_checkLoggedIn.php');
include_once ('database/databaseAPI.php');

if ($_SERVER["REQUEST_METHOD"]=="POST"){
    if (isset($_POST['email'])){
        if (removeAccount($_POST['email'])){
            if ($_SESSION['userEmail'] == $_POST['email']){
                $_SESSION['userEmail'] = "";
            }
        }
    }
}
header('location: admin_viewCustomers.php');
die();
 ?>
