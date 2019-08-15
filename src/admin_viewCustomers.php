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
    <link rel="stylesheet" href="css/admin.css">
</head>

<body>
    <?php include 'admin_header.php';
    include_once ('database/databaseAPI.php');
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
     ?>


    <!-- Searching Through Database - AJAX -->
    <!-- <div class="container-fluid">
        <label for="search" class="font-weight-bold lead text-dark py-3"> Search Customers</label>
        <input type="text" name="search" id="search_text" class="form-control form-control-lg rounded-0 border-primary" placeholder="Search with Name">
    </div> -->
    <!-- Searching Through Database - AJAX -->
    <!-- just viewing registered users for now -->
    <div class="py-3 container-fluid">
        <table class="table table-light table-hover table-striped thead-dark table-responsive-sm" id="table-data">
            <thead>
                <tr>
                    <th>Account Status</th>
                    <th>Email</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Phone Number</th>
                    <th>Subscription ID</th>
                    <th>Update Account</th>
                    <th>Delete Account</th>
                    <th>Change Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $accounts = getAllAccounts();
                foreach ($accounts as $key => $email){
                    $acc = getAccountDetails($email);
                    if ($acc != false){
                        $funcUpdate = "setModal('".$email."','".$acc[1]."','".$acc[2]."','".$acc[3]."','".$acc[4]."')";
                        $funcDel = "deleteAccount('".$email."')";
                        if ($acc[5] == "online"){
                            $statBtn = '<td><a href="admin_changeUserStatus.php?email='.$email.'&status=offline" class="btn btn-danger update">
                                Disable Account </a></td>';
                        } else {
                            $statBtn = '<td><a href="admin_changeUserStatus.php?email='.$email.'&status=online" class="btn btn-primary update">
                                Activate Account </a></td>';
                        }
                        if ($acc[5] == 'online'){
                            $color = 'green';
                        } else {
                            $color = 'red';
                        }
                        echo '
                        <tr id="'.$email.'">
                            <td style="color: '.$color.';">'.$acc[5].'</td>
                            <td id="email'.$email.'">'.$acc[0].'</td>
                            <td data-target="fName">'.$acc[1].'</td>
                            <td data-target="lName">'.$acc[2].'</td>
                            <td data-target="pNum">'.$acc[3].'</td>
                            <td data-target="subId">'.$acc[4].'</td>
                            <td><button type="button" onClick="'.$funcUpdate.'" class="btn btn-primary update" data-toggle="modal" data-target="#myModal">
                                Update Account </button></td>
                            <td><button type="button" onClick="'.$funcDel.'" class="btn btn-danger update" data-toggle="modal" data-target="#confirmModal">
                                Delete Account </button></td>
                            '.$statBtn.'
                        </tr>
                        ';
                    }
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Modal for Updating Customer with AJAX -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="admin_updateUser.php" method="post">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Update Customer</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Email </label>
                            <input type="text" id="email" name="email" class="form-control" readonly>
                        </div>
                        <div class="form-group">
                            <label>First Name </label>
                            <input type="text" id="fName" name="fName" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Last Name </label>
                            <input type="text" id="lName" name="lName" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Phone Number </label>
                            <input type="text" id="pNum" name="pNum" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Subscription ID </label>
                            <input type="text" id="subId" name="subId" class="form-control">
                        </div>
                        <input type="hidden" id="userId" class="form-control">
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary pull-right">Save Changes</button>
                        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- /Modal for Updating Customer with AJAX -->

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
                    Are you sure you want to delete this account? This will also delete all listings and properties linked to this account.
                </div>
                <div class="modal-footer">
                    <form action="admin_deleteUser.php" method="post">
                        <input type="text" id="emailConfirm" name="email" hidden></input>
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
    function deleteAccount(email){
        $('#emailConfirm').val(email);
        $('#confirmModal').modal('toggle');
    }

    function setModal(email, fName, lName, pNum, subId) {
        $('#fName').val(email);
        $('#fName').val(fName);
        $('#lName').val(lName);
        $('#email').val(email);
        $('#pNum').val(pNum);
        $('#subId').val(subId);
        $('#myModal').modal('toggle');
    }

    // $("#search_text").keyup(function() {
    //     var search = $(this).val();
    //     $.ajax({
    //         url: 'admin_searchCustomer.php',
    //         method: 'post',
    //         data: {
    //             query: search
    //         },
    //         success: function(response) {
    //             $("#table-data").html(response);
    //         }
    //     });
    // });

</script>


</html>
