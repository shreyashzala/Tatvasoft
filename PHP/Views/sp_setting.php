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

    <link rel="stylesheet" href="./assets/css/sp_setting.css">

    <link rel="stylesheet" href="./assets/css/bootstrap.min.css">

    <link rel="stylesheet" href="./assets/css/all.min.css">

    <!-- js Files -->

    <script src="./assets/js/jquery.min.js"></script>
    <script src="./assets/js/poper.min.js"></script>
    <script src="./assets/js/bootstrap.min.js"></script>
    <script src="./assets/js/all.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

</head>
<?php 
 
   include("./includes/sp-ajax/sp-setting-ajax.php");

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
                        <li><a class="nav-link" href="#">Upcoming Services</a></li>
                        <li><a class="nav-link" href="#">Service Schedule</a></li>
                        <li><a class="nav-link" href="#">Service History</a></li>
                        <li><a class="nav-link" href="#">My Rating</a></li>
                        <li><a class="nav-link" href="#">Block Customer</a></li>
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
                            <a class="nav-link" href="#">New Service Request</a>
                            <a class="nav-link" href="sp_upcoming_service.php">Upcoming Services</a>
                            <a class="nav-link" href="#">Service Schedule</a>
                            <a class="nav-link" href="sp_service_history">Service History</a>
                            <a class="nav-link" href="#">My Rating</a>
                            <a class="nav-link" href="#">Block Customer</a>
                          </nav>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-6 col-6 tabs">
                
                <ul class="nav nav-tabs" id="tab" role="tablist">
                    <li class="nav-item li-one">
                        <a href="#one" class="nav-link first-tab active" id="first" data-toggle="tab" role="tab">

                            <span class="font-weight-bold heading">My Details</span>
                        </a>
                    </li>
                    
                    <li class="nav-item li-two">
                        <a href="#two" class="nav-link second-tab" id="second" data-toggle="tab" role="tab">
                            
                            <span class="font-weight-bold heading">Change Password</span>
                        </a>
                    </li>
                    
                </ul>
                <div class="tab-content" id="tab">

                    <!-- Detail Tab -->

                    <div class="tab-pane active first-nav" role="tabpanel" id="one">
                    <div class="mt-2">
                      <span class="text-secondary font-weight-bold">Acount Status : </span> <span>Active</span>
                    </div>    
                     
                     <p class="text-secondary font-weight-bold mt-3">Basic Details</p><hr>
                      <div class="row mt-1">
                        <div class="col-md-4">
                          <div class="form-group">
                               <label for="FirstsName" class="text-secondary font-weight-bold">First Name</label>
                               <input type="text" class="form-control" id="fname">
                    
                               <br>

                               <label for="Mobile No" class="text-secondary font-weight-bold">Mobile No</label>
                               <input type="number" class="form-control" id="mobile">

                           </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                               <label for="LastName" class="text-secondary font-weight-bold">Last Name</label>
                               <input type="text" class="form-control" id="lname">
                                
                               <br>

                               <label for="dob" class="text-secondary font-weight-bold">Date Of Birth</label>
                               <input type="date" class="form-control" id="dateofbirth">

                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                 <label for="email" class="text-secondary font-weight-bold">Email-Address</label>
                                 <input type="email" class="form-control" id="email" readonly>

                                 <br>
                                 <label for="language" class="text-secondary font-weight-bold">Nationality</label><br>
                                 <select id="nation" class="form-control">
                                    <option value="1">India</option>
                                    <option value="2">Germany</option>
                                
                                </select>

                            </div>
                        </div>
                    </div>

                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="language" class="text-secondary font-weight-bold">Gender</label><br>
                            <input type="radio" name="gender" value="1">&nbsp;&nbsp;<span class="text-secondary font-weight-bold">Male</span>
                            <input type="radio" name="gender" value="2">&nbsp;&nbsp;<span class="text-secondary font-weight-bold">Female</span>
                            <input type="radio" name="gender" value="3">&nbsp;&nbsp;<span class="text-secondary font-weight-bold">rather not to say</span>
                        </div>
                    </div>  
                    <div class="mt-3 avatar">
                        <label class="text-secondary font-weight-bold mb-2">Select Avatar</label>

                        <div class="row">
                            <div class="col-sm-2">
                                <img src="assets/image/avatar-car.png" alt="car">
                            </div>
                            <div class="col-sm-2">
                                <img src="assets/image/avatar-female.png" alt="female">
                            </div>
                            <div class="col-sm-2">
                                <img src="assets/image/avatar-hat.png" alt="hat">
                            </div>
                            <div class="col-sm-2">
                                <img src="assets/image/avatar-iron.png" alt="iron">
                            </div>
                            <div class="col-sm-2">
                                <img src="assets/image/avatar-male.png" alt="male">
                            </div>
                            <div class="col-sm-2">
                                <img src="assets/image/avatar-ship.png" alt="ship">
                            </div>
                        </div>
                    </div>   
                    <div class="address">
                    <p class="text-secondary font-weight-bold mt-3">My Address</p><hr>
                      <div class="row mt-1">
                        <div class="col-md-4">
                          <div class="form-group">
                               <label for="StreetName" class="text-secondary font-weight-bold">Street Name</label>
                               <input type="text" class="form-control" id="sname">
                    
                               <br>

                               <label for="city" class="text-secondary font-weight-bold">City</label>
                               <input type="text" class="form-control" id="city">

                           </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                               <label for="houseno" class="text-secondary font-weight-bold">House Number</label>
                               <input type="text" class="form-control" id="houseno">

                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                 <label for="code" class="text-secondary font-weight-bold">Postal Code</label>
                                 <input type="number" class="form-control" id="code">


                            </div>
                        </div>
                    </div>

                    <hr>
                    </div>
                     <button class="text-light save" id="updateinfo">Save</button><br>
                     <div id="msg1"></div>       
          
                    </div>

                    

                    <!-- Password Tab -->


                    <div class="tab-pane second-nav mt-3" role="tabpanel" id="two">
                        <div class="form-group">
                              <label for="old" class="text-secondary font-weight-bold">Old Password</label>
                              <input type="password" class="form-control" id="oldpwd">
                        </div>
                        <div class="form-group">
                              <label for="new" class="text-secondary font-weight-bold">New Password</label>
                              <input type="password" class="form-control" id="newpwd">
                        </div>
                        <div class="form-group">
                              <label for="con" class="text-secondary font-weight-bold">Confirm Password</label>
                              <input type="password" class="form-control" id="conpwd">
                        </div>
                        <button class="text-light mt-3 save"
                        id = "chpwd">Save</button><br>
                        <div id="msg"></div>
                    </div>
                </div>     
                   
            </div>
        </div>        

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

