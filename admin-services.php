<?php
 require('layouts/header_admin.php');
    require_once "php/user-list-process.php";
    require('php/connection.php');
    

    
    $queryimage = "SELECT * FROM admin_quicktips"; //You don't need a like you do in SQL;
    $resultimage = mysqli_query($db_admin_account, $queryimage);

    if(isset($_POST['action'])){
        
        $id = $_POST['id'];
        $update_query = mysqli_query($con, "UPDATE messages SET seen=1 WHERE employee_id=$id");
        
        $query = mysqli_query($con,"SELECT * FROM usertable  WHERE id = $id") or die ('query failed');
        $seQuery = mysqli_fetch_array($query);
        $name = '';
        if(isset($seQuery)){
            $name = $seQuery['first_name'].' '.$seQuery['last_name'].' '.$seQuery['suffix'];
        }
        $returnHtml = '<input name="employee-id" value='.$id.' type="hidden" />
                        <div class="form-group" align="center">
                            <h5>'.$name.'</h5>
                        </div>
        ';
        $get_messages = "SELECT * FROM messages WHERE employee_id = $id";
        $res = mysqli_query($con, $get_messages);
        while($fetch_message = mysqli_fetch_assoc($res)){                                    
            if($fetch_message['sender_id']=='petko'){
                $returnHtml .= '<div class="outgoing_msg">
                                    <div class="sent_msg">
                                    <p>'.$fetch_message['message'].'</p>
                                    <span class="time_date"> '.date('h:i a',strtotime($fetch_message['created_at'])).'  |  '.date('F d',strtotime($fetch_message['created_at'])).'</span> </div>
                                </div>';
            }else{
                $returnHtml .= '<div class="incoming_msg">
                                    <div class="incoming_msg_img"> <img style="width:100%;" src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> </div>
                                    <div class="received_msg">
                                        <div class="received_withd_msg">
                                        <p>'.$fetch_message['message'].'</p>
                                        <span class="time_date"> '.date('h:i a',strtotime($fetch_message['created_at'])).'  |  '.date('F d',strtotime($fetch_message['created_at'])).'</span> </div>
                                    </div>
                                </div>';
            }
        }

        echo $returnHtml;
        die;
    }

    if(isset($_POST['submit-message'])){
        $message = $_POST['message'];
        

        date_default_timezone_set('Asia/Manila');
        $datetime = date("Y-m-d H:i:s");
        $user_id = $_POST['employee-id'];

        
        $sender = mysqli_query($con,"SELECT * FROM usertable  WHERE id = $user_id") or die ('query failed');
        $senderQuery = mysqli_fetch_array($sender);

        $name = $senderQuery['first_name'].' '.$senderQuery['last_name'].' '.$senderQuery['suffix'];

        $insert_data = "INSERT INTO messages (employee_id, `admin`, `message`, created_at, sender_name, receiver_name, sender_id)
                            values('$user_id', 'petko', '$message', '$datetime', '$name', '$name', 'petko')";
        $data_check1 = mysqli_query($con, $insert_data);
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
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<script src="https://kit.fontawesome.com/f8f3c8a43b.js" crossorigin="anonymous"></script>
<title>Admin || Dashboard</title>



<div class="col py-3 mt-5 p-5">
    <div class="container pt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header row">
                        <div class="col-md-6">
                            Services
                        </div>
                        <div class="col-md-6" align="right">
                            <button class="btn btn-success btn-sm" type="button" data-bs-toggle="modal"
                                data-bs-target="#add-modal"><span class="fa fa-plus"></span> Add Service</button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered">
                                <thead>
                                    <tr>
                                        <th>Service</th>
                                        <th>Description</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <?php 
                                            $querymenu = "SELECT * FROM `service`"; 
                                            $resultmenu = mysqli_query($con, $querymenu);  
                                            while($rowmenu =  mysqli_fetch_array($resultmenu)){
                                        ?>
                                <tr>
                                    <td><?php echo $rowmenu['service_name']; ?></td>
                                    <td><?php echo $rowmenu['description']; ?></td>
                                    <td>
                                        <a class="btn btn-sm btn-danger delete"
                                            data-id="<?php echo $rowmenu['service_id']; ?>"><span
                                                class="fa fa-times"></span></a>
                                        <a class="btn btn-sm btn-warning update"
                                            data-id="<?php echo $rowmenu['service_id']; ?>"><span
                                                class="fa fa-pencil text-white"></span></a>
                                    </td>
                                </tr>
                                <?php } ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ====================================================================================================== -->
        <div id="add-modal" class="modal fade" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Service</h5>
                    </div>
                    <div class="modal-body">
                        <form id="add-form" method="POST">
                            <div class="form-group mb-3">
                                <label>Service</label>
                                <input class="form-control" type="text" required name="name" />
                            </div>
                            <div class="form-group mb-3">
                                <label>Description</label>
                                <textarea id="summernote" class="form-control" name="description"></textarea>
                            </div>

                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success" name="submit-link" form="add-form">Submit</button>
                    </div>
                </div>
            </div>
        </div>
        <div id="update-modal" class="modal fade" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Update Service</h5>
                    </div>
                    <div class="modal-body">
                        <form id="update-form" method="POST">
                            <div class="form-group mb-3">
                                <label>Service</label>
                                <input class="form-control" type="text" required name="uname" />
                                <input class="form-control" type="hidden" name="service-id" />
                            </div>
                            <div class="form-group mb-3">
                                <label>Description</label>
                                <textarea id="usummernote" class="form-control" name="udescription"></textarea>
                            </div>

                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success" name="update-submit"
                            form="update-form">Submit</button>
                    </div>
                </div>
            </div>
        </div>
        <?php
            if(isset($_POST['submit-link'])){
                $name = $_POST['name'];
                $description = $_POST['description'];
                $insertavailable = "INSERT INTO `service` (`service_name`,`description`) VALUES ('$name','$description')";
                $run_query = mysqli_query($con, $insertavailable);
                if($run_query){
                    echo '<script>
                    alert("Service inserted Successfully!");
                    window.location.href="admin-services.php";
                    </script>';
                }
            }
            if(isset($_POST['update-submit'])){
                $name = $_POST['uname'];
                $description =str_replace("'",'',$_POST['udescription']);
                $id = $_POST['service-id'];
                $updateQuery = "UPDATE `service` SET `service_name`='$name', `description`='$description' WHERE service_id = '$id'";
        
                $run_querys = mysqli_query($con, $updateQuery);
                
                if($run_querys){
                    echo '<script>
                    alert("Update Service Successfully!");
                    window.location.href="admin-services.php";
                    </script>';
                 
                    // echo "<script>window.open('admin-services.php','_self');</script>";
                }
            }
            if(isset($_POST['delete_submit'])){
                $id = $_POST['id'];
                $del_query = "DELETE FROM `service` WHERE service_id = '$id'";
                $result = mysqli_query($con, $del_query);

                echo '<script>
                alert("Delete Service Successfully!");
                window.location.href="admin-services.php";
                </script>';
               
            }   
            
        ?>
        <!-- ====================================================================================================== -->
    </div>

</div>



<!--DIVISION -->



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous">
</script>
<script src="/js/script.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<script>
$(document).ready(function(index) {
    $('#summernote').summernote({
        height: 400
    });
    $(document).on('click', '.delete', function() {
        var id = $(this).data('id');
        console.log(id);
        $.post("admin-services.php", {
            delete_submit: 'delte',
            id: id
        }, function(data) {
            location.reload();
        });
    });
    $('#usummernote').summernote({
        height: 400
    });
    $(document).on('click', '.update', function() {
        var id = $(this).data('id');
        $('input[name="service-id"]').val(id);
        $.post("service_data.php", {
            id: id
        }, function(data) {
            var new_data = JSON.parse(data);
            $('input[name="uname"]').val(new_data['service_name']);
            // $('textarea[name="udescription"]').val(new_data['description']);

            $("#usummernote").summernote("code", new_data['description']);
        });
        $('#update-modal').modal('show');
    });
});
</script>
</body>

</html>