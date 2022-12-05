<?php 
require('layouts/header_admin.php');
require_once "php/user-list-process.php";
require('php/connection.php');
     
    //GET USER ID IN REGISTRATION
    
?>
<?php
  //This is for calling the informaiton of user in fields.
  if(isset($_SESSION['user_id'])){
    $sqlInfo = mysqli_query($con, "SELECT * FROM order WHERE order_user_id = '$user_id'");
  }else{
    $sqlInfo = mysqli_query($con, "SELECT * FROM order");
  }
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






    <div class="col-md-9 col-xl-10 py-3">
        <h3 class="text-center c-white py-3 mb-4">All Orders</h3>

        <div class="row justify-content-center">
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
        </div>

        <!-- <div class="card"> -->
        <div class="card-body bg-light p-4 m-2 rounded shadow">
            <form action="" method="POST">
                <table id="example" class="table table-striped table table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Address</th>
                            <th>Contact</th>
                            <!-- <th>Order Date/time</th> -->
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                                      $i = 1;
                                      $order_query = mysqli_query($con, "SELECT * FROM `order` ORDER BY `order`.`id` DESC " );
                                      
                                      if(mysqli_num_rows($order_query) > 0){
                                        while($row = mysqli_fetch_assoc($order_query)){    
                                  ?>

                        <tr>

                            <td><?php echo $row['first_name']." ".$row['last_name']  ?></td>
                            <td><?php echo $row['email']; ?></td>
                            <td><?php echo $row['address'] ?></td>
                            <td><?php echo $row['contact'] ?></td>
                            <!-- <td><?php echo date("Y-M-d h:i a",strtotime($row['orderdate']))?></td> -->

                            <?php if($row['order_status'] == 'confirmed'): ?>
                            <td class="text-center">

                                <span
                                    class="badge badge-success bg-success text-white"><?php echo $row['order_status'] ?></span>
                                <input type="hidden" value="<?php echo $row['order_status'] ?>" name="update_status">
                                <!-- <td><?php echo $row['order_status'] ?></td> -->
                            </td>

                            <?php elseif($row['order_status'] == 'pickup'): ?>
                            <td class="text-center">
                                <span
                                    class="badge badge-success bg-warning text-white"><?php echo $row['order_status'] ?></span>
                                <input type="hidden" value="<?php echo $row['order_status'] ?>" name="update_status">
                                <input type="hidden" value="<?php echo $row['order_user_id'] ?>"
                                    name="update_status_id">
        </div>
        </td>
        <?php elseif($row['order_status'] == 'pickedup'): ?>
        <td class="text-center col-sm-1 col-md-1 col-lg-1">
            <div class="col">
                <span class="badge badge-success bg-info text-dark"><?php echo $row['order_status'] ?></span>
                <input type="hidden" value="<?php echo $row['order_status'] ?>" name="update_status">
                <input type="hidden" value="<?php echo $row['order_user_id'] ?>" name="update_status_id">
            </div>
        </td>

        <?php elseif($row['order_status'] == 'cancelled'): ?>

        <td class="text-center col-sm-1 col-md-1 col-lg-1">
            <div class="col">
                <span class="badge badge-danger bg-danger text-light">Cancelled</span>
                <input type="hidden" value="<?php echo $row['order_status'] ?>" name="update_status">
                <input type="hidden" value="<?php echo $row['order_user_id'] ?>" name="update_status_id">
            </div>
        </td>

        <?php else: ?>
        <td class="text-center col-sm-1 col-md-1 col-lg-1 ">
            <div class="col"><span class="badge badge-secondary bg-secondary text-light">For
                    Verification<?php echo $row['order_status'] ?></span></div>
        </td>
        <?php endif; ?>

        <td class="col-sm-1 col-md-1 col-lg-1">
            <?php if($row['order_status'] != 'cancelled'){ ?>
            <div class="container btn btn-primary mt-3">

                <a class="btn btn primary  text-light" href='admin-view-orders.php?id=<?php echo $row["id"] ?>'>View
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
        $('#example').DataTable();
    });
    </script>

    </body>

</html>