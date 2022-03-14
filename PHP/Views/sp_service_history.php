<?php
  session_start();
      if(isset($_SESSION['name'])){
          $name = $_SESSION['name'];
          $userid = $_SESSION['id'];
      } else{
           $base_url = "http://localhost/Helperland/";
           header('Location:' . $base_url);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Service Provider - Upcoming Services</title>

    <link rel="stylesheet" href="./assets/css/upcoming_service.css">

    <link rel="stylesheet" href="./assets/css/bootstrap.min.css">

    <link rel="stylesheet" href="./assets/css/all.min.css">

    <!-- js Files -->

    <script src="./assets/js/jquery.min.js"></script>
    <script src="./assets/js/poper.min.js"></script>
    <script src="./assets/js/bootstrap.min.js"></script>
    <script src="./assets/js/all.min.js"></script>

</head>
<?php 
 
   include("./includes/sp-ajax/service-history-ajax.php");

?>

<body>
    <!-- navbar -->
    <div class="wrapper">
        <div class="rectangle1">
            <nav class="navbar">
                <div class="logo">
                    <a href="home.php"><img src="./assets/image/logo-small.png" alt="logo"></a>
                </div>    
                <input type="checkbox" id="click">
                <label for="click" class="menu-btn">
                    <i class="fas fa-bars"></i>
                </label> 
                <ul class="menu">
                    <li><a href="#" class="two"> Prices & Services</a></li>
                    <li><a href="#" class="three">Warranty</a></li>
                    <li><a href="#" class="three">Blog</a></li>
                    <li><a href="#" class="three">Contact</a></li>
                    <li>
                        <div class="box">&nbsp;&nbsp;&nbsp;&nbsp;
                            <img src="./assets/image/icon-notification.png" alt="notification" class="four">
                            &nbsp;&nbsp;&nbsp;&nbsp;
                        </div>
                    </li>
                    <li>
                    <a href="#" data-toggle="dropdown"><img src="./assets/image/user.png" alt="user" class="five"></a>
                        <div class="dropdown-menu bg-dark drop">
                            <a href="#" class="dropdown-item">Welcome <?php echo $name; ?></a>
                            <a href="#" class="dropdown-item">My Dashboard</a>
                            <a href="sp_setting.php" class="dropdown-item">MySettings</a>
                            <a href="http://localhost/Helperland/?controller=Helperland&function=logout" class="dropdown-item">Logout</a>
                            
                        </div>
                    </li>
                    <div class="v-nav">
                        <li><a class="nav-link" href="#">Dashboard</a></li>
                        <li><a class="nav-link" href="#">New Service Request</a></li>
                        <li><a class="nav-link  active" href="#">Upcoming Services</a></li>
                        <li><a class="nav-link" href="#">Service Schedule</a></li>
                        <li><a class="nav-link" href="#">Service History</a></li>
                        <li><a class="nav-link" href="#">My Rating</a></li>
                        <li><a class="nav-link" href="sp_block_customer.php">Block Customer</a></li>
                    </div>
                    
                </ul>
            </nav>
        </div>
        <div class="topic">
            <h1>Welcome, <span><?php echo $name; ?></span> </h1>
        </div>

        <!-- Table & Navbar Section -->
        <div class="row">
            <div class="offset-md-2 col-md-2 offset-sm-2 col-sm-2 col-2">
                <div class="card">
                    <div class="card-text">
                        <nav class="nav flex-column">
                            <a class="nav-link" href="#">Dashboard</a>
                            <a class="nav-link" href="sp_new_request.php">New Service Request</a>
                            <a class="nav-link" href="sp_upcoming_service.php">Upcoming Services</a>
                            <a class="nav-link" href="#">Service Schedule</a>
                            <a class="nav-link active" href="#">Service History</a>
                            <a class="nav-link" href="#">My Rating</a>
                            <a class="nav-link" href="sp_block_customer.php">Block Customer</a>
                          </nav>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-6 col-6">
                <table class="table">
                    <thead>
                        <th>Service ID <img src="./assets/image/sort.png" alt=""></th>
                        <th>Service date <img src="./assets/image/sort.png" alt=""></th>
                        <th>Customer details <img src="./assets/image/sort.png" alt=""></th>
                        
                    </thead>
                    <tbody id="table-details">
                        
                        
                    </tbody>
                </table>
                <div> Total Records: <span id="total-records">0</span></div>
            </div>
        </div>
        <!-- footer -->
        <div class="end">
            <div class="flex">
                <img src="./assets/image/footer-logo.png" alt="logo" class="logo">
                <span class="nav">
                    <span class="one">HOME</span>
                    <span class="two">ABOUT</span>
                    <span class="two">TESTIMONIALS</span>
                    <span class="two">FAQS</span>
                    <span class="two">INSURANCE POLICY</span>
                    <span class="two">IMPRESSUM</span>
                </span>
                <div class="media-icons">
                    <img src="./assets/image/ic-facebook.png" alt="facebook" class="facebook">
                    <img src="./assets/image/ic-instagram.png" alt="instagram" class="instagram">
                </div>
            </div>
            <hr>
            <span class="copy">&copy;2018 Helperland. All rights reserved. Terms and Conditions | Privacy Policy</span>
        </div>

    </div>




    
</body>

</html>


