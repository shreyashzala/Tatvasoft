<?php
class Helperland
{

    /* Creates database connection */
    public function __construct()
    {

        $db_host = "localhost";
        $db_user = "root";
        $db_password = "";
        $db_name = "helperland";
      
      //   Create Connection
         $this->conn = mysqli_connect($db_host,$db_user,$db_password,$db_name);
      
      // Checking Connection
         if($this->conn-> connect_error) {
             die('Connection Failed');
        }
    }

    public function ContactUs($array)
    {
         $name = $array['name'];
         $email = $array['email'];
         $sub = $array['sub'];
         $mobile = $array['mobile'];
         $msg = $array['msg'];
            $sql = "INSERT INTO contactus (Name , Email , Subject , PhoneNumber , Message)
            VALUES ('$name' ,'$email','$sub','$mobile','$msg')";
            $result =mysqli_query($this->conn, $sql);
            return $result;
           
            if ($result = 'yes') {
                $_SESSION['message'] = "Message Has Been Sent Succesfully";
            } else {
                $_SESSION['message'] = "Your Account is not Created Please Try Again.";
            }
            return $_SESSION['message'];

            
    }

}
?>
