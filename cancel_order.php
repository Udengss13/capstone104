<?php 
  require('php/connection.php');
  $id = $_POST['id'];
  $serve_query = "UPDATE `order` SET order_status='cancelled' WHERE id='$id'";
  $run_serve = mysqli_query($con, $serve_query);
  if($run_serve){
     
  }
?>