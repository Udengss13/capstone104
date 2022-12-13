<?php
 require('layouts/header_admin.php');
 require_once "php/user-list-process.php";
 require('php/connection.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Admin|| Orders</title>

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
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>





    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />



    <!-- ====================================================================================================== -->
    <div class="col-md-9 col-xl-10 py-3">
        <div class="row mt-5">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header row">
                        <div class="col-md-6">
                            Available Appointment
                        </div>
                        <div class="col-md-6" align="right">
                            <button class="btn btn-success btn-sm" type="button" data-bs-toggle="modal"
                                data-bs-target="#add-modal"><span class="fa fa-plus"></span> Add Appointment
                                Date</button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered">
                                <thead>
                                    <tr>
                                        <th>Day</th>
                                        <!-- <th>Time</th> -->
                                        <!-- <th>Service</th> -->
                                        <th>Employee Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <?php 
                                            $querymenu = "SELECT * FROM available_appointment"; 
                                            $resultmenu = mysqli_query($con, $querymenu);  
                                            while($rowmenu =  mysqli_fetch_array($resultmenu)){

                                                $day_decode = str_replace('"','',$rowmenu['day']);

                                                $day_decode2 = str_replace('[','',$day_decode);

                                                $day_decode3 = str_replace(']','',$day_decode2);
                                       ?>
                                <tr>
                                    <td><?php echo $day_decode3; ?></td>
                                    <!-- ss<td><?php echo date('h:i a',strtotime($rowmenu['time'])); ?></td> -->
                                    <!-- <td><?php echo $rowmenu['service']; ?></td> -->
                                    <!-- <td><?php echo $rowmenu['employee_id']; ?></td> -->

                                    <?php $querymenu = "SELECT first_name, last_name FROM available_appointment INNER JOIN usertable
                                        ON available_appointment.employee_id = usertable.id
                                        WHERE usertable.id=".$rowmenu['employee_id'];
                                        $result = mysqli_query($con, $querymenu);
                                        if(mysqli_num_rows($result) > 0){
                                            $fetch_user = mysqli_fetch_assoc($result); 
                                            };  ?>
                                    <td><?php echo $fetch_user['first_name']." ".$fetch_user['last_name']; ?></td>
                                    

                                    <td><a class="btn btn-danger btn-sm delete"
                                            data-id="<?php echo $rowmenu['id']; ?>"><span
                                                class="fa fa-times"></span></a></td>
                                </tr>
                                <?php } ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ====================================================================================================== -->
    <div id="add-modal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Available Appointment</h5>
                </div>
                <div class="modal-body">
                    <form id="add-form" method="POST">
                     
                        <div class="form-group mb-3">
                            <label>Day</label><br>
                            
                            <div class="row">
                                <div class="col">
                                    <input type="checkbox" name="day[]" value="Monday"> Monday<br>
                                    <input type="checkbox" name="day[]" value="Tuesday"> Tuesday<br>
                                    <input type="checkbox" name="day[]" value="Wednesday"> Wednesday<br>
                                    <input type="checkbox" name="day[]" value="Thursday"> Thursday<br>
                                </div>


                                <div class="col">
                                    <input type="checkbox" name="day[]" value="Friday"> Friday<br>
                                    <input type="checkbox" name="day[]" value="Saturday"> Saturday<br>
                                    <input type="checkbox" name="day[]" value="Sunday"> Sunday<br>
                                </div>
                            </div>
                            <br>


                            
                            <?php 
                                $queryservice = "SELECT * FROM `service`"; 
                                $resultservices = mysqli_query($con, $queryservice);
                            ?>
                            <!-- <div class="form-group">
                                <label>Service</label>
                                <select class="form-control" required name="service">
                                    <option value="">Select Service</option>
                                    <?php while($row =  mysqli_fetch_array($resultservices)){ ?>
                                    <option value=" <?php echo $row['service_name']; ?>">
                                        <?php echo $row['service_name']; ?>
                                    </option>
                                    <?php } ?>
                                </select>
                            </div> -->
                            <br>
                            <?php 
                                $queryservice = "SELECT * FROM `usertable` where user_level='employee'"; 
                                $resultservices = mysqli_query($con, $queryservice);
                            ?>
                            <div class="form-group">
                                <label>Choose Employee</label>
                                <select class="form-control" required name="employee">
                                    <option value="">Select employee</option>
                                    <?php while($row =  mysqli_fetch_array($resultservices)){ ?>
                                    <option value=" <?php echo $row['id'] ?>">
                                        <?php echo $row['first_name'].' '.$row['last_name'];  ?>
                                    </option>
                                    <?php } ?>
                                </select>
                            </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success" name="submit-appointment"
                        form="add-form">Submit</button>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    <?php
            if(isset($_POST['submit-appointment'])){
                // $date = $_POST['date-appointment'];
                // $time = $_POST['time-appointment'];
                $service = $_POST['service'];
                $day = json_encode($_POST['day']);
                $employee = $_POST['employee'];

                $insertavailable = "INSERT INTO available_appointment ( `service`,`day`,`employee_id`) VALUES ('$service','$day','$employee')";
                $run_query = mysqli_query($con, $insertavailable);
                if($run_query){
                    echo "<script>window.open('admin-appointment.php','_self');</script>";
                }
            }
            if(isset($_POST['delete_btn'])){
                $id = $_POST['id'];
                $insertavailable = "DELETE FROM available_appointment WHERE id = '$id'";
                $run_query = mysqli_query($con, $insertavailable);
                if($run_query){
                    
                }
            }
        ?>
    <!-- ====================================================================================================== -->


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">
    </script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <!-- <script>import Swal from 'sweetalert2/dist/sweetalert2.js'</script> -->

    <script>
    $(document).ready(function() {
        $('select[name="day[]"]').select2({
            dropdownParent: $("#add-modal"),
            width: "100%"
        });
        $('#available-appointment-menu').addClass('bg-primary');
        $(document).on('click', '.delete', function() {
            var id = $(this).data('id');
            Swal.fire({
                title: 'Are you sure you want to delete this schedule?',
                icon: 'info',
                showDenyButton: true,
                confirmButtonText: 'Yes',
                denyButtonText: 'No',
                customClass: {
                    actions: 'my-actions',
                    cancelButton: 'order-1 right-gap',
                    confirmButton: 'order-2',
                    denyButton: 'order-3',
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    $.post("admin-appointment.php", {
                        id: id,
                        delete_btn: "delete"
                    }, function() {
                        location.reload();
                    });
                    location.reload();
                } else if (result.isDenied) {
                    Swal.fire('Record is not deleted', '', 'info')
                }
            })

        });
    });
    </script>

    </body>

</html>