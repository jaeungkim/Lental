<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include('admin_checkLoggedIn.php');
include_once ('database/databaseAPI.php');

if ($_SERVER["REQUEST_METHOD"]=="GET"){
    if (isset($_GET['email']) && isset($_GET['status'])){
        changeAccountStatus($_GET['email'],$_GET['status']);
    }
}
header('location: admin_viewCustomers.php');
die();
 ?>
