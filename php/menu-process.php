<?php
    require("connection.php");
    session_start();
    if(isset($_POST['news'])){
        $title = $_POST['title'];
        $paragraph = $_POST['description'];
        $paragraph = nl2br($paragraph);      
        $safe_input = mysqli_real_escape_string($con,$paragraph);

        $subinfo = $_POST['subinfo'];
        $subinfo = nl2br($subinfo);
        $sub_input = mysqli_real_escape_string($con,$subinfo);

        $price = $_POST['price'];
        $category_name = $_POST['category_name'];
       
      
        $filenamedir = "../asset/menu/".$_FILES["photo"]["name"];
        $filename = $_FILES["photo"]["name"];

        // move file to a folder
        if(move_uploaded_file($_FILES["photo"]["tmp_name"], $filenamedir))
        {
            $sql = "INSERT INTO admin_menu (Menu_name, subinfo, Menu_description, Menu_price, Menu_category,  Menu_dir, Menu_filename) 
            VALUES('$title','$sub_input', '$safe_input', '$price', '$category_name', '$filenamedir', '$filename')";
            mysqli_query($con,$sql);    
            $_SESSION['success'] = 1;
            $_SESSION['message'] = 'Product Successfully Added!';        
            echo '<script> alert("Product Added Successfully");
                    window.location.href="../employee-menu.php";
                    </script>'; 
        
            
        }
        else
        {
            header("location: ../employee-menu.php");
        }
    }

    //For deleting menu by ID
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $querymenu = "SELECT * FROM admin_menu WHERE Menu_id=$id"; 
        $resultmenu = mysqli_query($con, $querymenu);
        $rowmenu =  mysqli_fetch_array($resultmenu);

        $filedir = $rowmenu['Menu_dir'];

        $sqldelete = "DELETE FROM admin_menu WHERE Menu_id=$id";
        $resultdelete = mysqli_query($con, $sqldelete);
        unlink($filedir);
        echo '<script> alert("Product Deleted Succesfully");
        window.location.href="../employee-menu.php";
        </script>'; 
    }

 //For deleting quicktips by ID
    if(isset($_POST['delete_submit'])){
        $id = $_POST['id'];
        $del_query = "DELETE FROM quicktips WHERE id = '$id'";
        $result = mysqli_query($con, $del_query);

        // echo '<script> alert("Product Deleted Succesfully");
        // window.location.href=" quicktips_content.php";
        // </script>'; 
       
    } 

    
?>