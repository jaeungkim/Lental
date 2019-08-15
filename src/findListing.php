<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <title>Lental - Find Listings</title>
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway:400,800">
    <link rel='stylesheet' href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/nouislider.css">
    <link rel="stylesheet" href="css/general.css">
    <link rel="stylesheet" href="css/findListing.css">
</head>

<body>

    <?php
    include "script/processSearchListings.php";
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    $_SESSION['currentPage']="search";
    include 'header.php';
     ?>

    <div class="jumbotron shadow" id="jumboFindListing">
        <button class="btn btn-secondary" type="button" data-toggle="collapse" data-target="#filters" aria-expanded="false" aria-controls="filters">
            Toggle Filters
        </button>
        <!-- TODO: have a modal popup to enter a title to save filter under? -->
        <!-- <button class="btn btn-outline-secondary">
            Save Filter
        </button>
        <button class="btn btn-outline-secondary">
            Use Saved Filter
        </button>
        <div class="btn-group">
            <button class="btn btn-outline-secondary">
                Setup Search Agent
            </button>
            <button type="button" class="btn btn-outline-secondary" data-container="body" data-toggle="popover" data-trigger="focus" data-placement="top"
                data-content="Setup a search agent that will send you automatic emails at a set interval of new listings based on your filters">?</button>
        </div> -->

        <div class="container collapse" id="filters">
            <form method="get">
                <div class="form-row">
                    <div class="form-group form-row col-lg-5">
                        <label class="col-sm-4 col-form-label">City</label>
                        <div class="col-sm-8">
                            <select class="form-control" id="selectCity" required>
                                <?php
                                $sel = '';
                                echo '<option value="">Any</option>';
                                $cities = getAvailableCities();
                                foreach ($cities as $key => $cityTemp){
                                    if ($city == $cityTemp){
                                        $sel = 'selected="selected"';
                                    } else {
                                        $sel = '';
                                    }
                                    echo "<option ".$sel.">".$cityTemp."</option>";
                                }
                                 ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-2"></div>
                    <!-- List type dropdown -->
                    <div class="form-group form-row col-lg-5">
                        <label class="col-sm-4 col-form-label">Term Lease</label>
                        <div class="col-sm-8">
                            <select class="form-control" id="selectTermLease" name="termLease" required>
                                <option selected="selected" value="">Any</option>
                                <?php $sel = 'selected="selected"'; ?>
                                <option <?php if ($termLease=="Short Term") {echo $sel;} ?>>Short Term</option>
                                <option <?php if ($termLease=="Mid Term (limited)") {echo $sel;} ?>>Mid Term (limited)</option>
                                <option <?php if ($termLease=="Open Term (long term)") {echo $sel;} ?>>Open Term (long term)</option>
                            </select>
                        </div>
                    </div>
                    <!-- TODO implement range -->
                    <!-- <div class="form-group form-row col-lg-5">
                        <label class="col-sm-4 col-form-label">Range (Km)</label>
                        <div class="col-sm-8">
                            <div class="slider-padding">
                                <div id="rangeSlider"></div>
                            </div>
                        </div>
                    </div> -->
                </div>
                <hr style="margin-bottom: 2em;">
                <div class="form-row">
                    <div class="form-group form-row col-lg-5">
                        <label class="col-sm-4 col-form-label">Built By</label>
                        <div class="col-sm-8">
                            <select class="form-control select-padding" id="selectBuilt">
                                <option selected="selected" value="">Anytime</option>
                                <?php
                                $yearStop = 1950;
                                $currYear = date("Y");
                                for ($year = $currYear; $year >= $yearStop; $year--){
                                    if ($builtBy==$year){
                                        $sel = 'selected="selected"';
                                    } else {
                                        $sel = '';
                                    }
                                    echo "<option ".$sel.">".$year."</option>";
                                }
                                 ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-2"></div>
                    <div class="form-group form-row col-lg-5">
                        <label class="col-sm-4 col-form-label">Property Type</label>
                        <div class="col-sm-8">
                            <select class="form-control select-padding" id="selectPropType" required>
                                <option selected="selected" value="">Any</option>
                                <?php
                                $propTypes = array("Room/Sharing","Studio","Apartment","Townhouse","Detached House","Acreage/Farm","Other");
                                foreach ($propTypes as $type){
                                    if ($type==$propType){
                                        $sel = 'selected="selected"';
                                    } else {
                                        $sel = '';
                                    }
                                    echo '<option '.$sel.'>'.$type.'</option>';
                                }
                                 ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group form-row col-lg-5">
                        <label class="col-sm-4 col-form-label">Bedrooms</label>
                        <div class="col-sm-8">
                            <div class="slider-padding">
                                <div id="bedSlider"></div>
                            </div>
                        </div>
                        <!-- Keeping for example -->
                        <!-- <div class="btn-group btn-group-toggle col-sm-9" data-toggle="buttons">
                            <label class="btn btn-outline-secondary">
                                <input type="checkbox" name="bedrooms" id="bed1" autocomplete="off">1
                            </label>
                            <label class="btn btn-outline-secondary">
                                <input type="checkbox" name="bedrooms" id="bed2" autocomplete="off">2
                            </label>
                            <label class="btn btn-outline-secondary">
                                <input type="checkbox" name="bedrooms" id="bed3" autocomplete="off">3
                            </label>
                            <label class="btn btn-outline-secondary">
                                <input type="checkbox" name="bedrooms" id="bed4+" autocomplete="off">4+
                            </label>
                        </div> -->
                    </div>
                    <div class="col-lg-2"></div>
                    <div class="form-group form-row col-lg-5">
                        <label class="col-sm-4 col-form-label">Bathrooms</label>
                        <div class="col-sm-8">
                            <div id="bathSlider" class="slider-padding"></div>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group form-row col-lg-5">
                        <label class="col-sm-4 col-form-label">Parking Spots</label>
                        <div class="col-sm-8">
                            <div class="slider-padding">
                                <div id="parkSlider"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr style="margin-bottom: 2em;">
                <div class="form-row" style="margin-bottom: 2em;">
                    <label class="col-sm-3 col-form-label">Monthly Rent</label>
                    <div class="col-sm-9">
                        <div class="slider-padding" style="margin-left: 1em; margin-right: 1em;">
                            <div id="priceSlider" name="priceSlider"></div>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <button class="col-2 btn btn-primary" type="button" id="apply">Apply</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Listings -->
    <!-- may need resizing for phones -->
    <div class="list-group container listing-container">
        <?php
        foreach ($listings as $key => $id){
            $list = getListing($id);
            $email = $list['email'];
            $propId = $list['idProp'];
            $prop = getProperty($propId);
            $images = getPropertyImages($propId);
            $imgPath = 'userFiles/'.$images[0];
            echo '
            <a href="viewListing.php?listId='.$id.'" class="list-group-item list-group-item-action flex-column align-items-start">
                <div class="row">
                    <div class="col-auto">
                        <img src="'.$imgPath.'" class="img-fit">
                    </div>
                    <div class="col">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1">'.$list["title"].'</h5>
                            <h4 class="listing-price">$'.$list["price"].'</h4>
                        </div>
                        <p class="mb-1">'.$prop['beds'].' Bedrooms | '.$prop['baths'].' Bathrooms | '.$prop['parkSpots'].' Parking Spot</p>
                        <div class="d-flex w-100 justify-content-between">
                            <small>'.$list['listType'].($prop["buildDate"]==""?"":" - Built: ".$prop["buildDate"]).(empty($prop["utilities"])?'':' - Includes: '.$prop["utilities"]).'</small>
                            <small>'.$prop['city'].', '.$prop['province'].'</small>
                        </div>
                    </div>
                </div>
            </a>
            ';
        }
        if (empty($listings)){
            echo '<h5 class="mb-1">No listings found</h5>';
        }
         ?>
    </div>

    <?php include 'footer.php' ?>

    <?php include 'scriptsGeneral.html' ?>
    <script src="js/nouislider.min.js"></script>
    <script src="https://unpkg.com/wnumb@1.1.0"></script>
    <script src="js/findListing.js"></script>
    <script>
    // create sliders
    var bathSlider = createSlider('bathSlider',0,5,<?php echo $minBaths; ?>,<?php echo $maxBaths; ?>,1,'', 0, true);
    var bedSlider = createSlider('bedSlider',0,5,<?php echo $minBeds; ?>,<?php echo $maxBeds; ?>,1,'', 0, true);
    var priceSlider = createSlider('priceSlider',0,2000,<?php echo $minRent; ?>,<?php echo $maxRent; ?>,100,'$', 0, true);
    var parkSlider = createSingleSlider('parkSlider',0,4,<?php echo $parkSpots; ?>,1,'', 0, true,'upper');
    // createSingleSlider('rangeSlider',0,100,5,'',0,true,'lower');

    // when apply button is clicked
    $("#apply").on("click", function(){
        var beds = bedSlider.noUiSlider.get();
        beds[0] = filt(beds[0]);
        beds[1] = filt(beds[1]);
        var baths = bathSlider.noUiSlider.get();
        baths[0] = filt(baths[0]);
        baths[1] = filt(baths[1]);
        var parkSpots = parkSlider.noUiSlider.get();
        parkSpots = filt(parkSpots);
        var rent = priceSlider.noUiSlider.get();
        rent[0] = filt(rent[0]);
        rent[1] = filt(rent[1]);
        var city = $('#selectCity').val();
        var built = $('#selectBuilt').val();
        var termLease = $('#selectTermLease').val();
        var propType = $('#selectPropType').val();

        document.location.href = 'findListing.php?minBeds='+beds[0]+'&maxBeds='+beds[1]+'&minBaths='+baths[0]+'&maxBaths='+baths[1]+'&parkSpots='+parkSpots+'&minRent='+rent[0]+'&maxRent='+rent[1]+'&city='+city+'&builtBy='+built+'&termLease='+termLease+'&propType='+propType;
    });

    function filt(val){
        return val.replace(/[^a-zA-Z0-9]/g,'');
    }
    </script>
</body>

</html>
