<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <title>Lental - Home</title>
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
    // show error msg
    if (isset($_SESSION['errorMsg'])){
        echo('<script type="text/javascript">alert("' . $_SESSION['errorMsg'] . '");</script>');
        unset($_SESSION['errorMsg']);
    //Ignore this. This is just to trigger a commit
    }
     ?>

    <form class="container my-5" method="post" action="admin_processLogin.php">
        <div class="form-group">
            <label for="exampleInputEmail1">User</label>
            <input type="text" class="form-control" name="user" id="adminUser" aria-describedby="emailHelp" placeholder="Enter email">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" name="password" class="form-control" id="adminPass" placeholder="Password">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

</body>
<script src="js/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/otherGeneral.js"></script>
</html>
