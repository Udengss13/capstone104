<?php
    require_once "php/user-list-process.php";
    require('php/connection.php');
    

    
    $queryimage = "SELECT * FROM admin_quicktips"; //You don't need a like you do in SQL;
    $resultimage = mysqli_query($db_admin_account, $queryimage);
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin|| Quicktips</title>
    <!-- MATERIAL CDN -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Icons+Sharp"
      rel="stylesheet">
    <!-- Stylesheets -->
    
    <link rel="stylesheet" href="./adminstyles.css">
</head>

<body>
    <div class="container ">
        <aside>
            <div class="top">
             <div class="logo">
                <img src="asset/logopet.png">
                <h2>PETCo.<span class="danger">ADMIN</span></h2>
             </div>
             <div class="close" id="close-btn">
                <span class="material-icons-sharp">close</span>
             </div>
            </div>
            <div class="sidebar">
                <a href="#">
                    <span class="material-icons-sharp">grid_view</span>
                    <h3>Dashboard</h3>
                </a>
                <a href="admin-user-accounts.php">
                    <span class="material-icons-sharp">person</span>
                    <h3>Accounts</h3>
                </a>
                <a href="admin-orders.php">
                    <span class="material-icons-sharp">receipt_long</span>
                    <h3>Orders</h3>
                </a>
                <a href="#">
                    <span class="material-icons-sharp">insights</span>
                    <h3>Analytics</h3>
                </a>     
                <a href="#">
                    <span class="material-icons-sharp">mail_outline</span>
                    <h3>Messages</h3>
                    <span class="message-count">26</span>
                </a>
                <a href="#">
                    <span class="material-icons-sharp">inventory</span>
                    <h3>Products</h3>
                </a>
                <a href="#">
                    <span class="material-icons-sharp">report_gmailerrorred</span>
                    <h3>Reports</h3>
                </a>
                <a href="#">
                    <span class="material-icons-sharp">settings</span>
                    <h3>Settings</h3>
                </a>
                <a href="admin-content.php">
                    <span class="material-icons-sharp">add</span>
                    <h3>Add Content</h3>
                </a>
                <a href="admin-login.php">
                    <span class="material-icons-sharp">logout</span>
                    <h3>Logout</h3>
                </a>
            </div>
        </aside>

        <main>
            <div class="col py-3">
                <div class="w3-main">
                    <div class="w3-transparent">

                        <h3 class="text-center c-white py-3">Image Content for Home</h3>
                    </div>
                </div>

                <!--All Content for Image Here-->

                <form action="php/quicktips-image-process.php" method="post" enctype="multipart/form-data"
                    class="row gap-2 justify-content-center">
                    <div class="row justify-content-md-center mb-5">
                        <div class="col-lg-7 col-md-6 col-sm-12">
                            <div class="card d-flex justify-content-center">
                                <div class="card-header">
                                    Upload New Image for Quicktips

                                    <?php if(!empty($messages)){
	                              echo "<div class='alert alert-success'>";
	                                foreach ($messages as $message) {
		                              echo "<span class='glyphicon glyphicon-ok'></span>&nbsp;".$message."<br>";
	                                }
	                                 echo "</div>";
                                    }
                          ?>

                                    <ul class="list-group list-group-flush">


                                        <!--Body-->
                                        <li class="list-group-item">
                                            <div> <label>Information:</label></div>
                                            <textarea name="info" style="height:150px;" required class="col-12"
                                                placeholder="Information"></textarea>
                                        </li>
                                        <!--Choose File-->
                                        <li class="list-group-item">
                                            <input name="photo" class="" id="upload-news" type="file" required>
                                        </li>

                                        <li class="list-group-item">
                                            <!--Add button-->
                                            <button type="submit" name="upload_image_content"
                                                class="btn btn-outline-success float-end"
                                                style="max-width:450px;">Add</button>
                                        </li>

                                    </ul>
                                </div>
                            </div>
                        </div>
                </form>

    <!--Displaying data in table-->
    <div class="div_background_light">
        <div class="table-responsive mt-4 mx-auto" style="width:95%;">
            <table class="table mt-3">
                    <thead class="table-dark c-white">
                        <th>Image ID</th>
                        <th>Information</th>
                        <th>Delete</th>
                    </thead>
                            <?php while($rowimage =  mysqli_fetch_array($resultimage)){ ?>
                            <tbody>
                                <td class="text-nowrap c-white"><?php echo $rowimage['id']; ?></td>
                                <td class="text-nowrap c-white"><?php echo $rowimage['info']; ?></td>

                                <td class="c-red d-flex mt-1">

                                    <a href="admin-edit-quicktips.php?updateid=<?php echo $rowimage['id'];?>">
                                        <span class="btn btn-outline-success mx-2">Edit </span>
                                    </a>

                                    <a href="php/quicktips-image-process.php?id=<?php echo $rowimage['id'];?>"><input
                                            type="button" class="btn btn-outline-danger" value="Delete"></a>
                                </td>
                            </tbody>
                            <?php } ?>
                        </table>
                    </div>
                </div>
            </div>
</main>


            <!--DIVISION -->


            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ"
                crossorigin="anonymous">
            </script>
            <script src="/js/script.js"></script>
</body>

</html>