<?php require('layouts/header_employee.php');
// require_once "controllerUserData.php"; 
   
   $user_id = $_SESSION['user_id'];

   if(!isset($user_id)){
     header('location:index.php');
   }

   $start_from = 0; 
$queryimage = "SELECT * FROM admin_content_homepage"; //You dont need like you do in SQL;
$resultimage = mysqli_query($con, $queryimage);


   $result = $con->query("SELECT image_path from admin_carousel_homepage");
?>
<?php
$users = "SELECT * FROM usertable where id='$user_id'"; //You dont need like you do in SQL;
$userresult = mysqli_query($con, $queryimage);
?>
<?php 
                 $select_user = mysqli_query($con, "SELECT * FROM usertable WHERE id = '$user_id'");
                 if(mysqli_num_rows($select_user) > 0){
                 $fetch_user = mysqli_fetch_assoc($select_user); 
                 };

                 $queryservice = "SELECT * FROM `service`"; //You don't need a ; like you do in SQL
                 $resultservices = mysqli_query($con, $queryservice);
        
        
                 $select_pet = mysqli_query($con, "SELECT * FROM pettable WHERE user_id = '$user_id'");
                 if(mysqli_num_rows($select_user) > 0){
                 $fetch_pet = mysqli_fetch_assoc($select_pet); 
                 };
             
             ?>

<?php
         
    if(isset($_POST['appoint'])){
        $appno = uniqid('PETCO-');
        

        $service = mysqli_real_escape_string($con, $_POST['service']);
        $appointdate = date('Y-m-d', strtotime($_POST['appointdate']));
        $appointtime = date('h:i A', strtotime($_POST['appointtime']));
        $petname =mysqli_real_escape_string($con,$_POST['petname']);
        $email =mysqli_real_escape_string($con,$_POST['email']);
        

            $sql = "INSERT INTO `client_appointment`( `service`, `appoint_no`, `appoint_date`, `appoint_time`, `petname`, `user_id`, `email`) 
            VALUES ('$service','$appno','$appointdate','$appointtime','$petname','$user_id', '$email')";
           $run = mysqli_query($con,$sql);

            // if(mysqli_query($con, $sql)){
           if($run)    {        
                echo "<script>
                    Swal.fire({
                    title: 'Success',
                    icon: 'success',
                    showDenyButton: false,
                    confirmButtonText: 'Okay',
                    denyButtonText: 'No',
                    customClass: {
                        actions: 'my-actions',
                        cancelButton: 'order-1 right-gap',
                        confirmButton: 'order-2',
                        denyButton: 'order-3',
                    }
                    }).then((result) => {
                        window.location.href='appointment-user.php';
                    })
                        </script>";
           }else{
           
           }     
  
    }
    if(isset($_POST['deleteAppointment'])){
        $id = $_POST['appoint-id'];
        $sql = "UPDATE client_appointment SET `status`='cancelled' WHERE id='$id'";
        $run = mysqli_query($con,$sql);
        echo "<script>  Swal.fire({
            title: 'Successfully Cancelled',
            icon: 'info',
            showDenyButton: false,
            confirmButtonText: 'Okay',
            denyButtonText: 'No',
            customClass: {
                actions: 'my-actions',
                cancelButton: 'order-1 right-gap',
                confirmButton: 'order-2',
                denyButton: 'order-3',
            }
            }).then((result) => {
                window.location.href='appointment-user.php';
            })</script>";
    }
    ?>

<style>
@media only screen and (min-width:1115px) {
    .images_menu {
        width: 80%;
        height: 10vh;
    }
}
</style>

<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<link rel="stylesheet" href="fullcalendar/core.min.css">
<link rel="stylesheet" href="fullcalendar/daygrid.min.css">
<link rel="stylesheet" href="fullcalendar/timegrid.min.css">
<link rel="stylesheet" href="fullcalendar/list.min.css">

