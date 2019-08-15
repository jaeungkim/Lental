<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['admin'])){
    $_SESSION['errorMsg'] = "ERROR: Not logged in.";
    header('location: admin_login.php');
    die();
}
 ?>
