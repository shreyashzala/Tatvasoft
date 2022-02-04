<?php 
session_start();
 $email = $_SESSION['email'];

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
   

    <link rel="stylesheet" href="./assets/css/bootstrap.min.css">

    <link rel="stylesheet" href="./assets/css/all.min.css">
</head>

<body>
    

<div class="container">

    <h1 class="text-center mt-5">Forgot Password</h1>

        <form method="post" autocomplete="off" action="http://localhost/Helperland/?controller=Helperland&function=resetpass">
            <input type="hidden" name="email" value="<?php echo $email; ?>">    
            <div class="form-group">
                    <label for="password" class="font-weight-bold pl-2">New Password</label><input type="password" name="n_password" class="form-control" placeholder="New Password">
            </div><br>
            <div class="form-group">
                      <label for="password" class="font-weight-bold pl-2">Confirm Password</label><input type="password" name="c_password" class="form-control" placeholder="Confirm Password">
            </div><br>
            <button name="submit" class="submit text-light btn btn-secondary btn-block">Update</button>
               
                
            </form>
</div>


