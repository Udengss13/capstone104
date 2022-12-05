<?php
    require('layouts/header_employee.php');

   //call all Menu
  $querymenu = "SELECT * FROM admin_menu"; //You don't need a ; like you do in SQL
  $resultmenu = mysqli_query($con, $querymenu);  
 
   //call all Category
  $querycategory = "SELECT * FROM admin_category"; //You don't need a ; like you do in SQL
  $resultcategory = mysqli_query($db_admin_account, $querycategory);

  $querycategory = "SELECT * FROM admin_category"; //You don't need a ; like you do in SQL
  $resultcategorys = mysqli_query($db_admin_account, $querycategory);

  if(isset($_POST['addStock'])){
    $qty = $_POST['qty'];
    $id = $_POST['product-id'];
    $remarks = $_POST['remarks'];
    $expiration = $_POST['expiration'];
    $sql = "SELECT * FROM admin_menu WHERE Menu_id='$id'";
    $result =  mysqli_query($con, $sql);  
    $query = $result->fetch_array();

    $current_qty = intval($query['stock_in'])+intval($qty);

    $update_sql = "UPDATE admin_menu SET stock_in = '$current_qty' WHERE Menu_id='$id'";
    $run_update = mysqli_query($con, $update_sql); 
    if($run_update){
        $alert = date('Y-m-d', strtotime("-5 days", $expiration));
        $insert_sql = "INSERT INTO stock_management (product_id,remarks,stock_in,current_stock,expiration,alert_expire)
                      VALUES ('$id','$remarks','$qty','$current_qty','$expiration','$alert')";
        $resultcategorys = mysqli_query($con, $insert_sql);
        echo "<script>window.location.href='employee-menu.php';</script>";
    }
  }
  if(isset($_POST['deductStock'])){
    $qty = $_POST['deduct-qty'];
    $id = $_POST['product-id'];
    $remarks = $_POST['remarks'];
    $expiration = $_POST['expiration'];
    $sql = "SELECT * FROM admin_menu WHERE Menu_id='$id'";
    $result =  mysqli_query($con, $sql);  
    $query = $result->fetch_array();

    $current_qty = intval($query['stock_in'])-intval($qty);
    $out = intval($query['stock_out'])+intval($qty);

    $update_sql = "UPDATE admin_menu SET stock_in = '$current_qty', stock_out='$out' WHERE Menu_id='$id'";
    $run_update = mysqli_query($con, $update_sql); 
    if($run_update){
        $alert = date('Y-m-d', strtotime("-5 days", $expiration));
        $insert_sql = "INSERT INTO stock_management (product_id,remarks,stock_out,current_stock)
                      VALUES ('$id','$remarks','$qty','$current_qty')";
        $resultcategorys = mysqli_query($con, $insert_sql);
        if($resultcategorys){
            if($_POST['expiration']!=''){
                $update_deduct = "UPDATE stock_management SET settled=1 WHERE product_id='$id' AND expiration='$expiration'";
                $res_update = mysqli_query($con, $update_deduct); 
            }
            echo "<script>window.location.href='employee-menu.php';</script>";
        }

        
    }
  }
  

?>



