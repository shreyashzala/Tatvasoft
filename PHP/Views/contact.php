<?php
  $base_url = "http://localhost/Helperland/";
  session_start();
  
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link rel="stylesheet" href="./assets/css/contact.css">

    <link rel="stylesheet" href="./assets/css/bootstrap.min.css">

    <link rel="stylesheet" href="./assets/css/all.min.css">
</head>

<body>
    
<?php 
   include('includes/navbar.php'); 
?>
        <div class="banner">
            <img src="./assets/image/group-16_2.png" alt="prices">
        </div>

        <div class="contact">
            <h1>Contact Us</h1>
			<div class="row">
            <div class="col-md-4">
                <hr class="line-1">
            </div>
            <div class="col-md-4">
                <img src="./assets/image/forma-1-copy-5.png" alt="logo" class="logo">
            </div>
            <div class="col-md-4">
                <hr class="line-2">
            </div>
        </div>
            <div class="flex">
                <img src="./assets/image/forma-1_2.png" alt="location" class="location">
                <img src="./assets/image/phone-call.png" alt="mobile" class="mobile">
                <img src="./assets/image/vector-smart-object.png" alt="msg" class="msg">
            </div>
            <div class="row">
                <div class="col-md-4 col-sm-4 col-4 txt-1">
                    <p>1111 Lorem ipsum text 100, Lorem ipsum AB</p>
                </div>
                <div class="col-md-4 col-sm-4 col-4 txt-2">
                    <p>+49 (40) 123 56 7890 <br>
                        +49 (40) 987 56 0000
                    </p>
                </div>
                <div class="col-md-4 col-sm-4 col-4 txt-3">
                    <p>info@helperland.com</p>
                </div>
            </div>
            <hr>
        </div>

        <div class="touch">
            <h1>Get In Touch with us</h1>
            <form method="post" autocomplete="off" action="http://localhost/Helperland/?controller=Helperland&function=ContactUs">
                <input type="text" name="firstname" id="fname" placeholder="First Name" required>
                <input type="text" name="lastname" id="lname" placeholder="Last Name" required><br>
                <input type="tel" name="mobile" id="mobile" placeholder="Mobile No" required>
                <input type="email" name="email" id="email" placeholder="Email Address" required><br>
                <select name="sub" required>
                    <option value="Select">Select</option>
                    <option value="Subscription">Subscription</option>
                    <option value="Feedback">Feedback</option>
                </select><br>
                <textarea name="message" id="txtlarge" cols="30" rows="10" placeholder="Message" required></textarea><br>
                <button class="submit text-light">Submit</button>
                <?php if(isset($_SESSION['message'])) { echo $_SESSION['message'];} ?>
            </form>
        </div>

        <!-- google map -->
        <div class="map">
            <img src="./assets/image/group-16.png" alt="map" class="area">
            <img src="./assets/image/pin.png" alt="pin" class="pin">
        </div>

        <!-- Footer -->

<?php 
   include('includes/footer.php');
?>
