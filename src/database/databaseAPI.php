<?php
// This file contains functions to get or store info from the database

// establish connection
include_once 'connection.php';
include_once (dirname(__DIR__) . '/script/deleteUserFiles.php');

// returns true if match is found
function login($email, $pass)
{
    $con = connect();
    $hashed = md5($pass);
    // the upper like comparator finds an email with non sensitive case
    $sql = "SELECT pwd, stat FROM Account WHERE UPPER(email) LIKE UPPER(?)";
    if ($stmt = $con->prepare($sql)){
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $stmt->bind_result($pwd, $status);
        while ($stmt->fetch()){
            if ($hashed == $pwd && $status == "online"){
                // logged in succesfully
                return true;
            }
        }
    }
    // failed to login
    return false;
}

function checkAccountActive($email){
    $con = connect();
    // the upper like comparator finds an email with non sensitive case
    $sql = "SELECT stat FROM Account WHERE email = ?";
    if ($stmt = $con->prepare($sql)){
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $stmt->bind_result($status);
        while ($stmt->fetch()){
            if ($status == "online"){
                // account active
                return true;
            }
        }
    }
    // failed to login
    return false;
}

function adminLogin($email, $pass)
{
    $con = connect();
    $hashed = md5($pass);
    // the upper like comparator finds an email with non sensitive case
    $sql = "SELECT pwd FROM Admin WHERE UPPER(email) LIKE UPPER(?)";
    if ($stmt = $con->prepare($sql)){
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $stmt->bind_result($pwd);
        while ($stmt->fetch()){
            if ($hashed == $pwd){
                // logged in succesfully
                return true;
            }
        }
    }
    // failed to login
    return false;
}

function checkEmailUsed($email)
{
    $con = connect();
    $sql = "SELECT email FROM Account WHERE UPPER(email) LIKE UPPER(?)";
    if ($stmt = $con->prepare($sql)){
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $stmt->bind_result($email2);
        while ($stmt->fetch()){
            if ($email = $email2){
                // email is used
                return true;
            }
        }
    }
    // email not used
    return false;
}

// returns true if registered succesfully, false if email already used
function register($email, $pass, $fName, $lName, $phoneNum)
{
    if (checkEmailUsed($email)){
        // if email is already used, return false
        return false;
    }

    $con = connect();
    $sql = "INSERT INTO Account (email, pwd, fName, lName, pNum) VALUES (?,?,?,?,?)";
    if ($stmt = $con->prepare($sql)){
        $hashed = md5($pass);
        $stmt->bind_param('sssss', $email, $hashed, $fName, $lName, $phoneNum);
        if ($stmt->execute()){
            // register successful
            return true;
        }
    }
    // register unsuccessful
    return false;
}

// removes account
function removeAccount($email)
{
    if (!checkEmailUsed($email)){
        return false;
    }

    $con = connect();
    $sql = "DELETE FROM Account WHERE UPPER(email) LIKE UPPER(?)";
    if ($stmt = $con->prepare($sql)){
        $stmt->bind_param('s', $email);
        if ($stmt->execute()){
            // removal successful
            return true;
        }
    }
    // removal unsuccessful
    return false;
}

// retruns array of account details
function getAccountDetails($email)
{
    if (!checkEmailUsed($email)){
        return false;
    }

    $con = connect();
    $sql = "SELECT fName,lName,pNum,subId,stat,token FROM Account WHERE UPPER(email) LIKE UPPER(?)";
    if ($stmt = $con->prepare($sql)){
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $stmt->bind_result($fName,$lName,$pNum,$subId,$status,$token);
        while ($stmt->fetch()){
            $details = array($email, $fName, $lName, $pNum, $subId, $status,$token);
            return $details;
        }
    }
    // failed to get account details
    return false;
}

function getAllAccounts()
{
    $con = connect();
    $sql = "SELECT email FROM Account";
    if ($stmt = $con->prepare($sql)){
        if ($stmt->execute()){
            $stmt->bind_result($email);
            $accounts = array();
            while ($stmt->fetch()){
                array_push($accounts, $email);
            }
            return $accounts;
        }
    }
    // failed to get account details
    return false;
}

