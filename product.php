<?php require('layouts/header_employee.php');
     require('php/connection.php');

     $user_id = $_SESSION['user_id'];
     $queryimage = "SELECT * FROM usertable where id= $user_id";
     $resultimage = mysqli_query($con, $queryimage);

     if(mysqli_num_rows($resultimage) > 0){
       $fetch = mysqli_fetch_assoc($resultimage); 
       };

    

     if(isset($user_id) and $fetch['user_level']=='employee'){
       header('location:index.php');

     }
    //https://www.codepile.net/pile/NYN5P9Qq

      $querycategory = "SELECT * FROM admin_category"; 
      $resultcategory = mysqli_query($con, $querycategory);   

      $user_id = $_SESSION['user_id'];

     
?>

<?php 
  //FOR MAIN CONTENT
  if(isset($_POST['add_to_cart'])){
    $product_id = $_POST['product_id']; //it is get on hidden input
    $product_name = $_POST['product_name']; //it is get on hidden input
    $product_price = $_POST['product_price']; //it is get on hidden input
    $product_image = $_POST['product_image']; //it is get on hidden input
    $product_quantity = 1;

    $select_cart = mysqli_query($con, "SELECT * FROM `cart` WHERE Cart_name = '$product_name' AND Cart_user_id = '$user_id'");

    if(mysqli_num_rows($select_cart) > 0){
        // $insert_product = mysqli_query($con," UPDATE `cart` SET `Cart_quantity` = '4' WHERE `cart`.`Cart_id` = '$user_id'");
        echo "<script>
        Swal.fire({
            title: 'Product successfully add to cart',
            icon: 'success',
            showDenyButton: false,
            confirmButtonText: 'Yes',
            customClass: {
                actions: 'my-actions',
                cancelButton: 'order-1 right-gap',
                confirmButton: 'order-2',
                denyButton: 'order-3',
            }
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href='product.php';
            } 
        })
       

        </script>";
    }else{
      $insert_product = mysqli_query($con, "INSERT INTO `cart`(Cart_user_id, product_id, Cart_name, Cart_price, Cart_image, Cart_quantity) 
      VALUES ('$user_id', '$product_id','$product_name', '$product_price', '$product_image', '$product_quantity')");
       echo "<script>

       Swal.fire({
            title: 'Product successfully add to cart',
            icon: 'success',
            showDenyButton: false,
            confirmButtonText: 'Yes',
            customClass: {
                actions: 'my-actions',
                cancelButton: 'order-1 right-gap',
                confirmButton: 'order-2',
                denyButton: 'order-3',
            }
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href='product.php';
            } 
        })

       </script>";
    }
  }
?>

<?php 
  //FOR SELECT & SEARCH ADD TO CART PROCESS
  if(isset($_POST['add_to_cart_select'])){
    $product_select_name = $_POST['product_category_name']; //it is get on hidden input
    $product_select_price = $_POST['product_category_price']; //it is get on hidden input
    $product_select_image = $_POST['product_category_image']; //it is get on hidden input
    $product_select_quantity = 1;

    $select_cart = mysqli_query($con, "SELECT * FROM `cart` WHERE Cart_name = '$product_select_name' AND Cart_user_id = '$user_id'");

    if(mysqli_num_rows($select_cart) > 0){
        echo "<script>
        Swal.fire({
            title: 'Product is already in your cart',
            icon: 'success',
            showDenyButton: false,
            confirmButtonText: 'Yes',
            customClass: {
                actions: 'my-actions',
                cancelButton: 'order-1 right-gap',
                confirmButton: 'order-2',
                denyButton: 'order-3',
            }
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href='product.php';
            } 
        })
       

        </script>";
        // header('location: admin-view-orders.php?id='.$_GET['id']);
    }else{
        $insert_product = mysqli_query($con, "INSERT INTO `cart`(Cart_user_id, product_id, Cart_name, Cart_price, Cart_image, Cart_quantity) 
        VALUES ('$user_id', '$product_id','$product_name', '$product_price', '$product_image', '$product_quantity')");
          echo "<script>
          Swal.fire({
              title: 'Product successfully add to cart',
              icon: 'success',
              showDenyButton: false,
              confirmButtonText: 'Yes',
              customClass: {
                  actions: 'my-actions',
                  cancelButton: 'order-1 right-gap',
                  confirmButton: 'order-2',
                  denyButton: 'order-3',
              }
          }).then((result) => {
              if (result.isConfirmed) {
                  window.location.href='product.php';
              } 
          })
         
  
          </script>";
    }
  }
