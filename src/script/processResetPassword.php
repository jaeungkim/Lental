<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include_once (dirname(__DIR__) . '/database/databaseAPI.php');

if ($_SERVER["REQUEST_METHOD"]=="POST"){
    if (isset($_POST['password']) && isset($_SESSION['tempEmail'])){
        // update password
        if (changeAccountPassword($_SESSION['tempEmail'], $_POST['password'])){
            // reset token and tempEmail
            setAccountToken($_SESSION['tempEmail'],'');
            unset($_SESSION['tempEmail']);
            $_SESSION['errorMsg'] = 'Password has been reset';
            header('location: ../frontPage.php');
            die();
        }
    }
}
$_SESSION['errorMsg'] = 'ERROR: Something went wrong';
header('location: ../resetPassword.php');
die();
 ?>