<!--Content of Menu-->
<div class="container-xl-fluid mt-5 mb-5">
    <div class="px-3">
        <h4 class="text-center c-white py-3">Appointment History</h4>

        <div class="row">
            <div class="col-md-6  ">
                <div class="d-flex float-end mb-2" align="right">
                    <button type="button" class="btn bg-button mb-3"
                        style="background: #EA6D52; border-radius: 15px; border-width: 7px;" data-bs-toggle="modal"
                        data-bs-target="#staticBackdrop">
                        <i class="fa-solid fa-circle-plus"></i> Appointment
                    </button>
                </div>
                <br>
                <!--Displaying Data -->
                <div class="container mt-5 bg-light p-4 shadow rounded">
                    <div class="col ">
                        <table class=" table table-striped table table-bordered table table-hover">
                            <!-- <div class="row"> -->

                            <?php 
          $select_cart = mysqli_query($con, "SELECT * FROM `client_appointment`WHERE user_id = '$user_id' ORDER BY `client_appointment`.`appoint_date` ASC ");
          $grand_total = 0;

                if(mysqli_num_rows($select_cart) > 0){
                    ?>
                            <thead>

                                <div class="row tex-dark">

                                    <th scope="col" style="text-align:;">
                                        <div class="col">Appointment No.</div>
                                    </th>
                                    <th scope="col" style="text-align: ">
                                        <div class="col">Service Type</div>
                                    </th>
                                    <th scope="col" style="text-align: ;">
                                        <div class="col">Pet Name</div>
                                    </th>
                                    <th scope="col" style="text-align:;">
                                        <div class="col">Date</div>
                                    </th>
                                    <th scope="col" style="text-align: ;">
                                        <div class="col">Time</div>
                                    </th>
                                    <th scope="col" style="text-align: ;">
                                        <div class="col">Status</div>
                                    </th>
                                    </tr>
                            </thead>
                            <?php
                    while($fetch_cart = mysqli_fetch_assoc($select_cart)):   
                    ?>
                            <tr class=" ">
                                <!--Image-->

                                <td class="align-middle "><?= $fetch_cart['appoint_no'];?></td>
                                <!--Price-->
                                <td class="align-middle">
                                    <?php echo $fetch_cart['service'];?>
                                </td>
                                <td class="align-middle">
                                    <?php echo $fetch_cart['petname'];?>
                                </td>
                                <td class="align-middle">
                                    <?php echo $fetch_cart['appoint_date'];?>
                                </td>
                                <td class="align-middle">
                                    <?php echo $fetch_cart['appoint_time'];?>
                                </td>
                                <td class="align-middle">
                                    <?php echo $fetch_cart['status'];?>
                                </td>
                            <tr>
                                <?php
                    endwhile;
                }

                 else{
                    ?><tbody class="text-light ">
                                    <center>
                                        <h1><img src="asset/oops.png" alt="Logo" class="rounded" /></h1>
                                    </center>
                                </tbody><?php
                }
        
            ?>

                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="row justify-content-center mb-4 m-1">
                    <div class="col-1 c-white">
                        <p class=""  style="background: #EA6D52; color:  #EA6D52">|</p>
                    </div>Pending
                    <div class="col-1 c-white ">
                        <p class="bg-info text-info">|</p>
                    </div>Approved
                    <div class="col-1 c-white ">
                        <p class="" style="background: #00d27a; color: #00d27a">|</p>
                    </div>Served
                    
                    <div class="col-1 c-white">
                        <p class="bg-danger text-danger">|</p>
                    </div>Cancelled
                </div>
                <div class="card">
                    <div class="card-body">
                        <div id='calendar'></div>
                    </div>
                </div>

            </div>
        </div>



    </div>


    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header bg">
                    <h4 class="modal-title ">Appointment Form</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form action="" method="post" enctype="multipart/form-data"
                        class="row gap-2 justify-content-center">

                        <div class="justify-content-center">

                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-2"> <label>Service: </label></div>
                                        <div class="col-4">

                                            <select class="form-select form-select-md" name="service" required>
                                                <option value="">Select Service</option>
                                                <?php while($row =  mysqli_fetch_array($resultservices)){ ?>
                                                <option value=" <?php echo $row['service_name']; ?>">
                                                    <?php echo $row['service_name']; ?>
                                                </option>
                                                <?php } ?>
                                            </select>

                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item" id="service-content">


                                </li>

                                <li class="list-group-item">

                                    <div class="row">
                                        <div class="col-2"> <label> Date: </label></div>
                                        <div class="col-4 ">

                                            <input type="date" name="appointdate" min="<?php echo date('Y-m-d'); ?>"
                                                class="form-control" required />
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-2"> <label> Time: </label></div>
                                        <div class="col-4 ">

                                            <input type="time" name="appointtime" class="form-control" required />
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item mt-5">
                                    <div class="row">
                                        <div class="col-2"> <label> Pet Name: </label></div>
                                        <div class="col-4 ">

                                            <?php $select_pet = mysqli_query($con, "SELECT * FROM pettable WHERE user_id = '$user_id'");?>


                                            <select name="petname">
                                                <option value="" name="select_all">Select Pet</option>
                                                <?php while($row =  mysqli_fetch_array($select_pet)){ ?>
                                                <option value=" <?php echo $row['petname']; ?>">
                                                    <?php echo $row['petname']; ?>
                                                </option>
                                                <?php } ?>
                                            </select>

                                        </div>
                                    </div>



                                </li>

                                <li class="list-group-item mt-5">
                                    <div class="row">
                                        <div class="col">
                                            <?php $select = mysqli_query($con, "SELECT * FROM usertable WHERE id = '$user_id'");
                                                 $emaila = mysqli_fetch_array($select, MYSQLI_ASSOC);?>
                                            <input name="email" class="form-control" type="text"
                                                value="<?php echo $emaila['email'];   ?> " hidden>
                                        </div>
                                    </div>
                                </li>




                                <li class="list-group-item">
                                    <button type="button" class="btn btn-danger float-end" style="margin-left: 5px;"
                                        data-bs-dismiss="modal"
                                        onclick="return confirm('Are you sure you want to cancel?')">Cancel</button>
                                    <button type="submit" name="appoint" class="btn btn-outline-success float-end"
                                        style="max-width:450px;">Set
                                        Appointment</button>


                                </li>



                            </ul>


                        </div>
                    </form>
                </div>



            </div>
        </div>
    </div>

    <div id="appointment-details" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">

                    <h4 class="modal-title">Appointment Details</h4>
                </div>
                <div class="modal-body" id="details-content">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-bs-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous">
    </script>
    <script src="/js/script.js"></script>
    <script src="js/gallery_menu.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="fullcalendar/core.min.js"></script>
    <script src="fullcalendar/daygrid.min.js"></script>
    <script src="fullcalendar/timegrid.min.js"></script>
    <script src="fullcalendar/list.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script>
    $(function() {
        $.post("reservation_list.php", function(data) {
            var reservation = JSON.parse(data);
            let calendar = [];
            let calendarEl = document.getElementById('calendar');
            calendar = new FullCalendar.Calendar(calendarEl, {
                plugins: ['interaction', 'dayGrid', 'timeGrid', 'list'],
                'themeSystem': 'bootstrap',
                editable: true,
                header: {
                    left: 'prevYear,prev,next,nextYear today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
                },
                events: reservation,
                selectable: true,
                selectHelper: true,
                dateClick: function(info) {
                    alert('Clicked on: ' + info.dateStr);
                    alert('Coordinates: ' + info.jsEvent.pageX + ',' + info.jsEvent.pageY);
                    alert('Current view: ' + info.view.type);
                    // change the day's background color just for fun
                    info.dayEl.style.backgroundColor = 'red';
                },
                eventClick: function(info) {
                    var reserve_id = info.event.id;
                    $('#details-content').html('');
                    $.post("appointment_details.php", {
                        id: reserve_id
                    }, function(data) {
                        $('#details-content').html(data);
                        $('#appointment-details').modal('show');
                    });
                }

            });
            calendar.render();
        });
    });
    $(document).ready(function() {
        $('#appointment-menu').addClass('bg-primary');
        $(document).on('change', 'input[name="appointdate"]', function() {
            var service = $('select[name="service"]').val();
            var appointdate = $('input[name="appointdate"]').val();
            $.post("service_available_appointment.php", {
                service: service,
                appointdate: appointdate
            }, function(data) {
                if (data != 1) {
                    Swal.fire(
                        'Notice',
                        data,
                        'info'
                    )
                    $('input[name="appointdate"]').val("");
                }
            });
        });
        $(document).on('change', 'select[name="schedule"]', function() {
            var schedule = $(this).find(':selected').val();
            var time = $(this).find(':selected').data('time');
            $('input[name="appointtime"]').val(time);
            $('input[name="appointdate"]').val(schedule);
        });
    });
    </script>
    </body>

    </html>