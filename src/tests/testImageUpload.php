<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>File Upload with PHP</title>
</head>
<body>
    <h3>Test site for image uploading</h3>
    <?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    $_SESSION['userEmail'] = 'test';
     ?>

    <form action="../script/processAddListing.php" method="post" enctype="multipart/form-data">
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text" name="images" id="inputGroupFileAddon01">Upload Images</span>
            </div>
            <div class="custom-file">
                <input type="file" class="custom-file-input" id="inputGroupFile" aria-describedby="inputGroupFileAddon01" name="images[]" multiple accept="image/*">
            </div>
        </div>
        <input type="submit" name="submit" value="Upload File Now">
    </form>

    <form action="../script/deleteUserFiles.php" method="post">
        <button type="submit">Delete Files</button>
    </form>

    <script src="../js/jquery.min.js"></script>
    <script type="text/javascript">
    // make sure uploaded files aren't too large
    $('#inputGroupFile').bind('change', function() {
      //this.files[0].size gets the size of your file.
      alert("test");
      var isOk = true;
      for (var i = 0; i<this.files.length; i++){
          if (this.files[i].size <= 0 || this.files[i].size > 1000000){
              console.log(this.files[i].size);
              isOk = false;
          }
      }
      // if file size is not good, empty input field and show error msg
      if (!isOk){
          document.getElementById('inputGroupFile').value= null;
      }
    });
    </script>
</body>
</html>
