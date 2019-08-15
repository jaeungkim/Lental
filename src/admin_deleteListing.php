<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include('admin_checkLoggedIn.php');
include_once ('database/databaseAPI.php');

if ($_SERVER["REQUEST_METHOD"]=="POST"){
    if (isset($_POST['listId'])){
        if (removeListing($_POST['listId'])){
        }
    }
}
header('location: admin_viewListings.php');
die();
 ?>