<!--Content of Menu-->
<div class="container-xl-fluid mt-5 mb-5">
    <div class="px-3">
        <h4 class="text-center c-white py-3">All Products</h4>

        <!-- Modal -->

        <div class="d-flex flex-row-reverse">
            <button type="button" class="btn bg-button"
                style="background: #EA6D52; border-radius: 15px; border-width: 7px;" data-bs-toggle="modal"
                data-bs-target="#staticBackdrop"><i class="fa-solid fa-circle-plus "></i>
                Add


            </button>
        </div>

 
        <!-- The Modal -->
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Add products</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <form action="php/menu-process.php" method="post" enctype="multipart/form-data"
                            class="row gap-2 justify-content-center">

                            <div class="justify-content-center">
                                <div class="card-header">
                                    Product Information
                                </div>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">
                                        <label>Product Name:</label>
                                        <input name="title" class="col-12" type="text" required>
                                    </li>
                                    <li class="list-group-item">
                                        <label>Sub Info:</label>
                                        <textarea name="subinfo" style="height:100px;" required
                                            class="col-12"></textarea>
                                    </li>
                                    <li class="list-group-item">
                                        <label>Product Description:</label>
                                        <textarea name="paragraph" style="height:100px;" required
                                            class="col-12"></textarea>
                                    </li>
                                    <li class="list-group-item">
                                        <label>Price:</label>
                                        <input name="price" class="col-12" type="number" min="0" step="0.01" required>
                                    </li>
                                   
                                    <li class="list-group-item">
                                        <label>Category:</label>

                                        <div class="input-group flex-nowrap">
                                            <select class="form-select form-select-md" name="category_name" required>
                                                <option value="">Select Category</option>
                                                <?php while($rowcategory =  mysqli_fetch_array($resultcategory)){ ?>
                                                <option value=" <?php echo $rowcategory['category_name']; ?>">
                                                    <?php echo $rowcategory['category_name']; ?>
                                                </option>
                                                <?php } ?>
                                            </select>

                                        </div>

                                    </li>

                                    <li class="list-group-item">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="upload-news" name="photo"
                                                required>
                                        </div>
                                        <!-- <input name="photo" class="col-md-6 c-white" id="upload-news" type="file" required> -->
                                    </li>
                                    <li class="list-group-item">
                                        <button type="button" class="btn btn-danger float-end" style="margin-left: 5px;"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="submit" name="news" class="btn btn-outline-success float-end"
                                            style="max-width:450px;">Confirm</button>
                                    </li>
                                </ul>


                            </div>
                        </form>
                    </div>



                </div>
            </div>
        </div>



        <!--Displaying Data -->
        <div class="container-fluid mt-4 p-4 bg-light">
            <table class="table table-striped table table-bordered">
                <!-- <div class="row"> -->
                <thead>
                    <tr>
                        <div class="row">

                            <th scope="col" style="text-align: center;">
                                <div class="col">Image</div>
                            </th>
                            <th scope="col" style="text-align: center;">
                                <div class="col">Product Name</div>
                            </th>
                            <th scope="col" style="text-align: center;">
                                <div class="col">Stock In</div>
                            </th>
                            <th scope="col" style="text-align: center;">
                                <div class="col">Stock Out</div>
                            </th>
                            <th scope="col" style="text-align: center;">
                                <div class="col">Description</div>
                            </th>
                            <th scope="col" style="text-align: center;">
                                <div class="col">Price</div>
                            </th>
                            
                            <th scope="col" style="text-align: center;">
                                <div class="col">Product Type</div>
                            </th>
                            <th scope="col" style="text-align: center;">
                                <div class="col">Action</div>
                            </th>
                    </tr>
                </thead>
                <?php while($rowmenu =  mysqli_fetch_array($resultmenu)){ ?>
                <tr>
                    <td class="col-1" style="text-align: center;">
                        <div class="col">
                            <a href="Petkoproj/<?php echo $rowmenu['Menu_dir']; ?>" class="fancybox " rel="ligthbox">
                                <img src=" asset/menu/<?php echo $rowmenu['Menu_filename']; ?> "
                                    class="zoom img-thumbnail img-responsive images_menu"></a>
                        </div>
                    </td>
                    <td style="text-align: center;">
                        <div class="col">
                            <?php echo $rowmenu['Menu_name']; ?></div>
                    </td>
                    <td style="text-align: center;">
                        <div class="col">
                            <?php echo $rowmenu['stock_in']; ?></div>
                    </td>
                    <td style="text-align: center;">
                        <div class="col">
                            <?php echo $rowmenu['stock_out']; ?></div>
                    </td>
                    <td style="text-align: center;">
                        <div class="col">
                            <?php echo $rowmenu['Menu_description']; ?></div>
                    </td>
                    <td class="col-1" style="text-align: center;">
                        <div class="col">Php
                            <?php echo $rowmenu['Menu_price']; ?></div>
                    </td>
                

                    <td class="col-1" style="text-align: center;">
                        <div class="col">
                            <?php echo $rowmenu['Menu_category']; ?></div>
                    </td>
                    <td class="col-1">
                        <div class="col">
                            <a class="text-decoration-none c-green update" data-id="<?php echo $rowmenu['Menu_id']; ?>">
                                <i class="fa-solid fa-pen" style="font-size:25px; padding: 10px"></i>
                            </a>
                            <a class="text-decoration-none c-green add-stock" data-id="<?php echo $rowmenu['Menu_id']; ?>">
                                <i class="fa fa-plus" style="font-size:25px; padding: 10px"></i>
                            </a>
                            <a href="php/menu-process.php?id=<?php echo $rowmenu['Menu_id'];?>">
                                <i class="fa-solid fa-trash-can" style="font-size:25px; color:red; padding: 10px"
                                    onclick="return confirm('Are you sure you want to delete this product?')"></i>
                            </a>
                            <a class="text-decoration-none text-info list-stock" data-id="<?php echo $rowmenu['Menu_id']; ?>">
                                <i class="fa fa-list" style="font-size:25px; padding: 10px"></i>
                            </a>
                            <a class="btn btn-sm btn-danger text-decoration-none  deduct-stock" style="border-radius: 41px;" data-id="<?php echo $rowmenu['Menu_id']; ?>">
                                <i class="fa fa-minus" style="font-size:25px; padding: 10px"></i>
                            </a>
                        </div>

                    </td>

                    <?php } ?>
                    <!-- --========================= -->


                    <div id="update-modal" class="modal fade" data-bs-backdrop="static" role="dialog">
                        <div class="modal-dialog modal-lg">

                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Update Product</h4>
                                </div>
                                <div class="modal-body">
                                    <form action="php/edit-menu-process.php" id="update-form" method="post"
                                        enctype="multipart/form-data" class="row gap-2 justify-content-center">

                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item">
                                                <label>Menu Name:</label>
                                                <input class="col-4 mb-3" name="menuid" type="text" hidden>
                                                <input name="title" id="utitle" class="col-12" type="text" required>
                                            </li>
                                            <li class=" list-group-item">
                                                <label>Sub Info:</label>
                                                <textarea name="subinfo" id="uinfo" style="height:100px;" required
                                                    class="col-12"></textarea>
                                            </li>
                                            <li class=" list-group-item">
                                                <label>Menu Description:</label>
                                                <textarea name="paragraph" id="uparagraph" style="height:100px;"
                                                    required class="col-12"></textarea>
                                            </li>
                                            <li class="list-group-item">
                                                <label>Price:</label>
                                                <input name="price" id="uprice" class="col-md-5" type="number" required
                                                    min="0" step="0.01">
                                            </li>
                                           
                                            <li class="list-group-item">
                                                <label>Category:</label>

                                                <div class="input-group flex-nowrap">
                                                    <select class="form-select form-select-md" id="ucategory_name"
                                                        name="category_name" required>
                                                        <option value="">Select Category</option>
                                                        <?php while($rowcategorys =  mysqli_fetch_array($resultcategorys)){ ?>
                                
                                
                                
                                
                                                            <option value=" <?php echo $rowcategorys['category_name']; ?>">
                                                            <?php echo $rowcategorys['category_name']; ?>
                                                        </option>
                                                        <?php } ?>
                                                    </select>

                                                </div>

                                            </li>

                                            <li class="list-group-item">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="upload-news"
                                                        name="photo" required>
                                                </div>
                                                <!-- <input name="photo" class="col-md-6 c-white" id="upload-news" type="file" required> -->
                                            </li>

                                        </ul>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" form="update-form" class="btn btn-outline-success"
                                        name="update_changes">Update</button>
                                </div>
                            </div>

                        </div>
                    </div>
                    

                    <div id="add-stock-modal" class="modal fade" role="dialog">
                        <div class="modal-dialog">

                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Add Stock</h5>
                                <a class="close" data-bs-dismiss="modal"><b><span class="fa fa-times text-danger"></span></b></a>
                            </div>
                            <div class="modal-body" id="stock-content">
                                
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-info" form="add-stock-form" name="addStock">Submit Stocks</button>
                            </div>
                            </div>

                        </div>
                    </div>

                    <div id="deduct-stock-modal" class="modal fade" role="dialog">
                        <div class="modal-dialog">

                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Deduct Stock</h5>
                                <a class="close" data-bs-dismiss="modal"><b><span class="fa fa-times text-danger"></span></b></a>
                            </div>
                            <div class="modal-body" id="deduct-stock-content">
                                
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-bs-dismiss="modal">Close</button>
                                <button type="submit" form="deduct-stock-form" class="btn btn-info" name="deductStock">Deduct Stocks</button>
                            </div>
                            </div>

                        </div>
                    </div>

                    <div id="stock-logs-modal" class="modal fade" role="dialog">
                        <div class="modal-dialog modal-lg">

                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Stock Logs</h5>
                                <a class="close" data-bs-dismiss="modal"><b><span class="fa fa-times text-danger"></span></b></a>
                            </div>
                            <div class="modal-body" id="stock-logs-content">
                                
                            </div>
                            </div>

                        </div>
                    </div>
                    
                    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"
                        integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ"
                        crossorigin="anonymous">
                    </script>
                    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
                    <script>
                    // alert('gumagana ba?');
                    $(document).ready(function() {
                        $('#product-menu').addClass('bg-primary');
                        $(document).on('click', '.update', function() {
                            var id = $(this).data('id');
                            $('input[name="menuid"]').val(id);
                            $.post("php/product_details.php", {
                                id: id
                            }, function(data) {
                                var query = JSON.parse(data);
                                $('#utitle').val(query[1]);
                                $('#uinfo').val(query[2]);
                                $('#uparagraph').val(query[3]);
                                $('#ucategory_name').val(query[4]);
                                $('#uprice').val(query[5]);
                                $('input[name="uexpiration-date"]').val(query['expiration']);
                                console.log(query);
                            });
                            $('#update-modal').modal('show');
                        });
                        $(document).on('click','.add-stock',function(){
                            var id = $(this).data('id');
                            $('#stock-content').html('');
                            $.post("php/product_details_stock.php", {
                                id: id
                            }, function(data) {
                                $('#stock-content').html(data);
                                $('#add-stock-modal').modal('show');
                            });
                        });
                        $(document).on('click','.deduct-stock',function(){
                            var id = $(this).data('id');
                            $('#deduct-stock-content').html('');
                            $.post("php/deduct_product_details_stock.php", {
                                id: id
                            }, function(data) {
                                $('#deduct-stock-content').html(data);
                                $('#deduct-stock-modal').modal('show');
                            });
                        });
                        
                        $(document).on('click','.list-stock',function(){
                            var id = $(this).data('id');
                            $('#stock-logs-content').html('');
                            $.post("php/product_stock_logs.php", {
                                id: id
                            }, function(data) {
                                $('#stock-logs-content').html(data);
                                $('#stock-logs-modal').modal('show');
                            });
                        });
                        
                    });
                    </script>
                    </body>

                    </html>