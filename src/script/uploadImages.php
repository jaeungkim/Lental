<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER["REQUEST_METHOD"]=="POST" && isset($_FILES['images']) && isset($_SESSION["userEmail"]) && isset($propId) && isset($listId)){
    // set email and propId
    $email = $_SESSION['userEmail'];

    foreach($_FILES['images']["tmp_name"] as $key=>$tmp_name) {
        $rand = random_str(64);
        $imgName = $_FILES['images']['name'][$key];
        $imgTmp = $_FILES['images']['tmp_name'][$key];
        $imgPath = dirname(__DIR__).'/userFiles';
        $imgFileType = strtolower(pathinfo($imgName,PATHINFO_EXTENSION));
        $targetImg = $imgPath.'/'.$rand.'.'.$imgFileType;
        $ext = array("jpg","jpeg","png","gif");
        // debug_to_console(($_FILES['images']['size'][$key]));
        $uploadOk = 1;

        // check extension
        if (in_array($imgFileType,$ext)){
            // check img size (max size = 1MB)
            if ($_FILES["images"]["size"][$key] > 1000000 || $_FILES["images"]["size"][$key] == 0){
                $uploadOk = 0;
            }

            if ($uploadOk) {
                // check if real iamge
                $check = getimagesize($_FILES["images"]["tmp_name"][$key]);
                if ($check == false){
                    $uploadOk = 0;
                }
            }
        } else {
            $uploadOk = 0;
        }

        if ($uploadOk == 1){
            move_uploaded_file($imgTmp=$_FILES["images"]["tmp_name"][$key],$targetImg);
            // add image to database
            addImage($rand.'.'.$imgFileType,$propId);
        } else {
            $_SESSION["errorMsg"] = "ERROR: Something went wrong.";
        }
    } // end foreach
}

function debug_to_console( $data ) {
    $output = $data;
    if ( is_array( $output ) )
        $output = implode( ',', $output);

    echo "<script>console.log( 'Debug: " . $output . "' );</script>";
}

// creates random string
function random_str(
    int $length = 64,
    string $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'
): string {
    if ($length < 1) {
        throw new \RangeException("Length must be a positive integer");
    }
    $pieces = [];
    $max = strlen($keyspace) - 1;
    for ($i = 0; $i < $length; ++$i) {
        $pieces []= $keyspace[random_int(0, $max)];
    }
    return implode('', $pieces);
}
 ?>
