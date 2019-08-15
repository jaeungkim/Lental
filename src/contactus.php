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
    <link rel="stylesheet" href="css/contactus.css">
</head>

<body>
    <?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    $_SESSION['currentPage']="contact";
    include 'header.php';
    include_once 'database/databaseAPI.php';
    include 'script/sendEmail.php';
    if(isset($_SESSION['userEmail'])){
        $acc = getAccountDetails($_SESSION['userEmail']);
        
    ?>
    <div class="jumbotron jumbotron-fluid bg-house shadow">
        <div class="container">
            <h1 class="display-4">How can we help you today?</h1>
            <p class="lead" style="max-width:20em;"></p>
        </div>
    </div>

    <section class="py-4 bg-gray-100">
        <div class="container">
            <h2 class="h4 mb-4">Contact form</h2>
            <div class="row">
                <div class="col-md-7 mb-5 mb-md-0">
                    <form id="contact-form" method="post" action="script/processEmail.php" class="form">
                        <div class="controls">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <input type="text" name="name" id="name" value = "<?php echo $acc[1] ?>"
                                        required="required" class="form-control">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <input type="text" name="surname" id="surname"
                                        value ="<?php echo $acc[2] ?>" required="required" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="email" name="email" id="email" value = "<?php echo $acc[0] ?>"
                                required="required" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="message" class="form-label">Your message for us</label>
                                <textarea rows="4" name="message" id="message" placeholder="Enter your message"
                                    required="required" class="form-control"></textarea>
                            </div>
                            <button type="submit" class="btn btn-outline-primary">Send message</button>
                        </div>
                    </form>
                </div>
                <div class="col-md-5">
                    <div class="pl-lg-4">
                        <p class="text-muted">“The best way to not feel hopeless is to get up and do something. Don’t
                            wait for good things to happen to you. If you go out and make some good things happen, you
                            will fill the world with hope, you will fill yourself with hope.”
                            ― Barack Obama </p>
                        <p class="text-muted">“No one is useless in this world who lightens the burdens of another.”
                            ― Charles Dickens</p>
                        <div class="social">
                            <ul class="list-inline">
                                <li class="list-inline-item"><a href="#" target="_blank"><i
                                            class="fa fa-twitter"></i></a></li>
                                <li class="list-inline-item"><a href="#" target="_blank"><i
                                            class="fa fa-facebook"></i></a></li>
                                <li class="list-inline-item"><a href="#" target="_blank"><i
                                            class="fa fa-instagram"></i></a></li>
                                <li class="list-inline-item"><a href="#" target="_blank"><i
                                            class="fa fa-pinterest"></i></a></li>
                                <li class="list-inline-item"><a href="#" target="_blank"><i class="fa fa-vimeo"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php } else { ?>
   
    <div class="jumbotron jumbotron-fluid bg-house shadow">
        <div class="container">
            <h1 class="display-4">How can we help you today?</h1>
            <p class="lead" style="max-width:20em;"></p>
        </div>
    </div>

    <section class="py-4 bg-gray-100">
        <div class="container">
            <h2 class="h4 mb-4">Contact form</h2>
            <div class="row">
                <div class="col-md-7 mb-5 mb-md-0">
                    <form id="contact-form" method="post" action="script/processEmail.php" class="form">
                        <div class="controls">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                    <input type="text" name="name" id="name" placeholder="Enter your firstname"
                                            required="required" class="form-control">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                    <input type="text" name="surname" id="surname"
                                            placeholder="Enter your  lastname" required="required" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                            <input type="email" name="email" id="email" placeholder="Enter your  email"
                                    required="required" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="message" class="form-label">Your message for us</label>
                                <textarea rows="4" name="message" id="message" placeholder="Enter your message"
                                    required="required" class="form-control"></textarea>
                            </div>
                            <button type="submit" class="btn btn-outline-primary">Send message</button>
                        </div>
                    </form>
                </div>
                <div class="col-md-5">
                    <div class="pl-lg-4">
                        <p class="text-muted">“The best way to not feel hopeless is to get up and do something. Don’t
                            wait for good things to happen to you. If you go out and make some good things happen, you
                            will fill the world with hope, you will fill yourself with hope.”
                            ― Barack Obama </p>
                        <p class="text-muted">“No one is useless in this world who lightens the burdens of another.”
                            ― Charles Dickens</p>
                        <div class="social">
                            <ul class="list-inline">
                                <li class="list-inline-item"><a href="#" target="_blank"><i
                                            class="fa fa-twitter"></i></a></li>
                                <li class="list-inline-item"><a href="#" target="_blank"><i
                                            class="fa fa-facebook"></i></a></li>
                                <li class="list-inline-item"><a href="#" target="_blank"><i
                                            class="fa fa-instagram"></i></a></li>
                                <li class="list-inline-item"><a href="#" target="_blank"><i
                                            class="fa fa-pinterest"></i></a></li>
                                <li class="list-inline-item"><a href="#" target="_blank"><i class="fa fa-vimeo"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php };?>
    <?php include 'footer.php' ?>
    <?php include 'scriptsGeneral.html' ?>
</body>
</html>
