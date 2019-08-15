<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include_once (dirname(__DIR__) . '/database/databaseAPI.php');

// check if logged in and correct method type
$infoGood = false;
if (isset($_SESSION["userEmail"]) && $_SERVER["REQUEST_METHOD"]=="POST") {
    // check values not null/empty
    // check listing info
    if (isset($_POST["listingTitle"]) && isset($_POST["deposit"]) && isset($_POST["termLease"]) && isset($_POST["monthlyRent"]) && isset($_POST["selectListType"])){
        // check property info
        if (isset($_POST["city"]) && isset($_POST["propertyTitle"]) && isset($_POST["address"]) && isset($_POST["province"]) && isset($_POST["postalCode"]) && isset($_POST["bathrooms"]) && isset($_POST["bedrooms"]) && isset($_POST["parkingSpots"]) && isset($_POST["country"])) {
            $infoGood = true;
        }
    }
}

if ($infoGood) {
    // put info onto database
    // property
    $buildDate = $_POST["buildDate"];
    $utilities = implode(",", $_POST["utilities"]);
    $propId = createProperty($_SESSION["userEmail"], $_POST["propertyTitle"], $_POST["address"], $_POST["country"], $_POST["province"], $_POST["city"], $_POST["postalCode"], $_POST["bedrooms"], $_POST["bathrooms"], $_POST["parkingSpots"], $_POST["description"], "", "online", $buildDate, $utilities);
    // listing
    $dateStart = ""; //$_POST["dateStart"];
    $dateEnd = ""; //$_POST["dateEnd"];
    $listId = createListing($propId, $_SESSION["userEmail"], $_POST["listingTitle"], $dateStart, $dateEnd, $_POST["monthlyRent"], $_POST["selectListType"], "online", $_POST["deposit"], $_POST["termLease"]);

    // upload images
    $addImgs = true;
    $images = $_FILES["images"]["name"];
    if (!empty($images[0])){
        include (dirname(__DIR__) . '/script/uploadImages.php');
    }

    if ($propId == false || $listId == false || isset($_SESSION["errorMsg"]) || $addImgs == false){
        // delete listing and all details/data
        removeListing($listId);
        removeImages($images, $propId);
        removeProperty($propId);
        // show error msg and redirect back to addListing page
        // $_SESSION["errorMsg"] = $images[0] .', '.$propId.', '.$_SESSION["userEmail"].', '. $_POST["propertyTitle"].', '. $_POST["address"].', '. $_POST["country"].', '. $_POST["province"].', '. $_POST["city"].', '. $_POST["postalCode"].', '. $_POST["bedrooms"].', '. $_POST["bathrooms"].', '. $_POST["parkingSpots"].', '. $_POST["description"].', '. "".', '. "online".', '. $buildDate.', '. $utilities.', '. $dateStart.', '. $dateEnd;
        $_SESSION["errorMsg"] = "ERROR: Something went wrong.";
        header("location: ../addListing.php");
    } else {
        // if all went correctly:
        // redirect to viewListing and display newly created listing
        header("location: ../viewListing.php?listId=".$listId);
    }
} else {
    $_SESSION["errorMsg"] = "ERROR: Bad data.";
    header("location: ../addListing.php");
}

 ?>
