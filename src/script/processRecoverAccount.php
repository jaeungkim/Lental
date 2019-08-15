<?php
require (dirname(__DIR__).'/script/sendEmail.php');
require (dirname(__DIR__).'/database/databaseAPI.php');
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
// send recovery email
if ($_SERVER["REQUEST_METHOD"]=="POST"){
    if (isset($_POST['email'])){
        if (checkEmailUsed($_POST['email']) && getAccountDetails($_POST['email'])[5]=="online"){
            $token = random_str(64);
            $path = ('cosc499.ok.ubc.ca/19831149/deploy/src/resetPassword.php?token='.$token);
            setAccountToken($_POST['email'],$token);
            if (sendMail($_POST['email'],'Account Recovery',"<h4>Please go to this link to reset your password:</h4> <br><br> ".$path,'')){
                echo 'sent';
            } else {
                echo "email sending error";
            }
        } else {
            echo 'sent';
        }
    }
}
 ?>