function changeAccountStatus($email, $status){
    if (($status != "online" && $status != "offline") || !checkEmailUsed($email)){
        return false;
    }

    $con = connect();
    $sql = "update Account set stat = ? where email = ?";
    if ($stmt = $con->prepare($sql)){
        $stmt->bind_param('ss', $status, $email);
        if ($stmt->execute()){
            return true;
        }
    }
    // if something went wrong
    return false;
}

// returns true if created succesfully
function createListing($idProp, $email, $title, $dateStart, $dateEnd, $price, $listType, $stat, $deposit, $termLease)
{
    // if any int/double vars are not numeric, return false
    if (!is_numeric($idProp) || !is_numeric($price) || !is_numeric($deposit) || !checkEmailUsed($email)){
        return false;
    }

    $con = connect();
    $sql = "insert into Listing (idProp, email, title, dateStart, dateEnd, price, listType, stat, deposit, termLease) VALUES (?,?,?,?,?,?,?,?,?,?)";
    if ($stmt = $con->prepare($sql)){
        $stmt->bind_param('issssdssds', $idProp, $email, $title, $dateStart, $dateEnd, $price, $listType, $stat, $deposit, $termLease);
        if ($stmt->execute()){
            // succesfully added listing
            return $stmt->insert_id;
        }
    }
    // failed to add listing
    return false;
}

// returns true if created succesfully
function createProperty($email, $title, $address, $country, $province, $city, $pCode, $bedRoom, $bathRoom, $parkSpot, $desc, $propType, $stat, $buildDate, $utilities)
{
    // return false if no email to link property to
    if (!checkEmailUsed($email)){
        return false;
    }

    // if postal code is not 6 characters long return false
    $pCode = preg_replace('/[^a-zA-Z0-9]/', '', $pCode);
    if (strlen($pCode) != 6 || !is_numeric($bedRoom) || !is_numeric($bathRoom) || !is_numeric($parkSpot)){
        return false;
    }

    $con = connect();
    $sql = "insert into Property (email, title, address, country,province,city,pCode,bedRoom,bathRoom,parkSpot,description,propType,stat,buildDate,utilities) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
    if ($stmt = $con->prepare($sql)){
        $stmt->bind_param('sssssssiiisssis', $email, $title, $address, $country, $province, $city, $pCode, $bedRoom, $bathRoom, $parkSpot, $desc, $propType, $stat, $buildDate, $utilities);
        if ($stmt->execute()){
            // succesfully added property
            return $stmt->insert_id;
        }
    }
    // failed to add property
    return false;
}

function changeListingStatus($listId, $stat){
    $list = getListing($listId);
    if (!is_numeric($listId) || !($stat == "online" || $stat == "offline") || !$list){
        return false;
    }

    $con = connect();
    $sql = "update Listing set stat = ? where idList = ?";
    if ($stmt = $con->prepare($sql)){
        $stmt->bind_param('si', $stat, $listId);
        if ($stmt->execute()){
            return true;
        }
    }
    // if something went wrong
    return false;
}

function changePropertyStatus($propId, $stat){
    $prop = getProperty($propId);
    if (!is_numeric($propId) || !($stat == "online" || $stat == "offline") || !$prop){
        return false;
    }

    $con = connect();
    $sql = "update Property set stat = ? where idProp = ?";
    if ($stmt = $con->prepare($sql)){
        $stmt->bind_param('si', $stat, $propId);
        if ($stmt->execute()){
            return true;
        }
    }
    // if something went wrong
    return false;
}

function removeListing($listId){
    if (!is_numeric($listId)){
        return false;
    }

    $con = connect();
    $sql = "delete from Listing where idList = ?";
    if ($stmt = $con->prepare($sql)){
        $stmt->bind_param('i', $listId);
        if ($stmt->execute()){
            return true;
        }
    }
    // if something went wrong
    return false;
}

function removeProperty($propId){
    if (!is_numeric($propId) || empty($imgArray)){
        return false;
    }

    $con = connect();
    $sql = "delete from Property where idProp = ?";
    if ($stmt = $con->prepare($sql)){
        $stmt->bind_param('i', $propId);
        if ($stmt->execute()){
            // delete data files
            deleteUserPropertyData($propId);
            return true;
        }
    }
    // if something went wrong
    return false;
}

