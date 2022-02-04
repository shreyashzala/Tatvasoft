<?php
class Helperland
{

    /* Creates database connection */
    public function __construct()
    {

        try {
            /* Properties */
            $dsn = 'mysql:dbname=helperland;host=localhost';
            $user = 'root';
            $password = '';
            $this->conn = new PDO($dsn, $user, $password);
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "";
            die();
        }
    }

    public function ContactUs($array)
    {
        $sql = "INSERT INTO contactus (Name , Email , Subject , PhoneNumber , Message , CreatedOn , Status , Priority )
        VALUES (:name ,  :email , :sub , :mobile , :msg , :creationdt , :status , :priority )";
        $stmt =  $this->conn->prepare($sql);
        $result = $stmt->execute($array);
        return $result;

        if ($result) {
            $_SESSION['message'] = "Message Has Been Sent Succesfully";
        } else {
            $_SESSION['message'] = "Your Account is not Created Please Try Again.";
        }
        return $_SESSION['message'];
            
    }

    public function register($register)
    {
        
        $sql = "INSERT INTO user (FirstName,LastName,Email,Password,Mobile ,UserTypeId,token)
        VALUES ( :firstname, :lastname, :email, :password, :mobile, :UserTypeId,:token)";
        $stmt1 =  $this->conn->prepare($sql);
        $row = $stmt1->execute($register);
        return $row;
    }

    public function login($email,$password)
    {
        $base_url = "http://localhost/Helperland/";
        $customer = "http://localhost/Helperland/service_history";
        $sp = "http://localhost/Helperland/upcoming_service";
        

        $sql = "SELECT * FROM user WHERE Email = '$email' AND Password = '$password' ";
        $stmt =  $this->conn->prepare($sql);
        $stmt->execute();
        $row  = $stmt->fetch(PDO::FETCH_ASSOC);
        $count = $stmt->rowCount();
        $usertypeid = $row['UserTypeId'];
        
        if($count == 1){
            if($usertypeid == 1){
                $_SESSION['name'] = $row['FirstName'];
                header('Location:' . $customer);
            }else if($usertypeid == 2){
                $_SESSION['name'] = $row['FirstName'];
                header('Location:' . $sp);
            } else{
                echo "Admin";
            }
        } else{
            $_SESSION['name'] = "Invalid details";
            header('Location:' . $base_url);
        }
 
    }

    public function EmailExists($email)
    {
        $sql = "select * from user where Email = '$email'";
        $stmt =  $this->conn->prepare($sql);
        $stmt->execute();
        $count = $stmt->rowCount();
        return $count;
    }

    public function resetpass($email, $newpass)
    {
        $sql = "UPDATE user SET Password = '$newpass' WHERE Email = '$email'";
        $stmt =  $this->conn->prepare($sql);
        $stmt->execute();

        if($stmt){
 
            $_SESSION['msg'] = "Password Updated Please Relogin";
            header('Location: http://localhost/Helperland/' );
        } else{
            echo '<script>
            alert("Some error occured....");
            </script>';
            header('Location: http://localhost/Helperland/forgotpassword' );
        }
    }

}
?>
