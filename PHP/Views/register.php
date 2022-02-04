
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account</title>
    <link rel="stylesheet" href="./assets/css/register.css">

    <link rel="stylesheet" href="./assets/css/bootstrap.min.css">

    <link rel="stylesheet" href="./assets/css/all.min.css">
</head>

<body>
    
<?php 
   include('includes/navbar.php'); 
?>

<div class="container">

            <h1 class="text-center mt-5">Create Account</h1>
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

        <form method="post" autocomplete="off" action="http://localhost/Helperland/?controller=Helperland&function=register" class="text-center">
                <input type="text" name="fname" id="fname" placeholder="First Name">
                <input type="text" name="lname" id="lname" placeholder="Last Name"><br>
                <input type="tel" name="mobile" id="mobile" placeholder="Mobile No">
                <input type="email" name="email" id="email" placeholder="Email Address"><br>
                <input type="password" name="password" id="pass" placeholder="password">
                <input type="password" name="c_password" id="cpass" placeholder="Confirm Password"><br><br>
                <input type="checkbox" name="check1" id=""> I have agreed to terms & Condition.<br><br>
                <input type="checkbox" name="check2" id=""> I have read the privacy policy.<br><br>
                <button name="submit" class="submit text-light btn btn-secondary">Register</button>
               
                
            </form>
</div>


<?php
  include('includes/footer.php');
?>