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
            if ($result) {
                $_SESSION['message'] = "Message Has Been Sent Succesfully";
            } else {
                $_SESSION['message'] = "Your Account is not Created Please Try Again.";
            }
            
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
                $base_url_home = "http://localhost/Helperland/#loginmodal";
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
                $base_url_home = "http://localhost/Helperland/#loginmodal";
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
        $base_url = "http://localhost/Helperland/";
        $customer = "http://localhost/Helperland/cust_dashboard";
        $sp = "http://localhost/Helperland/upcoming_service";
        
        if(isset($_POST['submit'])){

            if(($_POST['email'] == "") || ($_POST['password'] == "")){
                
                $base_url ="http://localhost/Helperland/includes/error";
                header('Location:' . $base_url);
                
            } else{
                
                $email = $_POST['email'];
                $password = $_POST['password'];
                $row = $this->model->login($email,$password);
                $userid = $row['UserId'];
                $usertypeid = $row['UserTypeId'];
        
               if($row){
                    if($usertypeid == 1){
                       $_SESSION['name'] = $row['FirstName'];
                       $_SESSION['id'] = $row['UserId'];
                       $userid = $row['UserId'];
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
                     unset($_SESSION['name']);
        }

                
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
                    if($result){
                        // echo '<script>
                        // alert("Password Updated Please Relogin");
                        // </script>';
                        $_SESSION['msg'] = "Password Updated Please Relogin";
                        header('Location: http://localhost/Helperland/' );
                    } else{
                        echo '<script>
                        alert("Some error occured....");
                        </script>';
                        header('Location: http://localhost/Helperland/forgotpassword' );
                    }
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

    public function checkcode()
    {   
        if(isset($_POST)){
               $code = $_POST['code'];
               
               $result = $this->model->checkcode($code);
               if($result == 1){
                  echo json_encode('Yes');
               } else{
                  echo json_encode('No');
               }
        }   
           
    }

    public function addadress()
    {
        if(isset($_POST)){
           $userid = $_POST['userid'];
           $street = $_POST['street'];
           $house = $_POST['houseno'];
           $zip = $_POST['zip']; 
           $city = $_POST['city']; 
           $mobile = $_POST['mobile']; 
           $address = [
               'userid' => $userid,
               'street' => $street,
               'house' => $house,
               'zip' => $zip,
               'city' => $city,
               'mobile' => $mobile,
           ];
           $result = $this->model->addadress($address);
           if($result){
               echo json_encode('Yes');
           } else{
               echo json_encode('No');
           }
       } 
    }

    public function showaddress()
    {
        if(isset($_POST)){
            $userid = $_POST['id'];
            $result = $this->model->showaddress($userid);
            if($result){
                
                foreach($result as $row){
                    $street = $row['AddressLine1'];
                    $house = $row['AddressLine2'];
                    $address = $row['AddressId'];
                    $userid = $row['UserId'];
                    $city = $row['City'];
                    $zip = $row['zip'];
                    $mobile = $row['Mobile'];
                    $output = '<div class="card mt-3 addcard">
                    <div class="card-text">
                    
                    <input type="radio" name="radio" id="address_id" value="'.$address.'" required> <span class="font-weight-bold ml-2"> Address :</span>
                    <span id="addressline1">'.$street.'</span>&nbsp;<span id="addressline2">'.$house.'</span>  
                    <span></span> <br>
                    <span class="font-weight-bold ml-4"> Phone Number :</span>
                    <span  id="mobile">'.$mobile.'</span>
                    
                    </div>   
                </div>';
    
                    echo ($output);
                   
                }
            }
            
        }
             
        
    }

    public function booking()
    {
        if(isset($_POST)){
            $userid = $_POST['userid'];
            $code = $_POST['zip'];
            $date = $_POST['date'];
            $total_hour = $_POST['totalhours'];
            $extra_hour = $_POST['extrahour'];
            $hour_rate = $_POST['hour_rate'];
            $payment = $_POST['payment'];
            $status = $_POST['status'];
            $discount = $_POST['discount'];
            $totalcost = $payment + $discount;
            $address_id = $_POST['addressId'];
            $service_id =  rand(100,1000);
            $array = [
                'userid' => $userid,
                'code' => $code,
                'date' => $date,
                'payment' => $payment,
                'total_hour' => $total_hour,
                'hour_rate' => $hour_rate,
                'extra_hour' => $extra_hour,
                'status' => $status,
                'discount' => $discount,
                'totalcost' => $totalcost,
                'addressId' => $address_id,
                'service_id' =>$service_id,
                
            ];
            $result = $this->model->booking($array);
            if($result){
                echo ($service_id);
            } else{
                echo ('No');
            }
        }
    }

    public function dashboard()
    {
       if(isset($_POST)){
            $userid = $_POST['id'];
            $rest = $this->model->dashboard_details($userid);
            if($rest){
                foreach($rest as $row){
                    $req_Id = $row['ServiceRequestId'];
                    $serviceid= $row['ServiceId'];
                    $servicedate = $row['ServiceDate'];
                    $servicehour = $row['ServiceHours'];
                    $payment = $row['TotalCost'];
                    $count = count($rest);
                    $output = '<tr id="unique-'.$req_Id.'" name="'.$req_Id.'">
                    <td data-toggle="modal" data-target="#servicedetailsmodal"> '.$serviceid.' 
                    </td>
                    <td data-toggle="modal" data-target="#servicedetailsmodal"><img src="./assets/image/calendar.png" alt="calender"> '.$servicedate.' <br>
                    <img src="./assets/image/layer-712.png" alt="clock"> '.$servicehour.' hrs.
                    </td>
                    <td>
                        
                    </td>
                    <td data-toggle="modal" data-target="#servicedetailsmodal">
                    
                    <i class="fas fa-dollar-sign"></i><span>'.$payment.'</span>
                    </td>
                    <td>
                      <button class="btn text-light reschedule-btn" data-toggle="modal" data-target="#reschedulemodal" style="border-radius : 20px; background-color : blue !important">Reschedule</button>
                      &nbsp;&nbsp;
                      <button class="btn text-light cancel-btn" id="cancel" data-toggle="modal" data-target="#cancelmodal" style="border-radius : 20px; background-color : rgb(238, 48, 80) !important">Cancel</button>
                      <input type="hidden" id="records" value="'.$count.'">
                    </td>
                </tr>
                ';
    
                echo $output;
                }
            }
        }
    }
    public function history()
    {
        if(isset($_POST)){
            $userid = $_POST['id'];
            $result = $this->model->history($userid);
            if($result){
                foreach($result as $row){
                    $serviceid = $row['ServiceRequestId'];
                    $servicestatus= $row['Status'];
                    $servicedate = $row['ServiceDate'];
                    $servicehour = $row['ServiceHours'];
                    $payment = $row['TotalCost'];
                    $count = count($result);
                    $output = '<tr name="'.$serviceid.'">
                    
                    <td>
                    
                    <img src="./assets/image/calendar.png" alt="calender"> '.$servicedate.' <br>
                    <img src="./assets/image/layer-712.png" alt="clock"> '.$servicehour.' hrs.
                    </td>
                    <td>
                        
                    </td>
                    <td>
                    <i class="fas fa-dollar-sign"></i><span>'.$payment.'</span>
                    </td>
                    <td>
                      <h6 class="text-dark font-weight-bold">'.$servicestatus.'</h6>
                      
                    </td>
                    <td class="rate" id="'.$serviceid.'">
                      <a href="#" data-toggle="modal" data-target="#ratingmodal">
                      <button class="btn btn-primary rating">RateSP</button>
                      <input type="hidden" id="records" value="'.$count.'"></a>
                      
                    </td>
                </tr>
                ';
    
                echo $output;
    
                }
            }
        }  
    }

    public function userdetails()
    {
        if(isset($_POST)){
            $userid = $_POST['id'];
            $result = $this->model->user_details($userid);
            if($result){
                foreach($result as $row){
                    $fname =  $row['FirstName'];
                    $lname =  $row['LastName'];
                    $email =  $row['Email'];
                    $mobile =  $row['Mobile'];
                    $dob = $row['DateOfBirth'];
                    $languageId = $row['LanguageId'];
                    $result = [$fname, $lname, $email, $mobile,$dob,$languageId];
    
                    echo json_encode($result);
                }
            }
        }
    }
    public function showuseraddress()
    {
        if(isset($_POST)){
            $userid = $_POST['id'];
            $result = $this->model->showuseraddress($userid);
            if($result){
                
                foreach($result as $row){
                    $street = $row['AddressLine1'];
                    $house = $row['AddressLine2'];
                    $address = $row['AddressId'];
                    $userid = $row['UserId'];
                    $city = $row['City'];
                    $zip = $row['zip'];
                    $mobile = $row['Mobile'];
                    $output = '<div class="card-text mt-3 mb-3">
                    <div class="row">
                        <div class="col-md-2 text-center">
                             <input type="radio" name="radio" id="address_id" value="'.$address.'" required>
                        </div>
                        <div class="col-md-7">
                          <span class="font-weight-bold"> Address : </span>
                          <span id="addressline1">'.$street.'</span>&nbsp;<span id="addressline2">'.$house.'</span>  
                          <span></span><br>
                          <span class="font-weight-bold"> Phone Number : </span>
                          <span  id="mobile">'.$mobile.'</span> 
                          
                          
                        </div>
                        <div class="col-md-1 mt-3">
                             <a href="#" data-toggle="modal" data-target="#editmodal"  id="edit">
                                  <img src="./assets/image/edit-icon.png" alt="edit">
                             </a> 
                        </div>
                        <div class="col-md-1 mt-3">
                            <input type="hidden" id="addressid" value="'.$address.'">
                             <a href="#" data-toggle="modal" data-target="#deletemodal">
                                  <img src="./assets/image/delete-icon.png" alt="delete">
                             </a>    
                        </div>
                    </div>
                       
                </div>';
    
                    echo ($output);
                   
                }
            }
        }
             
        
    }

    public function changepassword()
    {
        if(isset($_POST))
        {
            $userid = $_POST['id'];
            $oldpwd = $_POST['oldpwd'];
            $newpwd = $_POST['newpwd'];
            $conpwd = $_POST['conpwd'];
            

            $result = $this->model->updatepassword($userid,$newpwd,$oldpwd);
            if($result == 1){
                echo 1;
            } else{
                echo 0;
            }
        }

    }

    public function updateinfo()
    {
        if(isset($_POST))
        {
            $userid = $_POST['id'];
            $fname = $_POST['fname'];
            $lname = $_POST['lname'];
            $mobile = $_POST['mobile'];
            $dob = $_POST['dob'];
            $languageid = $_POST['languageid'];

            $array = [
                 'id' => $userid,
                 'fname' => $fname,
                 'lname' => $lname,
                 'mobile' => $mobile,
                 'dob' => $dob,
                 'languageid' => $languageid,
            ];

            $result = $this->model->updateinfo($array);
            if($result == 1){
                echo 1;
            } else{
                echo 0;
            }

        }
    }

    public function deleteaddress()
    {
        if(isset($_POST)){
            $userid = $_POST['id'];
            $count = $this->model->deleteaddress($userid);
            if($count == 1){
                echo 1;
            } else{
                echo 0;
            }
        }
    }
    public function editaddress()
    {
        if(isset($_POST)){
            $userid = $_POST['id'];
            $result = $this->model->editaddress($userid);
            if($result){
                
                foreach($result as $row){
                    $street = $row['AddressLine1'];
                    $house = $row['AddressLine2'];
                    $city = $row['City'];
                    $zip = $row['zip'];
                    $mobile = $row['Mobile'];
                    
                    $output = '<div class="row">
                    <div class="col-md-6">
                        <div class="form-field">
                             <label class="text-secondary font-weight-bold">Street Name</label>
                             <input type="text" class="form-control" value="'.$street.'" id="street-name">
                        </div><br>
                        <div class="forem-field">
                              <label class="text-secondary font-weight-bold">Postal Code</label>
                              <input type="number" class="form-control" value="'.$zip.'" 
                              id="postal-code">
                        </div><br>
                        <div class="form-field">
                              <label class="text-secondary font-weight-bold">Phone Number</label>
                              <input type="number" class="form-control" value="'.$mobile.'" id="phone-no">
                        </div>
                        
                    </div>
                    <div class="col-md-6">
                      <div class="form-field">
                             <label class="text-secondary font-weight-bold">House number</label>
                             <input type="text" class="form-control" value="'.$house.'" id="house-no">
                        </div><br>
                        <div class="form-field">
                             <label class="text-secondary font-weight-bold">City</label>
                             <input type="text" class="form-control" value="'.$city.'" id="city-name">
                        </div><br>
                    </div>
                    
                </div>';
                   
                    echo ($output);
                    
                }
            }
            
        }
    }
    public function updateaddress()
    {
        if(isset($_POST)){
            $addressid = $_POST['id'];
            $street = $_POST['sname'];
            $houseno = $_POST['houseno'];
            $zipcode = $_POST['zipcode'];
            $city = $_POST['city'];
            $mobile = $_POST['mobile'];

            $array = [
                 'id' => $addressid,
                 'sname' => $street,
                 'house' => $houseno,
                 'zip' => $zipcode,
                 'city' => $city,
                 'mobile' => $mobile,
            ];

            $rest = $this->model->updateaddress($array);
            if($rest == 1){
                echo 1;
            } else{
                echo 0;
            }
            
        }
    }

    public function rating()
    {
        if(isset($_POST))
        {
            $id = $_POST['id'];
            $reqid = $_POST['servicereqid'];
            $info1 = $_POST['info1'];
            $info2 = $_POST['info2'];
            $info3 = $_POST['info3'];
            $total = $_POST['total_rating'];
            $comment = $_POST['comment'];
            $array = [
                'id' => $id,
                'serviceid' => $reqid,
                'info1' => $info1,
                'info2' => $info2,
                'info3' => $info3,
                'total' => $total,
                'comment' => $comment,
                'ratingdate' => date('Y-m-d H:i:s'),
            ];
            $result = $this->model->rating($array);
            if($result){
                echo '1';
            } else {
                echo '0';
            }
        }
    }

    public function bookingdetails()
    {
        if(isset($_POST))
        {
            $servicereqid = $_POST['servicereqid'];
            $result = $this->model->bookingdetails($servicereqid);
            if($result){
                foreach($result as $row){
                    $serviceid= $row['ServiceId'];
                    $date = $row['ServiceDate'];
                    $netamont = $row['SubTotal'];
                    $duration = $row['ServiceHours'];
                    $extra = $row['ExtraHours'];
                    $email = $row['Email'];
                    $mobile = $row['Mobile'];
                    $address_1 = $row['AddressLine1'];
                    $address_2 = $row['AddressLine2'];
    
                    if($extra == 0.5)
                    {
                        $extra_things = 1;
                    } 
                    else if($extra == 1)
                    {
                        $extra_things = 2;
                    }
                    else if($extra == 1.5)
                    {
                        $extra_things = 3;
                    }
                    else if($extra == 2)
                    {
                        $extra_things = 4;
                    } 
                    else if($extra == 2.5)
                    {
                        $extra_things = 5;
                    }
                    else
                    {
                        $extra_things = 0;
                    }
    
                    $output = '<h2>'.$date.'</h2>
                    <span class="text-secondary font-weight-bold">Duration : </span>&nbsp; <span>'.$duration.' hrs.</span>
                    <hr>
                    <span class="text-secondary font-weight-bold">Service Id :</span>&nbsp;<span>'.$serviceid.'</span>
                    <br>
                    <span class="text-secondary font-weight-bold">Extra Items :</span>&nbsp;<span>'.$extra_things.'</span>
                    <br>
                    <span class="text-secondary font-weight-bold">Net Amount :</span>&nbsp;<i class="fas fa-dollar-sign"></i><span class="text-dark font-weight-bold">'.$netamont.'</span>
                    <br>
                    <hr>
                    <span class="text-secondary font-weight-bold"> Service Address :</span>&nbsp;<span>'.$address_1.'</span>&nbsp;<span>'.$address_2.'</span>
                    <br>
                    <span class="text-secondary font-weight-bold">Billing Addres :</span> Same as Service Address<span></span>
                    <br>
                    <span class="text-secondary font-weight-bold">Mobile No. :</span>&nbsp;<span>'.$mobile.'</span>
                    <br>
                    <span class="text-secondary font-weight-bold">Email :</span>&nbsp;<span>'.$email.'</span>
                    <br>
                    <hr>
                    <p class="text-secondary font-weight-bold">Comments</p>
                    <span>I do not Have Pets at home.</span>
                    <hr>
                    <button class="btn btn-primary mr-2" style="border-radius : 20px; background-color : blue !important">Reschedule</button>
                    <button class="btn text-light" style="border-radius : 20px; background-color :   rgb(238, 48, 80)!important">Cancel</button>';
    
                    echo($output);
                }
            }
        }
    }

    public function cancelrequest()
    {
        if(isset($_POST))
        {
            $servicereqid = $_POST['servicereqid'];
            $issue = $_POST['issue'];
            $rest = $this->model->cancelrequest($servicereqid,$issue);
            if($rest == 1){
                echo 1;
            } else{
                echo 0;
            }
        }
    }
    public function reschedulerequest()
    {
        if(isset($_POST))
        {
            $servicereqid = $_POST['servicereqid'];
            $newdate = $_POST['newdate'];
            $rest = $this->model->reschedulerequest($servicereqid,$newdate);
            if($rest == 1){
                echo ($servicereqid);
            } else{
                echo 0;
            }
        }
    }
}

