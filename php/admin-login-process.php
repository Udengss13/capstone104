<?php
   require('connection.php');
   
   $errors = array();
   if(isset($_POST['admin-login'])) {
 
      // username and password sent from form 
      $username = mysqli_real_escape_string($db_admin_account, $_POST['username']);
      $password = mysqli_real_escape_string($db_admin_account, $_POST['password']);
      
      $sql = "SELECT * FROM admin_login WHERE Username = '$username' and Password = '$password'";
      $result = mysqli_query($db_admin_account,$sql);
      // $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      
      // $count = mysqli_num_rows($result);
       
      // If result matched $myusername and $mypassword, table row must be 1 row
      if(mysqli_num_rows($result) > 0) {
         $fetch = mysqli_fetch_assoc($result);
         
         $_SESSION['admin_id']= $fetch['id'];
         header("location: ../admin-dashboards.php");
      }
      else{
         echo '<script> alert("username and password does not match");
        window.location.href="../admin-login.php";
        </script>'; 
         // header("location: ../admin-login.php");
      }
   }
 
?>