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
        <div class="col-3 shadow p-4">
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
        <div class="col-3 shadow p-4">
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
        <div class="col-3 shadow p-4">
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
        <div class="col-3 shadow p-4">
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


<div class="container mt-5 mb-5">

    <div class="row mt-5">
        <div class="col-1">

        </div>
        <div class="col-5 ">
            <div class="col profilebg ">
                <div class="row ">
                    <div class="row   ">
                        <center><img src="asset/profiles/<?php echo $fetch_user['image_filename']?>"
                                class="rounded-circle shadow user-profile" alt="Logo" style="width:50%; height:27vh" />
                        </center>
                    </div>
                    <div class="row mt-4 shadow">
                        <h3 class="text-white  text-center mb-0 name">
                            <?php echo $fetch_user['first_name']. " " .$fetch_user['middle_name'] . " " .$fetch_user['last_name']; ?>
                        </h3>
                        <h5 class="text-center text-secondary">Pet Owner</h5>


                        <center>
                            <a href="user-edit-profile.php?updateid=<?php echo $fetch_user['id'];?>">
                                <span class="btn btn-danger bg-button mx-2 mt-2 mb-5 text-white">Edit Profile <i
                                        class="fa-solid fa-pen-to-square "></i></span>
                            </a>
                        </center>

                    </div>
                </div>
            </div>
        </div>



        <div class="col-6 bg-white shadow rounded">

            <div class="row">
                <div class="col-8">
                    <h2 class="mt-3">Profile</h2>
                </div>
                <!-- <div class="col">
                        <a href="user-edit-profile.php?updateid=<?php echo $fetch_user['id'];?>">
                            <span class="btn btn-danger bg-button mx-2 mt-2 text-white">Edit Profile <i
                                    class="fa fa-solid fa fa-pen-to-square"></i></span>
                        </a>
                    </div> -->
            </div>

            <h5 class="c-blue  mt-5 mb-0 bg-gray rounded p-3 aboutme">
                <span><i class="fa fa-solid fa fa-phone"> </i> <?php echo $fetch_user['contact']?></span>
            </h5>
            <h5 class="c-blue  mt-2 mb-0 bg-gray rounded p-3 aboutme">
                <span><i class="fa fa-solid fa fa-house"></i> <?php echo $fetch_user['address']?></span>
            </h5>
            <h5 class="c-blue  mt-2 mb-0 bg-gray rounded p-3 aboutme">
                <span><i class="fa fa-solid fa fa-envelope"></i> <?php echo $fetch_user['email']?></span>
            </h5>
        </div>

    </div>
</div>

<hr>
<!--ANNOUNCEMENT-->
<section class="flex-sect" id="imagesec">
    <div class="container mt-5">
        <div class="row">

            <?php 
                    $select_pet = mysqli_query($con, "SELECT * FROM pettable WHERE user_id = '$user_id'");
                   

                    while($row=$select_pet->fetch_assoc()):
                    ?>
            <div class="col ">
                <div class="col-lg-5 profilebg">
                    <!-- <div class="card mb-4">
                            <div class="card-body"> -->
                    <div class="row">
                        <!-- <div class="col-sm-4 labels"> -->
                        <img src="asset/profile/pets.png" alt="Logo" style="width:40%; height:17vh" />
                        <!-- </div> -->
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-4 labels">
                            <p class="mb-0">Pet Name:</p>
                        </div>
                        <div class="col-sm-8">
                            <p class="c-blue mb-0"><?php echo $row['petname']; ?></p>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-4 labels">
                            <p class="mb-0">Pet Type:</p>
                        </div>
                        <div class="col-sm-8">
                            <p class="c-blue mb-0"><?php echo $row['pettype']; ?></p>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-4 labels">
                            <p class="mb-0">Pet Breed:</p>
                        </div>
                        <div class="col-sm-8">
                            <p class="c-blue mb-0"><?php echo $row['petbreed']; ?></p>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-4 labels">
                            <p class="mb-0">Pet Sex:</p>
                        </div>
                        <div class="col-sm-8">
                            <p class="c-blue mb-0"><?php echo $row['petsex']; ?></p>
                        </div>
                    </div>
                    <hr>

                    <div class="row">
                        <div class="col-sm-4 labels">
                            <p class="mb-0">Pet Birthday:</p>
                        </div>
                        <div class="col-sm-8">
                            <p class="c-blue mb-0"><?php echo $row['petbday']; ?></p>
                        </div>

                    </div>
                    <hr>
                    <div class="row">
                        <?php $bday = new DateTime($row['petbday']); // Your date of birth
                            $today = new Datetime(date('y-m-d'));
                            $diff = $today->diff($bday);
                            ?>
                        <div class="col-sm-4 labels">
                            <p class="mb-0">Pet Birthday:</p>
                        </div>
                        <div class="col-sm-8">
                            <p class="c-blue mb-0">
                                <?php printf(' %d years, %d month, %d days', $diff->y, $diff->m, $diff->d); ?>
                            </p>
                        </div>
                        <!-- <?php
                            printf(' Pet age : %d years, %d month, %d days', $diff->y, $diff->m, $diff->d);
                            printf("\n");
                            ?> -->

                    </div>
                    <hr>

                    <!-- </div>
                        </div> -->
                </div>
                <?php endwhile; ?>

            </div>
        </div>
</section>
<!--Footer-->
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

<script>
$(document).ready(function() {
    $('#user-user').addClass('bg-primary');
});
</script>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">
</script>
</body>

</html>