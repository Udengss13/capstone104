<?php
  require_once "controllerUserData.php"; 
  require('php/connection.php');
   $user_id = $_SESSION['user_id'];
   $queryimage = "SELECT * FROM usertable where id= $user_id";
   $resultimage = mysqli_query($con, $queryimage);

   if(mysqli_num_rows($resultimage) > 0){
     $fetch = mysqli_fetch_assoc($resultimage); 
     };

 if(!isset($user_id) ){
         header('location: index.php');
       }

  $start_from = 0; 
  $user_id = $_SESSION['user_id'];
  $queryimage = "SELECT * FROM admin_content_homepage"; //You dont need like you do in SQL;
  $resultimage = mysqli_query($db_admin_account, $queryimage);

  $result = $db_admin_account->query("SELECT image_path from admin_carousel_homepage");
  ?>

<?php
  $quicktipsquery = "SELECT * FROM admin_quicktips"; //You dont need like you do in SQL;
  $quicktipsresult = mysqli_query($db_admin_account, $quicktipsquery);

  
     //To remove by ID
     if(isset($_GET['remove'])){
        $remove_id = $_GET['remove'];
 
       $querydelete = mysqli_query($con, "DELETE FROM `cart` WHERE Cart_id = '$remove_id'");
       if($querydelete){
         header('location: cart.php');
       }
      }
 
      //To Delete all ITems
      if(isset($_GET['delete_all'])){
      mysqli_query($con, "DELETE FROM `cart` WHERE Cart_user_id = '$user_id'");
      header('location: cart.php');
 
 
 
 
      }
  ?>


<!DOCTYPE html>
<html lang="en">

<head>
    <title>PETKO ANIMAL CLINIC</title>
    <link rel="icon" href="asset/logopet.png" type="image/x-icon">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- slider -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/emp.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://kit.fontawesome.com/f8f3c8a43b.js" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
    @import url('https://fonts.googleapis.com/css?family=Poppins:400,700,900');

    /* .nav-item {
        margin-left: 3px
    }

    .nav-item:hover {
        background-color: rgb(23, 171, 201);
        border-radius: ;

    }

    .tips {
        font-family: 'Poppins';
        font-size: 22px;
        font-size: 30px;
        font-style: bold;
        color: Blue;
    } */
    </style>
</head>

