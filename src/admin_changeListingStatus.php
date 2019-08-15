<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include('admin_checkLoggedIn.php');
include_once ('database/databaseAPI.php');

if ($_SERVER["REQUEST_METHOD"]=="GET"){
    if (isset($_GET['listId']) && isset($_GET['status'])){
        changeListingStatus($_GET['listId'],$_GET['status']);
    }
}
header('location: admin_viewListings.php');
die();
 ?>
