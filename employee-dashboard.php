<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin|| Dashboard</title>
    <!-- MATERIAL CDN -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Icons+Sharp"
      rel="stylesheet">
    <!-- Stylesheets -->
    <link rel="stylesheet" href="./adminstyles.css">
</head>

<body>
    <div class="container">
        <aside>
            <div class="top">
             <div class="logo">
                <img src="asset/logopet.png">
                <h2>PETCo.<span class="danger">EMPLOYEE</span></h2>
             </div>
             <div class="close" id="close-btn">
                <span class="material-icons-sharp">close</span>
             </div>
            </div>
            <div class="sidebar">
                <a href="#">
                    <span class="material-icons-sharp">grid_view</span>
                    <h3>Home</h3>
                </a>
                <a href="admin-user-accounts.php">
                    <span class="material-icons-sharp">person</span>
                    <h3>Products</h3>
                </a>
                <a href="admin-orders.php">
                    <span class="material-icons-sharp">receipt_long</span>
                    <h3>Appointment</h3>
                </a>
                <a href="#">
                    <span class="material-icons-sharp">insights</span>
                    <h3>Available Appointment</h3>
                </a>     
                <a href="#">
                    <span class="material-icons-sharp">mail_outline</span>
                    <h3>Messages</h3>
                    <span class="message-count">26</span>
                </a>
               
                <a href="#">
                    <span class="material-icons-sharp">report_gmailerrorred</span>
                    <h3>About Us</h3>
                </a>
                
                <a href="admin-login.php">
                    <span class="material-icons-sharp">logout</span>
                    <h3>Logout</h3>
                </a>
            </div>
        </aside>

           
            
            <div class="right">
                <div class="top">
                    <button id="menu-btn">
                        <span class="material-icons-sharp">menu</span>
                    </button>
                    <div class="theme-toggler">
                        <span class="material-icons-sharp active">light_mode</span>
                        <span class="material-icons-sharp">dark_mode</span>
                    </div>
                    <div class="profile">
                        <div class="info">
                            <p>Hey, <b>Charlize</b></p>
                            <small class="text-muted">Employee</small>
                        </div>
                        <div class="profile-photo">
                            <img src="./asset/user2.jpg">
                        </div>
                    </div>
                </div>
               

    <script src="./orders.js"></script>
    <script src="./admin-dashboard.js"></script>
</body>

</html>