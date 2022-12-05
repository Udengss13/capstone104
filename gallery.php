<?php
  require('php/connection.php');
  require_once "controllerUserData.php"; 
  
  $start_from = 0; 
  $queryimage = "SELECT * FROM admin_gallery ORDER BY `admin_gallery`.`Image_id` DESC"; //You dont need like you do in SQL;
  $resultimage = mysqli_query($db_admin_account, $queryimage);

  $result = $db_admin_account->query("SELECT image_path from admin_carousel_homepage");
  ?>

<?php
  $quicktipsquery = "SELECT * FROM admin_gallery"; //You dont need like you do in SQL;
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


    <!--ANNOUNCEMENT-->
    <section class="flex-sect" id="imagesec">
        <section id="imagesection" class="div_background_light py-4">
            <div class="container-fluid px-5 mt-3">
                <div class="col-lg-12 col-md-12">
                    <div class="justify-content-center row col-md-12 rounded-3">
                        <h3 class="col-12  text-center fw-bolder"
                            style="text-shadow: 3px 1px 3px  lightblue; color: rgb(13, 13, 103)">
                           PET IMAGES</h3>
                        <hr>

                        <!--Pictures-->

                        <?php while($rowimage = mysqli_fetch_array($resultimage)) {?>

                        <div class="col-lg-3 col-xs-1 col-sm-5 card mx-3 my-4" style="height:350px;">


                            <img src="asset/homepage/<?php echo $rowimage['Image_filename'] ?>"
                                class="card-img-top pt-3 img-responsive " style="height:200px; width:100%;">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title text-center">
                                    <?php echo $rowimage['Image_subtitle'] ?></h5>
                                
                                <!-- <p class="card-text d-inline-block text-truncate">
                                    <?php echo $rowimage['Image_body'];?>
                                </p> -->
                               

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
    
    <footer class="footer-banner text-center" id="about">
        <h1 class="text-white" style="padding-top:20px;">PetCo. Animal Clinic</h1>
        <p class="text-white">Get in touch on our products and promos.</p>
        <div class="container" style="padding-top:20px;">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="form-group mt-2">
                        <label for="form_email " class="text-white "><span class="text-danger"></span></label>
                        <input id="form_email" type="email" name="email" class="form-control"
                            placeholder="Please enter your email *" required="required"
                            data-error="Valid email is required.">

                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div class="form-group mt-1 mb-4">
                            <label for="form_message" class="text-white "><span class="text-danger"></span></label>
                            <textarea id="form_message" name="message" class="form-control"
                                placeholder="Write your message here." rows="4" required="required"
                                data-error="Please, leave us a message."></textarea>
                        </div>

                    </div>

                    <div class="row justify-content-center">
                        <div class="col-md-6">
                            <input type="submit" class="btn btn-success btn-send  pt-2 btn-block" name="submit_messsage"
                                value="Send Message">
                        </div>
                    </div>
                    <div class="col-12 text-center">
                        <ul class="follow" style="color: white;">
                            <a href="https://www.facebook.com/PetCoAnimalClinic"><span
                                    class="fab fa-facebook text-white" style="font-size:30px;padding:10px;"></span></a>
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