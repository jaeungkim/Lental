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
    <link rel="stylesheet" href="css/frontPage.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.5.0/css/swiper.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.5.0/css/swiper.min.css">
</head>

<body>
    <?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    $_SESSION['currentPage']="home";
    include 'header.php' ?>

    <!-- Property search image / form submission div -->
    <section class="">
        <div class="position-relative">
            <div class="carousel-caption">
                <div class="text-center text-lg-left">
                    <p class="mb-2 text-secondary text-light" style="font-size: 2vw; text-shadow: 4px 4px 4px #000000;">
                        The best home experience
                    </p>
                    <h1 class="text-light" style="font-size:6vw; text-shadow: 4px 4px 4px #000000;">Find your home today
                    </h1>
                </div>
                <!-- search bar -->
                <div class="search-bar mt-5 p-3 p-lg-1 pl-lg-4">
                    <form action="findListing.php" method="get">
                        <div class="row">
                            <div class="col-lg-9 d-flex align-items-center form-group">
                                <label for="city" class="label-absolute"><i class="fa fa-crosshairs"></i><span
                                        class="sr-only">City</span></label>
                                <input type="text" name="city" class="mx-2 rounded form-control border-0"
                                    placeholder="City">
                            </div>
                            <div class="col-lg-3">
                                <input type="submit" class="btn btn-primary btn-block btn-dark rounded-pill h-100"
                                    value="Submit">
                            </div>
                        </div>
                    </form>
                </div>
                <!--/search bar -->
            </div>
            <div id="carouselExampleFade" class="carousel slide carousel-fade" data-ride="carousel" style="z-index:-20;">
                <div class="carousel-inner col-xs-12">
                    <div class="carousel-item active">
                        <img src="assets/house3.jpg" class="img-fluid" alt="..."
                            style="opacity:1; width: 100%; height: 60vh; background-repeat: no-repeat; background-position: center center; object-fit: cover!important;">
                    </div>
                    <div class="carousel-item">
                        <img src="assets/house2.jpg" class="img-fluid" alt="..."
                            style="opacity:1; width: 100%;height: 60vh; background-repeat: no-repeat; background-position: center center; object-fit: cover!important;">
                    </div>
                    <div class="carousel-item">
                        <img src="assets/house1.jpg" class="img-fluid" alt="..."
                            style="opacity:1; width: 100%; height: 60vh; background-repeat: no-repeat; background-position: center center; object-fit: cover!important;">
                    </div>
                    <div class="carousel-item">
                        <img src="assets/house4.jpg" class="img-fluid" alt="..."
                            style="opacity:1; width: 100%; height: 60vh; background-repeat: no-repeat; background-position: center center; object-fit: cover!important;">
                    </div>
                    <div class="carousel-item">
                        <img src="assets/house5.jpg" class="img-fluid" alt="..."
                            style="opacity:1; width: 100%; height: 60vh; background-repeat: no-repeat; background-position: center center; object-fit: cover!important;">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Property search image / form submission div -->

    <!-- BOOKING WITH US IS EASY -->
    <section class="jumbotron" style="background-color: #fff !important">
        <div class="text-center pb-lg-4">
            <p class="subtitle text-secondary">“Home is where our story begins…”</p>
            <h2 class="mb-5"> </h2>
        </div>
        <div class="row">
            <div class="col-lg-4 mb-3 mb-lg-0 text-center">
                <div class="px-0 px-lg-3">
                    <div class="icon-rounded bg-primary-light mb-3">
                        <i class="fa fa-map"></i>
                    </div>
                    <h3 class="h5">Find the perfect rental</h3>
                    <p class="text-muted"> “In this home… We do second chances. We do real. We do mistakes. We do I’m sorrys. We do loud really well. We do hugs. We do together best of all.”</p>
                </div>
            </div>
            <div class="col-lg-4 mb-3 mb-lg-0 text-center">
                <div class="px-0 px-lg-3">
                    <div class="icon-rounded bg-primary-light mb-3">
                        <i class="fa fa-credit-card-alt"></i>
                    </div>
                    <h3 class="h5">Book with confidence</h3>
                    <p class="text-muted">“You will never be completely at home again, because part of your heart will always be elsewhere. That is the price you pay for the richness of loving and knowing people in more than one place.”</p>
                </div>
            </div>
            <div class="col-lg-4 mb-3 mb-lg-0 text-center">
                <div class="px-0 px-lg-3">
                    <div class="icon-rounded bg-primary-light mb-3">
                        <i class="fa fa-heart"></i>
                    </div>
                    <h3 class="h5">Enjoy your stay</h3>
                    <p class="text-muted">“The ache for home lives in all of us, the safe place where we can go as we are and not be questioned.”</p>
                </div>
            </div>
        </div>
    </section>
    <!-- /BOOKING WITH US IS EASY -->
    <section class="py-5 py-lg-5 dark-overlay"><img
            src="assets/sweet_home.jpg" class="bg-image">
        <div class="container">
            <div class="overlay-content text-white py-lg-5 text-center">
                <p class="subtitle text-white letter-spacing-4 mb-4">Find the best home</p>
                <h3 class="display-3 font-weight-bold text-serif text-shadow mb-5">Travel & Explore</h3>
                <p class="lead text-shadow mb-5"> "Home is where Love resides, Memories are created, Friends and Family belong and Laughter never ends."</p><a href="register.php" class="btn btn-dark">Get Started</a>
            </div>
        </div>
    </section>

    <!-- SAVED LISTINGS -->
    <div class="swiper-container pt-5   ">
        <div class="swiper-wrapper">
            <div class="swiper-slide"> <img src="assets/viewListingExamplePhotos/room1.jpg" class="img-fluid" alt="..."
                    style="opacity:1; background-repeat: no-repeat; background-position: center center; object-fit: cover!important;">
            </div>
            <div class="swiper-slide"><img src="assets/viewListingExamplePhotos/room2.jpg" class="img-fluid" alt="..."
                    style="opacity:1; background-repeat: no-repeat; background-position: center center; object-fit: cover!important;">
            </div>
            <div class="swiper-slide"><img src="assets/viewListingExamplePhotos/room3.jpg" class="img-fluid" alt="..."
                    style="opacity:1; background-repeat: no-repeat; background-position: center center; object-fit: cover!important;">
            </div>
            <div class="swiper-slide"><img src="assets/viewListingExamplePhotos/room4.jpg" class="img-fluid" alt="..."
                    style="opacity:1; background-repeat: no-repeat; background-position: center center; object-fit: cover!important;">
            </div>
            <div class="swiper-slide"><img src="assets/viewListingExamplePhotos/room5.jpg" class="img-fluid" alt="..."
                    style="opacity:1; background-repeat: no-repeat; background-position: center center; object-fit: cover!important;">
            </div>
            <div class="swiper-slide"><img src="assets/viewListingExamplePhotos/room6.jpg" class="img-fluid" alt="..."
                    style="opacity:1; background-repeat: no-repeat; background-position: center center; object-fit: cover!important;">
            </div>
            <div class="swiper-slide"><img src="assets/viewListingExamplePhotos/room7.jpg" class="img-fluid" alt="..."
                    style="opacity:1; background-repeat: no-repeat; background-position: center center; object-fit: cover!important;">
            </div>
            <div class="swiper-slide"><img src="assets/viewListingExamplePhotos/room8.jpg" class="img-fluid" alt="..."
                    style="opacity:1; background-repeat: no-repeat; background-position: center center; object-fit: cover!important;">
            </div>
        </div>
    </div>
    <!-- /SAVED LISTINGS -->

    <?php include 'footer.php' ?>
    <?php include 'scriptsGeneral.html' ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.5.0/js/swiper.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.5.0/js/swiper.min.js"></script>

    <!-- Initialize Swiper -->
    <script>
    var swiper = new Swiper('.swiper-container', {
        slidesPerView: 5,
        spaceBetween: 10,
        loop: true,
        loopFillGroupWithBlank: true,
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
    });
    </script>
    <!-- /Initialize Swiper -->
</body>

</html>
