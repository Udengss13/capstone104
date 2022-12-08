<?php 
require('layouts/header_admin.php');
require_once "php/user-list-process.php";
require('php/connection.php');
require_once "controllerAdmin.php";
    
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <title>Admin|| add Client</title>
    <link rel="icon" href="asset/logopet.png" type="image/x-icon">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/admin.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/f8f3c8a43b.js" crossorigin="anonymous"></script>
    <!-- tables -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css">


    <div class="col py-3 mt-5 mb-5 rounded-3">
        <div class="form-groups  ">
            <a href=""><i class="fa-solid fa-circle-x"></i><a>
        </div>
        <h2 class="text-center text-white">Create Employee Account </h2>
        <p class="text-center text-white">It's quick and easy to Petko.</p>

        <form action="adminAddEmployee.php" method="POST" autocomplete="" enctype="multipart/form-data">

            <!--Message Alert-->
            <?php if(count($errors) == 1){ ?>
            <div class="alert alert-danger text-center">
                <?php
                            foreach($errors as $showerror){
                            echo $showerror;
                            }
                        ?>
            </div>
            <?php
                        }
                        elseif(count($errors) > 1){
                        ?>
            <div class="alert alert-danger">
                <?php
                        foreach($errors as $showerror){
                        ?><ul>
                    <li><?php echo $showerror; ?></li>
                </ul>
                <?php
                        }
                        ?>
            </div>
            <?php
                                }
                                ?>


            <div class="container ">
                <!--1st row-->
                <div class="row ">
                    <div class="col-6">
                        <!--FName-->
                        <div class="form-floating mt-3">
                            <input class="form-control mb-2" type="text" name="firstname" placeholder="First Name"
                                required value="<?php echo $fname ?>" id="floatingFirst" autocomplete="off">
                            <label for="floatingFirst">First Name</label>
                        </div>

                        <!--MName-->
                        <div class="form-floating mb-2">
                            <input class="form-control" type="text" name="middle_name" placeholder="Middle Name"
                                required value="<?php echo $mname ?>" id="floatingMiddle" autocomplete="off">
                            <label for="floatingMiddle">Middle Name</label>
                        </div>

                        <!--LName-->
                        <div class="form-floating">
                            <input class="form-control mb-2" type="text" name="last_name" placeholder="Last Name"
                                required value="<?php echo $lname ?>" id="floatingLast" autocomplete="off">
                            <label for="floatingLast">Last Name</label>
                        </div>

                        <!--Suffix-->
                        <div class="form-floating mb-2">
                            <input class="form-control" type="text" name="suffix" placeholder="Suffix"
                                value="<?php echo $suffix ?>" id="floatingSuffix" autocomplete="off">
                            <label for="floatingSuffix">Suffix</label>
                        </div>

                        <div class="form-floating mb-2">
                        <input class="form-control" type="number" name="contact" value="<?php echo $contact ?>"
                                placeholder="e.g. 639832456922" min="09123456789" id="floatingSuffix" autocomplete="off"
                                required>

                            <label for="floatingSuffix">Contact No (e.g. 09832456922)</label>
                        </div>

                        <div class="form-group">
                            <!-- <label for="exampleFormControlSelect1">Position</label> -->
                            <select class="form-control" id="exampleFormControlSelect1" name="position"
                                value="<?php echo $position ?>" required>
                                <option value="" disabled selected> Select Position ▼ </option>
                                <option value="veterinarian">Veterinarian</option>
                                <option value="receptionist">Receptionist</option>
                            </select>
                        </div>

                    </div>

                    <!--2nd Column-->
                    <div class="col-6 mt-3">
                        <!-- ID Number -->

                        <!--Email-->
                        <div class="form-floating mb-2">
                            <input class="form-control" type="email" name="email" placeholder="Email Address" required
                                value="<?php echo $email ?>" id="floatingEmail" autocomplete="off">
                            <label for="floatingEmail">Email</label>
                        </div>

                        <!--Address-->
                        <div class="form-floating mb-2">
                            <input class="form-control" type="text" name="address" placeholder="Address" required
                                value="<?php echo $address ?>" id="floatingAddress" autocomplete="off">
                            <label for="floatingAddress">Complete Address</label>
                        </div>

                        <!--Password-->
                        <div class="form-floating mb-2">
                            <input class="form-control" type="password" name="password" placeholder="Password" required
                                id="floatingPass">
                            <label for="floatingPassword">Password</label>
                        </div>

                        <!--Confirm Password-->
                        <div class="form-floating">
                            <input class="form-control" type="password" name="cpassword" placeholder="Confirm password"
                                required id="floatingConfirm">
                            <label for="floatingConfirm">Confirm Password</label>
                        </div>
                        <div class="form-floating mb-2">
                            <div class="row">
                                <label for="floatingSuffix " class="col-4  p-2 rounded">Choose Profile
                                    picture:</label>
                                <input type="file" id="upload-news" class="col" value="<?php echo $file ?>" name="photo"
                                    required>

                            </div>
                        </div>
                    </div>
                    <!--end of row-->
                </div>


                <div class="form-group mt-4 text-center">
                    <input class="form-control btn  " style="background-color: #EA6D52; width: 20%" type="submit"
                        name="signup_emp" value="Create">
                    <a href="admin-user-accounts.php" class="btn btn-success text-light"
                        onclick="return confirm('Are you sure you want to cancel it?')">Cancel</a>
                </div>

        </form>
    </div>
    </div>
    </div>


    </body>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">
    </script>

</html>