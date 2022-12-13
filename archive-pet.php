<?php
    require('layouts/header_admin.php');
    require_once "php/user-list-process.php";
    require('php/connection.php');
    

    $querys = "SELECT * FROM `pettable` WHERE archive_status= 'archive' ";  //You don't need a like you do in SQL;
    $results = mysqli_query($con, $querys);
    

    //this is for search name or id;
    if(isset($_GET['id'])){
        $user_id = $_GET['id'];
        $query = "SELECT * FROM usertable WHERE first_name='$user_id' OR id='$user_id' OR email='$user_id'"; //You don't need a ; like you do in SQL
        $result = mysqli_query($con, $query);
    }else{
        $query = "SELECT * FROM usertable"; //You don't need a ; like you do in SQL
        $result = mysqli_query($con, $query);
    }
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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://kit.fontawesome.com/f8f3c8a43b.js" crossorigin="anonymous"></script>

<title>Admin || Archive</title>


<!---End of Aside-->
<div class="col-md-9 col-xl-10 py-3">
    <div class="mt-4 rounded mb-5">
        <h4 class="c-white rounded-top py-2" style="text-align:center;">- Archive Information -</h4>
        <!--Search-->
        <div class="row">
            <div class="col-10">
                <!-- <form action="admin-user-accounts.php" method="GET">
                    <div class="input-group mx-auto" style="width: 450px;">
                        <span class="input-group-text">Search User</span>
                        <input type="text" required class="form-control" name="id" placeholder="User ID or Name.">
                        <span class="input-group-btn">
                            <button class="btn btn-success" name="search" type="submit"><span
                                    class="bi bi-search c-white"></span></button>
                        </span>
                    </div>
                </form> -->
            </div>


            <div class="d-flex flex-row-reverse">

            </div>
        </div>

    </div>
    <div class="card-body">
    <div class="bg-light ">
        <div class="p-4 mt-4 " style="width:100%;">
            <table id="example" class="table-responsive table table-bordered table table-striped ">
                <thead >

                    <th scope="col">Pet Name</th>

                    <th scope="col">Breed</th>
                    <th scope="col">pettype</th>
                    <th scope="col">Sex</th>
                    <th scope="col">Birthday</th>
                    <th scope="col">Age</th>
                    <th scope="col">Owner</th>
                </thead>

                <tbody>
                    <?php while($row = mysqli_fetch_array($results)){ ?>
                    <form action="php/user-list-process.php" method="post">
                        <tr>
                            <input name="user_id" readonly class="c-white text-center " type="text"
                                value="<?php echo $row['pet_id']; ?>" hidden>
                            <td>
                                <input name="first_name" readonly class="c-white " type="text"
                                    style="background-color:transparent;border:0;"
                                    value="<?php echo $row['petname'] ?>">
                            </td>


                            <td class="col-sm-1 col-md-1 col-lg-1">
                                <?php echo $row['petbreed']  ?>
                            </td>
                            <td class="col-sm-1 col-md-1 col-lg-1">
                                <?php echo $row['pettype']  ?>
                            </td>
                            <td class="col-sm-1 col-md-1 col-lg-1">
                                <?php echo $row['petsex']  ?>
                            </td>
                            <td class="col-sm-1 col-md-1 col-lg-2">
                                <?php echo $row['petbday']  ?>
                            </td>
                            <!-- <td class="col-sm-1 col-md-1 col-lg-2">
                                <?php echo $row['user_id']  ?>
                            </td> -->
                            <!-- <td class="col-sm-1 col-md-1 col-lg-2">

                            </td> -->
                            <?php $bday = new DateTime($row['petbday']); // Pet Bday
                            $today = new Datetime(date('y-m-d'));
                            $diff = $today->diff($bday);
                            ?>

                            <td col-2>
                                <?php printf(' %d years, %d month, %d days', $diff->y, $diff->m, $diff->d); ?>
                            </td>

                            <?php $userquery = "SELECT first_name, last_name FROM usertable INNER JOIN pettable ON usertable.id = pettable.user_id 
                            where pettable.archive_status='archive' and usertable.id=".$row['user_id'];;
                            $resultuser = mysqli_query($con, $userquery); 

                            if(mysqli_num_rows($resultuser) > 0){
                            $fetch_user = mysqli_fetch_assoc($resultuser);
                            }; ?>
                            <td class="col-sm-1 col-md-1 col-lg-2">
                                <?php echo $fetch_user['first_name']." ".$fetch_user['last_name']  ?>
                            </td>










                            <!-- Modal -->
                            <div class="modal fade" id="id<?php echo $row['id'] ;?>" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="id<?php echo $row['id'] ;?>">
                                                Confirmation:</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">

                                            <label class="text-center mb-2 mx-auto">Enter Password
                                                before
                                                Archive <span
                                                    class="fw-bold"><?php echo $row['first_name']; ?>!</span></label>
                                            <input type="password" class="form-control" name="password"
                                                placeholder="Password" aria-label="Password"
                                                aria-describedby="addon-wrapping" required>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary"
                                                name="delete_user">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
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