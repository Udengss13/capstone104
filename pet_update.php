<?php
    require('layouts/header_employee.php');
   
    require_once "controllerUserData.php"; 
     require('php/connection.php');
   
     $user_id = $_SESSION['user_id'];
      

   
    //This is for message
      if(isset($_SESSION['update_changes'])){
          $applychanges = $_SESSION['update_changes'];
          unset($_SESSION['update_changes']);
      }
      else{
          $applychanges="";
      }
  


    if (isset($_GET['updatepetid'])){
      $id = $_GET['updatepetid'];

      $editprofile = "SELECT * FROM pettable WHERE pet_id = '$id'";
      $result = mysqli_query($con, $editprofile);
      $rowimageEdit = mysqli_fetch_array($result, MYSQLI_ASSOC);
    }

    
?>
<?php
// $user_id = $_SESSION['user_id'];

    if(isset($_POST['update_profile'])){
        $id = $_POST['id'];
        // $petname = $_POST['petname'];
        // $petbreed = $_POST['petbreed'];
        
         // move file to a folder
        
         $userquery = "UPDATE `pettable` SET `archive_status`  = 'archive'
          WHERE `pettable`.`pet_id` = '$id'";
              
         if(mysqli_query($con, $userquery)){
             
          $_SESSION['update_changes'] = "Archive pet Successfully";
        //   header('location: ../pet_update.php?updateid='.$id);
         }
         else{
          echo "mlai";
         }
       
}

?>


<!--All Content Here-->
<div class="container  mt-5">
    <!-- <center><img src="asset/logopet.png" alt="Logo" style="position: absolute; z-index: -1;" /></center> -->



    <!-- <ul class="list-group "> -->
    <!--NAME-->
    <!-- <div class="row justify-content-md-center mb-5">
                    <div class="col-lg-12 col-md-6 col-sm-12">
                        <div class="card  justify-content-center"> -->
    <div class="container ">
        <div class="row justify-content-center">


            <div class="col-7 bg-light p-4 shadow rounded" width="50">
                <h4 class="text-center c-white py-3 text-dark">Archive </h4>

                <form action=" " method="post" enctype="multipart/form-data" onsubmit="return verifyPassword()">
                    <div class="row justify-content-md-center mb-5 ">

                        <!-- <div class="col-lg-7 col-md-6 col-sm-12"> -->

                        <!-- <div class="card-header">
                        Edit Information for Homepage
                    </div> -->
                        <!--Success Message-->
                        <?php if($applychanges!=""){?>
                        <div class="alert alert-primary alert-dismissible fade show mt-3 mx-auto justify-content-md-center mb-2"
                            role="alert" style="width: 50%;">
                            <strong>Apply Changes Successfully!</strong> <?php echo $applychanges; ?>.
                        </div>
                        <?php } ?>
                        <div class="row justify-content-md-center mb-2">

                            <label class="col-md-2 control-label "></label>
                            <div class="col-md-4 inputGroupContainer ">
                                <div class="input-group">
                                    <input name="id" class="col-12" type="text"
                                        value="<?php echo $rowimageEdit['pet_id']; ?>" hidden>
                                    <!-- <span class="input-group-addon"><i class="fa-solid fa-user ff"></i></span> -->
                                    <!-- <img src="asset/profiles/<?php echo $rowimageEdit['image_filename']?>"
                                class="rounded-circle" alt="Logo" style="width:40%; height:17vh" />

                            <input type="file" name="photo" placeholder="laagy" required> -->
                                </div>
                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="row  justify-content-md-center mb-2">
                            <label class="col-md-2 control-label">Pet Name</label>
                            <div class="col-md-4 inputGroupContainer">
                                <div class="input-group">
                                    <span class="input-group-addon ff"><i
                                            class="glyphicon glyphicon-user fa-5x "></i></span>
                                    <input name="fname" class="form-control" type="text"
                                        value="<?php echo $rowimageEdit['petname'];   ?>" readonly required>
                                </div>
                            </div>
                        </div>


                        <div class="row justify-content-md-center mb-2">
                            <label class="col-md-2 control-label">petbreed</label>
                            <div class="col-md-4 inputGroupContainer">
                                <div class="input-group">
                                    <span class="input-group-addon ff"><i
                                            class="glyphicon glyphicon-user fa-5x "></i></span>
                                    <input name="suffix" class="form-control" type="text"
                                        value="<?php echo $rowimageEdit['petbreed'];   ?>" readonly>
                                </div>
                            </div>
                        </div>


                        <div class="row mt-3">
                            <!--Back-->
                            <div class="col-4">

                            </div>
                           
                            <?php if($rowimageEdit['archive_status']=='archive'){?>
                            <div class="col-6">
                            <a href="userprofile.php"><span class="btn btn-danger mx-2">Back <i
                                            class="fa-sharp fa-solid fa-arrow-left"></i></span></a>

                            </div>

                            <?php } else{?>
                            
                            <div class="col-6">
                            <a href="userprofile.php"><span class="btn btn-danger mx-2">Back <i
                                        class="fa-sharp fa-solid fa-arrow-left"></i></span></a>
                                <button type="submit" name="update_profile" class="btn btn-success "
                                    style="max-width:450px;">Archive Pet <i
                                        class="fa-solid fa-box-archive"></i></button>
                            </div>
                            <?php } ?>

                            <!--Add button-->

                        </div>
                        <!-- </ul> -->
                    </div>
            </div>
        </div>
    </div>
</div>


</form>
</div>




<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous">
</script>
<script src="/js/script.js"></script>
</body>

</html>