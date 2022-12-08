<?php
 require('layouts/header_admin.php');
    require_once "php/user-list-process.php";
    require('php/connection.php');
 

   //call all Category
  $queryslide = "SELECT * FROM admin_category"; //You don't need a ; like you do in SQL
  $resultslide = mysqli_query($con, $queryslide);
?>

<html>

<head>
    <link rel="icon" href="asset/logopet.png" type="image/x-icon">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/admin.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/f8f3c8a43b.js" crossorigin="anonymous"></script>
    <!-- tables -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css">
    <title>Admin || Category</title>
</head>

<div class="col py-3 mt-5 p-5">
    <div class="container pt-5">
        <div class="row">
            <div class="col-md-12">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                    ADD
                </button>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title"> New Category Name</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <!-- Modal body -->

                        <form action="php/category-list-process.php" method="post"
                            class="row gap-2 justify-content-center">
                            <div class="modal-body">
                                <div class="card d-flex justify-content-center">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item">
                                            <label>Category Name:</label>
                                            <input class="col-12" name="title" type="text"
                                                placeholder="Enter Category Name" required>
                                        </li>
                                        <li class="list-group-item">
                                            <label>Category Details:</label>
                                            <input class="col-12" name="details" type="text"
                                                placeholder="Enter Category Details" required>
                                        </li>
                                        <!-- Modal footer -->

                                    </ul>
                                </div>

                                <div class="modal-footer">
                                    <button type="submit" name="submit_category"
                                        class="btn btn-outline-success float-end" style="max-width:450px;">Add</button>
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body  m-2 ">
            <div class="mt-4 bg-light p-4 shadow rounded">
                <table id="example" class="table-responsive table table-bordered table table-striped "
                    style="width:100%;">
                    <thead class="table-dark c-white">
                        <th class="text-center">Category ID</th>
                        <th class="text-center">Category Name</th>
                        <th class="text-center">Category Details</th>
                        <!-- <th class="text-center">Delete</th> -->
                    </thead>
                    <?php 
                     $queryslide = "SELECT * FROM admin_category"; //You don't need a ; like you do in SQL
                     $resultslide = mysqli_query($con, $queryslide);
                    while($rowslide =  mysqli_fetch_array($resultslide)){ ?>
                    <tbody>
                        <td class="text-nowrap text-center c-white"><?php echo $rowslide['category_id']; ?></td>
                        <td class="text-nowrap text-center c-white"><?php echo $rowslide['category_name']; ?></td>
                        <td class="text-nowrap text-center c-white"><?php echo $rowslide['category_details']; ?></td>
                        <!-- <td class="c-red text-center"> -->
                            <!--Edit-->
                            <!-- <a href="admin-edit-category.php?updateid=<?php echo $rowslide['category_id'];  ?>"
                                class="text-decoration-none c-green">
                                <button class="btn btn-outline-success mx-2 my-2">Edit</button></a> -->

                            <!--Delete-->
                            <!-- <a href="php/category-list-process.php?id=<?php echo $rowslide['category_id']; ?>"><input
                                    type="button" class="btn btn-outline-danger " value="Delete">
                            </a> -->
                        <!-- </td> -->
                    </tbody>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous">
    </script>
    <script src="/js/script.js"></script>
    </body>

</html>