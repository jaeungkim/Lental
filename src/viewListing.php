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
    <link rel="stylesheet" href="css/viewListing.css">
</head>

<body>
    <!-- retrieves all details of listing and puts them into vars -->
    <?php include 'script/retrieveViewListingDetails.php';
    if (isset($_SESSION["errorMsg"])){
        header("location: frontPage.php");
    } else {
        include 'header.php';
    }
     ?>

    <!-- Images for current listing -->
    <div class="container">
        <div class="imageViewer">
            <div id="myCarousel" class="carousel slide" data-ride="carousel" data-interval="false">
                <!-- Carousel indicators -->
                <ol class="carousel-indicators">
                    <?php
                    if (!empty($images[0])){
                    foreach ($images as $key => $image) {
                        $active = "";
                        if ($key == 0){
                            $active = "active";
                        }
                        echo '
                        <li data-target="#myCarousel" data-slide-to="'.$key.'" class="'.$active.'"></li>
                        ';
                    }}
                     ?>
                </ol>
                <!-- Wrapper for carousel items -->
                <div class="carousel-inner">
                    <?php
                    if (!empty($images[0])){
                    foreach ($images as $key => $image) {
                        $active = "";
                        if ($key == 0){
                            $active = "active";
                        }
                        echo ('
                        <div class="carousel-item '.$active.'">
                            <img src="userFiles/'.$image.'" alt="Image">
                        </div>
                        ');
                    }} else {
                        echo ('
                        <div class="carousel-item active">
                            <img src="assets/placeholderImage.jpg" alt="No Images">
                        </div>
                        ');
                    }
                     ?>
                </div>
                <!-- Carousel controls -->
                <a class="carousel-control-prev" href="#myCarousel" data-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                </a>
                <a class="carousel-control-next" href="#myCarousel" data-slide="next">
                    <span class="carousel-control-next-icon"></span>
                </a>
            </div>
        </div>
    </div>
    <!-- Images for current listing -->

    <!-- LISTING DESCRIPTION -->
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-8">
                <div class="text-block">
                    <p class="text-primary"><i class="fas fa-map-marker fa mr-1"></i> <?php echo($prop['address'].', '.$prop['city'].', '.$prop['province'].' '.$prop['pCode']); ?></p>
                    <h1><?php echo $list['title'] ?></h1>
                    <p class="text-muted text-uppercase mb-4"><?php echo $list['listType']; ?> <?php echo $prop["buildDate"]==""?"":" - Built: ".$prop["buildDate"] ?></p>
                    <ul class="list-inline text-sm mb-4">
                        <!-- <li class="list-inline-item mr-3"><i class="fa fa-users mr-1 text-secondary"></i> 4 guests</li> -->
                        <li class="list-inline-item mr-3"><i class="fa fa-bed mr-1 text-secondary"></i>
                            <?php echo $prop['beds'].' bedroom'. ($prop['beds'] > 1? 's':''); ?>
                        </li>
                        <li class="list-inline-item mr-3"><i class="fa fa-bath mr-1 text-secondary"></i>
                            <?php echo $prop['baths'].' bathroom'. ($prop['baths'] > 1? 's':''); ?>
                        </li>
                        <li class="list-inline-item mr-3"><i class="fa fa-car mr-1 text-secondary"></i>
                            <?php echo $prop['parkSpots'].' parking spot'. ($prop['parkSpots'] > 1? 's':''); ?>
                        </li>
                    </ul>
                    <p class="text-muted font-weight-light"><?php echo $prop['desc']; ?></p>
                </div>
                <div class="text-block">
                    <h4 class="mb-4">Included Amenities</h4>
                    <ul class="list-inline">
                        <?php
                        $util = $prop['utilities'];
                        $util = explode(',',$util);
                        foreach ($util as $item){
                            echo '
                            <li class="list-inline-item mb-2"><span
                                    class="badge badge-pill badge-light p-3 text-muted font-weight-normal">'.$item.'</span></li>
                            ';
                        }
                         ?>
                    </ul>
                </div>
            </div>
            <div class="col-lg-4">
                <div style="top: 100px;" class="p-4 shadow ml-lg-4 rounded sticky-top">
                    <p class="text-muted"><span class="text-primary h1">$ <?php echo $list['price']; ?> </span> per month</p>
                    <p class="text-muted"><span class="text-secondary h4">$ <?php echo $list['deposit']; ?> </span> deposit</p>
                    <hr class="my-4">
                    <!-- <form id="booking-form" method="get" action="#" autocomplete="off" class="form">
                        <div class="form-group">
                            <label for="bookingDate" class="form-label">Month of Move In</label>
                            <select name="guests" id="guests" class="form-control">
                                <option value="1">January</option>
                                <option value="2">Feburary</option>
                                <option value="3">March</option>
                                <option value="4">April</option>
                                <option value="5">May</option>
                                <option value="6">June</option>
                                <option value="7">July</option>
                                <option value="8">August</option>
                                <option value="9">September</option>
                                <option value="10">October</option>
                                <option value="11">November</option>
                                <option value="12">December</option>
                            </select>
                        </div>
                        <div class="form-group mb-4">
                            <label for="guests" class="form-label">Length of Rent</label>
                            <select name="guests" id="guests" class="form-control">
                                <option value="1">6 months</option>
                                <option value="2">8 months (school year)</option>
                                <option value="3">1 year</option>
                                <option value="4">2 years</option>
                                <option value="5">5 years</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block">Contact Landlord</button>
                        </div>
                    </form> -->
                    <button type="submit" class="btn btn-primary btn-block my-4">Contact Landlord</button>
                    <!-- <hr class="my-4"> -->
                    <div class="text-center">
                        <?php // TODO: add bookmarking feature ?>
                        <p> <a href="#" class="text-secondary text-sm"> <i class="fa fa-heart"></i> Bookmark This Listing</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- LISTING DESCRIPTION -->

    <!-- Footer-->
    <?php include 'footer.php'?>

    <?php include 'scriptsGeneral.html' ?>

</body>

</html>
