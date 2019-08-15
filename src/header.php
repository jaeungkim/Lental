<?php
// check for any error messages to display
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
// check if can connect to database
include_once ('database/databaseAPI.php');
if (!connect()){
    $_SESSION['errorMsg'] = "ERROR: Cannot connect to database";
}

// show error msg
if (isset($_SESSION['errorMsg'])){
    echo('<script type="text/javascript">alert("' . $_SESSION['errorMsg'] . '");</script>');
    unset($_SESSION['errorMsg']);
}

// if logged in, check if account active
if (isset($_SESSION['userEmail'])){
    if (!checkAccountActive($_SESSION['userEmail'])){
        unset($_SESSION['userEmail']);
        // session_destroy();
        // header("Refresh:0");
        // // echo '<script>window.location.reload();</script>';
        // die();
    }
}
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
                <a class="nav-item nav-link <?php if ($_SESSION['currentPage']=="home"){echo 'active';} ?>" href="frontPage.php">Home</a>
                <a class="nav-item nav-link <?php if ($_SESSION['currentPage']=="search"){echo 'active';} ?>" href="findListing.php">Search</a>
                <a class="nav-item nav-link <?php if ($_SESSION['currentPage']=="contact"){echo 'active';} ?>" href="contactus.php">Contact</a>
                <li class="nav-item dropdown <?php if ($_SESSION['currentPage']=="account"){echo 'active';} ?>">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-offset="10,303"
                    <?php
                    // Displays log in if not logged in, else Account if logged in
                    if(isset($_SESSION['userEmail'])){ echo ">Account";} else {echo " onclick='focusEmail(1)'>Log In";} ?>
                    </a>
                    <?php
                    // if user logged in
                    if(isset($_SESSION['userEmail'])){
                        // display if logged in
                        echo '
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="myAccount.php">My Account</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="script/processLogout.php">Logout</a>
                        </div>
                        ';
                    }
                    else{
                        // display if not logged in (log in form)
                        echo '
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink" style="min-width:20em;">
                            <form class="px-4 py-3" method="post" id="loginForm">
                                <div class="alert alert-danger d-none" id="loginError">
                                    <strong>Error!</strong> Email or Password is incorrect.
                                </div>
                                <div class="form-group">
                                    <label>Email address</label>
                                    <input type="email" class="form-control" name="email" placeholder="email@example.com" id="emailLogin" autofocus required>
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" name="password" class="form-control" placeholder="Password" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Sign in</button>
                            </form>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="register.php">No account? Register</a>
                            <a class="dropdown-item" href="accountRecovery.php">Forgot Password?</a>
                        </div>
                        ';
                    }

                    ?>
                </li>
                <?php
                // display if logged in
                if (isset($_SESSION['userEmail'])){
                    echo '<a href="addListing.php" class="btn btn-primary nav-item">Add a listing</a>';
                }
                else {
                // display if not logged in
                echo '
                    <button type="button" class="btn btn-primary disabled" data-trigger="focus" aria-disabled="true" data-container="body" data-toggle="popover" data-placement="bottom" data-content="You must be logged in to add a listing.">
                    Add Listing
                    </button>';
                }
                // clear currentPage
                $_SESSION['currentPage']="";
                 ?>

            </ul>
        </div>
    </div>
</nav>
