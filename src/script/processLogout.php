<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if(isset($_SESSION['userEmail'])){
    session_destroy();
    $_SESSION = [];
    header('location: ../frontPage.php');
    // header("location: ".$_SERVER['HTTP_REFERER']);
}
else {
    header("location: ".$_SERVER['HTTP_REFERER']);
}
 ?>