?>


<?php 
  if(isset($message)){
    foreach($message as $message){
     echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="Myid">'
    .$message.
     '<button type="button" class="btn-close" aria-label="Close" onclick="toggleText()"></button></div>';
     echo '<script>
     function toggleText(){
       var x = document.getElementById("Myid");
       if (x.style.display === "none") {
         x.style.display = "block";
       } else {
         x.style.display = "none";
       }
     }
     </script>';

}
}
?>

<?php
  $num_per_page = 20;

  if(isset($_GET["page"])){
    $page = $_GET['page'];
  }
  else{
    $page = 1;
  }  

?>
<link rel="stylesheet" type="text/css" href="css/styles.css">
<link rel="stylesheet" type="text/css" href="css/product.css">



<div class="container-fluid mt-4">
    <div class="row">
        <div class="col-3">
            <form action="product.php" method="GET">
                <div class="input-group flex-nowrap ">
                    <select class="form-select form-select-md" name="select_category" required
                        onchange="this.form.submit()">
                        <option value="" name="select_all">Select Category</option>
                        <?php while($rowcategory =  mysqli_fetch_array($resultcategory)){ ?>
                        <option value=" <?php echo $rowcategory['category_name']; ?>">
                            <?php echo $rowcategory['category_name']; ?>
                        </option>
                        <?php } ?>
                    </select>
                </div>
            </form>
        </div>
        <div class="col">

        </div>
        <div class="col-4 float-end">
            <form action="product.php" method="GET">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" name="search" value="<?php if(isset($_GET['search'])) {
                                            echo $_GET['search'];
                                        }?>" placeholder="Brand, product name, price ">
                    <!--Button Search-->
                    <button class="btn btn-primary">Search</button>
                </div>
            </form>
        </div>

    </div>
</div>





<!-- For Category Container -->
<div class="container  search mt-4">

    <!-- </div>
        </div> -->
</div>


<!--Search Form-->



<!--THE PRODUCT CATEGORY IS SELECTED-->
<?php   
          if(isset($_GET['select_category'])){
           $filtervalues = $_GET['select_category']; 
           $querysearchmenu = mysqli_query($con,"SELECT * FROM admin_menu WHERE CONCAT(Menu_id, Menu_name, Menu_price, Menu_category,Menu_filename) LIKE '%$filtervalues%' AND DATE(expiration)>NOW()"); //You dont need like you do in SQL;
                   
           if(mysqli_num_rows($querysearchmenu)>0 ){
                    ?>
<section class="product ms-5 mb-4">
    <center>
        <div class="fs-5 fw-bold ">All Product</div>
    </center>
    <div class="box-container justify-content-center">
        <?php
                            while($fetch_product = mysqli_fetch_assoc($querysearchmenu)){
                            ?>
        <form action="product.php" method="post" class="bg-light m-2 rounded">
            <div class="m-3 mb-3 rounded-3 ">

                <a href="home-view-image.php?id=<?php echo $fetch_product['Menu_id'] ?>" class=" w-100 mb-3"><img
                        src="asset/menu/<?php echo $fetch_product['Menu_filename']?>" alt="Image section"
                        class="card-img-top  img-responsive " style="height:13rem; width:100%;"></a>

                <div class="card-body d-flex flex-column">
                    <h6 class="card-title text-center"><?php echo $fetch_product['Menu_name']?></h6>

                    <p class="card-text d-inline-block text-truncate text-dark mt-1">
                        <?php echo $fetch_product['subinfo'] ?>
                    </p>

                    <div class="row">
                        <div class="col">
                            <h6 class="card-text  text-dark mt-2 text-center">
                                Php <?php echo $fetch_product['Menu_price']?>.00
                            </h6>
                        </div>
                        <div class="col">
                            <input type="submit" name="add_to_cart" value="Add to Cart"
                                class="btn btn-danger bg-button text w-90">
                        </div>
                    </div>
                </div>

                <!-- <h4 class="mt-2"><?php echo $fetch_product['Menu_name']?></h4>
                    <h6 class="card-text text-center text-muted">
                        <?php echo $fetch_product['Menu_description'] ?>
                    </h6>


                    <div class="mt-2 ">Php <?php echo $fetch_product['Menu_price']?>
                        </h3>

                    </div> -->

                <!--hidden inputs-->
                <input type="hidden" name="product_id" value="<?php echo $fetch_product['Menu_id'] ?>">
                <input type="hidden" name="product_name" value="<?php echo $fetch_product['Menu_name'] ?>">
                <input type="hidden" name="product_price" value="<?php echo $fetch_product['Menu_price'] ?>">
                <input type="hidden" name="product_description"
                    value="<?php echo $fetch_product['Menu_description'] ?>">
                <input type="hidden" name="product_image" value="<?php echo $fetch_product['Menu_filename'] ?>">

                <!--Add to cart button-->
                <!-- <a href="home-view-image.php?id=<?php echo $fetch_product['Menu_id'] ?>"
                        class=" btn btn-outline-secondary w-100 mb-3">View</a> -->


            </div>
        </form>
        <?php
                        }; ?>
    </div>
</section>
<?php };?>

<?php } ?>




