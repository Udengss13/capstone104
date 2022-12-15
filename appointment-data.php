<?php 
    require('php/connection.php');
    $id = $_POST['employee'];
    $query = mysqli_query($con,"SELECT * FROM `available_appointment`  WHERE id = $id") or die ('query failed');
    $seQuery = mysqli_fetch_array($query);
    echo json_encode($seQuery);
?>