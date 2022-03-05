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

    <link rel="stylesheet" href="./assets/css/service_history.css">

    <link rel="stylesheet" href="./assets/css/bootstrap.min.css">

    <link rel="stylesheet" href="./assets/css/all.min.css">

    <!-- js files -->

    <script src="./assets/js/jquery.min.js"></script>
    <script src="./assets/js/poper.min.js"></script>
    <script src="./assets/js/bootstrap.min.js"></script>
    <script src="./assets/js/all.min.js"></script>
</head>
<?php 
  
  include("./includes/customer-ajax/service-history-ajax.php");

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

        <!-- Table & Navbar Section -->
        <div class="row">
            <div class="offset-md-2 col-md-2 offset-sm-2 col-sm-2 col-2">
                <div class="card">
                    <div class="card-text">
                        <nav class="nav flex-column">
                            <a class="nav-link" href="cust_dashboard.php">Dashboard</a>
                            <a class="nav-link" href="#">Service Schedule</a>
                            <a class="nav-link active" href="#">Service History</a>
                            <a class="nav-link" href="#">Favourite Pros</a>
                            <a class="nav-link" href="#">Invoices</a>
                            <a class="nav-link" href="#">Notifications</a>
                          </nav>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-6 col-6">
                <table class="table">
                    <thead>
                        <th>Service Details <img src="./assets/image/sort.png" alt=""></th>
                        <th>Service Provider <img src="./assets/image/sort.png" alt=""></th>
                        <th>Payments <img src="./assets/image/sort.png" alt=""></th>
                        <th>Status <img src="./assets/image/sort.png" alt=""></th>
                        <th>Rate SP </th>
                    </thead>
                    <tbody id="table-history">
                        
                        

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

<!-- Rating Modal -->

<div class="modal fade edit" id="ratingmodal" tabindex="-1" role="dialog" aria-labelledby="ratingmodalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
           <div class="modal-title" id="ratingmodalLabel">
                <img src="./assets/image/cap.png" class="p-4 font-weight-bold" alt="avatar">
                <span class="font-weight-bold text-secondary">Sandip Patel</span>
           </div>
           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <div class="row">
                <div class="col-md-5">
                    <span class="font-weight-bold text-secondary">On time Arrival</span><br>
                    <span class="font-weight-bold text-secondary">Friendly</span><br>
                    <span class="font-weight-bold text-secondary">Quality Of Service</span>
                </div>
                <div class="col-md-1">
                    <img src="./assets/image/star-empty.png" alt="star" id="ontime1">
                    <img src="./assets/image/star-empty.png" alt="star" id="friendly1"><br>
                    <img src="./assets/image/star-empty.png" alt="star" id="service1"><br>
                </div>
                <div class="col-md-1">
                    <img src="./assets/image/star-empty.png" alt="star" id="ontime2"><br>
                    <img src="./assets/image/star-empty.png" alt="star" id="friendly2"><br>
                    <img src="./assets/image/star-empty.png" alt="star" id="service2"><br>
                </div>
                <div class="col-md-1">
                    <img src="./assets/image/star-empty.png" alt="star" id="ontime3"><br>
                    <img src="./assets/image/star-empty.png" alt="star" id="friendly3"><br>
                    <img src="./assets/image/star-empty.png" alt="star" id="service3"><br>
                </div>
                <div class="col-md-1">
                    <img src="./assets/image/star-empty.png" alt="star" id="ontime4"><br>
                    <img src="./assets/image/star-empty.png" alt="star" id="friendly4"><br>
                    <img src="./assets/image/star-empty.png" alt="star" id="service4"><br>
                </div>
                <div class="col-md-1">
                    <img src="./assets/image/star-empty.png" alt="star" id="ontime5"><br>
                    <img src="./assets/image/star-empty.png" alt="star" id="friendly5"><br>
                    <img src="./assets/image/star-empty.png" alt="star" id="service5"><br>
                </div>
                <div class="col-md-1">
                    <span id="info1"></span><br>
                    <span id="info2"></span><br>
                    <span id="info3"></span><br>
                </div>
            </div><br>
          <div>
              <p class="font-weight-bold text-secondary">Feedback on Service Provider</p>
             <textarea id="feedback" style="width:100%;"></textarea>
         </div>
      
      
      </div>
      <div class="modal-footer">
      <button class="btn btn-primary text-light btn-block mt-2" style="border-radius : 20px;" id="submit">Submit</button>
       <div id="successmsg"></div>   
      </div>
      
    </div>
  </div>
</div>
