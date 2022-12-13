<?php 
session_start();
require('php/connection.php'); 
$id = $_POST['id'];
$querymenu = "SELECT * FROM client_appointment inner join usertable on client_appointment.employee_id=usertable.id WHERE client_appointment.id='$id'"; 
$resultmenu = mysqli_query($con, $querymenu);  
$result = $resultmenu->fetch_array();

$query= "SELECT * FROM client_appointment where `id`='$id'"; 
$resultsquery= mysqli_query($con, $query);  
$resultsnew = $resultsquery->fetch_array();

// SELECT * FROM order_list o inner join admin_menu p on menu_id = product_id
?>

<div class="form-group">
    <h3> <?php echo $result['appoint_no']; ?> </h3> 
    <b>Employee Name : </b> <?php echo $result['first_name'].' '.$result['last_name']; ?> <br class="m-0">
    <b>Pet Name : </b> <?php echo $result['petname']; ?> <br class="m-0">
    <b>Appointment Schedule : </b> <?php echo date('F d,Y h:ia',strtotime($result['appoint_date'].' '.$result['appoint_time'])); ?> <br class="m-0">
    <b>Status : </b> <?php echo $resultsnew['status']; ?> <br class="m-0">

   

</div>
<?php if($resultsnew['status']=='pending'||$resultsnew['status']=='approved'){ ?>
    <hr>
<div class="form-group" align="center">
<form action="appointment-user.php" method="post" >
    <input name="appoint-id" type="hidden" value="<?php echo $resultsnew['id']; ?>"/>

   
    <button type="submit" class="btn btn-danger btn-block" name="deleteAppointment">Cancel Appointment</button>

</form>
</div>
<?php } ?>