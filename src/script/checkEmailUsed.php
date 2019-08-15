<?php
session_start();
include_once (dirname(__DIR__) . '/database/databaseAPI.php');

if ($_SERVER["REQUEST_METHOD"]=="POST"){
    if (isset($_POST['email'])){
        $email = $_POST['email'];
        echo checkEmailUsed($email);
    }
}
echo false;

 ?>
