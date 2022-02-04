<?php
class HelperlandController
{
    function __construct()
    {
        include('Models/Connection.php');
        $this->model = new Helperland();
        session_start();
        //  $_SESSION['message'] = '';
    }
    public function HomePage()
    {
        
        include("./Views/home.php");
    }
    
    public function ContactUs()
    {
        
        if (isset($_POST)) {

            $base_url = "http://localhost/Helperland/contact";
            $mobile =  $_POST['mobile'];
            $email = $_POST['email'];
            $subject = $_POST['sub'];
            $message = $_POST['message'];
            $name = $_POST['firstname'] . " " . $_POST['lastname'];
            $array = [
                'name' => $name,
                'email'=> $email,
                'mobile' => $mobile,
                'sub' => $subject,
                'msg'=> $message,
                'creationdt' => date('Y-m-d H:i:s'),
                'status' => 'success',
                'priority' => 4,
            ];
            $result = $this->model->Contactus($array);
            $_SESSION['message'] = $msg;
            header('Location:' . $base_url);
           
            
        }
    }

    public function register()
    {
         
        if(isset($_POST['submit'])){

            if(($_POST['fname'] == "") || ($_POST['lname'] == "")
            || ($_POST['mobile'] == "") || ($_POST['email'] == "") || ($_POST['password'] == "") || ($_POST['c_password'] == "")){
                
                $base_url ="http://localhost/Helperland/includes/error";
                header('Location:' . $base_url);
                
            }else{
                $base_url_home = "http://localhost/Helperland/";
                $firstname = $_POST['fname'];
                $lastname = $_POST['lname'];
                $mobile = $_POST['mobile'];
                $password = $_POST['password'];
                $confirm = $_POST['c_password'];
                $usertype = 1;
                $token = bin2hex(random_bytes(15));
                $email = $_POST['email'];
                $count = $this->model->EmailExists($email);
                if($password == $confirm){
                    if($count == 0){
                    $register = [
                        'firstname' => $firstname,
                        'lastname'  => $lastname,
                        'email' => $email,
                        'mobile' => $mobile,
                        'password' => $password,
                        'UserTypeId' => $usertype,
                        'token' => $token,
                    ];
                    $result = $this->model->register($register);
                    $_SESSION['email'] = $email;
                    header('Location:' . $base_url_home);
                  } else{
                    $base_url_email ="http://localhost/Helperland/includes/email";
                    header('Location:' . $base_url_email);
                  }
                } else{
                    $base_url_pass ="http://localhost/Helperland/includes/password";
                    header('Location:' . $base_url_pass);
                }
            }   
        }
       
    }

    public function registerSP()
    {
         
        if(isset($_POST['submit'])){

            if(($_POST['fname'] == "") || ($_POST['lname'] == "")
            || ($_POST['mobile'] == "") || ($_POST['email'] == "") || ($_POST['password'] == "") || ($_POST['c_password'] == "")){
                
                $base_url ="http://localhost/Helperland/includes/error";
                header('Location:' . $base_url);
                
            }else{
                $base_url_home = "http://localhost/Helperland/";
                $firstname = $_POST['fname'];
                $lastname = $_POST['lname'];
                $mobile = $_POST['mobile'];
                $password = $_POST['password'];
                $confirm = $_POST['c_password'];
                $usertype = 2;
                $token = bin2hex(random_bytes(15));
                $email = $_POST['email'];
                $count = $this->model->EmailExists($email);
                if($password == $confirm){
                    if($count == 0){
                    $register = [
                        'firstname' => $firstname,
                        'lastname'  => $lastname,
                        'email' => $email,
                        'mobile' => $mobile,
                        'password' => $password,
                        'UserTypeId' => $usertype,
                        'token' => $token,
                    ];
                    $result = $this->model->register($register);
                    header('Location:' . $base_url_home);
                  } else{
                    $base_url_email ="http://localhost/Helperland/includes/email";
                    header('Location:' . $base_url_email);
                  }
                } else{
                    $base_url_pass ="http://localhost/Helperland/includes/password";
                    header('Location:' . $base_url_pass);
                }
            }   
        }
       
    }
    
    public function login()
    {
        if(isset($_POST['submit'])){

            if(($_POST['email'] == "") || ($_POST['password'] == "")){
                
                $base_url ="http://localhost/Helperland/includes/error";
                header('Location:' . $base_url);
                
            } else{
                $base_url ="http://localhost/Helperland/includes/login";
                $email = $_POST['email'];
                $password = $_POST['password'];

                $result = $this->model->login($email,$password);
                
            }
        }
    
    }

    public function forgotpass()
    {
        if(isset($_POST['submit'])){
            if($_POST['email'] == ""){
                     echo '<script>
                      alert("Fill all Details");
                      </script>';
            } else{
                $email = $_POST['email'];
                $count = $this->model->EmailExists($email);
                if($count == 1){
                    $_SESSION['email'] = $email;

                    // with Mail

                    // include("./Views/mail.php");

                    // Without Mail

                    header('Location: http://localhost/Helperland/forgotpassword' );

                } else{
                    echo '<script>
                    alert("Invalid Email Address");
                    </script>';
                }
            }
        }
    }

    public function resetpass()
    {
        if(isset($_POST['submit'])){
            if(($_POST['n_password'] == "") || ($_POST['c_password'] == "")){
                echo '<script>
                    alert("fill details");
                    </script>';
            } else{
                $email = $_POST['email'];
                $newpass = $_POST['n_password'];
                $confirmpass = $_POST['c_password'];
                if($newpass == $confirmpass){

                    $result = $this->model->resetpass($email , $newpass);
                } else{
                    echo '<script>
                    alert("Password does not match");
                    </script>';
                }
            }
        }
    }

    public function logout()
    {
        $base_url = "http://localhost/Helperland/";
        session_destroy();
        header('Location:' . $base_url);

    }

}
