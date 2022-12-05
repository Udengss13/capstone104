<?php
require('php/connection.php');
require('layouts/header_admin.php');
    

$queryimage = "SELECT * FROM admin_carousel_homepage"; //You don't need a like you do in SQL;
$resultimage = mysqli_query($db_admin_account, $queryimage);

$msg='';
if(isset($_POST['upload'])){
  $image = $_FILES['image']['name'];
  $path ='asset/sliderimage/'.$image;

  $sql = $db_admin_account->query("INSERT INTO admin_carousel_homepage (image_path) VALUES ('$path')");

  if($sql){
    move_uploaded_file($_FILES['image']['tmp_name'], $path);
    $msg='Image Uploaded successfully';
  }
  else{
    $msg='Image Upload Failed';
  }
}

$result = $db_admin_account->query("SELECT image_path from admin_carousel_homepage");

?>

<!DOCTYPE html>
<html>
<meta charset="UTF-8">
<link rel="icon" href="asset/logopet.png" type="image/x-icon">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="css/admin.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/f8f3c8a43b.js" crossorigin="anonymous"></script>
<title>Admin || Slider</title>
</head>


<!-- <h2 class="text-center text-light pb-4 ">Dynamic boostrap 5 caroussel using php and mysqli</h2> -->
<div class="col py-3">
    <div class="container-fluid bg-transparent">
         <!--<div class="row justify-content-center mb-5 ">
            <div class="col-lg-12">
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
                            <img src="<?= $row['image_path'] ?>" width="100%" height="400">
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
        </div> -->

        <div class="row justify-content-center">
            <div class="col-lg-4 bg-dark rounded px-4">
                <h4 class="text-center text-light p-1">Choose Image to Upload</h4>

                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <input type="file" name="image" class="form-control p-1 mb-3" required>
                    </div>
                    <div class="form-group">
                        <input type="submit" name="upload" class="btn btn-warning btn-block  mb-3" value="Upload Image">
                    </div>
                    <div class="form-group">
                        <h5 class="text-center text-light"><?=$msg; ?></h5>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- displaying Editin Slider Content  -->
    <!--Displaying data in table-->
    <div class="">
        <div class="table-responsive mt-4 mx-auto bg-light p-4" style="width:95%;">
            <table class=" table table-striped table table-bordered">
                <thead class="table-dark c-white">
                    <!-- <th>Image ID</th> -->
                    <th>Image Filename</th>
                    <th>Delete</th>
                </thead>
                <?php while($rowimage =  mysqli_fetch_array($resultimage)){ ?>
                <tbody>
                    <!-- <td class="text-nowrap c-white"><?php echo $rowimage['id']; ?></td> -->
                    <td class="text-nowrap c-white"><?php echo $rowimage['image_path']; ?></td>

                    <td class="c-red d-flex mt-1">
                        <a href="php/admin-delete-carousel.php?id=<?php echo $rowimage['id'];?>"><input type="button"
                                class="btn btn-outline-danger" value="Delete"></a>
                    </td>
                </tbody>
                <?php } ?>
            </table>
        </div>
    </div>
</div>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>


</body>

</html>