<body>
    <!--Navigation Bar-->
    <nav class="navbar navbar-expand-lg navbar-light ; ">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="asset/logopet.png" alt="Logo" class="logo" />
                <span style="text-shadow: 2px 2px 2px  rgba(49, 44, 44, 0.767);" class="text-white"><b>PETCO. ANIMAL
                        CLINIC</b></span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll"
                aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

        </div>

        <div class="collapse navbar-collapse me-3" id="navbarScroll">
            <ul class="navbar-nav me-auto my-0 my-lg-0 " style="--bs-scroll-height: 100px;">
                <?php if($_SESSION['user_level']=='employee'){ ?>
                <div class="text-nowrap">
                    <li class="nav-item">
                        <a class="nav-link text-white" id="home-menu" style="border-radius:10px;" aria-current="page"
                            href="employee-dashboard.php">HOME</a>
                    </li>
                </div>
                <?php  }else{ ?>
                <div class="text-nowrap">
                    <li class="nav-item">
                        <a class="nav-link text-white" id="home-menu" style="border-radius:10px;" aria-current="page"
                            href="home.php">HOME</a>
                    </li>
                </div>
               
                <div class="text-nowrap">
                    <li class="nav-item">
                        <a class="nav-link text-white" id="appointment-menu" href="appointment-user.php">APPOINTMENT</a>
                    </li>
                </div>
                <?php } ?>
                <?php if($_SESSION['user_level']=='employee'){ ?>
                <div class="text-nowrap">
                    <li class="nav-item">
                        <a class="nav-link text-white " id="product-menu" href="employee-menu.php">PRODUCTS</a>
                    </li>
                </div>
                <div class="text-nowrap">
                    <li class="nav-item">
                        <a class="nav-link text-white " id="list-appointment-menu"
                            href="appointment_list.php">APPOINTMENT LIST</a>
                    </li>
                </div>


                <?php  }else{ ?>
                <div class="text-nowrap">
                    <li class="nav-item">
                        <a class="nav-link text-white" href="gallery.php">PET GALLERY</a>
                    </li>
                </div>
                <div class="text-nowrap">
                    <li class="nav-item">
                        <a class="nav-link text-white " id="shop-user" href="product.php">SHOP</a>
                    </li>
                </div>

                <?php 
                    $select_rows = mysqli_query($con,"SELECT * FROM `cart` WHERE Cart_user_id = '$user_id'") or die ('query failed');
                    $row_count = mysqli_num_rows($select_rows);
                  ?>
                <div class="text-nowrap">
                    <li class="nav-item">
                    <a class="nav-link text-white  " id="cart-user-user" href="cart.php">CART
                            <?php if($row_count>0){ ?> <span
                                class="badge badge-light mx-1 bg-light text-dark"><?php echo $row_count ?></span><?php } ?>

                        </a>

                    </li>
                </div>
                <?php } ?>

                <?php if($_SESSION['user_level']=='employee'){ ?>
                <div class="text-nowrap">
                    <li class="nav-item">
                        <a class="nav-link text-white " id="available-appointment-menu"
                            href="employee-appointment.php">AVAILABLE APPOINTMENT</a>
                    </li>
                </div>
                <?php } ?>

                <?php 
                        $selectMessages = mysqli_query($con,"SELECT * FROM `messages` WHERE employee_id = '$user_id' AND seen = 0 AND sender_id != $user_id") or die ('query failed');
                        $count_message = mysqli_num_rows($selectMessages);
                    if(isset($user_id)){
                     ?>
                <div class="text-nowrap">
                    <li class="nav-item">
                        <a class="nav-link text-white  " href="messages.php">MESSAGE
                            <?php if($count_message>0){ ?> <span
                                class="badge badge-light mx-1 bg-danger text-light"><?php echo $count_message ?></span><?php } ?>
                        </a>

                    </li>
                </div>
                <?php } ?>
                <?php if($_SESSION['user_level']=='employee'){ ?>
                <div class="text-nowrap">
                    <li class="nav-item">
                    <?php 
                            $select_user = mysqli_query($con, "SELECT * FROM usertable WHERE id = '$user_id'");
                            if(mysqli_num_rows($select_user) > 0){
                            $fetch_user = mysqli_fetch_assoc($select_user); 
                            };
                        ?>
                        <a class="nav-link text-white" id="user-user" href="userprofile.php"><img
                                src="asset/profiles/<?php echo $fetch_user['image_filename']?>" alt="user"
                                style=" margin-left: 10px" width="28" height="28" class="rounded-circle">
                            <span
                                class="d-none d-sm-inline mx-2">EMPLOYEE</span>
                        </a>
                        <!-- <a class="nav-link text-white" href="#imagesec">MY PROFILE</a> -->
                    </li>
                </div>

                <?php  }else{ ?>
                    <div class="text-nowrap">
                    <li class="nav-item">
                        <a class="nav-link text-white" href="home.php#about">ABOUT US</a>
                    </li>
                </div>
                <div class="text-nowrap">
                    <li class="nav-item">
                        <?php 
                            $select_user = mysqli_query($con, "SELECT * FROM usertable WHERE id = '$user_id'");
                            if(mysqli_num_rows($select_user) > 0){
                            $fetch_user = mysqli_fetch_assoc($select_user); 
                            };
                        ?>
                        <a class="nav-link text-white" id="user-user" href="userprofile.php"><img
                                src="asset/profiles/<?php echo $fetch_user['image_filename']?>" alt="user"
                                style=" margin-left: 10px" width="28" height="28" class="rounded-circle">
                            <span
                                class="d-none d-sm-inline mx-2">MY PROFILE</span>
                        </a>

                        <!-- <p class="nav-link text-white">
                            <?php echo $fetch_user['first_name']." ". $fetch_user['last_name']; ?></p> -->
                    </li>
                </div>
               
                <?php } ?>
               
         <!-- <?php echo  date("m/d/y") . "<br>"; ?> -->
       <!-- </div> --> 
                <div class="text-nowrap">
                    <li class="nav-item">
                        <a class="nav-link text-white" href="logout-user.php"
                                onclick="return confirm('Are you sure do you want to log out?')">LOG OUT</a>
                    </li>
                </div>


                </li>
        </div>
        </ul>
        </div>
    </nav>
    <div>


    <?php ?>

    <script>
        $(function(){
            // Swal.fire(
            //     'Success',
            //     '{{ Session::get("message") }}',
            //     'success'
            // )
        });
    </script>