<?php
    require('layouts/header_admin.php');
    require_once "php/user-list-process.php";
    require('php/connection.php');
    require_once "php/content-image-process.php";

    
    $queryimage = "SELECT * FROM admin_content_homepage"; //You don't need a like you do in SQL;
    $resultimage = mysqli_query($db_admin_account, $queryimage);
    
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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css">


<title>Admin Content</title>
</head>




<div class="col py-3">
    <div class="w3-main">
        <div class="w3-transparent">
            <h3 class="text-center c-white py-3">Announcement</h3>
        </div>
    </div>
    <!--All Content for Image Here-->
    <div class="d-flex flex-row-reverse">
        <button type="button" class="btn bg-button" style="background: #EA6D52; border-radius: 15px; border-width: 7px;"
            data-bs-toggle="modal" data-bs-target="#staticBackdrop"><i class="fa-solid fa-circle-plus "></i>
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
                    <h4 class="modal-title">Post an Announcement</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form action="php/content-image-process.php" method="post" enctype="multipart/form-data">
                        <div class="row justify-content-md-center mb-5">
                            <!-- <div class="col-lg-7 col-md-6 col-sm-12"> -->
                            <!-- <div class="card d-flex justify-content-center mt-5"> -->
                            <div class="card-header">


                                <?php if(!empty($messages)){
                                                            echo "<div class='alert alert-success'>";
                                                                foreach ($messages as $message) {
                                                                echo "<span class='glyphicon glyphicon-ok'></span>&nbsp;".$message."<br>";
                                                                }
                                                                echo "</div>"; 
                                                                }
                                                    ?>

                                <ul class="list-group list-group-flush">
                                    <!--Title-->
                                    <li class="list-group-item">
                                        <label>Title:</label>
                                        <input name="title" class="col-12" type="text" placeholder="News Title"
                                            required>
                                    </li>
                                    <!--Subtitle-->
                                    <li class="list-group-item">
                                        <label>Subtitle:</label>
                                        <input name="subtitle" class="col-12" type="text" placeholder="News Subtitle"
                                            required>
                                    </li>
                                    <!--Body-->
                                    <li class="list-group-item">
                                        <div> <label>Body:</label></div>
                                        <textarea name="paragraph" style="height:150px;" required class="col-12"
                                            placeholder="News Paragraph"></textarea>
                                    </li>
                                    <!--Choose File-->
                                    <li class="list-group-item">
                                        <input name="photo" class="" id="upload-news" type="file" required>
                                    </li>


                                    <li class="list-group-item">
                                        <!--Add button-->
                                        <button type="button" class="btn btn-danger float-end" style="margin-left: 5px;"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="submit" name="upload_image_content"
                                            class="btn btn-outline-success float-end"
                                            style="max-width:450px;">Add</button>
                                    </li>

                                </ul>
                                <!-- </div> -->
                                <!-- </div> -->
                            </div>
                    </form>
                </div>



            </div>
        </div>
    </div>
</div>



<!--Displaying data in table-->

<div class="container-fluid mt-4 p-4 bg-light">
    <table id="example" class="table table-striped table table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Image</th>
                <th>Title</th>
                <th>Subtitle</th>
                <th>Body</th>
                <th>Delete</th>

            </tr>
        </thead>
        <tbody>
            <?php while($rowimage =  mysqli_fetch_array($resultimage)){ ?>
            <tr>

                <td class="col-2">
                    <img src=" asset/homepage/<?php echo $rowimage['Image_filename']; ?> "
                        class="zoom img-thumbnail img-responsive images_menu" width="70%">
                </td>

                <td>
                    <?php echo $rowimage['Image_title']; ?>
                </td>
                <td>
                    <?php echo $rowimage['Image_subtitle']; ?>
                </td>
                <td>

                    <?php echo $rowimage['Image_body']; ?>
                </td>
                <td>
                    <a class="update" data-id="<?php echo $rowimage['Image_id'];?>">
                        <i class="fa-solid fa-pen" style="font-size:25px; padding: 10px"></i>

                    </a>

                    <a href="php/content-image-process.php?id=<?php echo $rowimage['Image_id'];?>"
                        onclick="return confirm('Are you sure you want to delete?')">
                        <i class="fa-solid fa-trash-can" style="font-size:25px; color:red; padding: 10px"></i>

                    </a>


                </td>


                <?php } ?>
        </tbody>



        <!--Modal for Updating the announcements -->


        <div id="update-modal" class="modal fade" data-bs-backdrop="static" role="dialog">
            <div class="modal-dialog modal-lg">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Update Announcements</h4>
                    </div>
                    <div class="modal-body">
                        <form action="php/content-image-edit-process.php" id="update-form" method="post"
                            enctype="multipart/form-data" class="row gap-2 justify-content-center">


                            <ul class="list-group list-group-flush">
                                <!--Title-->
                                <li class="list-group-item">
                                    <label>Header Name:</label>
                                    <input name="contentimageid" class="col-12" type="text" hidden>
                                    <input name="title" class="col-12" id="utitle" type="text" required>
                                </li>
                                <!--Subtitle-->
                                <li class=" list-group-item">
                                    <label>Subtitle:</label>
                                    <input name="subtitle" class="col-12" id="usubtitle" type="text" required>
                                </li>
                                <!--Body-->
                                <li class="list-group-item">
                                    <div> <label>Body:</label></div>
                                    <textarea name="paragraph" id="uparagraph" style="height:150px;" required
                                        class="col-12"></textarea>
                                </li>
                                <!--Choose File-->
                                <li class="list-group-item">
                                    <input name="photo" class="" id="upload-news" type="file" required>
                                </li>
                            </ul>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        <button type="submit" form="update-form" name="update_image_content"
                            class="btn btn-outline-success">Update</button>
                    </div>
                </div>

            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous">
        </script>
        <script src="/js/script.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script>
        $(document).ready(function() {
            $(document).on('click', '.update', function() {
                var id = $(this).data('id');
                $('input[name="contentimageid"]').val(id);
                $.post("content_details.php", {
                    id: id
                }, function(data) {
                    var query = JSON.parse(data);
                    $('#utitle').val(query[1]);
                    $('#usubtitle').val(query[2]);
                    $('#uparagraph').val(query[3]);
                    console.log(query);
                });
                $('#update-modal').modal('show');
            });
        });
        </script>

        <script src="/js/app.js"></script>
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>

        <script>
        $(document).ready(function() {
            $('#example').DataTable();
        });
        </script>
        </body>

</html>