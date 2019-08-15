<?php
deleteUserFiles("test");
// deleteDir(dirname(__DIR__).'/userFiles'.'/test');

// deletes user files and account
function deleteUserFiles($email) {
    $dirPath = (dirname(__DIR__).'/userFiles'.'/'.$email);

    if (deleteDir($dirPath)){
        return true;
    } else {
        return false;
    }
}

function deleteUserPropertyData($email, $propId){
    $dirPath = (dirname(__DIR__).'/userFiles'.'/'.$email.'/'.$propId);

    if (deleteDir($dirPath)){
        return true;
    } else {
        return false;
    }
}

function deleteListingImage($email, $propId, $image){
    try {
        $imgToRem = (dirname(__DIR__).'/userFiles'.'/'.$email.'/'.$propId.'/'.$image);
        if (is_file($imgToRem) && file_exists($imgToRem)){
            unlink($imgToRem) or die("Couldn't delete file");
        }
    } catch (Exception $e) {}
}

function deleteDir($path) {
    $dirPath = $path;
    if (!is_dir($dirPath)) {
        return false;
    }
    if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
        $dirPath .= '/';
    }
    $files = glob($dirPath . '*', GLOB_MARK);
    foreach ($files as $file) {
        if (is_dir($file)) {
            deleteDir($file);
        } else {
            unlink($file);
        }
    }
    rmdir($dirPath);
    return true;
}
 ?>
