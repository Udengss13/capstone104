<?php 

    require('php/connection.php'); 
    $service = $_POST['service'];
    $querymenu = "SELECT * FROM available_appointment WHERE `service`='$service'"; 
    $resultmenu = mysqli_query($con, $querymenu);  

    $result = $resultmenu->fetch_array();

    if($result){
        $decode = json_decode($result['day'],true);
    
        $appoint_date = date('l',strtotime($_POST['appointdate']));
        if(in_array($appoint_date, $decode)){
            echo 1;
        }else{
            echo $service.' only available on '.$result['day'];
        }
    }else{
        echo 1;
    }
    
?>

