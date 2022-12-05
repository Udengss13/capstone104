<?php 
    require("php/connection.php");
    require_once "controllerUserData.php"; 
    require('layouts/header_employee.php');

      $user_id = $_SESSION['user_id'];

      
        $id = $_GET['id'];
        //call all news and announcement
        $queryimage = "SELECT * FROM admin_content_homepage WHERE Image_id = $id "; //You don't need a ; like you do in SQL
        $resultimage = mysqli_query($db_admin_account, $queryimage);
        

?>

      





    <section id="#home">
        <div class="container mt-4">
            <div class="row ">
                <?php while($rowimage =  mysqli_fetch_array($resultimage)){ ?>
                <div class="col-12  justify-content-center  mt-4">
                    <img class="img-responsive"src="asset/homepage/<?php echo $rowimage['Image_filename']; ?>"
                        width="100%" height="500px">
                        <div class="news-body img-body mt-4 p-3">
                    <!--Name-->
                    <h1 class="text-center c-green display-8 " style="color: ;">
                        <?php echo $rowimage['Image_title']; ?></h1>
                    <!--Price-->
                    <p class="text-center text-muted pb-4" style="font-size:20px">
                        <?php echo $rowimage['Image_subtitle']; ?>
                    </p>
                   
                        <!-- <label>Information:</label> -->
                        <p class="c-white  m-5 " style="font-size: 20px; text-align: justify;"><?php echo $rowimage['Image_body']; ?></p>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </section>
   




    <!-- Script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous">

    </script>

</body>

</html>