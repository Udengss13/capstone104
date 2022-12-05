<?php 
 require('layouts/header_employee.php');
?>

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
                        <ul class="nav nav-pills mb-3 " id="pills-tab" role="tablist">
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
                    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
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
        <div class="container-fluid px-5 ">
            <div class="col-lg-12 col-md-12">
                <div class="justify-content-center row col-md-12 rounded-3">
                    <div style="width: 100%; height: 30px; border-bottom: 2px solid white; text-align: center">
                        <span style="font-size: 40px; background-color:#9FBACD; color: white">
                            ABOUT US
                            <!--Padding is optional-->
                        </span>
                    </div>
                    <div class="row box mt-4">
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
$(document).ready(function() {
    $('#home-menu').addClass('bg-primary');
});
</script>


</body>

</html>