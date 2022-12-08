<?php
    require_once "php/user-list-process.php";
    require('php/connection.php');
    require('layouts/header_admin.php');

   

    
    $queryimage = "SELECT * FROM admin_quicktips"; //You don't need a like you do in SQL;
    $resultimage = mysqli_query($con, $queryimage);

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
<script src="https://kit.fontawesome.com/f8f3c8a43b.js" crossorigin="anonymous"></script>
<link rel="stylesheet" href="fullcalendar/core.min.css">
<link rel="stylesheet" href="fullcalendar/daygrid.min.css">
<link rel="stylesheet" href="fullcalendar/timegrid.min.css">
<link rel="stylesheet" href="fullcalendar/list.min.css">

<!-- tables -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css">

<title>Admin || Dashboard</title>





<div class="col py-3 mt-5 p-5">
    <div class="row">
        <div class="col-md-3">
            <?php 
                            $querysales = "SELECT 
                            product_price*qty  AS total_price
                            FROM order_list 
                            LEFT JOIN `order` ON order.id=order_list.order_id
                            LEFT JOIN admin_menu ON admin_menu.Menu_id = order_list.product_id
                            WHERE 
                            order.order_status = 'pickedup' AND 
                            product_price > 0 AND
                            admin_menu.Menu_name IS NOT NULL"; 
                            $resultsales = mysqli_query($con, $querysales);  

                            $total_sales = 0;
                            $order_count = 0;
                            while($rowsales =  mysqli_fetch_array($resultsales)){ 
                                $total_sales = $total_sales+floatval($rowsales['total_price']);
                                $order_count = $order_count + 1;
                            }

                            $querycustomer_count = "SELECT 
                                                        CONCAT(first_name,' ',middle_name,' ',last_name,' ',suffix) AS fullname,email,contact
                                                        FROM usertable
                                                        WHERE 
                                                        `status`='verified' AND user_level='client'"; 
                            $resultcustomer_count = mysqli_query($con, $querycustomer_count);  
                            $customer_count = 0;
                            while($rowcustomer_count =  mysqli_fetch_array($resultcustomer_count)){
                                $customer_count = $customer_count + 1;
                            }

                            $appointment_count = 0;
                            $queryappoint = "SELECT c.*,CONCAT(u.first_name,' ',u.middle_name,' ',u.last_name,' ',u.suffix) AS customer_name FROM client_appointment c LEFT JOIN usertable u ON u.id = c.user_id WHERE c.status='approved' AND u.id is not null";
                            $resultcappoint = mysqli_query($con, $queryappoint);  
                            while($rowcapp =  mysqli_fetch_array($resultcappoint)){
                                $appointment_count = $appointment_count + 1;
                            }

                        ?>
            <div class="card shadow">
                <div align="left" class="p-3">
                    <h3 class="text-dark"><b class=" text-success">₱</b> Total Sales</h3>
                </div>
                <div align="right" class="p-3">
                    <h1>Php <?php echo number_format($total_sales,2); ?></h1>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow">
                <a href="view-totalsales.php" class="text-decoration-none">
                    <div align="left" class="p-3">
                        <h3 class="text-dark"><b class="fa fa-shopping-cart text-info"></b> Orders</h3>
                    </div>
                    <div align="right" class="p-3">
                        <h1><?php echo $order_count; ?></h1>
                    </div>
            </div></a>
        </div>
        <div class="col-md-3">
            <div class="card shadow">
                <a href="view-customerlist.php" class="text-decoration-none">
                    <div align="left" class="p-3">
                        <h3 class="text-dark"><b class="fa fa-users text-primary"></b> Active Users</h3>
                    </div>
                    <div align="right" class="p-3">
                        <h1><?php echo $customer_count; ?></h1>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow">
                <a href="view-appointment.php" class="text-decoration-none">
                    <div align="left" class="p-3">
                        <h3 class="text-dark"><b class="fa fa-calendar text-danger"></b> Appointments</h3>
                    </div>
                    <div align="right" class="p-3">
                        <h1><?php echo $appointment_count; ?></h1>
                    </div>
            </div>
            </a>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header ">
                    <h3 class="text-dark">Expired Products</h3>
                </div>
                <div class="card-body">
                    <?php 
                                    $querymenu = "SELECT s.id,s.expiration,a.Menu_name,s.alert_expire,s.settled FROM stock_management s 
                                                    LEFT JOIN admin_menu a
                                                    ON a.Menu_id = s.product_id
                                                    WHERE DATE(s.alert_expire)<NOW() AND s.settled=0"; 
                                    $resultmenu = mysqli_query($con, $querymenu);  

                                    
                                ?>
                    <button type="button" class="btn btn-primary mb-3"
                        onclick="PrintElem('product-content','Expired Products')"><span class="fa fa-print"></span>
                        Print</button>
                    <div class="table-responsive" id="product-content">
                        <table id="expired" class="table table-bordered table table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Product</th>
                                    <th>Expiration Date</th>
                                    <th>Settled</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                <?php   
                                
                                $count = 0; while($rowmenu =  mysqli_fetch_array($resultmenu)){  $count++;?>
                                <tr>
                                    <?php
                                    $date =date("Y/m/d");
                                    if($rowmenu['expiration'] < strtotime($date) ){?>
                                    <td align="center" class="text-light bg-danger"><?php echo $count; ?></td>
                                    <td><?php echo $rowmenu['Menu_name']; ?></td>
                                    <td><?php echo date('F d,Y',strtotime($rowmenu['expiration'])); ?></td>
                                    <td align="center"><input type="checkbox" class="settle"
                                            data-id="<?php echo $rowmenu['id']; ?>" /></td>
                                    <?php }
                                            

                                    
                                    else{?>
                                    <td align="center" class="text-light bg-danger"><?php echo $count; ?></td>
                                    <td><?php echo $rowmenu['Menu_name']; ?></td>
                                    <td><?php echo date('F d,Y',strtotime($rowmenu['expiration'])); ?></td>
                                    <td align="center"><input type="checkbox" class="settle"
                                            data-id="<?php echo $rowmenu['id']; ?>" /></td>
                                    <?php }?>

                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>


                </div>
            </div>

        </div>
        <div class="col-md-6">

            <div class="card shadow">
                <div class="card-header ">
                    <h3 class="text-dark">Products</h3>
                </div>
                <div class="card-body">
                    <?php 
                                    $querymenus = "SELECT * FROM admin_menu "; 
                                    $resultmenus = mysqli_query($con, $querymenus);  
                                ?>

                    <div class="table-responsive" id="product-content">
                        <table id="products" class="table table-bordered table table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Product</th>
                                    <th>Stock In</th>
                                    <th>Stock Out</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $count2 = 0; while($rowmenu =  mysqli_fetch_array($resultmenus)){  $count2++;?>
                                <tr>
                                    <td align="center"><?php echo $count2; ?></td>
                                    <td><?php echo $rowmenu['Menu_name']; ?></td>
                                    <td align="center"><?php echo $rowmenu['stock_in']; ?></td>
                                    <td align="center"><?php echo $rowmenu['stock_out']; ?></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 mt-4">
            <div class="card shadow">
                <div class="card-header ">
                    <h3 class="text-dark">Appointments</h3>
                </div>
                <div class="card-body">
                    <div id='calendar'></div>
                </div>
            </div>
        </div>

    </div>
</div>
<?php 
                if(isset($_POST['change_settle'])){
                    $id = $_POST['id'];
                    $status = $_POST['status'];
                    $querymenu = "UPDATE stock_management SET settled='$status' WHERE id = '$id'"; 
                    $resultmenu = mysqli_query($con, $querymenu);   
                }
            ?>
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
<!--DIVISION -->


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous">
</script>
<script src="/js/script.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="fullcalendar/core.min.js"></script>
<script src="fullcalendar/daygrid.min.js"></script>
<script src="fullcalendar/timegrid.min.js"></script>
<script src="fullcalendar/list.min.js"></script>
<script>
$(function() {
    $.post("reservation_list_all.php", function(data) {
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
                $.post("appointment_details_all.php", {
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

function PrintElem(elem, title) {
    var mywindow = window.open('', 'PRINT', 'height=1000,width=1920');

    mywindow.document.write('<html><head><title>' + document.title + '</title>');
    mywindow.document.write('</head><body ><style>' +
        'table, td, th {' +
        'border: 1px solid;' +
        '}' +
        'table {' +
        'width: 100%;' +
        'border-collapse: collapse;' +
        '}' +
        '</style>');
    mywindow.document.write('<h1>' + title + '</h1>');
    mywindow.document.write(document.getElementById(elem).innerHTML);
    mywindow.document.write('</body></html>');

    mywindow.document.close(); // necessary for IE >= 10
    mywindow.focus(); // necessary for IE >= 10*/

    mywindow.print();
    mywindow.close();

    return true;
}
$(document).ready(function(index) {
    $(document).on('click', '.settle', function() {
        var id = $(this).data('id');
        if ($(this).is(':checked')) {
            $.post("admin-dashboards.php", {
                id: id,
                status: 1,
                change_settle: 'change_settle'
            }, function(data) {
                location.reload();
            });
        } else {
            $.post("admin-dashboards.php", {
                id: id,
                status: 0,
                change_settle: 'change_settle'
            }, function(data) {
                location.reload();
            });
        }
    });
});
</script>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>

<script>
$(document).ready(function() {
    $('#expired').DataTable();
});
</script>
<script>
$(document).ready(function() {
    $('#products').DataTable();
});
</script>
</body>

</html>