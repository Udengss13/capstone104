<?php 
require('layouts/header_admin.php');
require_once "php/user-list-process.php";
require('php/connection.php');
    
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
        <div class="container">



            <?php 
                    $select_user = mysqli_query($con, "SELECT * FROM admin_login WHERE id = '$admin_id'");
                    if(mysqli_num_rows($select_user) > 0){
                    $fetch_user = mysqli_fetch_assoc($select_user); 
                    };
                ?>

            <div class="row">
                <div class="col profilebg ">
                    <div class="row mt-5">
                        <div class="col-5 ms-5">
                            <img src="asset/profiles/<?php echo $fetch_user['image_filename']?>"
                                class="rounded-circle shadow user-profile" alt="Logo" style="width:50%; height:27vh" />
                          
                            <!-- <a href="admin-edit-profile.php?updateid=<?php echo $fetch_user['id'];?>">
                                <span class="btn btn-danger bg-button mx-2 text-white">Edit
                                    Profile <i class="fa-solid fa-pen-to-square "></i></span>
                            </a> -->
                            <div class="row">
                                <div class="col">
                                    <div class="mt-3 ms-3">
                                        <h3 class="text-white mb-0 name">
                                            <?php echo $fetch_user['first_name']. " " .$fetch_user['last_name']; ?>
                                        </h3>
                                        <p>Admin</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-4">

                        </div>
                        <div class="col mt-3">
                        <a href="admin-edit-profile.php?updateid=<?php echo $fetch_user['id'];?>">
                                <span class="btn btn-outline-danger bg-light bg-button mx-2 text-dark">Edit
                                    Profile <i class="fa-solid fa-pen-to-square "></i></span>
                            </a>
                            <br>
                            <br>
                            <a href="admin-changepass.php">
                                <span class="btn btn-outline-success bg-light bg-button mx-2 text-dark">Change Password <i class="fa-solid fa-pen-to-square "></i></span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container bg-light shadow rounded">
                <div class="row mt-5 ">
                    <div class="col-4 ms-5 mt-3">
                        <label class="mt-1 mb-1 ms-3">Username</label>
                        <input name="fname" class="form-control" type="text"
                            value="<?php echo $fetch_user['username'];   ?>" readonly>
                    </div>
                    <div class="col-2"></div>

                    <div class="col-4  mt-3">
                        <label class="mt-1 mb-1 ms-2">Password</label>
                        <input name="fname" class="form-control" type="password"
                            value="<?php echo $fetch_user['password'];   ?>" readonly>
                    </div>
                </div>


                <div class="row mt-4">
                    <div class="col-4 ms-5">
                        <label class="mt-1 mb-1 ms-3">First Name</label>
                        <input name="fname" class="form-control mb-5" type="text"
                            value="<?php echo $fetch_user['first_name'];   ?>" readonly>
                    </div>

                    <div class="col-2"></div>

                    <div class="col-4 ">
                        <label class="mt-1 mb-1 ms-2">Last Name</label>
                        <input name="fname" class="form-control" type="text"
                            value="<?php echo $fetch_user['last_name'];   ?>" readonly>
                    </div>
                </div>
            </div>


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