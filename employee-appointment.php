<?php 
      require('layouts/header_employee.php');
    // require_once "controllerUserData.php"; 
   
    $user_id = $_SESSION['user_id'];

    if(!isset($user_id)){
      header('location: index.php');
    }
    $update = mysqli_query($con, "UPDATE messages SET seen=1 WHERE employee_id=$user_id AND sender_id='petko'");

    if(isset($_POST['submit-message'])){
        $message = $_POST['message'];
        date_default_timezone_set('Asia/Manila');
        $datetime = date("Y-m-d H:i:s");

        $sender = mysqli_query($con,"SELECT * FROM usertable  WHERE id = $user_id") or die ('query failed');
        $senderQuery = mysqli_fetch_array($sender);

        $name = $senderQuery['first_name'].' '.$senderQuery['last_name'].' '.$senderQuery['suffix'];

        $insert_data = "INSERT INTO messages (employee_id, `admin`, `message`, created_at, sender_name, receiver_name, sender_id)
                            values('$user_id', 'petko', '$message', '$datetime', '$name', 'Administrator', '$user_id')";
        $data_check1 = mysqli_query($con, $insert_data);
    }
?>


<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />



      <!-- ====================================================================================================== -->
      <div class="container pt-5">
            <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header row">
                                <div class="col-md-6">
                                    Available Appointment
                                </div>
                                <!-- <div class="col-md-6" align="right">
                                    <button class="btn btn-success btn-sm" type="button" data-bs-toggle="modal" data-bs-target="#add-modal"><span class="fa fa-plus"></span> Add Available Appointment</button>
                                </div> -->
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Day</th>
                                                <th>Time</th>
                                                <th>Service</th>
                                                
                                            </tr>
                                        </thead>
                                        <?php 
                                            $querymenu = "SELECT * FROM available_appointment where employee_id=$user_id" ; 
                                            $resultmenu = mysqli_query($con, $querymenu);  
                                            while($rowmenu =  mysqli_fetch_array($resultmenu)){

                                                $day_decode = str_replace('"','',$rowmenu['day']);

                                                $day_decode2 = str_replace('[','',$day_decode);

                                                $day_decode3 = str_replace(']','',$day_decode2);
                                       ?>
                                        <tr>
                                            <td><?php echo $day_decode3; ?></td>
                                            <td><?php echo date('h:i a',strtotime($rowmenu['time'])); ?></td>
                                            <td><?php echo $rowmenu['service']; ?></td>
                                            <!-- <td><a class="btn btn-danger btn-sm delete" data-id="<?php echo $rowmenu['id']; ?>"><span class="fa fa-times"></span></a></td> -->
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
                            <!-- <div class="form-group mb-3">
                                <label>Date</label>
                                <input class="form-control" type="date" min="<?php //echo date('Y-m-d'); ?>" required name="date-appointment"/>
                            </div> -->
                            <div class="form-group mb-3">
                                <label>Day</label>
                                <select class="form-control" name="day[]" multiple="multiple" required>
                                    <option value="">Select Day</option>
                                    <option value="Monday">Monday</option>
                                    <option value="Tuesday">Tuesday</option>
                                    <option value="Wednesday">Wednesday</option>
                                    <option value="Thursday">Thursday</option>
                                    <option value="Friday">Friday</option>
                                    <option value="Saturday">Saturday</option>
                                    <option value="Sunday">Sunday</option>
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label>Time</label>
                                <input class="form-control" type="time" required name="time-appointment"/>
                            </div>
                            <?php 
                                $queryservice = "SELECT * FROM `service`"; 
                                $resultservices = mysqli_query($con, $queryservice);
                            ?>
                            <div class="form-group">
                                <label>Service</label>
                                <select class="form-control" required name="service">
                                    <option value="">Select Service</option>
                                    <?php while($row =  mysqli_fetch_array($resultservices)){ ?>
                                    <option value=" <?php echo $row['service_name']; ?>">
                                        <?php echo $row['service_name']; ?>
                                    </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success" name="submit-appointment" form="add-form">Submit</button>
                    </div>
                </div>
            </div>
        </div>
        <?php
            if(isset($_POST['submit-appointment'])){
                // $date = $_POST['date-appointment'];
                $time = $_POST['time-appointment'];
                $service = $_POST['service'];
                $day = json_encode($_POST['day']);

                $insertavailable = "INSERT INTO available_appointment ( `service`,`time`,`day`) VALUES ('$service','$time','$day')";
                $run_query = mysqli_query($con, $insertavailable);
                if($run_query){
                    echo "<script>window.open('employee-appointment.php','_self');</script>";
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
    <script>
        $(document).ready(function() {
            $('select[name="day[]"]').select2({
                dropdownParent: $("#add-modal"),
                width:"100%"
            });
            $('#available-appointment-menu').addClass('bg-primary');
            $(document).on('click','.delete',function(){
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
                        $.post("employee-appointment.php",{id:id,delete_btn:"delete"},function(){
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