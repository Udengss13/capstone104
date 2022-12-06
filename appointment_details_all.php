<?php 
require('php/connection.php'); 
$id = $_POST['id'];
$querymenu = "SELECT * FROM client_appointment WHERE `id`='$id'"; 
$resultmenu = mysqli_query($con, $querymenu);  
$result = $resultmenu->fetch_array();

?>

<div class="form-group">
    <b>Appointment No. </b> <?php echo $result['appoint_no']; ?>  <br class="m-0">
    <b>Client Email : </b>  <?php echo $result['email']; ?> <br class="m-0">
    <b>Pet Name : </b>  <?php echo $result['petname']; ?> <br class="m-0">
    <b>Appointment Schedule : </b> <?php echo date('F d,Y h:ia',strtotime($result['appoint_date'].' '.$result['appoint_time'])); ?> <br class="m-0">
    <b>Status : </b> <?php echo $result['status']; ?> <br class="m-0">

   

</div>