<!--SEARCH SECTION-->
<?php   
                if(isset($_GET['search'])){
                $filtervalues = $_GET['search']; 
                $querysearchmenu = mysqli_query($con,"SELECT * FROM admin_menu WHERE CONCAT(Menu_name, Menu_price, Menu_category) LIKE '%$filtervalues%' AND DATE(expiration)>NOW()"); //You dont need like you do in SQL;
                        
                    if(mysqli_num_rows($querysearchmenu)>0 ){
                        ?>
<section class="product ms-5 mb-4">
    <center>
        <div class="fs-5 fw-bold ">All Product</div>
    </center>
    <div class="box-container justify-content-center">
        <?php
                            while($fetch_product = mysqli_fetch_assoc($querysearchmenu)){
                            ?>
        <form action="product.php" method="post" class="bg-light m-2 rounded">
            <div class="m-3 mb-3 rounded-3 ">

                <a href="home-view-image.php?id=<?php echo $fetch_product['Menu_id'] ?>" class=" w-100 mb-3"><img
                        src="asset/menu/<?php echo $fetch_product['Menu_filename']?>" alt="Image section"
                        class="card-img-top  img-responsive " style="height:13rem; width:100%;"></a>

                <div class="card-body d-flex flex-column">
                    <h6 class="card-title text-center"><?php echo $fetch_product['Menu_name']?></h6>

                    <p class="card-text d-inline-block text-truncate text-dark mt-1">
                        <?php echo $fetch_product['subinfo'] ?>
                    </p>

                    <div class="row">
                        <div class="col">
                            <h6 class="card-text  text-dark mt-2 text-center">
                                Php <?php echo $fetch_product['Menu_price']?>.00
                            </h6>
                        </div>
                        <div class="col">
                            <input type="submit" name="add_to_cart" value="Add to Cart"
                                class="btn btn-danger bg-button text w-90">
                        </div>
                    </div>
                </div>

                <!-- <h4 class="mt-2"><?php echo $fetch_product['Menu_name']?></h4>
                    <h6 class="card-text text-center text-muted">
                        <?php echo $fetch_product['Menu_description'] ?>
                    </h6>


                    <div class="mt-2 ">Php <?php echo $fetch_product['Menu_price']?>
                        </h3>

                    </div> -->

                <!--hidden inputs-->
                <input type="hidden" name="product_id" value="<?php echo $fetch_product['Menu_id'] ?>">
                <input type="hidden" name="product_name" value="<?php echo $fetch_product['Menu_name'] ?>">
                <input type="hidden" name="product_price" value="<?php echo $fetch_product['Menu_price'] ?>">
                <input type="hidden" name="product_description"
                    value="<?php echo $fetch_product['Menu_description'] ?>">
                <input type="hidden" name="product_image" value="<?php echo $fetch_product['Menu_filename'] ?>">

                <!--Add to cart button-->
                <!-- <a href="home-view-image.php?id=<?php echo $fetch_product['Menu_id'] ?>"
                        class=" btn btn-outline-secondary w-100 mb-3">View</a> -->


            </div>
        </form>
        <?php
                        }; ?>
    </div>
</section>
<?php };?>
<?php } ?>




