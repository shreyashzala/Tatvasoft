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

    <link rel="stylesheet" href="./assets/css/cust_setting.css">

    <link rel="stylesheet" href="./assets/css/bootstrap.min.css">

    <link rel="stylesheet" href="./assets/css/all.min.css">

    <!-- js files -->

    <script src="./assets/js/jquery.min.js"></script>
    <script src="./assets/js/poper.min.js"></script>
    <script src="./assets/js/bootstrap.min.js"></script>
    <script src="./assets/js/all.min.js"></script>
</head>
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
                            <a href="#" class="dropdown-item">MySettings</a>
                            <a href="http://localhost/Helperland/?controller=Helperland&function=logout" class="dropdown-item">Logout</a>
                            
                        </div>
                   </li>
                    <div class="v-nav">
                        <li><a href="#">Dashboard</a></li>
                        <li>
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
                <div class="card" id="first-card">
                    <div class="card-text">
                        <nav class="nav flex-column">
                            <a class="nav-link" href="cust_dashboard.php">Dashboard</a>
                            <a class="nav-link" href="#">Service Schedule</a>
                            <a class="nav-link" href="cust_service_history.php">Service History</a>
                            <a class="nav-link" href="#">Favourite Pros</a>
                            <a class="nav-link" href="#">Invoices</a>
                            <a class="nav-link" href="#">Notifications</a>
                          </nav>
                    </div>
                </div>
            </div>
<?php 
    include('includes/customer-ajax/cust-setting-ajax.php'); 
?>            
            <div class="col-md-6 col-sm-6 col-6 tabs">
            <!-- Tab Section     -->
            <ul class="nav nav-tabs" id="tab" role="tablist">
                    <li class="nav-item li-one">
                        <a href="#one" class="nav-link first-tab active" id="first" data-toggle="tab" role="tab">

                            <span class="font-weight-bold heading">My Details</span>
                        </a>
                    </li>
                    <li class="nav-item li-two">
                        <a href="#two" class="nav-link second-tab" id="second" data-toggle="tab" role="tab">
                            
                            <span class="font-weight-bold heading">My Address</span>
                        </a>
                    </li>
                    <li class="nav-item li-three">
                        <a href="#three" class="nav-link third-tab" id="third" data-toggle="tab" role="tab">
                            
                            <span class="font-weight-bold heading">Change Password</span>
                        </a>
                    </li>
                    
                </ul>
                <div class="tab-content" id="tab">

                    <!-- Detail Tab -->

                    <div class="tab-pane active first-nav" role="tabpanel" id="one">
                      <div class="row mt-3">
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
                            </div>
                        </div>
                    </div>

                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="language" class="text-secondary font-weight-bold">My Prefered Langauge</label><br>
                            <select id="language" class="form-control">
                                <option value="1">English</option>
                                <option value="2">Hindi</option>
                                <option value="3">Gujrati</option>
                           </select>
                        </div>
                    </div>     
                     <button class="text-light mt-5 save" id="updateinfo">Save</button><br>
                     <div id="msg1"></div>       
          
                    </div>

                    <!-- Address Tab -->

                    <div class="tab-pane second-nav" role="tabpanel" id="two">
                    
                    <div class="card mt-3">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-2">
                                   <span class="text-secondary font-weight-bold">Invoicing</span>
                                </div>
                                <div class="col-md-7 text-center">
                                    <span class="text-secondary font-weight-bold">Address</span>
                                </div>
                                <div class="col-md-3 text-center">
                                     <span class="text-secondary font-weight-bold">Actions</span>
                                </div>
                            </div>
                            
                            
                        </div>
                        <div id="address"></div>
                    </div>

                    <a href="#" data-toggle="modal" data-target="#addmodal"><button class="btn btn-primary text-light mt-3" style="border-radius:20px;">Add New Address</button></a>


                    </div>

                    <!-- Password Tab -->


                    <div class="tab-pane third-nav mt-3" role="tabpanel" id="three">
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

<!-- Add Modal -->

<div class="modal fade edit" id="addmodal" tabindex="-1" role="dialog" aria-labelledby="addmodalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addmodalLabel">Add New Address</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="row">
                <div class="col-md-6">
                    <div class="form-field">
                         <label class="text-secondary font-weight-bold">Street Name</label>
                         <input type="text" class="form-control" id="sname">
                    </div><br>
                    <div class="forem-field">
                          <label class="text-secondary font-weight-bold">Postal Code</label>
                          <input type="number" class="form-control" id="code">
                    </div><br>
                    <div class="form-field">
                          <label class="text-secondary font-weight-bold">Phone Number</label>
                          <input type="number" class="form-control" id="phone">
                    </div>
                    
                </div>
                <div class="col-md-6">
                  <div class="form-field">
                         <label class="text-secondary font-weight-bold">House number</label>
                         <input type="text" class="form-control" id="houseno">
                    </div><br>
                    <div class="form-field">
                         <label class="text-secondary font-weight-bold">City</label>
                         <input type="text" class="form-control" id="city">
                    </div><br>
                </div>
                
            </div>
      
      </div>
      <div class="modal-footer">
          <button class="btn text-light btn-block save mt-2" id="addbtn">Save</button><br>
          <div id="msg3"></div>
      </div>
      
    </div>
  </div>
</div>





<!-- Edit Modal -->

<div class="modal fade edit" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="editmodalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editmodalLabel">Edit Address</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="demo">
            
      
      </div>
      <div class="modal-footer">
          <button class="btn text-light btn-block save mt-2" id="editbtn">Save</button><br>
          <div id="msg2"></div>
      </div>
      
    </div>
  </div>
</div>


<!-- Delete Modal -->

<div class="modal fade" id="deletemodal" tabindex="-1" role="dialog" aria-labelledby="deletemodalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deletemodalLabel">Delete Address</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <h6>Are you sure to want delete this address ??</h6>
          <button class="btn text-light btn-block save mt-4" id="deletebtn">Delete</button>
      </div>
      
    </div>
  </div>
</div>

