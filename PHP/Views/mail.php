
<?php

session_start();
 $email = $_SESSION['email'];
 
$to_email = "$email";
$subject = "Reset Password";
$body = "Hi, This is email to change your password:
        http://localhost/Helperland/forgotpassword.php";
$headers = "From: receiver@email.com";

if (mail($to_email, $subject, $body, $headers)) {
    echo "Email successfully sent to $to_email...";
} else {
    echo "Email sending failed...";
}
?>
