<?php 
     require('layouts/header_employee.php');
   
      $user_id = $_SESSION['user_id'];

      

      $start_from = 0; 
  $queryimage = "SELECT * FROM admin_content_homepage"; //You dont need like you do in SQL;
  $resultimage = mysqli_query($db_admin_account, $queryimage);


      $result = $db_admin_account->query("SELECT image_path from admin_carousel_homepage");
?>
<?php
$users = "SELECT * FROM usertable where id='$user_id'"; //You dont need like you do in SQL;
$userresult = mysqli_query($con, $queryimage);
?>
<?php 
                    $select_user = mysqli_query($con, "SELECT * FROM usertable WHERE id = '$user_id'");
                    if(mysqli_num_rows($select_user) > 0){
                    $fetch_user = mysqli_fetch_assoc($select_user); 
                    };
                ?>

<link rel="stylesheet" type="text/css" href="css/styles.css">



<div class="container mt-5 mb-5">
    <h5 class="text-white">My Order Reservation</h5>
    <div class="row justify-content-center">
        <?php 
                    $select_rows = mysqli_query($con,"SELECT * FROM `order` WHERE order_user_id= '$user_id' and order_status= ' ' ") or die ('query failed');
                    $row_count = mysqli_num_rows($select_rows);
                  ?>
        <div class="col-3 shadow p-4" id="verification">
            <a href="order_list.php?status=verification">
            <center>
                <!-- <?php if($row_count>0){ ?> <span
                        class="badge badge-light mx-1 bg-light text-dark"><?php echo $row_count ?></span><?php } ?>

                    </a> -->

                <?php if($row_count>0){ ?><span
                    class="badge badge-light bg-button text-white no"><?php echo $row_count ?></span><?php } 
                     else{ ?><span class=" text-white no"></span><?php } ?>
                <h1 class="icons"><i class="fa fa-solid fa fa-clipboard-list"></i></h1>
                For Verification
            </center>
            </a>
        </div>
        <div class="col-3 shadow p-4" id="confirmed">
            <a href="order_list.php?status=confirmed">
            <center>
                <?php 
                    $select_rows = mysqli_query($con,"SELECT * FROM `order` WHERE order_user_id= '$user_id' and order_status= 'confirmed' ") or die ('query failed');
                    $row_count = mysqli_num_rows($select_rows);
                  ?>
                <?php if($row_count>0){ ?><span
                    class="badge badge-light bg-button text-white no"><?php echo $row_count ?></span><?php } 
                     else{ ?><span class=" text-white no"></span><?php } ?>
                <h1 class="icons"><i class="fa fa-solid fa fa-circle-check"></i></h1>
                Confirmed
            </center>
            </a>
        </div>
        <div class="col-3 shadow p-4" id="pickup">
            <a href="order_list.php?status=pickup">
            <?php 
                    $select_rows = mysqli_query($con,"SELECT * FROM `order` WHERE order_user_id= '$user_id' and order_status= 'pickup' ") or die ('query failed');
                    $row_count = mysqli_num_rows($select_rows);
                  ?>
            <center>
                <?php if($row_count>0){ ?><span
                    class="badge badge-light bg-button text-white no"><?php echo $row_count ?></span><?php } 
                     else{ ?><span class=" text-white no"></span><?php } ?>
                <h1 class="icons"><i class="fa fa-solid fa fa-box"></i></h1>
                For pick up
            </center>
            </a>
        </div>
        <div class="col-3 shadow p-4" id="pickedup">
            <a href="order_list.php?status=pickedup">
            <?php 
                    $select_rows = mysqli_query($con,"SELECT * FROM `order` WHERE order_user_id= '$user_id' and order_status= 'pickedup' ") or die ('query failed');
                    $row_count = mysqli_num_rows($select_rows);
                  ?>
            <center>
                <?php if($row_count>0){ ?><span
                    class="badge badge-light bg-button text-white no"><?php echo $row_count ?></span><?php } 
                     else{ ?><span class=" text-white no"></span><?php } ?>
                <h1 class="icons"><i class="fa fa-solid fa fa-basket-shopping"></i></h1>
                Picked Up
            </center>
            </a>
        </div>
    </div>
</div>
</div>

<br><br>
<script>
    $('#<?php echo $_GET['status']; ?>').css('background','yellow');
</script>

