<?php
    require_once "php/user-list-process.php";
    require('php/connection.php');
    

    $querys = "SELECT * FROM `usertable` WHERE archive =''";  //You don't need a like you do in SQL;
    $results = mysqli_query($con, $querys);
    

    //this is for search name or id;
    if(isset($_GET['id'])){
        $user_id = $_GET['id'];
        $query = "SELECT * FROM usertable WHERE first_name='$user_id' OR last_name='$user_id' OR id='$user_id' OR email='$user_id'"; //You don't need a ; like you do in SQL
        $results = mysqli_query($con, $query);
    }else{
        $query = "SELECT * FROM usertable"; //You don't need a ; like you do in SQL
        $result = mysqli_query($con, $query);
    }
?>
<!-- <?php
require_once "controllerAdmin.php";  
?> -->



<?php

require('layouts/header_admin.php');
    require_once "php/user-list-process.php";
    require('php/connection.php');
    

    $query = "SELECT * FROM usertable"; //You don't need a like you do in SQL;
    $result = mysqli_query($con, $query);
    

    //this is for search name or id;
    // if(isset($_GET['id'])){
    //     $user_id = $_GET['id'];
    //     $query = "SELECT * FROM usertable WHERE first_name='$user_id' OR id='$user_id' OR email='$user_id'"; //You don't need a ; like you do in SQL
    //     $result = mysqli_query($con, $query);
    // }else{
    //     $query = "SELECT * FROM usertable"; //You don't need a ; like you do in SQL
    //     $result = mysqli_query($con, $query);
    // }
?>
<!-- <?php
require_once "controllerAdmin.php";  
?> -->


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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://kit.fontawesome.com/f8f3c8a43b.js" crossorigin="anonymous"></script>

<title>Admin || User</title>
<!---End of Aside-->
<div class="col-md-9 col-xl-10 py-3">
    <div class="mt-4 rounded mb-5 ">
        <h4 class="c-white rounded-top py-2" style="text-align:center;"> User Information </h4>
    
        <div class="col-2 float-end mb-4">
            <div class="dropdown  ms-auto ms-sm-0 flex-shrink-1 "
                style="background-color: #EA6D52; border-radius: 10px;">

                <a href="#" class="d-flex align-items-center text-decoration-none text-dark dropdown-toggle btn"
                    id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fa-solid fa-circle-plus"></i> <span class="text-light"> Add User </span>
                    
                </a>

                <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
                    <li><a class="dropdown-item" href="adminAddClient.php">Client</a></li>
                   
                    <li><a class="dropdown-item" href="adminAddEmployee.php">Employee</a></li>

                </ul>
            </div>

            <div class="d-flex flex-row-reverse">

            </div>
        </div>

    </div>
    <div class="card-body  m-2 ">
        <div class="mt-4 bg-light p-4 shadow rounded" >
            <table id="example" class="table-responsive table table-bordered table table-striped " style="width:100%;">
                <thead>

                    <th scope="col">Full Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">User Level</th>
                    <th scope="col">Status</th>

                </thead>

                <tbody>
                    <?php while($row = mysqli_fetch_array($results)){ ?>
                    <form action="php/user-list-process.php" method="post">
                        <tr>
                            <input name="user_id" readonly class="c-white text-center " type="text"
                                value="<?php echo $row['id']; ?>" hidden>
                                <td>
                                <?php echo $row['first_name']." ".$row['middle_name']." ". $row['last_name']." ".$row['suffix']; ?>
                            <!-- <td><input name="first_name" readonly class="c-white " type="text"
                                    style="background-color:transparent;border:0;"
                                    value="<?php echo $row['first_name']." ".$row['middle_name']." ". $row['last_name']." ".$row['suffix']; ?>"> -->
                            </td>


                            <td class="col-sm-1 col-md-1 col-lg-2">
                                <div class="col">
                                    <?php echo $row['email']  ?></div>
                            </td>
                            <td class=" col-sm-1 col-md-1 col-lg-2">
                                <div class="col">

                                    <?php echo $row['user_level']  ?></div>
                            </td>
                            <td> <input name="status" readonly class=" " type="text"
                                    style="background-color:transparent;border:0; color: " value="<?php  if( $row['status']!="verified"){
                                                echo "Not Verified";}
                                                else{
                                                   
                                                    echo "Verified";
                                            }; 
                                        ?>">
                            </td>


                        </tr>
                    </form>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>


</div>
</div>



<!--DIVISION -->


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous">
</script>
<script src="/js/script.js"></script>

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