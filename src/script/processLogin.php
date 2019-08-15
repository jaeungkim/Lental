<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include_once (dirname(__DIR__) . '/database/databaseAPI.php');

$state = 0;
if ($_SERVER["REQUEST_METHOD"]=="POST"){
    if (isset($_POST['email']) && isset($_POST['password'])){
        $email = $_POST['email'];

        // sanitize and validate email
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);
        if (filter_var($email, FILTER_VALIDATE_EMAIL)){
            // attempt to login
            if (login($email, $_POST['password'])){
                // logged in succesfully
                $_SESSION['userEmail'] = $email;
                $state = 1; //state = 1 means logged in succesfully
            }
        }
    }
}
echo ($state); // state = 1 means success, state = 0 means an error occurred
 ?>
