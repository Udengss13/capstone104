<?php 
    require('php/connection.php'); 
    session_start();
    $user_id = $_SESSION['user_id'];

    $querymenu = "SELECT * FROM client_appointment WHERE `user_id`='$user_id'"; 
    $resultmenu = mysqli_query($con, $querymenu);  
    $data = array();
    while($reserve = mysqli_fetch_assoc($resultmenu)){
        if($reserve['status']=='served'){
            $color = '#00d27a';
        }elseif($reserve['status']=='pending'){
            $color = '#f5803e';
        }elseif($reserve['status']=='approved'){
            $color = '#27bcfd';
        }else{
            $color = '#e63757';
        }
        $reserve_array = array(
            'start'=>date('Y-m-d H:i',strtotime($reserve['appoint_date'].' '.$reserve['appoint_time'])),
            'title'=>$reserve['service'].' - '.$reserve['petname'],
            'color'=>$color,
            'id'=>$reserve['id']
        );
        array_push($data,$reserve_array);
    }
    echo json_encode($data);
?>