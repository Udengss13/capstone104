<?php 
require('layouts/header_admin.php');
require_once "php/user-list-process.php";
require('php/connection.php');
// require_once "controllerUserData.php"; 
     
    //GET USER ID IN REGISTRATION
    
?>




<!--When Click ORDER NOW!-->

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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>






    <div class="col-md-9 col-xl-10 py-3">
        <h3 class="text-center c-white py-3 mb-4">All Orders</h3>

        <!-- <div class="row justify-content-center">
            <div class="col-1 c-white">
                <p class="bg-secondary text-secondary">|</p>
            </div>For Verification
            <div class="col-1 c-white ">
                <p class="bg-success text-success">|</p>
            </div>Confirmed
            <div class="col-1 c-white ">
                <p class="bg-warning text-warning">|</p>
            </div>For Pick Up
            <div class="col-1 c-white">
                <p class="bg-info text-info">|</p>
            </div>Picked Up
            <div class="col-1 c-white">
                <p class="bg-danger text-danger">|</p>
            </div>Cancelled
        </div> -->

        <div class="container mt-3">
            
           
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-bs-toggle="tab" href="#home">For Verification</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#menu1">Confirmed</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#menu2">For Pick Up</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#menu3">Picked Up</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#menu4">Cancelled</a>
                </li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div id="home" class="container tab-pane active"><br>

                    <div class="card-body bg-light p-4 m-2 rounded shadow">
                        <form action="" method="POST">
                            <table id="example" class="table table-striped table table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Address</th>
                                        <th>Contact</th>
                                        <th>Order Date/time</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                      $i = 1;
                                      $order_query = mysqli_query($con, "SELECT * FROM `order` where order_status=''" );
                                      
                                      if(mysqli_num_rows($order_query) > 0){
                                        while($row = mysqli_fetch_assoc($order_query)){    
                                  ?>

                                    <tr>

                                        <td><?php echo $row['first_name']." ".$row['last_name']  ?></td>
                                        <td><?php echo $row['email']; ?></td>
                                        <td><?php echo $row['address'] ?></td>
                                        <td><?php echo $row['contact'] ?></td>
                                        <td><?php echo date("Y-M-d h:i a",strtotime($row['orderdate']))?></td>


                                        <td class="text-center">

                                            <span class="badge badge-success bg-secondary text-black">For
                                                verification</span>
                                            <input type="hidden" value="<?php echo $row['order_status'] ?>"
                                                name="update_status">
                                            <input type="hidden" value="<?php echo $row['order_user_id'] ?>"
                                                name="update_status_id">
                                        </td>
                                        <td class="col-sm-1 col-md-1 col-lg-1">
                                            <?php if($row['order_status'] != 'cancelled'){ ?>
                                            <div class="container btn btn-primary mt-3">

                                                <a class="btn btn primary  text-light"
                                                    href='admin-view-orders.php?id=<?php echo $row["id"] ?>'>View
                                                    Orders</a>

                                            </div>
                                            <?php } ?>
                                        </td>




                                    </tr>

                                    <?php
                                          };
                                        };
                                    ?>
                        </form>
                        </tbody>
                        </table>
                    </div>
                </div>


                <div id="menu1" class="container tab-pane fade"><br>
                    <div class="card-body bg-light p-4 m-2 rounded shadow">
                        <form action="" method="POST">
                            <table id="confirm" class="table table-striped table table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Address</th>
                                        <th>Contact</th>
                                        <th>Order Date/time</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                      $i = 1;
                                      $order_query = mysqli_query($con, "SELECT * FROM `order` where order_status='confirmed' ORDER BY `order`.`orderdate` ASC " );
                                      
                                      if(mysqli_num_rows($order_query) > 0){
                                        while($row = mysqli_fetch_assoc($order_query)){    
                                  ?>

                                    <tr>

                                        <td><?php echo $row['first_name']." ".$row['last_name']  ?></td>
                                        <td><?php echo $row['email']; ?></td>
                                        <td><?php echo $row['address'] ?></td>
                                        <td><?php echo $row['contact'] ?></td>
                                        <td><?php echo date("Y-M-d h:i a",strtotime($row['orderdate']))?></td>


                                        <td class="text-center">

                                            <span
                                                class="badge badge-success bg-success text-white"><?php echo $row['order_status'] ?></span>
                                            <input type="hidden" value="<?php echo $row['order_status'] ?>"
                                                name="update_status">
                                            <input type="hidden" value="<?php echo $row['order_user_id'] ?>"
                                                name="update_status_id">
                                        </td>
                                        <td class="col-sm-1 col-md-1 col-lg-1">
                                            <?php if($row['order_status'] != 'cancelled'){ ?>
                                            <div class="container btn btn-primary mt-3">

                                                <a class="btn btn primary  text-light"
                                                    href='admin-view-orders.php?id=<?php echo $row["id"] ?>'>View
                                                    Orders</a>


                                                <?php } ?>
                                        </td>




                                    </tr>

                                    <?php
                                          };
                                        };
                                    ?>
                        </form>
                        </tbody>
                        </table>
                    </div>
                </div>
                <div id="menu2" class="container tab-pane fade"><br>
                    <div class="card-body bg-light p-4 m-2 rounded shadow">
                        <form action="" method="POST">
                            <table id="pickup" class="table table-striped table table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Address</th>
                                        <th>Contact</th>
                                        <th>Order Date/time</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                      $i = 1;
                                      $order_query = mysqli_query($con, "SELECT * FROM `order` where order_status='pickup' " );
                                      
                                      if(mysqli_num_rows($order_query) > 0){
                                        while($row = mysqli_fetch_assoc($order_query)){    
                                  ?>

                                    <tr>

                                        <td><?php echo $row['first_name']." ".$row['last_name']  ?></td>
                                        <td><?php echo $row['email']; ?></td>
                                        <td><?php echo $row['address'] ?></td>
                                        <td><?php echo $row['contact'] ?></td>
                                        <td><?php echo date("Y-M-d h:i a",strtotime($row['orderdate']))?></td>


                                        <td class="text-center">
                                        <td class="text-center">
                                            <span
                                                class="badge badge-success bg-warning text-white"><?php echo $row['order_status'] ?></span>
                                            <input type="hidden" value="<?php echo $row['order_status'] ?>"
                                                name="update_status">
                                            <input type="hidden" value="<?php echo $row['order_user_id'] ?>"
                                                name="update_status_id">
                                        </td>
                                        <td class="col-sm-1 col-md-1 col-lg-1">
                                            <?php if($row['order_status'] != 'cancelled'){ ?>
                                            <div class="container btn btn-primary mt-3">

                                                <a class="btn btn primary  text-light"
                                                    href='admin-view-orders.php?id=<?php echo $row["id"] ?>'>View
                                                    Orders</a>


                                                <?php } ?>
                                        </td>




                                    </tr>

                                    <?php
                                          };
                                        };
                                    ?>
                        </form>
                        </tbody>
                        </table>
                    </div>
                </div>
                <div id="menu3" class="container tab-pane fade"><br>
                    <div class="card-body bg-light p-4 m-2 rounded shadow">
                        <form action="" method="POST">
                            <table id="pickedup" class="table table-striped table table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Address</th>
                                        <th>Contact</th>
                                        <th>Order Date/time</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                      $i = 1;
                                      $order_query = mysqli_query($con, "SELECT * FROM `order` where order_status='pickedup' " );
                                      
                                      if(mysqli_num_rows($order_query) > 0){
                                        while($row = mysqli_fetch_assoc($order_query)){    
                                  ?>

                                    <tr>

                                        <td><?php echo $row['first_name']." ".$row['last_name']  ?></td>
                                        <td><?php echo $row['email']; ?></td>
                                        <td><?php echo $row['address'] ?></td>
                                        <td><?php echo $row['contact'] ?></td>
                                        <td><?php echo date("Y-M-d h:i a",strtotime($row['orderdate']))?></td>


                                        <td class="text-center">

                                            <span
                                                class="badge badge-success bg-info text-dark"><?php echo $row['order_status'] ?></span>
                                            <input type="hidden" value="<?php echo $row['order_status'] ?>"
                                                name="update_status">
                                            <input type="hidden" value="<?php echo $row['order_user_id'] ?>"
                                                name="update_status_id">
                                        </td>
                                        <td class="col-sm-1 col-md-1 col-lg-1">
                                            <?php if($row['order_status'] != 'cancelled'){ ?>
                                            <div class="container btn btn-primary mt-3">

                                                <a class="btn btn primary  text-light"
                                                    href='admin-view-orders.php?id=<?php echo $row["id"] ?>'>View
                                                    Orders</a>


                                                <?php } ?>
                                        </td>




                                    </tr>

                                    <?php
                                          };
                                        };
                                    ?>
                        </form>
                        </tbody>
                        </table>
                    </div>
                </div>

                <div id="menu4" class="container tab-pane fade"><br>
                    <div class="card-body bg-light p-4 m-2 rounded shadow">
                        <form action="" method="POST">
                            <table id="cancel" class="table table-striped table table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Address</th>
                                        <th>Contact</th>
                                        <th>Order Date/time</th>
                                        <th>Status</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                      $i = 1;
                                      $order_query = mysqli_query($con, "SELECT * FROM `order` where order_status='cancelled' " );
                                      
                                      if(mysqli_num_rows($order_query) > 0){
                                        while($row = mysqli_fetch_assoc($order_query)){    
                                  ?>

                                    <tr>

                                        <td><?php echo $row['first_name']." ".$row['last_name']  ?></td>
                                        <td><?php echo $row['email']; ?></td>
                                        <td><?php echo $row['address'] ?></td>
                                        <td><?php echo $row['contact'] ?></td>
                                        <td><?php echo date("Y-M-d h:i a",strtotime($row['orderdate']))?></td>


                                        <td class="text-center">

                                            <span
                                                class="badge badge-success bg-info text-dark"><?php echo $row['order_status'] ?></span>
                                            <input type="hidden" value="<?php echo $row['order_status'] ?>"
                                                name="update_status">
                                            <input type="hidden" value="<?php echo $row['order_user_id'] ?>"
                                                name="update_status_id">
                                        </td>
                                        




                                    </tr>

                                    <?php
                                          };
                                        };
                                    ?>
                        </form>
                        </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>



    </div>
    </div>
    </div>






    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">
    </script>

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>

    <script>
    $(document).ready(function() {
        $('#example').DataTable({
            order: [
                [5, 'desc']
            ],
        });
    });
    </script>
    <script>
    $(document).ready(function() {
        $('#confirm').DataTable({
            order: [
                [5, 'desc']
            ],
        });
    });
    </script>
    <script>
    $(document).ready(function() {
        $('#pickup').DataTable({
            order: [
                [5, 'desc']
            ],
        });
    });
    </script>
    <script>
    $(document).ready(function() {
        $('#pickedup').DataTable({
            order: [
                [5, 'desc']
            ],
        });
    });
    </script>
    <script>
    $(document).ready(function() {
        $('#cancel').DataTable({
            order: [
                [5, 'desc']
            ],
        });
    });
    </script>

    </body>

</html>