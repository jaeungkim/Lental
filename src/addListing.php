<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <title>Lental - Add Listing</title>
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway:400,800">
    <link rel='stylesheet' href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/general.css">
    <link rel="stylesheet" href="leaflet/leaflet.css" />
    <link rel="stylesheet" href="css/addListing.css" />

</head>

<body>

    <?php
    include 'header.php';
    include 'script/loggedInCheck.php';
    ?>

    <!-- The info under the navbar, jumbo -->
    <div class="jumbotron jumbotron-fluid bg-house shadow">
        <div class="container">
            <h1 class="display-4">Add Listing</h1>
            <p class="lead" style="max-width:20em;">Here you can add a listing and associate it with a property (or create a new one)</p>
        </div>
    </div>

    <!-- accordion -->
    <form action="script/processAddListing.php" method="post" enctype="multipart/form-data">
        <div class="container">
            <div class="accordion" id="accordionExample">
                <div class="card">
                    <a class="tabFocus" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne" tabindex="0">
                    <div class="card-header" id="headingOne">
                        <h2 class="mb-0">
                            <span class="btn">
                                Listing Information
                            </span>
                        </h2>
                    </div>
                    </a>

                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                        <div class="card-body">
                            <div class="row">
                                <!-- Title -->
                                <div class="input-group mb-3 col-md-12">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Listing Title</span>
                                    </div>
                                    <input type="text" class="form-control" name="listingTitle" required>
                                </div>
                            </div>

                            <div class="row">
                                <!-- Deposit -->
                                <div class="input-group mb-3 col-md-6">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Deposit: $</span>
                                    </div>
                                    <input type="number" class="form-control" min="0" oninput="this.value = Math.abs(this.value)" name="deposit" required>
                                    <div class="input-group-append">
                                        <span class="input-group-text">.00</span>
                                    </div>
                                </div>

                                <!-- List type dropdown -->
                                <div class="input-group mb-3 col-md-6">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Term Lease</span>
                                    </div>
                                    <select class="form-control" name="termLease" required>
                                        <option selected="selected" value="">Select</option>
                                        <option>Short Term</option>
                                        <option>Mid Term (limited)</option>
                                        <option>Open Term (long term)</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Monthly Rent -->
                            <div class="row">
                                <div class="input-group mb-3 col-md-6">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Monthly Rent: $</span>
                                    </div>
                                    <input type="number" class="form-control" min="0" oninput="this.value = Math.abs(this.value)" name="monthlyRent" required>
                                    <div class="input-group-append">
                                        <span class="input-group-text">.00</span>
                                    </div>
                                </div>

                                <!-- List type dropdown -->
                                <div class="input-group mb-3 col-md-6">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">List Type</span>
                                    </div>
                                    <select class="form-control" name="selectListType" required>
                                        <option selected="selected" value="">Select</option>
                                        <option>Room/Sharing</option>
                                        <option>Studio</option>
                                        <option>Apartment</option>
                                        <option>Townhouse</option>
                                        <option>Detached House</option>
                                        <option>Acreage/Farm</option>
                                        <option>Other</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <!-- Start Date -->
                                <div class="input-group mb-3 col-md-6">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Start Date</span>
                                        <button type="button" class="btn btn-secondary" data-container="body" data-toggle="popover" data-trigger="focus" data-placement="top" data-content="When the listing post goes online.">?</button>
                                    </div>
                                    <input class="form-control" type="date" name="dateStart" readonly value="<?php
                                    // days will be amount of time the listing will be posted for
                                    $days = 30;
                                    $date = new DateTime('now'); // Y-m-d
                                    echo $date->format('Y-m-d');
                                     ?>">
                                </div>

                                <!-- End Date -->
                                <div class="input-group mb-3 col-md-6">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">End Date</span>
                                        <button type="button" class="btn btn-secondary" data-container="body" data-toggle="popover" data-trigger="focus" data-placement="top"
                                            data-content="The amount of time the listing will be online for before it needs to be renewed.">?</button>
                                    </div>
                                    <input class="form-control" type="date" name="dateEnd" readonly value="<?php
                                    // days will be amount of time the listing will be posted for
                                    $days = 30;
                                    $date = new DateTime('now'); // Y-m-d
                                    $date->add(new DateInterval('P'.$days.'D'));
                                    echo $date->format('Y-m-d');
                                     ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End listing details card -->

                <div class="card">
                    <a class="collapsed tabFocus" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo" tabindex="0" id="temp1">
                    <div class="card-header" id="headingTwo">
                        <h2 class="mb-0">
                            <span class="btn">
                                Property Information
                            </span>
                        </h2>
                    </div>
                    </a>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                        <div class="card-body">
                            <!-- TODO: finish preset properties autofill and update attributes if used -->
                            <!-- Existing properties select -->
                            <!-- <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Preset Properties</span>
                                </div>
                                <select class="form-control" name="selectProperty">
                                    <option selected="selected" value="">- Create New -</option>
                                    <option value="">?</option>
                                    <option value="">?</option>
                                </select>
                            </div>
                            <hr class="hr-fade" style="margin-top: 2em;">
                            <p class="center-text">Select a previously created property or create a new one</p>
                            <hr class="hr-fade" style="margin-bottom: 2em;"> -->

                            <!-- make collapsible -->
                            <div class="row">
                                <!-- left side with title, address, etc -->
                                <div class="col-md-6">
                                    <!-- Title -->
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Property Title</span>
                                        </div>
                                        <input type="text" class="form-control" name="propertyTitle" required>
                                    </div>
                                    <!-- Address -->
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Address</span>
                                        </div>
                                        <input type="text" class="form-control" name="address" id="address" required>
                                    </div>
                                    <!-- City -->
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">City</span>
                                        </div>
                                        <input type="text" class="form-control" name="city" id="city" required>
                                    </div>
                                    <!-- Province -->
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Province</span>
                                        </div>
                                        <input type="text" class="form-control" name="province" id="province" required>
                                    </div>
                                    <!-- Country -->
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Country</span>
                                        </div>
                                        <input type="text" class="form-control" name="country" id="country" required>
                                    </div>
                                    <!-- Postal Code -->
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Postal Code</span>
                                        </div>
                                        <input type="text" class="form-control" name="postalCode" id="pCode" pattern=".{6}" title="Postal Code must be 6 characters" required>
                                    </div>
                                    <div class="alert alert-danger d-none my-2" id="pCodeError" role="alert">
                                        Postal code must be exactly 6 characters long
                                    </div>
                                </div>
                                <!-- mini map -->
                                <div class="col-md-6 shadow" id="miniMap"></div>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- End property details card -->

                <div class="card">
                    <a class="collapsed tabFocus" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree" tabindex="0">
                    <div class="card-header" id="headingThree">
                        <h2 class="mb-0">
                            <span class="btn">
                                Property Details
                            </button>
                        </h2>
                    </div>
                    </a>
                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                        <div class="card-body">

                            <div class="row">
                                <!-- Bedrooms -->
                                <div class="input-group mb-3 col-md-6">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Bedrooms</span>
                                    </div>
                                    <input type="number" class="form-control" min="0" oninput="this.value = Math.abs(this.value)" name="bedrooms" required>
                                </div>

                                <!-- Bathrooms -->
                                <div class="input-group mb-3 col-md-6">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Bathrooms</span>
                                    </div>
                                    <input type="number" class="form-control" min="0" oninput="this.value = Math.abs(this.value)" name="bathrooms" required>
                                </div>
                            </div>

                            <div class="row">
                                <!-- Parking spots -->
                                <div class="input-group mb-3 col-md-6">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Parkings Spots</span>
                                    </div>
                                    <input type="number" class="form-control" min="0" oninput="this.value = Math.abs(this.value)" name="parkingSpots" required>
                                </div>

                                <!-- Build Date -->
                                <div class="input-group mb-3 col-md-6">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Built</span>
                                        <button type="button" class="btn btn-secondary" data-container="body" data-toggle="popover" data-trigger="focus" data-placement="top" data-content="When the house was built.">?</button>
                                    </div>
                                    <select class="form-control" name="buildDate">
                                        <option selected="selected" value="">Select Year</option>
                                        <?php
                                        $yearStop = 1950;
                                        $currYear = date("Y");
                                        for ($year = $currYear; $year >= $yearStop; $year--){
                                            echo "<option>".$year."</option>";
                                        }
                                         ?>
                                    </select>
                                </div>
                            </div>
                            <div class="input-group mb-3 btn-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Included Utilities</span>
                                </div>
                                <div class="btn-group btn-group-toggle" role="group" data-toggle="buttons" aria-label="Basic example">
                                    <label class="btn btn-outline-secondary">
                                        <input type="checkbox" autocomplete="off" name="utilities[]" value="Water">Water</input>
                                    </label>
                                    <label class="btn btn-outline-secondary">
                                        <input type="checkbox" autocomplete="off" name="utilities[]", value="Heat/AC">Heat/AC</input>
                                    </label>
                                    <label class="btn btn-outline-secondary">
                                        <input type="checkbox" autocomplete="off" name="utilities[]" value="Internet">Internet</input>
                                    </label>
                                </div>
                            </div>
                            <!-- Description -->
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Description</span>
                                </div>
                                <textarea class="form-control" name="description" aria-label="With textarea"></textarea>
                            </div>
                            <hr>
                            <!-- Upload images -->
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" name="images" id="inputGroupFileAddon01">Upload Images</span>
                                </div>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="inputGroupFile" aria-describedby="inputGroupFileAddon01" name="images[]" multiple accept="image/jpeg, image/x-png, image/gif">
                                    <label class="custom-file-label" for="inputGroupFile">Choose images</label>
                                </div>
                            </div>
                            <!-- Error msg for file input -->
                            <div class="alert alert-danger col-12 d-none" id="imageInputError" style="margin-top: 1em;">
                                <strong>Error!</strong> Images must be 1MB or smaller and have one of the following extensions: .jpeg, .jpg, .gif, .png
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Confirm button -->
        <div class="container" style="margin-top: 1em;">
            <div class="row">
                <!-- <div class="col-sm-6" style="margin-bottom:1em;">
                    <button class="btn btn-secondary btn-block">Save Listing</button></div> -->
                <div class="col-sm-12" style="margin-bottom:1em;">
                    <button id="proceedBtn" type="submit" class="btn btn-outline-primary btn-block">Save and Proceed</button></div>
            </div>
        </div>

        <!-- Error Message (Not all inputs filled) -->
        <div class="container" style="margin-top: 1em;">
            <div class="row">
                <div class="alert alert-danger col-12 d-none" id="addListingError">
                    <strong>Error!</strong> Please fill in all required inputs displayed in yellow.
                </div>
            </div>
        </div>
    </form>

    <!-- Footer -->
    <?php include 'footer.php' ?>

    <?php include 'scriptsGeneral.html' ?>
    <script src="leaflet/leaflet.js"></script>
    <!-- <script src="js/leafletSetup.js"></script> -->
    <script src="js/addListing.js"></script>
</body>

</html>
