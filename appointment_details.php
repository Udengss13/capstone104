<?php 
session_start();
require('php/connection.php'); 
$id = $_POST['id'];
$querymenu = "SELECT * FROM client_appointment WHERE `id`='$id'"; 
$resultmenu = mysqli_query($con, $querymenu);  
$result = $resultmenu->fetch_array();

?>

<div class="form-group">
    <h3> <?php echo $result['appoint_no']; ?> </h3> 
    <b>Pet Name : </b> <?php echo $result['petname']; ?> <br class="m-0">
    <b>Appointment Schedule : </b> <?php echo date('F d,Y h:ia',strtotime($result['appoint_date'].' '.$result['appoint_time'])); ?> <br class="m-0">
    <b>Status : </b> <?php echo $result['status']; ?> <br class="m-0">

   

</div>
<?php if($result['status']=='pending'||$result['status']=='approved'){ ?>
    <hr>
<div class="form-group" align="center">
<form action="appointment-user.php" method="post" >
    <input name="appoint-id" type="hidden" value="<?php echo $result['id']; ?>"/>

   
    <button type="submit" class="btn btn-danger btn-block" name="deleteAppointment">Cancel Appointment</button>

</form>
</div>
<?php } ?>