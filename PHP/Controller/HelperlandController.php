<?php
class HelperlandController
{
    function __construct()
    {
        include('Models/Connection.php');
        $this->model = new Helperland();
        
        // session_start();
        // $_SESSION['error'] = '';
    }
    public function HomePage()
    {
        // echo "in";
        // exit;
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
            ];
            $result = $this->model->Contactus($array);
            $_SESSION['firstname'] = $results[0];
            header('Location:' . $base_url);
            
        }
    }
    
    
}
