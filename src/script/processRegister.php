<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include_once (dirname(__DIR__) . '/database/databaseAPI.php');

$state = 0;
if ($_SERVER["REQUEST_METHOD"]=="POST"){
    if (isset($_POST['email']) && isset($_POST['password']) && isset($_POST['phoneNum']) && isset($_POST['firstName']) && isset($_POST['lastName'])){
        $email = $_POST['email'];
        $pNum = $_POST['phoneNum'];
        //sanitize phone number
        $pNum = filter_var($_POST['phoneNum'], FILTER_SANITIZE_NUMBER_INT);
        $find = array("+","-");
        $pNum = str_replace($find, "", $pNum);
        // validate user input
        if (filter_var($email, FILTER_VALIDATE_EMAIL) && strlen($_POST['password']) >= 8 && strlen($pNum) <= 15){
            // attempt to register
            if (register($email, $_POST['password'],$_POST['firstName'],$_POST['lastName'],$pNum)){
                // registered succesfully
                $_SESSION['userEmail'] = $email;
                $state = 1;
            }
    }
    }
}
// 0 = error, 1 = success
echo $state;
 ?>
