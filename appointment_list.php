<?php 
      require('layouts/header_employee.php');
    // require_once "controllerUserData.php"; 
   
    $user_id = $_SESSION['user_id'];

    if(!isset($user_id)){
      header('location: index.php');
    }
    
    
?>
<link rel="stylesheet" href="fullcalendar/core.min.css">
<link rel="stylesheet" href="fullcalendar/daygrid.min.css">
<link rel="stylesheet" href="fullcalendar/timegrid.min.css">
<link rel="stylesheet" href="fullcalendar/list.min.css">





      <!-- ====================================================================================================== -->
      <div class="container-xl-fluid pt-5 m-4">
        
            
            <div class="row">
                    <div class="col-md-6  rounded">
                        <div class="card shadow">
                            <div class="card-header">
                                <div class="col-md-">
                                  Appointment List
                                </div>
                                <div class="col-md-6" align="right">
                                    
                                </div>
                            </div>
                            <div class="card-body">
                                <nav>
                                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                        <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Pending</button>
                                        <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Approved</button>
                                        <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">Served</button>
                                        <button class="nav-link" id="cancelled-contact-tab" data-bs-toggle="tab" data-bs-target="#cancelled-contact" type="button" role="tab" aria-controls="cancelled-contact" aria-selected="false">Cancelled</button>
                                    </div>
                                </nav>
                                <div class="tab-content" id="nav-tabContent">
                                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                        <div class="table-responsive mt-4">
                                            <table id="pending" class="table table-hover table-bordered" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Ref. No.</th>
                                                        <th>Date Schedule</th>
                                                        <th>Customer Name</th>
                                                        <th>Pet Name</th>
                                                        <th>Service</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>
                                                <?php
                                                    $query_pending = "SELECT c.*,CONCAT(u.first_name,' ',u.middle_name,' ',u.last_name,' ',u.suffix) AS customer_name FROM client_appointment c LEFT JOIN usertable u ON u.id = c.user_id WHERE c.status='pending' AND u.id is not null"; 
                                                    $result_pending = mysqli_query($con, $query_pending);  
                                                    $count = 0;
                                                    while($row_pending =  mysqli_fetch_array($result_pending)){
                                                        $count++;
                                                ?>
                                                    <tr>
                                                        <td><?php echo $count; ?></td>
                                                        <td><?php echo $row_pending['appoint_no']; ?></td>
                                                        <td><?php echo date('F d,Y h:ia',strtotime($row_pending['appoint_date'].' '.$row_pending['appoint_time'])); ?></td>
                                                        <td><?php echo $row_pending['customer_name']; ?></td>
                                                        <td><?php echo $row_pending['petname']; ?></td>
                                                        <td><?php echo $row_pending['service']; ?></td>
                                                        <td class="col-2">
                                                            <a class="btn btn-sm btn-info approved" data-id="<?php echo $row_pending['id']; ?>"><span class="fa fa-thumbs-o-up" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Approve"></span></a> 
                                                            <a class="btn btn-sm btn-danger cancel" data-id="<?php echo $row_pending['id']; ?>"><span class="fs-5 fa fa-times" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Cancel"></span></a>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                                        <div class="table-responsive mt-4">
                                            <table id="approve" class="table table-hover table-bordered" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Ref. No.</th>
                                                        <th>Date Schedule</th>
                                                        <th>Customer Name</th>
                                                        <th>Pet Name</th>
                                                        <th>Service</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>
                                                <?php
                                                    $query_approved = "SELECT c.*,CONCAT(u.first_name,' ',u.middle_name,' ',u.last_name,' ',u.suffix) AS customer_name FROM client_appointment c LEFT JOIN usertable u ON u.id = c.user_id WHERE c.status='approved' AND u.id is not null"; 
                                                    $result_approved = mysqli_query($con, $query_approved);  
                                                    $count1 = 0;
                                                    while($row_approved =  mysqli_fetch_array($result_approved)){
                                                        $count1++;
                                                ?>
                                                    <tr>
                                                        <td><?php echo $count1; ?></td>
                                                        <td><?php echo $row_approved['appoint_no']; ?></td>
                                                        <td><?php echo date('F d,Y h:ia',strtotime($row_approved['appoint_date'].' '.$row_approved['appoint_time'])); ?></td>
                                                        <td><?php echo $row_approved['customer_name']; ?></td>
                                                        <td><?php echo $row_approved['petname']; ?></td>
                                                        <td><?php echo $row_approved['service']; ?></td>
                                                        <td>
                                                            <a class="btn btn-sm btn-success serve" data-id="<?php echo $row_approved['id']; ?>"><span class="fa fa-check" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Served"></span></a> 
                                                            <a class="btn btn-sm btn-danger cancel" data-id="<?php echo $row_approved['id']; ?>"><span class="fs-5 fa fa-times" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Cancel"></span></a>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                                        <!-- <div class="table-responsive mt-4"> -->
                                            <table id="serve" class="table table-hover table-bordered" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Ref. No.</th>
                                                        <th>Date Schedule</th>
                                                        <th>Customer Name</th>
                                                        <th>Pet Name</th>
                                                        <th>Service</th>
                                                    </tr>
                                                </thead>
                                                <?php
                                                    $query_serve = "SELECT c.*,CONCAT(u.first_name,' ',u.middle_name,' ',u.last_name,' ',u.suffix) AS customer_name FROM client_appointment c LEFT JOIN usertable u ON u.id = c.user_id WHERE c.status='served' AND u.id is not null"; 
                                                    $result_serve = mysqli_query($con, $query_serve);  
                                                    $count2 = 0;
                                                    while($row_serve =  mysqli_fetch_array($result_serve)){
                                                        $count2++;
                                                ?>
                                                    <tr>
                                                        <td><?php echo $count2; ?></td>
                                                        <td><?php echo $row_serve['appoint_no']; ?></td>
                                                        <td><?php echo date('F d,Y h:ia',strtotime($row_serve['appoint_date'].' '.$row_serve['appoint_time'])); ?></td>
                                                        <td><?php echo $row_serve['customer_name']; ?></td>
                                                        <td><?php echo $row_serve['petname']; ?></td>
                                                        <td><?php echo $row_serve['service']; ?></td>
                                                    </tr>
                                                <?php } ?>
                                            </table>
                                        <!-- </div> -->
                                    </div>
                                    <div class="tab-pane fade" id="cancelled-contact" role="tabpanel" aria-labelledby="cancelled-contact-tab">
                                        <div class="table-responsive mt-4">
                                            <table id="cancel" class="table table-hover table-bordered" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Ref. No.</th>
                                                        <th>Date Schedule</th>
                                                        <th>Customer Name</th>
                                                        <th>Pet Name</th>
                                                        <th>Service</th>
                                                    </tr>
                                                </thead>
                                                <?php
                                                    $query_cancelled = "SELECT c.*,CONCAT(u.first_name,' ',u.middle_name,' ',u.last_name,' ',u.suffix) AS customer_name FROM client_appointment c LEFT JOIN usertable u ON u.id = c.user_id WHERE c.status='cancelled' AND u.id is not null"; 
                                                    $result_cancelled = mysqli_query($con, $query_cancelled);  
                                                    $count3 = 0;
                                                    while($row_cancelled =  mysqli_fetch_array($result_cancelled)){
                                                        $count3++;
                                                ?>
                                                    <tr>
                                                        <td><?php echo $count3; ?></td>
                                                        <td><?php echo $row_cancelled['appoint_no']; ?></td>
                                                        <td><?php echo date('F d,Y h:ia',strtotime($row_cancelled['appoint_date'].' '.$row_cancelled['appoint_time'])); ?></td>
                                                        <td><?php echo $row_cancelled['customer_name']; ?></td>
                                                        <td><?php echo $row_cancelled['petname']; ?></td>
                                                        <td><?php echo $row_cancelled['service']; ?></td>
                                                    </tr>
                                                <?php } ?>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                    <div class="card shadow">
                <div class="card-body">
                <div id='calendar'></div>
                </div>
             </div>
                    </div>
            </div>
       </div>
       <!-- ====================================================================================================== -->
     
        <?php
            // if(isset($_POST['approved_submit'])){
            //     $id = $_POST['id'];

            //     $approved_query = "UPDATE client_appointment SET `status`='approved' WHERE id='$id'";
            //     $run_approved = mysqli_query($con, $approved_query);
            //     if($run_approved){
            //         echo "<script>window.open('appointment_list.php','_self');</script>";
            //     }
            // }
            // if(isset($_POST['cancel_submit'])){
            //     $id = $_POST['id'];

            //     $approved_query = "UPDATE client_appointment SET `status`='cancelled' WHERE id='$id'";
            //     $run_approved = mysqli_query($con, $approved_query);
            //     if($run_approved){
            //         echo "<script>window.open('appointment_list.php','_self');</script>";
            //     }
            // }
            if(isset($_POST['serve_submit'])){
                $id = $_POST['id'];

                $serve_query = "UPDATE client_appointment SET `status`='served' WHERE id='$id'";
                $run_serve = mysqli_query($con, $serve_query);
                if($run_serve){
                    echo "<script>window.open('appointment_list.php','_self');</script>";
                }
            }
            
        ?>
       <!-- ====================================================================================================== -->


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">
    </script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="fullcalendar/core.min.js"></script>
            <script src="fullcalendar/daygrid.min.js"></script>
            <script src="fullcalendar/timegrid.min.js"></script>
            <script src="fullcalendar/list.min.js"></script>
    <script>
         $(function () {
                    $.post("reservation_list_all.php",function(data){
                        var reservation = JSON.parse(data);
                        let calendar = [];
                        let calendarEl = document.getElementById('calendar');
                        calendar = new FullCalendar.Calendar(calendarEl, {
                            plugins: [ 'interaction','dayGrid','timeGrid', 'list' ],
                            'themeSystem': 'bootstrap',
                            editable:true,
                            header: {
                                left: 'prevYear,prev,next,nextYear today',
                                center: 'title',
                                right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
                            },
                            events:reservation,
                            selectable:true,
                            selectHelper:true,
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
                                $.post("appointment_details_all.php",{id:reserve_id},function(data){
                                    $('#details-content').html(data);
                                    $('#appointment-details').modal('show');
                                });
                            }
                            
                        });
                        calendar.render();
                    });
                });
        $(document).ready(function() {
            $('#list-appointment-menu').addClass('bg-primary');
            $(document).on('click','.approved',function(){
                var id = $(this).data('id');

                Swal.fire({
                title: 'Do you want to approve this appointment?',
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
                        $.post("appointment_list.php",{approved_submit:'approved_submit',id:id},function(data){
                            location.reload();
                        });
                        location.reload();
                    } else if (result.isDenied) {
                        Swal.fire('Record is not approved', '', 'info')
                    }
                })
            });
            $(document).on('click','.cancel',function(){
                var id = $(this).data('id');
                Swal.fire({
                title: 'Do you want to cancel this appointment?',
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
                        $.post("appointment_list.php",{cancel_submit:'cancel_submit',id:id},function(data){
                            location.reload();
                        });
                        location.reload();
                    } else if (result.isDenied) {
                        Swal.fire('Record is not cancelled', '', 'info')
                    }
                })
                
            });
            $(document).on('click','.serve',function(){
                var id = $(this).data('id');
                Swal.fire({
                    title: 'Do you want to serve this appointment?',
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
                        $.post("appointment_list.php",{serve_submit:'serve_submit',id:id},function(data){
                            location.reload();
                        });
                        location.reload();
                    } else if (result.isDenied) {
                        Swal.fire('Record is not SERVED', '', 'info')
                    }
                })
                
            });
            
        });
    </script>

<script>
// Initialize tooltips
var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
  return new bootstrap.Tooltip(tooltipTriggerEl)
})
</script>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>

        <script>
        $(document).ready(function() {
            $('#pending').DataTable();
        });
        </script>
        <script>
        $(document).ready(function() {
            $('#approve').DataTable();
        });
        </script>
        <script>
        $(document).ready(function() {
            $('#serve').DataTable();
        });
        </script>
        <script>
        $(document).ready(function() {
            $('#cancel').DataTable();
        });
        </script>
        </body>

</body>

</html>