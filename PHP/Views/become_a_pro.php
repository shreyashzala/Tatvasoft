<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Service Provider - Become a Pro</title>

    <link rel="stylesheet" href="./assets/css/become_a_pro.css">

    <link rel="stylesheet" href="./assets/css/bootstrap.min.css">

    <link rel="stylesheet" href="./assets/css/all.min.css">

</head>

<body>
<?php 
   include('includes/sp_navbar.php');
?>
            <!-- Register Card -->

            <div class="card register">
                <h1>Register Now!</h1>
                <form method="post" autocomplete="off" action="http://localhost/Helperland/?controller=Helperland&function=registerSP">
                    <div class="form-group">
                        <input type="text" name="fname" class="form-control" placeholder="First name">
                    </div>
                    <div class="form-group">
                        <input type="text" name="lname" class="form-control" placeholder="Last name">
                    </div>
                    <div class="form-group">
                        <input type="email" name="email" class="form-control" placeholder="Email Address">
                    </div>
                    <div class="form-group phonenum">
                        <div class="input-group ">
                            <div class="input-group-prepend">
                                <div class="input-group-text">+49</div>
                            </div>
                            <input type="tel"  name="mobile" class="form-control" placeholder="Phone Number">
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" class="form-control" placeholder="Password">
                    </div>
                    <div class="form-group">
                        <input type="password" name="c_password" class="form-control" placeholder="Confirm Password">
                    </div>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        <label class="form-check-label " for="exampleCheck1">Send me newsletters from Helperland</label>
                    </div>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck2">
                        <label class="form-check-label " for="exampleCheck2">I accept <a href="#">terms and
                                conditions</a> & <a href="#">privacy policy</a></label>
                    </div>
                    <div class="form-group sbmtbtn">
                        <button name="submit" class="btn btn-success">Get Started</button>
                    </div>
                </form>

            </div>
            <div class="dwn">
                <img src="./assets/image/ellipse-525.svg" class="eclipce">
                <div class="download">
                    <img src="./assets/image/shape-1.svg" alt="" class="download1">
                </div>
            </div>
            <!-- end -->
        </div>

        <div class="topic">
            <h1 class="text-center mt-5">How It Works</h1>
            <div class="one">
                <div class="row mt-5">
                    <div class="offset-md-3 col-md-3 col-sm-6">
                        <h2>Register Yourself</h2>
                        <p>Provide your basic information to register your self as a provider</p>
                        <br><br>
                        <span>Read More</span>
                        <img src="./assets/image/shape-2.png" class="arrow" alt="arrow">


                    </div>
                    <div class="col-md-3 col-sm-6">
                        <img src="./assets/image/group-29.png" alt="logo">
                    </div>
                </div>
            </div>
            <div class="two">
                <div class="row mt-5">
                    <div class="offset-md-3 col-md-3 col-sm-3">
                        <img src="./assets/image/group-29.png" alt="logo">
                    </div>
                    <div class="col-md-3 col-sm-3">

                        <h2>Get Service Request</h2>
                        <p>You will get Service Request from customers depend on service area and profile</p>
                        <br><br>
                        <span>Read More</span>
                        <img src="./assets/image/shape-2.png" class="arrow" alt="arrow">

                    </div>
                </div>
            </div>

            <div class="three">
                <div class="row mt-5">
                    <div class="offset-md-3 col-md-3 col-sm-4">
                        <h2>Complete Service</h2>
                        <p>Accept Service request from your customer and complete the work.</p>
                        <br><br>
                        <span>Read More</span>
                        <img src="./assets/image/shape-2.png" class="arrow" alt="arrow">
                    </div>
                    <div class="col-md-3 col-sm-4">
                        <img src="./assets/image/group-30.png" alt="logo">
                    </div>
                </div>
            </div>
        </div>

        <!-- footer -->
<?php 
      include('includes/footer.php');
?>