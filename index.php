<?php
  require('php/connection.php');
  require_once "controllerUserData.php"; 
  
  $start_from = 0; 
  $queryimage = "SELECT * FROM admin_content_homepage ORDER BY `admin_content_homepage`.`Image_id` DESC"; //You dont need like you do in SQL;
  $resultimage = mysqli_query($db_admin_account, $queryimage);

  $result = $db_admin_account->query("SELECT image_path from admin_carousel_homepage");
  ?>

<?php
  $quicktipsquery = "SELECT * FROM admin_quicktips"; //You dont need like you do in SQL;
  $quicktipsresult = mysqli_query($db_admin_account, $quicktipsquery);

  
  ?>

<!DOCTYPE html>
<html lang="en">

<head>

    <title>PetCo Homepage</title>

    <link rel="icon" href="asset/logopet.png" type="image/x-icon">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta https-equiv="X-UA-Compatible" content="ie=edge" />

    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <script src="https://kit.fontawesome.com/f8f3c8a43b.js" crossorigin="anonymous"></script>

    <!-- slider -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="css/styles.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
</head>

<body>
    <!--Navigation Bar-->
    <nav class="navbar navbar-expand-lg navbar-light ">
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
                <div class="text-nowrap">
                    <li class="nav-item">
                        <a class="nav-link text-white bg-primary " style="border-radius:10px;" aria-current="page"
                            href="index.php">HOME</a>
                    </li>
                </div>
                <div class="text-nowrap">
                    <li class="nav-item">
                        <div class="dropdown">
                            <a class="nav-link text-white" href="#sevice-content">SERVICES</a>
                        </div>
                    </li>
                </div>

                <div class="text-nowrap">
                    <li class="nav-item">

                        <a class="nav-link text-white" href="#imagesec">PET GALLERY</a>

                    </li>
                </div>
                <div class="text-nowrap">
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#about">ABOUT US</a>
                    </li>
                </div>




                <!-- <div class=" text-white">
         <?php echo  date("m/d/y") . "<br>"; ?>
       </div> -->
                <!--
                <div class="text-nowrap">
                    <li class="nav-item">
                        <a class="nav-link text-white" href="login-user.php">SIGN IN</a>
                    </li>
                </div>

                <div class="text-nowrap">
                    <li class="nav-item">
                        <a class="nav-link text-white" href="signup-user.php">SIGN UP</a>
                    </li>
                </div>
            </ul>
