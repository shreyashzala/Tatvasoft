<?php
  session_start();
  
       $name = $_SESSION['name'];

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
                            <a class="nav-link" href="#">Dashboard</a>
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
                    <tbody>
                        <tr>
                            <td><img src="./assets/image/calendar.png" alt="calender"> 09/04/2018 <br>
                                 12.00 - 18.00
                            </td>
                            <td>
                                <img src="./assets/image/cap.png" alt="cap"> Lyum Watson
                            </td>
                            <td>
                                <i class="fas fa-euro-sign font"></i><span>63</span>
                            </td>
                            <td><button class="sucess">Completed</button> </td>
                            <td><button class="btn btn-primary">Rate SP</button> </td>
                        </tr>
                        <tr>
                            <td><img src="./assets/image/calendar.png" alt="calender"> 09/04/2018 <br>
                                 12.00 - 18.00
                            </td>
                            <td>
                                <img src="./assets/image/cap.png" alt="cap"> Lyum Watson
                            </td>
                            <td>
                                <i class="fas fa-euro-sign font"></i><span>63</span>
                            </td>
                            <td><button class="sucess">Completed</button> </td>
                            <td><button class="btn btn-primary">Rate SP</button> </td>
                        </tr>
                        <tr>
                            <td><img src="./assets/image/calendar.png" alt="calender"> 09/04/2018 <br>
                                 12.00 - 18.00
                            </td>
                            <td>
                                <img src="./assets/image/cap.png" alt="cap"> Lyum Watson
                            </td>
                            <td>
                                <i class="fas fa-euro-sign font"></i><span>63</span>
                            </td>
                            <td><button class="sucess">Completed</button> </td>
                            <td><button class="btn btn-primary">Rate SP</button> </td>
                        </tr>
                        <tr>
                            <td><img src="./assets/image/calendar.png" alt="calender"> 09/04/2018 <br>
                                 12.00 - 18.00
                            </td>
                            <td>
                                <img src="./assets/image/cap.png" alt="cap"> Lyum Watson
                            </td>
                            <td>
                                <i class="fas fa-euro-sign font"></i><span>63</span>
                            </td>
                            <td><button class="cancel">Cancelled</button> </td>
                            <td><button class="btn btn-primary">Rate SP</button> </td>
                        </tr>
                        <tr>
                            <td><img src="./assets/image/calendar.png" alt="calender"> 09/04/2018 <br>
                                 12.00 - 18.00
                            </td>
                            <td>
                                <img src="./assets/image/cap.png" alt="cap"> Lyum Watson
                            </td>
                            <td>
                                <i class="fas fa-euro-sign font"></i><span>63</span>
                            </td>
                            <td><button class="sucess">Completed</button> </td>
                            <td><button class="btn btn-primary">Rate SP</button> </td>
                        </tr>
                        <tr>
                            <td><img src="./assets/image/calendar.png" alt="calender"> 09/04/2018 <br>
                                 12.00 - 18.00
                            </td>
                            <td>
                                <img src="./assets/image/cap.png" alt="cap"> Lyum Watson
                            </td>
                            <td>
                                <i class="fas fa-euro-sign font"></i><span>63</span>
                            </td>
                            <td><button class="cancel">Cancelled</button> </td>
                            <td><button class="btn btn-primary">Rate SP</button> </td>
                        </tr>
                        <tr>
                            <td><img src="./assets/image/calendar.png" alt="calender"> 09/04/2018 <br>
                                 12.00 - 18.00
                            </td>
                            <td>
                                <img src="./assets/image/cap.png" alt="cap"> Lyum Watson
                            </td>
                            <td>
                                <i class="fas fa-euro-sign font"></i><span>63</span>
                            </td>
                            <td><button class="sucess">Completed</button> </td>
                            <td><button class="btn btn-primary">Rate SP</button> </td>
                        </tr>
                        <tr>
                            <td><img src="./assets/image/calendar.png" alt="calender"> 09/04/2018 <br>
                                 12.00 - 18.00
                            </td>
                            <td>
                                <img src="./assets/image/cap.png" alt="cap"> Lyum Watson
                            </td>
                            <td>
                                <i class="fas fa-euro-sign font"></i><span>63</span>
                            </td>
                            <td><button class="sucess">Completed</button> </td>
                            <td><button class="btn btn-primary">Rate SP</button> </td>
                        </tr>
                        <tr>
                            <td><img src="./assets/image/calendar.png" alt="calender"> 09/04/2018 <br>
                                 12.00 - 18.00
                            </td>
                            <td>
                                <img src="./assets/image/cap.png" alt="cap"> Lyum Watson
                            </td>
                            <td>
                                <i class="fas fa-euro-sign font"></i><span>63</span>
                            </td>
                            <td><button class="cancel">Cancelled</button> </td>
                            <td><button class="btn btn-primary">Rate SP</button> </td>
                        </tr>
                        <tr>
                            <td><img src="./assets/image/calendar.png" alt="calender"> 09/04/2018 <br>
                                 12.00 - 18.00
                            </td>
                            <td>
                                <img src="./assets/image/cap.png" alt="cap"> Lyum Watson
                            </td>
                            <td>
                                <i class="fas fa-euro-sign font"></i><span>63</span>
                            </td>
                            <td><button class="cancel">Cancelled</button> </td>
                            <td><button class="btn btn-primary">Rate SP</button> </td>
                        </tr>
                        

                    </tbody>
                </table>
            </div>
        </div>


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


    

    <!-- js files -->

    <script src="./assets/js/jquery.min.js"></script>
    <script src="./assets/js/poper.min.js"></script>
    <script src="./assets/js/bootstrap.min.js"></script>
    <script src="./assets/js/all.min.js"></script>
</body>
</html>