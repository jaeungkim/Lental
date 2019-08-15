<?php
    include('admin_checkLoggedIn.php');
    include_once('database/databaseAPI.php');
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    $_SESSION["adminEmail"] = "temp";
    if (isset($_SESSION["adminEmail"]) && $_SERVER["REQUEST_METHOD"] == "POST"){
        $fName = $_POST['fName'];
        $lName = $_POST['lName'];
        $email = $_POST['email'];
        $pNum = $_POST['pNum'];
        $subId = $_POST['subId'];

        if (!updateAccount($email,$fName,$lName,$pNum,$subId)){
            $_SESSION["errorMsg"] = "ERROR: Issue updating account";
        }
        header("location: admin_viewCustomers.php");
    }
?>
