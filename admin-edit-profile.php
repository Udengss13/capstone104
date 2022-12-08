<?php 
require('layouts/header_admin.php');
require_once "php/user-list-process.php";
require('php/connection.php');

if(isset($_SESSION['update_changes'])){
    $applychanges = $_SESSION['update_changes'];
    unset($_SESSION['update_changes']);
}
else{
    $applychanges="";
}

    
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <title>Admin|| Orders</title>
    <link rel="icon" href="asset/logopet.png" type="image/x-icon">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/admin.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/f8f3c8a43b.js" crossorigin="anonymous"></script>
    <!-- tables -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css">


    <div class="col-md-9 col-xl-10 py-3">
        <div class="container mt-5">



            <?php 
                    $select_user = mysqli_query($con, "SELECT * FROM admin_login WHERE id = '$admin_id'");
                    if(mysqli_num_rows($select_user) > 0){
                    $fetch_user = mysqli_fetch_assoc($select_user); 
                    };
                ?>

            <form action="php/profile-edit-process.php" method="post" enctype="multipart/form-data"
                onsubmit="return verifyPassword()">
                <div class="row justify-content-md-center mb-5 ">

                    <!-- <div class="col-lg-7 col-md-6 col-sm-12"> -->

                    <!-- <div class="card-header">
                            Edit Information for Homepage
                        </div> -->
                    <!--Success Message-->
                    <?php if($applychanges!=""){?>
                    <div class="alert alert-primary alert-dismissible fade show mt-3 mx-auto justify-content-md-center mb-2"
                        role="alert" style="width: 50%;">
                        <strong>Apply Changes Successfully!</strong> <?php echo $applychanges; ?>.
                    </div>
                    <?php } ?>
                    <!-- <ul class="list-group "> -->
                    <!--NAME-->
                    <!-- <div class="row justify-content-md-center mb-5">
                    <div class="col-lg-12 col-md-6 col-sm-12">
                        <div class="card  justify-content-center"> -->

                    <div class="row justify-content-md-center mb-2">

                        <label class="col-md-2 control-label "></label>
                        <div class="col-md-4 inputGroupContainer ">
                            <div class="input-group">
                                <input name="id" class="col-12" type="text" value="<?php echo $fetch_user['id']; ?>"
                                    hidden>
                                <!-- <span class="input-group-addon"><i class="fa-solid fa-user ff"></i></span> -->
                                <img src="asset/profiles/<?php echo $fetch_user['image_filename']?>"
                                    class="rounded-circle" alt="Logo" style="width:40%; height:17vh" />

                                <input type="file" name="photo" placeholder="lagy" required>
                            </div>
                        </div>
                    </div>

                    <!-- Text input-->
                    <div class="row  justify-content-md-center mb-2">
                        <label class="col-md-2 control-label">First Name</label>
                        <div class="col-md-4 inputGroupContainer">
                            <div class="input-group">
                                <span class="input-group-addon ff"><i
                                        class="glyphicon glyphicon-user fa-5x "></i></span>
                                <input name="fname" class="form-control" type="text"
                                    value="<?php echo $fetch_user['first_name'];   ?>" required>
                            </div>
                        </div>
                    </div>
                    <div class="row  justify-content-md-center mb-2">
                        <label class="col-md-2 control-label">Last Name</label>
                        <div class="col-md-4 inputGroupContainer">
                            <div class="input-group">
                                <span class="input-group-addon ff"><i
                                        class="glyphicon glyphicon-user fa-5x "></i></span>
                                <input name="lname" class="form-control" type="text"
                                    value="<?php echo $fetch_user['last_name'];   ?>" required>
                            </div>
                        </div>
                    </div>

                    


                    <div class="row mt-3">
                        <!--Back-->
                        <div class="col-6">
                            <button type="submit" name="admin_profile" class="btn btn-success float-end"
                                style="max-width:450px;">Save <i class="fa-solid fa-floppy-disk"></i></button>
                        </div>
                        <div class="col-2">
                            <a href="admin-profile.php"><span class="btn btn-danger mx-2">Back <i
                                        class="fa-sharp fa-solid fa-arrow-left"></i></span></a>
                        </div>
                        <!--Add button-->

                    </div>
                    <!-- </ul> -->
                </div>
        </div>


        </form>

    </div>





    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous">
    </script>
    <script src="/js/script.js"></script>

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>

    <script>
    $(document).ready(function() {
        $('#example').DataTable();
    });
    </script>
    </body>

</html>