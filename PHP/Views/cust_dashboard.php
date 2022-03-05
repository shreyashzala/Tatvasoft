<?php
  session_start();
  if(isset($_SESSION['name'])){
         $name = $_SESSION['name'];
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
    <title>Customer - Service History</title>

    <link rel="stylesheet" href="./assets/css/cust_dashboard.css">

    <link rel="stylesheet" href="./assets/css/bootstrap.min.css">

    <link rel="stylesheet" href="./assets/css/all.min.css">

    <!-- js files -->

    <script src="./assets/js/jquery.min.js"></script>
    <script src="./assets/js/poper.min.js"></script>
    <script src="./assets/js/bootstrap.min.js"></script>
    <script src="./assets/js/all.min.js"></script>
</head>
<?php 
  
  include("./includes/customer-ajax/dashboard-ajax.php");
  
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
                    <li><button class="box1"><a href="book_a_service.php" class="first">Book now</a></button></li>
                    <li><a href="prices.php" class="two"> Prices & Services</a></li>
                    <li><a href="#" class="three">Warranty</a></li>
                    <li><a href="#" class="three">Blog</a></li>
                    <li><a href="contact.php" class="three">Contact</a></li>
                    <li>
                        <div class="box">&nbsp;&nbsp;&nbsp;&nbsp;
                            <img src="./assets/image/icon-notification.png" alt="notification" class="four">
                            &nbsp;&nbsp;&nbsp;&nbsp;
                        </div>
                    </li>
                    <li>
                        <a href="#" data-toggle="dropdown"><img src="./assets/image/user.png" alt="user" class="five"></a>
                        <div class="dropdown-menu bg-dark">
                            <a href="#" class="dropdown-item">Welcome <?php echo $name; ?></a>
                            <a href="cust_dashboard.php" class="dropdown-item">My Dashboard</a>
                            <a href="cust_setting.php" class="dropdown-item">MySettings</a>
                            <a href="http://localhost/Helperland/?controller=Helperland&function=logout" class="dropdown-item">Logout</a>
                            
                        </div>
                   </li>
                    <div class="v-nav">
                        <li><a href="#">Dashboard</a></li>
                        <li class="active">
                                <a href="#">Service History</a>
                            </li>
                            <li><a href="#">Service Schedule</a></li>
                            <li><a href="#">Favourite Pros</a></li>
                            <li><a href="#">Invoices</a></li>
                            <li><a href="#">Notifications</a></li>
                    </div>

                </ul>
            </nav>
        </div>
        
        <div class="topic">
            <h1>Welcome, <span><?php echo $name; ?></span> </h1>
        </div>

        <div class="row">
            <div class="offset-md-2 col-md-2 offset-sm-2 col-sm-2 col-2">
                <div class="card">
                    <div class="card-text">
                        <nav class="nav flex-column">
                            <a class="nav-link active" href="#">Dashboard</a>
                            <a class="nav-link" href="#">Service Schedule</a>
                            <a class="nav-link" href="cust_service_history.php">Service History</a>
                            <a class="nav-link" href="cust_favpros.php">Favourite Pros</a>
                            <a class="nav-link" href="#">Invoices</a>
                            <a class="nav-link" href="#">Notifications</a>
                          </nav>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-6 col-6">
                
                   
                <span>
                
                    <a href="book_a_service.php" class="btn btn-primary float-right m-2" style="border-radius : 20px; background-color : blue !important">Add New Service Request</a>
               </span>
            
                
                <table class="table">
                    <thead>
                        <th>Service Id <img src="./assets/image/sort.png" alt=""></th>
                        <th>Service Date <img src="./assets/image/sort.png" alt=""></th>
                        <th>Service Provider <img src="./assets/image/sort.png" alt=""></th>
                        <th>Payments <img src="./assets/image/sort.png" alt=""></th>
                        <th>Actions <img src="./assets/image/sort.png" alt=""></th>
                        
                    </thead>
                    <tbody id="table-dashboard">
                        
                        

                    </tbody>
                </table>
                <div> Total Recods :  <span id="total-records"></span>
                </div>
            </div>
        </div>        

<!-- Footer -->
        <div class="end">
             <div class="flex">
                <img src="./assets/image/footer-logo.png" alt="logo" class="logo">
                <span class="nav">
                    <span class="one"><a href="home.php" class="text-light">HOME</a> </span>
                    <span class="two"> <a href="about.php" class="text-light">ABOUT</a></span>   
                    <span class="two"><a href="#" class="text-light">TESTIMONIALS</a></span>  
                    <span class="two"><a href="faq.php" class="text-light">FAQS</a></span>
                    <span class="two"><a href="#" class="text-light">INSURANCE POLICY</a></span>
                    <span class="two"><a href="#" class="text-light">IMPRESSUM</a></span>    
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

<!-- Servicedetails Modal -->

<div class="modal fade" id="servicedetailsmodal" tabindex="-1" role="dialog" aria-labelledby="servicedetailsmodalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-secondary font-weight-bold" id="servicedetailsmodalLabel">Service Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="booking-details">
          
      </div>
      
    </div>
  </div>
</div>


<!-- Cancel Modal -->
<div class="modal fade" id="cancelmodal" tabindex="-1" role="dialog" aria-labelledby="cancelmodalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-secondary font-weight-bold" id="cancelmodalLabel">Cancel Service Request</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <p class="text-secondary font-weight-bold">Why you want to delete the Service Request ??</p>
          <textarea id="cancelreq" style="width:100%;" required></textarea>
          <button class="btn btn-primary btn-block mt-3" style="border-radius : 20px; background-color : blue !important" id="cancelnow">Cancel Now</button><br>
          <div id="errormsg"></div>
      </div>
      
    </div>
  </div>
</div>

<!-- Reschedule Model -->

<div class="modal fade" id="reschedulemodal" tabindex="-1" role="dialog" aria-labelledby="reschedulemodalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-secondary font-weight-bold" id="reschedulemodalLabel">Reschedule Service Request</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <p class="text-secondary font-weight-bold">Select New Date </p>
          <input type="date" id="newdate">
          <button class="btn text-light btn-block mt-3" style="border-radius : 20px; background-color : blue !important" id="reschedule">Update</button><br>
          <div id="reschedulemsg"></div>
      </div>
      
    </div>
  </div>
</div>

