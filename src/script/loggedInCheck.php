<?php
// this prevents a user from accessing a site unless they are logged in
if (isset($_SESSION['userEmail'])){
    // is logged in - Do nothing
} else {
    // is not logged in, redirect to previous page and show error msg
    $_SESSION['errorMsg'] = "ERROR: You must be logged in to access this site.";
    header("location: frontPage.php");

}
 ?>