-->
        </div>
    </nav>

    <div class="container-fluid  ">
        <div class="waveWrapper waveAnimation  ">
            <div class="waveWrapperInner top  mt-4 ">
                <div class="wave waveTop  mt-4" style="background-image: url(asset/wave-top.png); "></div>
            </div>
            <div class="waveWrapperInner mid">
                <div class="wave waveMid  mt-4" style="background-image: url(asset/wave-mid.png); "></div>
            </div>
            <div class="waveWrapperInner bottom">
                <div class="wave waveBottom  mt-4" style="background-image: url(asset/wave-bot.png); "></div>
            </div>
        </div>
    </div>


    <div class="container Box  mb-5">
        <div class="row">
            <div class=" col-lg-3">
                <img src="asset/shitzu.png" alt="DOG" class="dog" height="500px" />
            </div>
            <div class="col-md-4 col-lg-4 col-sm- 2 mt-5 text-light text" style="margin-left: 50px; ">
                <br>

                <h3 class="text-center">WELCOME</h3>
                <h4 class="text-center">To keep connected with us</h4>
                <h4 class="text-center">Please log-in you personal info</h4>
            </div>
            <div class="col-md-7 col-lg-4 col-sm-4 mt-5 form login-form">
                <form action="" method="POST" autocomplete="">
                    <h1 class="text-center  mt-3 text-primary">Sign In</h1>

                    <?php
                    
                    if (isset($_SESSION["error"])){ ?>
                    <div class="alert alert-danger bg-danger text-center text-white">
                        <?=$_SESSION["error"]; ?> </div>

                    <?php  unset($_SESSION["error"]); } ?>
                    <div class="form-group">
                        <input class="form-control mb-3" type="email" name="email" placeholder="Email Address" required
                            value="<?php echo $email ?>">
                    </div>
                    <div class="form-group">
                        <input class="form-control mb-3" type="password" name="password" placeholder="Password"
                            required>
                    </div>
                    <div class="link forget-pass text-end text-center"><a href="forgot-password.php">Forgot
                            password?</a>
                    </div>
                    <div class="form-group">

                        <input class="form-control button" type="submit" name="login" value="Sign In">

                    </div>
                    <div class="link login-link text-center mb-1 mt-3">Don't have an account? <a
                            href="signup-user.php">Sign up
                            now</a></div>
                </form>

            </div>




        </div>
    </div>

    <br><br>





    <!-- SLIDER Images -->
    <div id="demo" class="carousel slide" data-bs-ride="carousel">

        <!-- Indicators/dots -->
        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <?php 
              $i=0;
              foreach($result as $row){
                $actives ='';
                if($i==0){
                  $actives= 'active';
                }
              
              ?>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="<?=$i; ?>"
                    class="<?=$actives; ?>" aria-current="true" aria-label="Slide 1"></button>
                <?php $i++;} ?>
            </div>
            <div class="carousel-inner">
                <?php 
              $i=0;
              foreach($result as $row){
                $actives ='';
                if($i==0){
                  $actives= 'active';
                }
              
              ?>
                <div class="carousel-item <?= $actives; ?>">
                    <img src="<?= $row['image_path'] ?>" class="img-fluid mt-5" width="100%" height="500px">
                </div>

                <?php $i++; } ?>

            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
    <?php 
         $query_service = "SELECT * FROM `service`"; 
         $result_service = mysqli_query($con, $query_service);  
         $count = 0;
         $service_content = '';
         $service_desc = '';
         $tab_content = '';
         $tab_desc = '';
         while($row_service =  mysqli_fetch_array($result_service)){
            $count++;
            $serv = $row_service['service_name'];
            $querymenu = "SELECT * FROM quicktips WHERE category='$serv'"; 
            $resultmenu = mysqli_query($con, $querymenu);  
            $tab_option = '';
           
            while($rowmenu =  mysqli_fetch_array($resultmenu)){
                $str = $rowmenu['link'];
                $code = explode("?v=",$str);
                $tab_option .= '<div class="col-md-4">
                                    <iframe width="100%" class="shadow vid" height="500" src="https://www.youtube.com/embed/'.$code[1].'"></iframe>
                                </div>';
             }
            
            if($count==1){
                $service_content .= '<a class="nav-link active" id="v-pills-'.$row_service['service_id'].'-tab" data-toggle="pill" href="#v-pills-'.$row_service['service_id'].'" role="tab" aria-controls="v-pills-home" aria-selected="true">'.$row_service['service_name'].'</a>';
                $service_desc .= '<div class="tab-pane fade show active" id="v-pills-'.$row_service['service_id'].'" role="tabpanel" aria-labelledby="v-pills-'.$row_service['service_id'].'-tab">'.$row_service['description'].'</div>';
                $tab_content .= '<li class="nav-item">
                                    <a class="nav-link active" id="pills-'.$row_service['service_id'].'-tab" data-toggle="pill" href="#pills-'.$row_service['service_id'].'" role="tab" aria-controls="pills-'.$row_service['service_id'].'" aria-selected="true">'.$row_service['service_name'].'</a>
                                </li>';
                $tab_desc .= '<div class="tab-pane fade show active row" id="pills-'.$row_service['service_id'].'" role="tabpanel" aria-labelledby="pills-'.$row_service['service_id'].'-tab"><div class="row">'.$tab_option.'</div></div>';
            }else{
                $service_content .= '<a class="nav-link" id="v-pills-'.$row_service['service_id'].'-tab" data-toggle="pill" href="#v-pills-'.$row_service['service_id'].'" role="tab" aria-controls="v-pills-home" aria-selected="false">'.$row_service['service_name'].'</a>';
                $service_desc .= '<div class="tab-pane fade" id="v-pills-'.$row_service['service_id'].'" role="tabpanel" aria-labelledby="v-pills-'.$row_service['service_id'].'-tab">'.$row_service['description'].'</div>';
                $tab_content .= '<li class="nav-item">
                                        <a class="nav-link" id="pills-'.$row_service['service_id'].'-tab" data-toggle="pill" href="#pills-'.$row_service['service_id'].'" role="tab" aria-controls="pills-'.$row_service['service_id'].'" aria-selected="false">'.$row_service['service_name'].'</a>
                                    </li>';
                $tab_desc .= '<div class="tab-pane fade row" id="pills-'.$row_service['service_id'].'" role="tabpanel" aria-labelledby="pills-'.$row_service['service_id'].'-tab"><div class="row">'.$tab_option.'</div></div>';
            }
            
         }
    ?>

    <!--QUICKTIPS-->
    <section class="flex-sect" id="imagesec">
        <section id="imagesection" class="div_background_light py-4">
            <div class="container-fluid px-5">
                <div class="col-lg-12 col-md-12">
                    <div style="width: 100%; height: 30px; border-bottom: 2px solid white; text-align: center">
                        <span style="font-size: 40px; background-color:#9FBACD; color: white">
                            QUICKTIPS
                            <!--Padding is optional-->
                        </span>
                    </div>
                    <div class=" row  mt-5 mb-5 ml-5" align="center">
                        <div class="col-md-2">

                        </div>
                        <div class="col-md-8">
                            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                <?php echo $tab_content; ?>
                            </ul>
                        </div>
                        <div class="col-md-2">

                        </div>
                    </div>
                    <div class="tab-content" id="pills-tabContent">
                        <?php echo $tab_desc; ?>
                    </div>


                </div>
            </div>
        </section>
    </section>




    <!--ANNOUNCEMENT-->
    <section class="flex-sect" id="imagesec">
        <section id="imagesection" class="div_background_light py-4">
            <div class="container-fluid px-5 mt-3">
                <div class="col-lg-12 col-md-12">
                    <div class="justify-content-center row col-md-12 rounded-3">
                        <h3 class="col-12  text-center fw-bolder"
                            style="text-shadow: 3px 1px 3px  lightblue; color: rgb(13, 13, 103)">
                            ANNOUNCEMENT</h3>
                        <hr>

                        <!--Pictures-->

                        <?php while($rowimage = mysqli_fetch_array($resultimage)) {?>

                        <div class="col-lg-3 col-xs-1 col-sm-5 card mx-3 my-4" style="height:350px;">


                            <img src="asset/homepage/<?php echo $rowimage['Image_filename'] ?>"
                                class="card-img-top pt-3 img-responsive " style="height:200px; width:100%;">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title text-center">
                                    <?php echo $rowimage['Image_title'] ?></h5>
                                <h6 class="card-text text-center text-truncate">
                                    <?php echo $rowimage['Image_subtitle'] ?>
                                </h6>
                                <!-- <p class="card-text d-inline-block text-truncate">
                                    <?php echo $rowimage['Image_body'];?>
                                </p> -->
                                <div class="mb-4">
                                    <a href="index-view-image.php?id=<?php echo $rowimage['Image_id'] ?>"
                                        class=" btn btn-success w-100">View Details</a>
                                </div>

                            </div>
                        </div>

                        <?php }?>


                    </div>
                </div>
            </div>
            </div>
            </div>
            </div>


        </section>
    </section>
    <section id="sevice-content" class="mb-5" style="background-color:#fafafa4f;">
        <section id="imagesection" class="div_background_light py-4">
            <div class="justify-content-center row col-md-12 rounded-3 mb-5">
                <div style="width: 100%; height: 30px; border-bottom: 2px solid white; text-align: center">
                    <span style="font-size: 40px; background-color:#fafafa4f; color: black">
                        SERVICES
                    </span>
                </div>
            </div>
            <div class="container-fluid px-5">
                <div class="row">
                    <div class="col-md-3">
                        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist"
                            aria-orientation="vertical">
                            &emsp;<?php echo $service_content; ?>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="tab-content text-justify" id="v-pills-tabContent">
                            <?php echo $service_desc; ?>
                        </div>
                    </div>
                </div>


            </div>
        </section>
    </section>
    <!-- About us -->
    <section class="flex-sect" id="about" style="background-color:#9FBACD;">
        <section id="imagesection" class="div_background_light py-4">
            <div class="container-fluid px-5">
                <div class="col-lg-12 col-md-12">
                    <div class="justify-content-center row col-md-12 rounded-3">
                        <div style="width: 100%; height: 30px; border-bottom: 2px solid white; text-align: center">
                            <span style="font-size: 40px; background-color:#9FBACD; color: white">
                                ABOUT US
                                <!--Padding is optional-->
                            </span>
                        </div>
                        <div class="row box">
                            <div class="col bg-light p-4 rounded shadow">
                                <h4 style=" text-align: justify">&emsp;PetCo. Animal Clinic was established in June
                                    2021, and
                                    they started offering services in their Grand Opening last July 3, 2021.
                                    Mr. Karl Ken Sto Domingo
                                    owned it.
                                    <br>&emsp;
                                    It started with just an Idea of having a Pet Shop
                                    because he has a friend who is a Veterinarian, and he’s the one injecting Mr. Sto.
                                    Domingo’s
                                    pets. He also sees that some people around their area have to go too far to find an
                                    accessible Pet Clinic,
                                    and that is where they started building the PetCo. Their intention to provide an
                                    accessible
                                    Pet Clinic around their area is why their ideas turned into a Clinic that offers
                                    many
                                    pet
                                    services. The PetCo. Animal Clinic is currently residing at 389 Parada, Sta. Maria,
                                    Bulacan,
                                    their main branch.
                                    <br>&emsp;PetCo. Animal Clinic specializes in Vaccination, Consultation,
                                    Confinement, Surgery, Pet
                                    Supplies, etc., for cats and dogs only.
                                </h4>
                            </div>
                            <div class="col">
                                <img src="asset/profiles/ownerpetco.jpg" class="card-img-top pt-3 img-responsive "
                                    style="height:500px; width:100%;">
                                <center>
                                    <h5 class="mt-4 text-white">Mr. Karl Ken Sto Domingo
                                    </h5>
                                    <h6 class="text-muted">Owner</h6>
                                </center>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </section>
    <footer class="footer-banner text-center" id="about">
        <h1 class="text-white" style="padding-top:20px;">PetCo. Animal Clinic</h1>
        <p class="text-white">Please contact us with the social links below.</p>
        <div class="container" style="padding-top:100px;">
            <div class="row">
                <div class="col-12 text-center">
                    <ul class="follow" style="color: white;">
                        <a href="https://www.facebook.com/PetCoAnimalClinic"><span class="fab fa-facebook text-white"
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




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">
    </script>
</body>

</html>