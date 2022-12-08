<?php
require('layouts/header_admin.php');
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

<title>Admin || Profile</title>
<!---End of Aside-->

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