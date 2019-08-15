<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include_once (dirname(__DIR__) . '/database/databaseAPI.php');

$city = $_GET['city'] ?? false;
$termLease = $_GET['termLease'] ?? false;
$propType = $_GET['propType'] ?? false;
$builtBy = $_GET['builtBy'] ?? 0;
$minBeds = $_GET['minBeds'] ?? 0;
$maxBeds = $_GET['maxBeds'] ?? 5;
$minBaths = $_GET['minBaths'] ?? 0;
$maxBaths = $_GET['maxBaths'] ?? 5;
$parkSpots = $_GET['parkSpots'] ?? 0;
$minRent = $_GET['minRent'] ?? 0;
$maxRent = $_GET['maxRent'] ?? 2000;
if ((!is_numeric($builtBy)&&$builtBy!=false)||!is_numeric($minBeds)||!is_numeric($maxBeds)||!is_numeric($minBaths)||!is_numeric($maxBaths)||!is_numeric($parkSpots)||!is_numeric($minRent)||!is_numeric($maxRent)){
    $listings = array();
    header('location: findListing.php?test='.$builtBy.','. $minBeds.','. $maxBeds.','. $minBaths.','.$maxBaths.','.$parkSpots .','.$minRent.','.$maxRent);
} else {
    $maxBeds = $maxBeds==5?100:$maxBeds;
    $maxBaths = $maxBaths==5?100:$maxBaths;
    $parkSpots = $parkSpots==4?100:$parkSpots;
    $maxRent = $maxRent==2000?1000000:$maxRent;
    $tempListings = searchListings($builtBy, $minBeds, $maxBeds, $minBaths,$maxBaths,$parkSpots ,$minRent,$maxRent);
    // check city, termLease, propType
    $listings = array();
    foreach ($tempListings as $key => $listing) {
        $list = getListing($listing);
        $prop = getProperty($list['idProp']);
        if ((strcasecmp($prop['city'],$city)==0 || !$city) && $list['status'] == 'online' && ($list['termLease']==$termLease || !$termLease) && ($list['listType']==$propType || !$propType)){
            array_push($listings, $listing);
        }
    }
}
 ?>