<!-- FOR THE DISPLAY OF ALL PRODUCTS [IF THE CATEGORY AND THE SEARCH IS NOT TRIGGERED] -->
<?php   
                if(!isset($_GET['search']) && !isset($_GET['select_category'])){
                // $filtervalues = $_GET['search']; 
                $menu = mysqli_query($con,"SELECT * FROM admin_menu"); //You dont need like you do in SQL;
                // DATE(expiration)>NOW()"
                    if(mysqli_num_rows($menu)>0 ){
                        ?>

<section class="product ms-5 mb-4">
    <center>
        <div class="fs-5 fw-bold ">All Product</div>
    </center>
    <div class="box-container justify-content-center">
        <?php
                            while($fetch_product = mysqli_fetch_assoc($menu)){
                            ?>
        <form action="product.php" method="post" class="bg-light m-2 rounded">
            <div class="m-3 mb-3 rounded-3 ">

                <a href="home-view-image.php?id=<?php echo $fetch_product['Menu_id'] ?>" class=" w-100 mb-3"><img
                        src="asset/menu/<?php echo $fetch_product['Menu_filename']?>" alt="Image section"
                        class="card-img-top  img-responsive " style="height:13rem; width:100%;"></a>

                <div class="card-body d-flex flex-column">
                    <h6 class="card-title text-center"><?php echo $fetch_product['Menu_name']?></h6>

                    <p class="card-text d-inline-block text-truncate text-dark mt-1">
                        <?php echo $fetch_product['subinfo'] ?>
                    </p>

                    <div class="row">
                        <div class="col">
                            <h6 class="card-text  text-dark mt-2 text-center">
                                Php <?php echo $fetch_product['Menu_price']?>.00
                            </h6>
                        </div>
                        <div class="col">
                            <input type="submit" name="add_to_cart" value="Add to Cart"
                                class="btn btn-danger bg-button text w-90">
                        </div>
                    </div>
                </div>

                <!-- <h4 class="mt-2"><?php echo $fetch_product['Menu_name']?></h4>
                    <h6 class="card-text text-center text-muted">
                        <?php echo $fetch_product['Menu_description'] ?>
                    </h6>


                    <div class="mt-2 ">Php <?php echo $fetch_product['Menu_price']?>
                        </h3>

                    </div> -->

                <!--hidden inputs-->
                <input type="hidden" name="product_id" value="<?php echo $fetch_product['Menu_id'] ?>">
                <input type="hidden" name="product_name" value="<?php echo $fetch_product['Menu_name'] ?>">
                <input type="hidden" name="product_price" value="<?php echo $fetch_product['Menu_price'] ?>">
                <input type="hidden" name="product_description"
                    value="<?php echo $fetch_product['Menu_description'] ?>">
                <input type="hidden" name="product_image" value="<?php echo $fetch_product['Menu_filename'] ?>">

                <!--Add to cart button-->
                <!-- <a href="home-view-image.php?id=<?php echo $fetch_product['Menu_id'] ?>"
                        class=" btn btn-outline-secondary w-100 mb-3">View</a> -->


            </div>
        </form>
        <?php
                        }; ?>
    </div>
</section>
<?php };?>

<?php } ?>


<footer class="footer-banner text-center" id="about">
        <h1 class="text-white" style="padding-top:20px;">PetCo. Animal Clinic</h1>
        <p class="text-white">Get in touch on our products and promos.</p>
       
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