function checkImageExists($img, $propId){
    if (!is_numeric($propId)){
        return false;
    }

    $con = connect();
    $sql = "select image from Image where idProp = ? and image = ?";
    if ($stmt = $con->prepare($sql)){
        $stmt->bind_param('is', $propId, $img);
        if ($stmt->execute()){
            $stmt->bind_result($image);
            while ($stmt->fetch()){
                if ($image == $img){
                    return true;
                }
            }
        }
    }
    // if no issues
    return false;
}

function addImage($image, $propId){
    if (!is_numeric($propId)){
        return false;
    }

    $con = connect();
    $sql = "insert into Image(idProp, image) VALUES(?,?)";
    if ($stmt = $con->prepare($sql)){
        $stmt->bind_param('is', $propId, $image);
        if ($stmt->execute()){
            // if no issues
            return true;
        }
    }
    // if something went wrong
    return false;
}

function removeImages($imgArray, $propId){
    if (!is_numeric($propId) || empty($imgArray)){
        return false;
    }

    $con = connect();
    foreach ($imgArray as $key => $image) {
        // if image to delete does not exist, return false
        if (!checkImageExists($image, $propId)){
            return false;
        }
        $sql = "delete from Image where idProp = ? and image = ?";
        if ($stmt = $con->prepare($sql)){
            $stmt->bind_param('is', $propId, $image);
            if ($stmt->execute()){
                $email = getEmailFromPropId($propId);
                deleteListingImage($email, $propId, $image);
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    // if no issues
    return true;
}

function getEmailFromPropId($propId){
    if (!is_numeric($propId)){
        return false;
    }

    $con = connect();
    $sql = "select email from Property where idProp = ?";
    if ($stmt = $con->prepare($sql)){
        $stmt->bind_param('i', $propId);
        if ($stmt->execute()){
            $stmt->bind_result($email);
            while ($stmt->fetch()){
                return $email;
            }
        }
    }
    // if something went wrong
    return false;
}

// returns listing details
function getListing($listId)
{
    if (!is_numeric($listId)){
        return false;
    }
    $listId = (int)$listId;

    $con = connect();
    $sql = "SELECT idProp, email, title, dateStart, dateEnd, price, listType, stat, deposit, termLease FROM Listing WHERE idList = ?";
    if ($stmt = $con->prepare($sql)){
        $stmt->bind_param('i', $listId);
        $stmt->execute();
        $stmt->bind_result($idProp, $email, $title, $dateStart, $dateEnd, $price, $listType, $stat, $deposit, $termLease);
        while ($stmt->fetch()){
            $details = array('idProp'=>$idProp, 'email'=>$email, 'title'=>$title, 'dateStart'=>$dateStart, 'dateEnd'=>$dateEnd, 'price'=>$price, 'listType'=>$listType, 'status'=>$stat, 'deposit'=>$deposit, 'termLease'=>$termLease);
            return $details;
        }
    }

    // if something went wrong
    return false;
}

// returns property details as array
function getProperty($propId)
{
    if (!is_numeric($propId)){
        return false;
    }

    $con = connect();
    $sql = "SELECT email, title, address, country,province,city,pCode,bedRoom,bathRoom,parkSpot,description,propType,stat,buildDate,utilities FROM Property WHERE idProp = ?";
    if ($stmt = $con->prepare($sql)){
        $stmt->bind_param('i', $propId);
        $stmt->execute();
        $stmt->bind_result($email, $title, $address, $country, $province, $city, $pCode, $bedRoom, $bathRoom, $parkSpot, $desc, $propType, $stat, $buildDate, $utilities);
        while ($stmt->fetch()){
            $details = array('email' => $email, 'title'=>$title, 'address'=>$address, 'country'=>$country, 'province'=>$province, 'city'=>$city, 'pCode'=>$pCode, 'beds'=>$bedRoom, 'baths'=>$bathRoom, 'parkSpots'=>$parkSpot, 'desc'=>$desc, 'propType'=>$propType, 'status'=>$stat, 'buildDate'=>$buildDate, 'utilities'=>$utilities);
            return $details;
        }
    }

    // if something went wrong
    return false;
}

// returns all listings of a particular account
function getAllListingsOfAccount($email){
    if (!checkEmailUsed($email)){
        return false;
    }

    $con = connect();
    $sql = "SELECT idList FROM Listing WHERE email = ?";
    if ($stmt = $con->prepare($sql)){
        $stmt->bind_param('s', $email);
        if ($stmt->execute()) {
            $stmt->bind_result($listId);
            $listings = array();
            while ($stmt->fetch()){
                array_push($listings, $listId);
            }
            return $listings;
        }
    }

    // if something went wrong
    return false;
}

// returns all image filepaths of a property
function getPropertyImages($propId){
    if (!is_numeric($propId)){
        return false;
    }

    $con = connect();
    $sql = "select image from Image where idProp = ?";
    if ($stmt = $con->prepare($sql)){
        $stmt->bind_param('i', $propId);
        $stmt->execute();
        $stmt->bind_result($image);
        $imgArr = array();
        while ($stmt->fetch()){
            array_push($imgArr, $image);
        }
        if (!empty($imgArr)){
            return $imgArr;
        }
    }

    // if something went wrong
    return false;
}

// update account information
function updateAccount($email, $fName, $lName, $pNum, $subId){
    if (!is_numeric($subId) || !is_numeric($pNum) || !checkEmailUsed($email)){
        return false;
    }

    $con = connect();
    $sql = "UPDATE Account SET fName = ?, lName=?, pNum = ?, subId=? WHERE email = ?";
    if ($stmt = $con->prepare($sql)){
        $stmt->bind_param('ssiis', $fName, $lName, $pNum, $subId, $email);
        if ($stmt->execute()){
            return true;
        }
    }

    // if something went wrong
    return false;
}

function getAvailableCities(){
    $con = connect();
    $sql = "select distinct city from Property";
    if ($stmt = $con->prepare($sql)){
        if ($stmt->execute()){
            $stmt->bind_result($city);
            $arrCities = array();
            while ($stmt->fetch()){
                array_push($arrCities, $city);
            }
            return $arrCities;
        }
    }
    // if something went wrong
    return false;
}

// returns list/array of found listing ids
function searchListings($builtBy, $minBeds, $maxBeds, $minBaths, $maxBaths, $minParking, $minRent, $maxRent)
{

    $con = connect();
    $sql = "SELECT idList FROM Property Right Join Listing on Property.idProp = Listing.idProp Where buildDate >= ? and (bedRoom >= ? and bedRoom <= ?) and (bathRoom >= ? and bathRoom <= ?) and parkSpot >= ? and (price >= ? and price <= ?)";
    if ($stmt = $con->prepare($sql)){
        $stmt->bind_param("iiiiiiii", $builtBy, $minBeds, $maxBeds, $minBaths, $maxBaths, $minParking, $minRent, $maxRent);
        if ($stmt->execute()){
            $stmt->bind_result($listId);
            $listings = array();
            while ($stmt->fetch()){
                array_push($listings, $listId);
            }
            return $listings;
        }
    }

    // if something went wrong
    return false;
}

function setAccountToken($email, $token){
    if (!checkEmailUsed($email)){
        return false;
    }

    $con = connect();
    $sql = "UPDATE Account SET token=? WHERE email = ?";
    if ($stmt = $con->prepare($sql)){
        $stmt->bind_param('ss', $token, $email);
        if ($stmt->execute()){
            return true;
        }
    }

    // if something went wrong
    return false;
}

function getTokenAccount($token)
{
    $con = connect();
    $sql = "SELECT email FROM Account WHERE token=?";
    if ($stmt = $con->prepare($sql)){
        $stmt->bind_param('s', $token);
        $stmt->execute();
        $stmt->bind_result($email);
        while ($stmt->fetch()){
            return $email;
        }
    }
    // failed to get account details
    return false;
}

function changeAccountPassword($email, $pass){
    if (!checkEmailUsed($email)){
        return false;
    }

    $con = connect();
    $pwd = md5($pass);
    $sql = "UPDATE Account SET pwd=? WHERE email = ?";
    if ($stmt = $con->prepare($sql)){
        $stmt->bind_param('ss', $pwd, $email);
        if ($stmt->execute()){
            return true;
        }
    }

    // if something went wrong
    return false;
}
