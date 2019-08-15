<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <title>Lental - Register</title>
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway:400,800">
    <link rel='stylesheet' href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/general.css">
</head>

<body>

    <?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    // if logged in, redirect to home page
    if (isset($_SESSION['userEmail'])){
        header('location: frontPage.php');
    }
    include 'header.php'; ?>

    <!-- The info under the navbar, jumbo -->
    <div class="jumbotron jumbotron-fluid bg-house shadow">
        <div class="container">
            <h1 class="display-4">Register</h1>
            <p class="lead" style="max-width:20em;">Become a member!</p>
        </div>
    </div>

    <!-- Form for registering info -->
    <div class="container">
        <form id="registerForm" method="post">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="regFirstName">First Name</label>
                    <input type="text" class="form-control" id="regFirstName" name="firstName" placeholder="First Name">
                </div>
                <div class="form-group col-md-6">
                    <label for="regLastName">Last Name</label>
                    <input type="text" class="form-control" id="regLastName" name="lastName" placeholder="Last Name">
                </div>
            </div>
            <div class="form-group">
                <label for="regInputEmail">Email</label>
                <input type="email" class="form-control" id="regInputEmail" name="email" placeholder="Email" required>
                <div class="alert alert-danger d-none my-2" id="emailAlert" role="alert">
                    Email is already in use.
                </div>
                <div class="alert alert-success d-none my-2" id="emailAvailable" role="alert">
                    Email is Available!
                </div>
            </div>
            <div class="form-group">
                <label for="regInputPhone">Phone Number</label>
                <input type="text" class="form-control" id="regInputPhone" name="phoneNum" placeholder="Phone Number" required>
            </div>
            <label for="regInputPassword">Password</label>
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
            <button type="submit" class="btn btn-primary" style="width:10em;">Register</button>
        </form>
    </div>

    <!-- Footer -->
    <?php include 'footer.php' ?>

    <?php include 'scriptsGeneral.html' ?>
    <!-- <script src="js/registerAJAX.js"></script> -->
    <!-- <script src="js/registerValidate.js"></script> -->
    <script>
    // checks if email is available
    // form eventlistener
    $('#regInputEmail').on("change", function(e) {
        $("#emailAvailable").addClass("d-none");
        $("#emailAlert").addClass("d-none");
        if ($("#regInputEmail").val().length == 0) {
            return;
        }
        var email = $('#regInputEmail').val();
        $.post("script/checkEmailUsed.php", {
                email: email
            },
            function(result) {
                if (result) {
                    $("#emailAlert").removeClass("d-none");
                } else {
                    $("#emailAvailable").removeClass("d-none");
                }
            });
    });

    // checks that passwords are the same
    $('#regPass, #regPassConfirm').on("change keyup", function(e) {
        var pass1 = $('#regPass');
        var pass2 = $('#regPassConfirm');
        $('#passAlert').addClass("d-none");

        if (((pass1.val().length < 8 && pass1.val().length > 0) || (pass1.val() != pass2.val())) && pass2.val().length > 0){
            $('#passAlert').removeClass("d-none");
        }
    });

    // validate
    $('#registerForm').on("submit", function(e) {
        var valid = true;
        e.preventDefault();

        // check that passwords are the same
        var pass1 = $('#regPass');
        var pass2 = $('#regPassConfirm');
        if (pass1.val().length < 8 || pass1.val() != pass2.val()) {
            valid = false;
        }

        // check the phone field is not empty
        if ($('#regInputPhone').val().length == 0) {
            valid = false;
        }

        // check that email is unique and has been filled
        var email = $('#regInputEmail').val();
        if (email.length == 0) {
            valid = false;
        }
        if (valid) {
            $.post("script/checkEmailUsed.php", {
                    email: email
                },
                function(result) {
                    if (result) {
                        valid = false;
                    } else if (valid) {
                        $.post("script/processRegister.php", $('#registerForm').serialize(), function(error) {
                            // if error occurred
                            if (error == 0) {
                                window.alert('An error has occured.' + error);
                            } else {
                                window.location.href = "frontPage.php";
                            }
                        });
                    }
                });
        }

    });
    </script>
</body>

</html>
