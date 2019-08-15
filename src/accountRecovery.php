<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <title>Lental - Recover Account</title>
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
            <h1 class="display-4">Recover Account</h1>
        </div>
    </div>

    <!-- Form for registering info -->
    <div class="container" style="margin-bottom: 20em;">
        <form id="recoveryForm" method="post">
            <div class="form-group">
                <label for="regInputEmail">Enter your email to recover:</label>
                <input type="email" class="form-control" id="inputEmail" name="email" placeholder="Email" required>
                <div class="alert alert-success d-none my-2" id="emailSent" role="alert">
                    The password recovery link has been sent to your email
                </div>
            </div>
            <button type="submit" class="btn btn-primary" style="width:10em;">Recover</button>
        </form>
    </div>

    <!-- Footer -->
    <?php include 'footer.php' ?>
    <?php include 'scriptsGeneral.html' ?>
</body>

<script>
$('#recoveryForm').on("submit", function(e) {
    e.preventDefault();
    e.stopImmediatePropagation();
    var email = $('#inputEmail').val();
    $('#inputEmail').val(email);
    $.post("script/processRecoverAccount.php", {
            email: email
        },
        function(result) {
            if (result=="sent"){
                $('#emailSent').removeClass('d-none');
            }
            // alert(result);
        });
});
</script>

</html>
