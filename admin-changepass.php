<?php
    require_once "php/user-list-process.php";
    require('php/connection.php');
    require('layouts/header_admin.php');

   

if(count($_POST)>0) {
$result = mysqli_query($con,"SELECT *from admin_login WHERE id= $admin_id");
$row=mysqli_fetch_array($result);
if($_POST["currentPassword"] == $row["password"] && $_POST["newPassword"] == $_POST["confirmPassword"] ) {
mysqli_query($con,"UPDATE admin_login set password='" . $_POST["newPassword"] . "' WHERE id=$admin_id");
$message = "Password Changed Sucessfully";
} else{
 $message = "Password is incorrect";
}
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Password Change</title>
    <meta charset="UTF-8">
    <link rel="icon" href="asset/logopet.png" type="image/x-icon">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://kit.fontawesome.com/f8f3c8a43b.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="fullcalendar/core.min.css">
    <link rel="stylesheet" href="fullcalendar/daygrid.min.css">
    <link rel="stylesheet" href="fullcalendar/timegrid.min.css">
    <link rel="stylesheet" href="fullcalendar/list.min.css">

    <!-- tables -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css">



<body>
    <div class="col py-3 mt-5 p-5 ">
        <div class="container">
            <div class="row">
                <div class="col-3">

                </div>
                <div class="col-7 bg-light mx-uto shadow rounded">
                    <h3 align="center" class="text-dark mt-3 p-4">CHANGE PASSWORD</h3>
                    <?php if(isset($message)) {?>
                    <div class="alert alert-danger alert-dismissible fade show mt-3 mx-auto justify-content-md-center mb-2"
                        role="alert" style="width: 50%;">
                        <strong><?php echo $message;?>!</strong> .
                    </div>
                    <?php } ?>

                    <!-- <div><?php if(isset($message)) { echo $message; } ?></div> -->
                    <form method="post" action="">
                        <div class="row justify-content-center">
                            <div class="col-6">
                                Current Password:<br>

                                <input type="password" class="form-control" name="currentPassword"><span
                                    id="currentPassword" class="required"></span>
                                <br>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-6">
                                New Password:<br>
                                <input type="password" class="form-control" name="newPassword"><span id="newPassword"
                                    class="required"></span>
                                <br>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-6">
                                Confirm Password:<br>
                                <input type="password" class="form-control" name="confirmPassword"><span
                                    id="confirmPassword" class="required"></span>
                                <br>
                                <input type="submit" class="mb-5  btn btn-primary">
                                <a href="admin-profile.php" class="mb-5  btn btn-success text-light">Back</a>
                            </div>
                        </div>





                    </form>
                </div>

            </div>
        </div>


    </div>
</body>

</html>