<div class="container mt-5 mb-5">

    <div class="row mt-5">
       
        <div class="col-md-12">
        <div class="card-body bg-light p-4">
                    <form action="" method="POST">
                        <table class="table table-striped table table-bordered">
                            <thead>
                                <tr>
                                    <!-- <th scope="col">Number</th> -->
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Address</th>
                                    <th scope="col">Contact</th>
                                    <th scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                      $i = 1;
                                      $status = $_GET['status'];
                                      if($status=='verification'){
                                        $status = '';
                                      }
                                      $order_query = mysqli_query($con, "SELECT * FROM `order` WHERE order_user_id='$user_id' AND `order_status`='$status' ORDER BY `order`.`id` DESC " );
                                      
                                      if(mysqli_num_rows($order_query) > 0){
                                        while($row = mysqli_fetch_assoc($order_query)){    
                                  ?>

                                <tr>

                                    <td class="col-sm-5 col-md-2 col-lg-2">
                                        <div class="col">
                                            <?php echo $row['first_name']." ".$row['last_name']  ?></div>
                                    </td>
                                    <td class=" col-sm-5 col-md-2 col-lg-1"><input name="email" readonly class="c-white"
                                            type="text" style="background-color:transparent;border:0; "
                                            value="<?php echo $row['email']; ?>">
                                    </td>

                                    <td class="col-sm-5 col-md-2 col-lg-4">
                                        <div class="col"><?php echo $row['address'] ?></div>
                                    </td>
                                    <td class="col-sm-5 col-md-2 col-lg-2">
                                        <div class="col"><?php echo $row['contact'] ?></div>
                                    </td>

                                    <?php if($row['order_status'] == 'confirmed'): ?>
                                    <td class="text-center col-sm-1 col-md-1 col-lg-1">
                                        <div class="col">
                                            <span class="badge badge-success bg-success text-white">Confirmed</span>
                                            <input type="hidden" value="<?php echo $row['order_status'] ?>"
                                                name="update_status">
                                            <input type="hidden" value="<?php echo $row['order_user_id'] ?>"
                                                name="update_status_id">
                                        </div>
                                    </td>

                                    <?php elseif($row['order_status'] == 'pickup'): ?>
                                    <td class="text-center col-sm-1 col-md-1 col-lg-1">
                                        <div class="col">
                                            <span class="badge badge-success bg-warning text-white">For Pick Up</span>
                                            <input type="hidden" value="<?php echo $row['order_status'] ?>"
                                                name="update_status">
                                            <input type="hidden" value="<?php echo $row['order_user_id'] ?>"
                                                name="update_status_id">
                                        </div>
                                    </td>
                                    <?php elseif($row['order_status'] == 'pickedup'): ?>
                                    <td class="text-center col-sm-1 col-md-1 col-lg-1">
                                        <div class="col">
                                            <span class="badge badge-success bg-info text-dark">Picked Up</span>
                                            <input type="hidden" value="<?php echo $row['order_status'] ?>"
                                                name="update_status">
                                            <input type="hidden" value="<?php echo $row['order_user_id'] ?>"
                                                name="update_status_id">
                                        </div>
                                    </td>


                                    <?php else: ?>
                                    <td class="text-center col-sm-1 col-md-1 col-lg-1 ">
                                        <div class="col"><span class="badge badge-secondary bg-secondary text-dark">For
                                                Verification</span></div>
                                    </td>
                                    <?php endif; ?>

                                    <td class="col-sm-1 col-md-1 col-lg-1">
                                       <?php if($row['order_status']==''){ ?>
                                        <a class="btn btn-danger cancel" data-id="<?php echo $row['id']; ?>"><span class="fa fa-times"></span></a>
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


<footer class="footer-banner text-center" id="about">
    <h1 class="text-white" style="padding-top:20px;">PetCo. Animal Clinic</h1>
    <p class="text-white">Please contact us with the social links below.</p>
    <div class="container" style="padding-top:100px;">
        <div class="row">
            <div class="col-12 text-center">
                <ul class="follow" style="color: white;">
                    <a href="https://www.facebook.com/"><span class="fab fa-facebook text-white"
                            style="font-size:30px;padding:10px;"></span></a>
                    <a href="https://www.instagram.com//"><span class="fab fa-instagram text-white"
                            style="font-size:30px;padding:10px;"></span></a>
                    <a href="https://www.twitter.com/"><span class="fab fa-twitter text-white"
                            style="font-size:30px;padding:10px;"></span></a>
                </ul>
                <label class="text-white">© 2022 All Rights Reserved. PetCo. Animal Clinic.</label>
            </div>
        </div>
    </div>
</footer>
<?php 
    if(isset($_POST['cancel_submit'])){
        $id = $_POST['id'];
        $serve_query = "UPDATE order SET order_status='cancelled' WHERE id='$id'";
        $run_serve = mysqli_query($con, $serve_query);
        if($run_serve){
            echo "<script>window.open('order_list.php','_self');</script>";
        }
    }

?>
<script>
$(document).ready(function() {
    $('#user-user').addClass('bg-primary');
    $(document).on('click','.cancel',function(){
        var id = $(this).data('id');
        Swal.fire({
            title: 'Do you want to CANCEL this order?',
            icon: 'info',
            showDenyButton: true,
            confirmButtonText: 'Yes',
            denyButtonText: 'No',
            customClass: {
                actions: 'my-actions',
                cancelButton: 'order-1 right-gap',
                confirmButton: 'order-2',
                denyButton: 'order-3',
            }
        }).then((result) => {
            if (result.isConfirmed) {
                $.post("cancel_order.php",{cancel_submit:'cancel_submit',id:id},function(data){
                    location.reload();
                    console.log(data);
                });
                location.reload();
            } else if (result.isDenied) {
                Swal.fire('Record is not SERVED', '', 'info')
            }
        })
    });
});
</script>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">
</script>
</body>

</html>