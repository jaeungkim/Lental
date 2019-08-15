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
</head>

<body>
    <?php include 'admin_header.php';
    include_once ('database/databaseAPI.php');
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
     ?>
     <div class="py-3 container-fluid">
         <table class="table table-light table-hover table-striped thead-dark table-responsive-sm">
             <thead>
                 <tr>
                     <th>Listing Status</th>
                     <th>Listing Id</th>
                     <th>Property Id</th>
                     <th>Title</th>
                     <th>Email</th>
                     <th>Delete Listing</th>
                     <th>Change Status</th>
                     <th>View Listing</th>
                 </tr>
             </thead>
             <tbody>
                 <?php
                 // get all listings
                 $listings = searchListings(0,0,1000,0,1000,0,0,10000000);
                 foreach ($listings as $listId){
                     $list = getListing($listId);
                     $funcDel = "deleteListing('".$listId."')";
                     if ($list['status'] == "online"){
                         $statBtn = '<td><a href="admin_changeListingStatus.php?listId='.$listId.'&status=offline" class="btn btn-danger update">
                             Disable Listing </a></td>';
                     } else {
                         $statBtn = '<td><a href="admin_changeListingStatus.php?listId='.$listId.'&status=online" class="btn btn-primary update">
                             Activate Listing </a></td>';
                     }
                     if ($list['status'] == 'online'){
                         $color = 'green';
                     } else {
                         $color = 'red';
                     }
                     echo '
                     <tr>
                         <td style="color: '.$color.';">'.$list['status'].'</td>
                         <td>'.$listId.'</td>
                         <td>'.$list['idProp'].'</td>
                         <td>'.$list['title'].'</td>
                         <td>'.$list['email'].'</td>
                         <td><button type="button" onClick="'.$funcDel.'" class="btn btn-danger update" data-toggle="modal" data-target="#confirmModal">
                             Delete Listing </button></td>
                         '.$statBtn.'
                         <td><a class="btn btn-primary" href="admin_viewListing.php?listId='.$listId.'">View Listing</a></td>
                     </tr>
                     ';
                 }
                  ?>
             </tbody>
         </table>
     </div>

     <!-- Confirm Modal -->
     <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
         <div class="modal-dialog modal-dialog-centered" role="document">
             <div class="modal-content">
                 <div class="modal-header">
                     <h5 class="modal-title" id="exampleModalLongTitle">Are you sure?</h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                     </button>
                 </div>
                 <div class="modal-body">
                     Are you sure you want to delete this listing? This action is irreversible.
                 </div>
                 <div class="modal-footer">
                     <form action="admin_deleteListing.php" method="post">
                         <input type="text" id="listingConfirm" name="listId" hidden></input>
                         <button type="submit" class="btn btn-danger">Delete</button>
                         <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
                     </form>
                 </div>
             </div>
         </div>
     </div>
     <!-- end confirm modal -->
 </body>

    <script src="js/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/otherGeneral.js"></script>
    <script>
    function deleteListing(listId){
        $('#listingConfirm').val(listId);
        $('#confirmModal').modal('toggle');
    }
    </script>

</html>
