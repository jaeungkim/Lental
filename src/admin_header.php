<?php
// check for any error messages to display
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
// check if can connect to database
include_once ('database/connection.php');
if (!connect()){
    $_SESSION['errorMsg'] = "ERROR: Cannot connect to database";
}

// show error msg
if (isset($_SESSION['errorMsg'])){
    echo('<script type="text/javascript">alert("' . $_SESSION['errorMsg'] . '");</script>');
    unset($_SESSION['errorMsg']);
}

// check if logged in
include('admin_checkLoggedIn.php');
 ?>
<!-- show error msg if JavaScript is disabled -->
 <noscript>
     <META HTTP-EQUIV="Refresh" CONTENT="0;URL=ShowErrorPage.html">
 </noscript>

<!-- navbar container -->
<nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="frontPage.php">Lental</a>
        <!-- button is for mobile view -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- selectable options and items go in this div -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <a class="nav-item nav-link" href="admin_viewCustomers.php">View Accounts</a>
                <a class="nav-item nav-link" href="admin_viewListings.php">View Listings</a>
                <a class="nav-item nav-link" href="">...</a>
                <a class="nav-item nav-link" href="admin_logout.php">Logout</a>
            </ul>
        </div>
    </div>
</nav>
