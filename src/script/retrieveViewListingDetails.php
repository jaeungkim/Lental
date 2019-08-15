<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include_once (dirname(__DIR__) . '/database/databaseAPI.php');

// $list = getListing(1);
if ($_SERVER["REQUEST_METHOD"]=="GET"){
    if (isset($_GET['listId'])){
        // get listing and property details/data and put in array
        if ($list = getListing($_GET['listId'])){
            // don't allow viewing listing unless admin is logged in
            if (($list['status']=='online') || isset($_SESSION['admin'])){
                // succesfully retrieved data
                $list = getListing($_GET['listId']);
                $propId = $list['idProp'];
                $prop = getProperty($propId);
                $images = getPropertyImages($list['idProp']);
            } else {
                $_SESSION['errorMsg'] = 'ERROR: This listing is not available.';
                $list = [];
            }
        } else {
            $_SESSION['errorMsg'] = 'ERROR: no matching listing id';
        }
    } else {
        $_SESSION['errorMsg'] = 'ERROR: listing id (listId) not set';
    }
} else {
    $_SESSION['errorMsg'] = 'ERROR: Wrong method (Only GET accepted)';
}

 ?>
