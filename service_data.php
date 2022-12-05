<?php 
    require('php/connection.php');
    $id = $_POST['id'];
    $query = mysqli_query($con,"SELECT * FROM `service`  WHERE service_id = $id") or die ('query failed');
    $seQuery = mysqli_fetch_array($query);
    echo json_encode($seQuery);
?>