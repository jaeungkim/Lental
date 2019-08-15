<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if(isset($_SESSION['admin'])){
    session_destroy();
    $_SESSION = [];
    header("location: admin_login.php");
}
else {
    header("location: admin_login.php");
}
 ?>
