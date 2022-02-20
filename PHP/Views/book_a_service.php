<?php
  session_start();
  if(isset($_SESSION['name'])){
         $name = $_SESSION['name'];
         $id = $_SESSION['id'];
         
    
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
    <title>Book A Service</title>

    <link rel="stylesheet" href="./assets/css/book_a_service.css">

    <link rel="stylesheet" href="./assets/css/bootstrap.min.css">

    <link rel="stylesheet" href="./assets/css/all.min.css">

</head>

<body>
    
    <!-- navbar -->
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
                    <li><button class="box1"><a href="#" class="first">Book now</a></button></li>
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
                        <div class="dropdown-menu bg-dark">
                            <a href="#" class="dropdown-item">Welcome <?php echo $name; ?></a>
                            <a href="#" class="dropdown-item">My Dashboard</a>
                            <a href="#" class="dropdown-item">MySettings</a>
                            <a href="http://localhost/Helperland/?controller=Helperland&function=logout" class="dropdown-item">Logout</a>
                            
                        </div>
                   </li>
                    

                </ul>
            </nav>
        </div>
        
    
        <div class="banner">
            <img src="./assets/image/book-service-banner.jpg" alt="About">
        </div>

        <div class="title">
            <h1>Set up your cleaning Service</h1>
        </div>
        <div class="line">
            <hr class="line-1">
            <img src="./assets/image/forma-1-copy-5.png" alt="img">
            <hr class="line-2">
        </div>

        <!-- Tab Section -->

        <div class="row mt-3">
            <div class="offset-md-2 col-md-6 mr-2">
                <ul class="nav nav-tabs" id="tab" role="tablist">
                    <li class="nav-item demo">
                        <a href="#one" class="nav-link first-tab active" id="first" data-toggle="tab" role="tab">

                            <img src="./assets/image/setup-service-white.png" id="img" alt="">
                            <span>Setup Service</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#two" class="nav-link second-tab" id="second" data-toggle="tab" role="tab">
                            <img src="./assets/image/schedule-white.png" alt="">
                            <span>Schedule & Plan</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#three" class="nav-link third-tab" id="third" data-toggle="tab" role="tab">
                            <img src="./assets/image/details.png" alt="">
                            <span>Your Details</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#four" class="nav-link fourth-tab" id="fourth" data-toggle="tab" role="tab">
                            <img src="./assets/image/payment.png" alt=""> 
                            <span>Make Payment</span>
                        </a>
                    </li>
                </ul>

                <!-- Setup-service -->

                <div class="tab-content" id="tab">
                    <div class="tab-pane active first-nav" role="tabpanel" id="one">
                        <div class="text mt-5">
                            
                                <label for="input" class="font-weight-bold">Enter your Postal code</label><br>
                                <input type="number" name="code" class="mr-5" placeholder="Postal Code" id="code">
                                <button class="sub-btn text-light" onclick="checkcode()">
                                    Check Availibility
                                </button>
                                <div id="msg"></div>
                           
                        </div>
                    </div>

                    <!-- Schedule & Plan -->

                    <div id="two" class="tab-pane second-nav" role="tabpanel">
                        <div class="topic">Select no of rooms and bath</div>
                        <input type="hidden" id="user_id" value=<?php echo $id; ?>>
                        <select id="bed" onclick="bed()">
                            <option value="1 bed">1 bed</option>
                            <option value="2 bed">2 bed</option>
                            <option value="3 bed">3 bed</option>
                        </select>
                        <select id="bath" onclick="bath()" class="mb-4">
                            <option value="1 bath">1 bath</option>
                            <option value="2 bath">2 bath</option>
                            <option value="3 bath">3 bath</option>
                        </select><br>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="topic">When do you need cleaner ?</div>
                                <span id="selectdate">
                                   <span id="date" style="border : 1px solid;border-collapse : collapse; padding: 2px;"></span></span>
                                   <script>
        
                                    var tomorrow = new Date(new Date().getTime() + 24*60*60*1000);
                                     var today = tomorrow.getDate();
                                     var tomonth = tomorrow.getMonth() + 1;
                                     var toyear = tomorrow.getFullYear();
                                     document.getElementById("date").innerHTML = ( today + "/" + tomonth + "/" + toyear );
        
                              </script>
                                
                                <select id="time" onclick="time()">
                                    <option value="2:00 PM">2:00 PM</option>
                                    <option value="3:00 PM">3:00 PM</option>
                                    <option value="4:00 PM">4:00 PM</option>
                                    <option value="5:00 PM">5:00 PM</option>
                                    <option value="6:00 PM">6:00 PM</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <div class="topic">how long do you need your cleaner to stay ?</div>
                                <select class="mb-4" id="hours" onclick="hour()">
                                    <option value="3">3 Hrs</option>
                                    <option value="4">4 Hrs</option>
                                    <option value="5">5 Hrs</option>
                                    <option value="6">6 Hrs</option>
                                </select>
                            </div>
                        </div>
                        <hr>
                        <div class="topic">Extra Services</div>
                        <div class="row">
                            <div class="offset-md-1 col-md-2 one" onclick="extra1()">
                                 <img src="./assets/image/3.png" alt="logo">
                                 <p class="text" id="extra1">Inside cabinets</p>
                             
                            </div>
                            <div class="col-md-2 two"  onclick="extra2()">
                              
                                <img src="./assets/image/5.png" alt="logo">
                                <p class="text" id="extra2">Inside fridge</p>
                            </div>
                            <div class="col-md-2 three" onclick="extra3()">
                             
                                <img src="./assets/image/oven.png" alt="logo">
                                <p class="text" id="extra3">Inside oven</p>
                               
                            </div>
                            <div class="col-md-2 four" onclick="extra4()">
                            
                                <img src="./assets/image/2.png" alt="logo">
                                <p class="text" id="extra4">Laundry wash & dry</p>
                              
                            </div>
                            <div class="col-md-2 five mb-5" onclick="extra5()">
                                <img src="./assets/image/1.png" alt="logo">
                                <p class="text" id="extra5">Interior windows</p>
                            </div>
                        </div>
                        <hr class="mt-5">

                        <div class="topic">Comments</div>

                        <input type="text" class="comment-box mb-4">
                        <input type="checkbox" class="mb-4"> I have pets at home.
                        <hr>

                        <button class="sub-btn float-right">
                            <a href="#" class="text-center text-light" id="link" onclick="plan()">Continue</a>
                        </button>

                    </div>

                    <!-- Your Details  -->

                    <div id="three" class="tab-pane third-tab" role="tabpanel">
                    
                        <div class="font-weight-bold mt-5 topic">Enter your contact details so we can serve you in a
                            better way!</div>
                        
                        <div id="address">
                           


                        </div><br>
                        
                        <div class="mt-3">
                            <button class="submit">
                                <a href="#newadd" class="text-center text-primary font-weight-bold" id="link"
                                    data-toggle="collapse">+ Add New Address</a>
                            </button>
                            <div class="collapse" id="newadd">
                                <div class="new">
                                    
                                        <input type="hidden" name="id" id="userid"
                                        value="<?php echo $id; ?>">
                                        <label class="ml-3 mr-5 topic">Street Name
                                            <input type="text" name="sname" id="sname"></label>
                                        <label class="topic ml-5">House No
                                            <input type="text" name="houseno"
                                            id="houseno"></label>
                                        <br>
                                        <label class="ml-3 mr-5 topic">Zip Code
                                        <span id="zipcode" class="bg-light text-dark"></span></label>

                                        <label class="topic ml-5">City
                                            <input type="text" name="city"
                                            id="city"></label>
                                        <br>
                                        <label class="ml-3 mr-5 topic">Phone Number
                                            <input type="number" name="phone"
                                            id="phone">
                                        </label><br><br>
                                        <button class="save ml-3" onclick="add()">
                                            <a href="#" class="text-center text-light" id="link">Save</a>
                                        </button>
                                        <button class="cancel mb-3">
                                            <a href="#" class="text-center text-primary" id="link">Cancel</a>
                                        </button>
                                        <div id="msg1"></div>
                                    
                                </div>
                            </div>

                            <div class="topic">Your Favourite Service Provider</div>
                            <hr>
                            <p>you can choose your Favourite service provider from below list</p>

                            <div class="img">
                                <img src="./assets/image/cap.png" class="p-4 font-weight-bold" alt="avatar">
                            </div>
                            <p class="topic">Sandip Patel</p>
                            <a href="#" class="btn btn-outline-secondary">Select </a>

                            <hr>
                            <button class="sub-btn float-right">
                                <a href="#" class="text-center text-light" id="link"
                                onclick="yourdetails()">Continue</a>
                            </button>
                        </div>
                    </div>

                    <!-- Make Payment -->

                    <div id="four" class="tab-pane fourth-nav" role="tabpanel">
                        <div class="font-weight-bold mt-5 topic">Pay Securely with Helperland Payment Gateway</div>
                        
                            <label class="topic"> Promo Code (Optional) <br>
                                <input type="text" name="promocode" id="promocode" placeholder="Promo Code (Optional)">
                            </label>
                            <button class="sub-btn">
                                <a href="#" class="text-center text-light" id="link" onclick="promocode()">Apply</a>
                            </button>
                            <div id="promo"></div>
                        
                        <hr>
                        <div class="mt-4">
                            <input type="number" name="cardnumber" id="cardnumber" placeholder="Card Number">
                            <input type="text" name="month" id="month" placeholder="MM/YY">
                            <input type="number" name="cvv" id="cvv" placeholder="CVV">
                        </div><br>
                        <div id="pay"></div>
                        <img src="./assets/image/credit-cards.png" alt="cards" class="float-right">
                        <br><br>
                        <hr>
                        <input type="checkbox" class="mb-4"> I accept the <span><a href="#">terms and
                                conditions</a></span> and <span><a href="#">privacy policy.</a></span>
                        <hr>
                        <button class="sub-btn float-right">
                            <a href="#" class="text-center text-light" id="link" onclick="payment()">Complete Booking</a>
                        </button>
                    </div>
                </div>



            </div>

            <!-- Card Section -->

            <div class="col-md-3">
                <div class="card">
                    <div class="card-header head">
                        <p>Payment Summary</p>
                    </div>
                    <div class="card-text">
                        <p class="mt-3 ml-3">
                         <span id="adddate"> 
                         </span>
                         <script>
        
                                    var tomorrow = new Date(new Date().getTime() + 24*60*60*1000);
                                     var today = tomorrow.getDate();
                                     var tomonth = tomorrow.getMonth() + 1;
                                     var toyear = tomorrow.getFullYear();
                                     document.getElementById("adddate").innerHTML = ( today + "/" + tomonth + "/" + toyear );
        
                            </script>
                         
                         
                         @
                        <span id="addtime">4:00 pm</span> </p>
                        <p class="ml-3"><span id="addbed">1 bed,</span> <span id="addbath">1 bath.</span> </p>
                        <p class="ml-3 dur">Duration</p>
                        <p class="ml-3">Basic Inside<span class="float-right mr-3" id="addhour"> 3 hrs</span>  </span></p>

                        <span id="addextra1"></span>
                        <span id="addextra2"></span>
                        <span id="addextra3"></span>
                        <span id="addextra4"></span>
                        <span id="addextra5"></span>
        
                        <hr class="ml-3" width="92%">
                        <span id="totaltime1"></span>
                        <p class="ml-3 dur">Total Service Time <span class="float-right mr-3"><span id="totalservice">3 </span>  hrs </p>
                        <hr>
                        <p class="ml-3">Per cleaning
                            <span class="float-right mr-3 font-weight-bold"><i class="fas fa-dollar-sign"></i><span id="amount">18</span> </span>
                        </p>
                        <div id="discount"></div>
                        <hr>
                        <p class="ml-3">Total Payment<span class="float-right mr-3 font">
                            <i class="fas fa-dollar-sign"></i><span id="totalPayment">54</span></span>
                           
                        </p><br>
                        
                    </div>
                    <div class="card-footer">
                        <div class="dummy">
                            <img src="./assets/image/smiley.png" alt="smiley">
                            <p class="ml-3">See what is always included</p>
                        </div>
                    </div>
                </div>

                <!-- Question Section -->

                <div class="topic text-center">Questions</div>
                <div class="question-text">
                    <img src="./assets/image/right-arrow-dark.png" alt="arrow"><span>Which Helperland professional will come to
                        my place?</span>
                </div>
                <hr>
                <div class="question-text">
                    <img src="./assets/image/right-arrow-dark.png" alt="arrow"><span>Which Helperland professional will come to
                        my place?</span>
                </div>
                <hr>
                <div class="question-text">
                    <img src="./assets/image/right-arrow-dark.png" alt="arrow"><span>Which Helperland professional will come to
                        my place?</span>
                </div>
                <hr>
                <div class="question-text">
                    <img src="./assets/image/right-arrow-dark.png" alt="arrow"><span>Which Helperland professional will come to
                        my place?</span>
                </div>
                <hr>
                <div class="question-text">
                    <img src="./assets/image/right-arrow-dark.png" alt="arrow"><span>Which Helperland professional will come to
                        my place?</span>
                </div>
                <hr>
                <div class="question-text">
                    <img src="./assets/image/right-arrow-dark.png" alt="arrow"><span>Which Helperland professional will come to
                        my place?</span>
                </div>
                <hr>
                <div class="question-text">
                    <img src="./assets/image/right-arrow-dark.png" alt="arrow"><span>Which Helperland professional will come to
                        my place?</span>
                </div>
                <hr>
                <div class="topic">For more help</div>
            </div>
        </div>

        
        <!-- Footer -->
  
        
        
<?php
  include('includes/footer.php');
?>
