<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <title>Lental - Password Reset</title>
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway:400,800">
    <link rel='stylesheet' href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/general.css">
</head>

<body>

    <?php include 'header.php';
    include_once ('database/databaseAPI.php');
    // check that token is valid
    if (!isset($_GET['token'])){
        $_SESSION['errorMsg']="The password reset link you used either doesn't exist or has expired.";
        header('location: frontPage.php');
        die();
    } else {
        $email = getTokenAccount($_GET['token']);
        if (!$email){
            header('location: frontPage.php');
            die();
        } else {
            $_SESSION['tempEmail']=$email;
        }
    }
    ?>

    <!-- The info under the navbar, jumbo -->
    <div class="jumbotron jumbotron-fluid bg-house shadow">
        <div class="container">
            <h1 class="display-4">Password Reset</h1>
            <p class="lead" style="max-width:20em;">Reset Password</p>
        </div>
    </div>

    <!-- Form for registering info -->
    <div class="container" style="margin-bottom: 20em;">
        <form id="registerForm" method="post" action="script/processResetPassword.php">
            <label for="regInputPassword">New Password</label>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <input type="password" class="form-control" id="regPass" name="password" placeholder="Password" required>
                </div>
                <div class="form-group col-md-6">
                    <input type="password" class="form-control" id="regPassConfirm" name="passwordConfirm" placeholder="Confirm Password" required>
                </div>
            </div>
            <div class="alert alert-danger d-none" id="passAlert" role="alert">
                <strong>Error:</strong> Passwords must match and be at least 8 characters long.
            </div>
            <!-- <div class="form-group">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="gridCheck">
                    <label class="form-check-label" for="gridCheck">
                        I want to receive emails on updates and new listings
                    </label>
                </div>
            </div> -->
            <button type="submit" class="btn btn-primary" style="width:10em;">Reset</button>
        </form>
    </div>

    <!-- Footer -->
    <?php include 'footer.php' ?>

    <?php include 'scriptsGeneral.html' ?>
    <!-- <script src="js/registerAJAX.js"></script> -->
    <!-- <script src="js/registerValidate.js"></script> -->
    <script>

    // checks that passwords are the same
    $('#regPass, #regPassConfirm').on("change keyup", function(e) {
        var pass1 = $('#regPass');
        var pass2 = $('#regPassConfirm');
        $('#passAlert').addClass("d-none");

        if (pass1.val() != pass2.val()) {
            $('#passAlert').removeClass("d-none");
        }
        if (pass1.val().length < 8 && pass1.val().length > 0) {
            $('#passAlert').removeClass("d-none");
        }
    });

    // validate
    $('#registerForm').on("submit", function(e) {
        var valid = true;
        // check that passwords are the same
        var pass1 = $('#regPass');
        var pass2 = $('#regPassConfirm');
        if (pass1.val().length < 8 || pass1.val() != pass2.val()) {
            valid = false;
        }

        if (!valid) {
            e.preventDefault();
        }
    });
    </script>
</body>

</html>
