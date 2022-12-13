<?php 

    require('php/connection.php'); 
    $employ = $_POST['employ'];
    $querymenu = "SELECT first_name, employee_id, last_name, day FROM available_appointment INNER JOIN usertable
    ON available_appointment.employee_id = usertable.id
    WHERE usertable.id= '$employ' and `employee_id`='$employ'"; 
    $resultmenu = mysqli_query($con, $querymenu);  

    // SELECT first_name, employee_id, last_name FROM available_appointment INNER JOIN usertable
    //                                     ON available_appointment.employee_id = usertable.id
    //                                     WHERE usertable.id= employee_id

    $result = $resultmenu->fetch_array();

    if($result){
        $decode = json_decode($result['day'],true);
    
        $appoint_date = date('l',strtotime($_POST['appointdate']));
        if(in_array($appoint_date, $decode)){
            echo 1;
        }else{
            echo $result['first_name'].' '.$result['last_name'].' only available on '.$result['day'];
        }
    }else{
        echo 1;
    }
    
?>

