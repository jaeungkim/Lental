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
    <link rel="stylesheet" href="css/admin.css">
</head>

<body>
    <?php include 'header.php';
    include 'script/loggedInCheck.php';
    include_once 'database/databaseAPI.php';

        if(isset($_SESSION['userEmail'])){
            $acc = getAccountDetails($_SESSION['userEmail']);
            echo '
    <div class="col-md-9 container-fluid py-4">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <h4>Your Profile</h4>
                        <hr>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                            <div class="form-group row">
                                <label for="email" class="col-4 col-form-label">Email</label>
                                <div class="col-8">
                                    <p name="email">'.$acc[0].'</p>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="name" class="col-4 col-form-label">First Name</label>
                                <div class="col-8">
                                    <p name="firstName">'.$acc[1].'</p>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="lastname" class="col-4 col-form-label">Last Name</label>
                                <div class="col-8">
                                    <p name="lastName">'.$acc[2].'</p>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-4 col-form-label">Phone Number</label>
                                <div class="col-8">
                                    <p name="phoneNumber">'.$acc[3].'</p>
                                </div>
                            </div>

                            <button type="button" class="btn btn-primary active"><a href = "contactus.php" class = "text-light">Contact Support</a></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
';}?>
    <?php include 'footer.php' ?>
    <?php include 'scriptsGeneral.html' ?>
</body>

</html>
