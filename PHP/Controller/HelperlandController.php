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
                        'CreatedDate' => date('Y-m-d'),
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
                        'CreatedDate' => date('Y-m-d'),
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
        $base_url ="http://localhost/Helperland/#loginmodal";
        $customer = "http://localhost/Helperland/cust_dashboard";
        $sp = "http://localhost/Helperland/sp_upcoming_service";
        $admin = "http://localhost/Helperland/admin_service_request";
        
        if(isset($_POST['submit'])){

            if(($_POST['email'] == "") || ($_POST['password'] == "")){

                $_SESSION['err'] = '<p class="alert alert-warning">fill all details</p>';
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
                        $_SESSION['id'] = $row['UserId'];
                        $_SESSION['active'] = $row['IsActive'];
                        if($_SESSION['active'] == 1){
                            $_SESSION['err'] = '<p class="alert alert-warning">Your Account is Inactive</p>';
                            header('Location:' . $base_url);
                        } else{
                             header('Location:' . $sp);
                        }
                        
               } else{
                        
                        $_SESSION['name'] = $row['FirstName'];
                        $_SESSION['id'] = $row['UserId'];
                        header('Location:' . $admin);
                }
            } else{
                     $_SESSION['err'] = '<p class="alert alert-warning">Invalid details</p>';
                     header('Location:' . $base_url);
                     
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
            $time = $_POST['stime'];
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
                'servicestarttime' => $time,
                
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
                    $stime = $row['ServiceStartTime'];
                    $endtime = intval($stime)  + $servicehour;
                    if($endtime >= 12){
                        $pm = 1;
                        $dummy = $endtime - 12;
                        $var1 = intval($dummy);
                        $min = $dummy - $var1;
                          if($min == 0.5){
                              $min = 30;
                          } else{
                              $min = 00;
                          }
                        
                    } else{
                        $pm = 0;
                        $dummy = $endtime;
                        $var1 = intval($dummy);
                        $min = $dummy - $var1;
                          if($min == 0.5){
                              $min = 30;
                          } else{
                              $min = 00;
                          }
                    }

                    if($pm == 1){
                        $var2 = "PM";
                    } else{
                        $var2 = "AM";
                    }
                    
                    

                    
                    $output = '<tr id="unique-'.$req_Id.'" name="'.$req_Id.'">
                    <td data-toggle="modal" data-target="#servicedetailsmodal"> '.$serviceid.' 
                    </td>
                    <td data-toggle="modal" data-target="#servicedetailsmodal"><img src="./assets/image/calendar.png" alt="calender"> '.$servicedate.' <br>
                    <img src="./assets/image/layer-712.png" alt="clock"> '.$stime.'-'.$var1.':'.$min.' '.$var2.'
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
                </tr>';
                
                echo ($output);
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
                    $servicereqid = $row['ServiceRequestId'];
                    $servicestatus= $row['Status'];
                    $servicedate = $row['ServiceDate'];
                    $servicehour = $row['ServiceHours'];
                    $payment = $row['TotalCost'];
                    $spname = $row['ServiceProviderId'];
                    $count = count($result);
                    $stime = $row['ServiceStartTime'];
                    $endtime = intval($stime)  + $servicehour;
                    if($endtime >= 12){
                        $pm = 1;
                        $dummy = $endtime - 12;
                        $var1 = intval($dummy);
                        $min = $dummy - $var1;
                          if($min == 0.5){
                              $min = 30;
                          } else{
                              $min = 00;
                          }
                        
                    } else{
                        $pm = 0;
                        $dummy = $endtime;
                        $var1 = intval($dummy);
                        $min = $dummy - $var1;
                          if($min == 0.5){
                              $min = 30;
                          } else{
                              $min = 00;
                          }
                    }

                    if($pm == 1){
                        $var2 = "PM";
                    } else{
                        $var2 = "AM";
                    }

                    if(($spname != '') && ($servicestatus == "Completed")){
                        $sp_name = $this->model->GetSP($servicereqid);
                        $rating = $this->model->GetRating($spname);

                        $full_rating = ceil($rating);

                        if($full_rating == 1){
                            $rate = '<i class="fa fa-star" style="color:yellow !important;"></i>
                            <i class="fa fa-star" style="color:rgb(207, 196, 196) !important;"></i>
                            <i class="fa fa-star" style="color:rgb(207, 196, 196) !important;"></i>
                            <i class="fa fa-star" style="color:rgb(207, 196, 196) !important;"></i>
                            <i class="fa fa-star" style="color: rgb(207, 196, 196) !important;"></i>';
                        } else if($full_rating == 2){
                            $rate = '<i class="fa fa-star" style="color:yellow !important;"></i>
                            <i class="fa fa-star" style="color:yellow !important;"></i>
                            <i class="fa fa-star" style="color:rgb(207, 196, 196) !important;"></i>
                            <i class="fa fa-star" style="color:rgb(207, 196, 196) !important;"></i>
                            <i class="fa fa-star" style="color: rgb(207, 196, 196) !important;"></i>';
                        } else if($full_rating == 3){
                            $rate = '<i class="fa fa-star" style="color:yellow !important;"></i>
                            <i class="fa fa-star" style="color:yellow !important;"></i>
                            <i class="fa fa-star" style="color:yellow !important;"></i>
                            <i class="fa fa-star" style="color:rgb(207, 196, 196) !important;"></i>
                            <i class="fa fa-star" style="color: rgb(207, 196, 196) !important;"></i>';
                        } else if($full_rating == 4){
                            $rate = '<i class="fa fa-star" style="color:yellow !important;"></i>
                            <i class="fa fa-star" style="color:yellow !important;"></i>
                            <i class="fa fa-star" style="color:yellow !important;"></i>
                            <i class="fa fa-star" style="color:yellow !important;"></i>
                            <i class="fa fa-star" style="color: rgb(207, 196, 196) !important;"></i>';
                        } else  {
                            $rate = '<i class="fa fa-star" style="color:yellow !important;"></i>
                            <i class="fa fa-star" style="color:yellow !important;"></i>
                            <i class="fa fa-star" style="color:yellow !important;"></i>
                            <i class="fa fa-star" style="color:yellow !important;"></i>
                            <i class="fa fa-star" style="color:yellow !important;"></i>';
                        }
                   } else {
                       $sp_name = '';
                       $rating = '';
                       $rate = '';
                   }

                   if($servicestatus == 'Completed'){
                       $modal = '<a href="#" data-toggle="modal" data-target="#ratingmodal">
                       <button class="btn btn-primary rating">RateSP</button>';
                   } else {
                       $modal = '
                       <button class="btn btn-primary rating disabled">RateSP</button>';
                   }
                    $output = '<tr name="'.$servicereqid.'">
                    
                    <td>
                    
                    <img src="./assets/image/calendar.png" alt="calender"> '.$servicedate.' <br>
                    <img src="./assets/image/layer-712.png" alt="clock"> '.$stime.'-'.$var1.':'.$min.' '.$var2.'
                    </td>
                    <td class="spname">
                        '.$sp_name.' <br> '.$rate.'
                    </td>
                    <td>
                    <i class="fas fa-dollar-sign"></i><span>'.$payment.'</span>
                    </td>
                    <td>
                      <h6 class="text-dark font-weight-bold">'.$servicestatus.'</h6>
                      <input type="hidden" id="records" value="'.$count.'"></a>
                      
                    </td>
                    <td class="rate" name="'.$servicereqid.'">
                       '.$modal.'
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

    public function spname()
    {
        if(isset($_POST))
        {
            $sp_id = $_POST['id'];
            $result = $this->model->spname($sp_id);
            echo $result;
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

            $check_rating = $this->model->check_rating($reqid);

            if($check_rating == 1){
                echo '2';
            } else{
                $result = $this->model->rating($array);
                if($result){
                    echo '1';
                } else {
                    echo '0';
                }
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
            $newtime = $_POST['newtime'];
            $rest = $this->model->reschedulerequest($servicereqid,$newdate,$newtime);
            if($rest == 1){
                echo ($servicereqid);
            } else{
                echo 0;
            }
        }
    }

    public function newrequest()
    {
        if(isset($_POST))
        {
            $sp_id = $_POST['id'];
            $result = $this->model->newrequest($sp_id);
            if($result){
                foreach($result as $row){
                    $servicereqid = $row['ServiceRequestId'];
                    $serviceid = $row['ServiceId'];
                    $date = $row['ServiceDate'];
                    $hour = $row['ServiceHours'];
                    $fname = $row['FirstName'];
                    $lname = $row['LastName'];
                    $address_1 = $row['AddressLine1'];
                    $address_2 = $row['AddressLine2'];
                    $payment = $row['TotalCost'];
                    $sp_id  = $row['ServiceProviderId'];
                    $count = count($result);
                    $stime = $row['ServiceStartTime'];
                    $endtime = intval($stime)  + $hour;
                    if($endtime >= 12){
                        $pm = 1;
                        $dummy = $endtime - 12;
                        $var1 = intval($dummy);
                        $min = $dummy - $var1;
                          if($min == 0.5){
                              $min = 30;
                          } else{
                              $min = 00;
                          }
                        
                    } else{
                        $pm = 0;
                        $dummy = $endtime;
                        $var1 = intval($dummy);
                        $min = $dummy - $var1;
                          if($min == 0.5){
                              $min = 30;
                          } else{
                              $min = 00;
                          }
                    }

                    if($pm == 1){
                        $var2 = "PM";
                    } else{
                        $var2 = "AM";
                    }
                    

                    $output ='<tr name="'.$servicereqid.'">
                    <td>'.$serviceid.'</td>
                    <td><img src="./assets/image/calendar2.png" alt=""> '.$date.'<br>
                    <img src="./assets/image/layer-712.png" alt="clock"> '.$stime.'-'.$var1.':'.$min.' '.$var2.'
                    </td>
                    <td>'.$fname.'&nbsp;'.$lname.' <br>
                        <img src="./assets/image/layer-719.png" alt=""> '.$address_1.' &nbsp; '.$address_2.'
                    </td>
                    <td><i class="fas fa-dollar-sign"></i> '.$payment.'</td>
                    <td class="conflict-'.$servicereqid.'"></td>
                    <td>
                    <button class="btn btn-primary open-btn" data-path="'.$date.'" style="background-color : blue !important"
                    data-toggle="modal" data-target="#acceptrequestmodal">Accept</button> 
                    <input type="hidden" id="records" value="'.$count.'">
                    </td>
                </tr>';

                echo ($output);
                }
            }
        }
    }

    public function acceptrequestmodel()
    {
        if(isset($_POST))
        {
            $req_id = $_POST['reqid'];
            $result = $this->model->acceptrequestmodel($req_id);
            if($result){
                foreach($result as $row){
                    $serviceid = $row['ServiceId'];
                    $date = $row['ServiceDate'];
                    $hour = $row['ServiceHours'];
                    $fname = $row['FirstName'];
                    $lname = $row['LastName'];
                    $address_1 = $row['AddressLine1'];
                    $address_2 = $row['AddressLine2'];
                    $payment = $row['TotalCost'];
                    $sp_id  = $row['ServiceProviderId'];
                    $stime = $row['ServiceStartTime'];
                    $endtime = intval($stime)  + $hour;
                    if($endtime >= 12){
                        $pm = 1;
                        $dummy = $endtime - 12;
                        $var1 = intval($dummy);
                        $min = $dummy - $var1;
                          if($min == 0.5){
                              $min = 30;
                          } else{
                              $min = 00;
                          }
                        
                    } else{
                        $pm = 0;
                        $dummy = $endtime;
                        $var1 = intval($dummy);
                        $min = $dummy - $var1;
                          if($min == 0.5){
                              $min = 30;
                          } else{
                              $min = 00;
                          }
                    }

                    if($pm == 1){
                        $var2 = "PM";
                    } else{
                        $var2 = "AM";
                    }


                    

                    $output = '<h2>'.$date.'</h2>
                    <span class="text-secondary font-weight-bold">Duration : </span>&nbsp; <span>'.$stime.'-'.$var1.':'.$min.' '.$var2.'</span>
                    <hr>
                    <span class="text-secondary font-weight-bold">Service Id :</span>&nbsp;<span>'.$serviceid.'</span>
                    <br>
                    <span class="text-secondary font-weight-bold">Net Amount :</span>&nbsp;<i class="fas fa-dollar-sign"></i><span class="text-dark font-weight-bold">'.$payment.'</span>
                    <br>
                    <hr>
                    <span class="text-secondary font-weight-bold">Customer Name :</span> '.$fname.'  '.$lname.'<span></span>
                    <br>
                    <span class="text-secondary font-weight-bold"> Service Address :</span>&nbsp;<span>'.$address_1.'</span>&nbsp;<span>'.$address_2.'</span>
                    <br>
                    
                    <hr>
                    <p class="text-secondary font-weight-bold">Comments</p>
                    <span>I do not Have Pets at home.</span>
                    ';
    
                    echo($output);
                }
            }
        }
    }

    public function acceptrequest()
    {
        if(isset($_POST))
        {
            $req_id = $_POST['reqid'];
            $date = $_POST['date'];
            $sp_id = $_POST['id'];
            $conflict = $this->model->timeconflict($sp_id,$date);
            if($conflict >= 1){
                echo 2;
            } else{
                 $result = $this->model->acceptrequest($req_id,$sp_id);
                  if($result == 1){
                       echo 1;
                  } else {
                       echo 0;
                  } 
            }

            

        }
    }

    public function upcomingservices()
    {
        if(isset($_POST))
        {
            $sp_id = $_POST['id'];
            $result = $this->model->upcomingservices($sp_id);
            if($result){
                foreach($result as $row){
                    $servicereqid = $row['ServiceRequestId'];
                    $serviceid = $row['ServiceId'];
                    $date = $row['ServiceDate'];
                    $hour = $row['ServiceHours'];
                    $fname = $row['FirstName'];
                    $lname = $row['LastName'];
                    $address_1 = $row['AddressLine1'];
                    $address_2 = $row['AddressLine2'];
                    $payment = $row['TotalCost'];
                    $count = count($result);
                    $stime = $row['ServiceStartTime'];
                    $endtime = intval($stime)  + $hour;
                    if($endtime >= 12){
                        $pm = 1;
                        $dummy = $endtime - 12;
                        $var1 = intval($dummy);
                        $min = $dummy - $var1;
                          if($min == 0.5){
                              $min = 30;
                          } else{
                              $min = 00;
                          }
                        
                    } else{
                        $pm = 0;
                        $dummy = $endtime;
                        $var1 = intval($dummy);
                        $min = $dummy - $var1;
                          if($min == 0.5){
                              $min = 30;
                          } else{
                              $min = 00;
                          }
                    }

                    if($pm == 1){
                        $var2 = "PM";
                    } else{
                        $var2 = "AM";
                    }


                    $output ='<tr name="'.$servicereqid.'">
                    <td data-toggle="modal" data-target="#showdatamodal">'.$serviceid.'</td>
                    <td data-toggle="modal" data-target="#showdatamodal"><img src="./assets/image/calendar2.png" alt=""> '.$date.'<br>
                    <img src="./assets/image/layer-712.png" alt="clock"> '.$stime.'-'.$var1.':'.$min.' '.$var2.'
                    </td>
                    <td data-toggle="modal" data-target="#showdatamodal">'.$fname.'&nbsp;'.$lname.' <br>
                        <img src="./assets/image/layer-719.png" alt=""> '.$address_1.' &nbsp; '.$address_2.'
                    </td>
                    <td data-toggle="modal" data-target="#showdatamodal"><i class="fas fa-dollar-sign"></i> '.$payment.'</td>
                    
                    <td>
                    <button class="btn btn-danger cancel-req" name="'.$servicereqid.'">Cancel</button> 
                    <input type="hidden" id="records" value="'.$count.'">
                    </td>
                </tr>';

                echo ($output);
                }
            }
        }
    }

    public function sp_history()
    {
        if(isset($_POST))
        {
            $sp_id = $_POST['id'];
            $result = $this->model->sp_history($sp_id);
            if($result){
                foreach($result as $row){
                    $servicereqid = $row['ServiceRequestId'];
                    $serviceid = $row['ServiceId'];
                    $date = $row['ServiceDate'];
                    $hour = $row['ServiceHours'];
                    $fname = $row['FirstName'];
                    $lname = $row['LastName'];
                    $address_1 = $row['AddressLine1'];
                    $address_2 = $row['AddressLine2'];
                    $payment = $row['TotalCost'];
                    $count = count($result);
                    $stime = $row['ServiceStartTime'];
                    $endtime = intval($stime)  + $hour;
                    if($endtime >= 12){
                        $pm = 1;
                        $dummy = $endtime - 12;
                        $var1 = intval($dummy);
                        $min = $dummy - $var1;
                          if($min == 0.5){
                              $min = 30;
                          } else{
                              $min = 00;
                          }
                        
                    } else{
                        $pm = 0;
                        $dummy = $endtime;
                        $var1 = intval($dummy);
                        $min = $dummy - $var1;
                          if($min == 0.5){
                              $min = 30;
                          } else{
                              $min = 00;
                          }
                    }

                    if($pm == 1){
                        $var2 = "PM";
                    } else{
                        $var2 = "AM";
                    }
                    

                    $output ='<tr name="'.$servicereqid.'">
                    <td>'.$serviceid.'
                    <input type="hidden" id="records" value="'.$count.'">
                    </td>
                    <td><img src="./assets/image/calendar2.png" alt=""> '.$date.'<br>
                       <img src="./assets/image/layer-712.png" alt="clock"> '.$stime.'-'.$var1.':'.$min.' '.$var2.'
                    </td>
                    <td>'.$fname.'&nbsp;'.$lname.' <br>
                        <img src="./assets/image/layer-719.png" alt=""> '.$address_1.' &nbsp; '.$address_2.'
                    </td>
                </tr>';

                echo ($output);
                }
            }
        }
    }

    public function completeservicereq()
    {
        if(isset($_POST))
        {
            $req_id = $_POST['reqid'];
            $result = $this->model->completeservicereq($req_id);
            if($result == 1){
                echo 1;
            } else {
                echo 0;
            }
        }
    }
    public function cancelservicereq()
    {
        if(isset($_POST))
        {
            $req_id = $_POST['reqid'];
            $result = $this->model->cancelservicereq($req_id);
            if($result == 1){
                echo 1;
            } else {
                echo 0;
            }
        }
    }
    public function getallspdetails()
    {
        if(isset($_POST))
        {
            $sp_id = $_POST['id'];
            $result = $this->model->getallspdetails($sp_id);
            if($result){
                foreach($result as $row){
                    $fname = $row['FirstName'];
                    $lname = $row['LastName'];
                    $email = $row['Email'];
                    $mobile = $row['Mobile'];
                    $dob = $row['DateOfBirth'];
                    $nation = $row['NationalityId'];
                    $sname = $row['AddressLine1'];
                    $houseno = $row['AddressLine2'];
                    $code = $row['zip'];
                    $city = $row['City'];
                    $gender = $row['Gender'];
                    $img = $row['UserProfilePicture'];

                    $output = [$fname,$lname,$email,$mobile,$dob,$nation,$sname,$houseno,$code,$city,$gender,$img];

                    echo json_encode($output);
                }
            }
        }
    }

    public function updatespinfo()
    {
        if(isset($_POST))
        {
            $sp_id = $_POST['id'];
            $fname = $_POST['fname'];
            $lname = $_POST['lname'];
            $mobile = $_POST['mobile'];
            $gender = $_POST['gender'];
            $dob = $_POST['dob'];
            $nation = $_POST['nation'];
            $street = $_POST['sname'];
            $houseno = $_POST['houseno'];
            $city = $_POST['city'];
            $code = $_POST['code'];
            $img = $_POST['img'];

            $array1 = [
                'sp_id' => $sp_id,
                'fname' => $fname,
                'lname' => $lname,
                'mobile' => $mobile,
                'dob' => $dob,
                'gender' => $gender,
                'nation' => $nation,
                'code' => $code,
                'img' => $img,
            ];
            $result1 = $this->model->updatespdetails($array1);

            $array2=[
                'sp_id' => $sp_id,
                'sname' => $street,
                'houseno' => $houseno,
                'city' => $city,
                'code' => $code,
            ];
            $result2 = $this->model->updatespaddress($array2);

            if(($result1 == 1) || ($result2 == 1)){
                echo 1;
            } else {
                echo 0;
            }
        }
    }

    public function getuserdetails()
    {
        if(isset($_POST))
        {
            $sp_id = $_POST['id'];
            $result = $this->model->getuserdetails($sp_id);
            if($result){
                foreach($result as $row){
                    $userid = $row['UserId'];
                    $fname = $row['FirstName'];
                    $lname = $row['LastName'];
                    $block = $row['IsBlocked'];
                    if($block == 1){
                        $btn = 'Unblock';
                    } else{
                        $btn = 'Block';
                    }

                    $output = '<div class="col-md-4">
                    <div class="card">
                      <div class="card-text">
                        <div class="text-center mt-3">
                            <img src="assets/image/avatar-hat.png" alt="user">
                        </div>
                        
                        <p class="text-center mt-3 text-secondary font-weight-bold">'.$fname.' '.$lname.'</p>
                        <div class="text-center mt-3 mb-3" name="'.$userid.'">
                           <button class="btn text-light customer" style="background-color:rgb(238, 48, 80); border-radius: 20px;">'.$btn.'</button>
                        </div>
                        
                      </div>
                     </div>
                    
                </div>';

                echo $output;
                }
            }
        }
    }

    public function blockcustomer()
    {
        if(isset($_POST))
        {
            $sp_id = $_POST['id'];
            $userid = $_POST['userid'];
            $result = $this->model->blockcustomer($sp_id,$userid);
            if($result){
                echo 1;
            } else {
                echo 0;
            }
        }
    }
    public function unblockcustomer()
    {
        if(isset($_POST))
        {
            $sp_id = $_POST['id'];
            $userid = $_POST['userid'];
            $result = $this->model->unblockcustomer($sp_id,$userid);
            if($result){
                echo 1;
            } else {
                echo 0;
            }
        }
    }

    public function sprating()
    {
        if(isset($_POST))
        {
            $sp_id = $_POST['id'];
            $result = $this->model->sprating($sp_id);
            if($result){
                foreach($result as $row){
                    $serviceid = $row['ServiceId'];
                    $fname = $row['FirstName'];
                    $lname = $row['LastName'];
                    $date = $row['ServiceDate'];
                    $hour = $row['ServiceHours'];
                    $rating = $row['Ratings'];
                    $comment = $row['Comments'];
                    $stime = $row['ServiceStartTime'];
                    $endtime = intval($stime)  + $hour;
                    if($endtime >= 12){
                        $pm = 1;
                        $dummy = $endtime - 12;
                        $var1 = intval($dummy);
                        $min = $dummy - $var1;
                          if($min == 0.5){
                              $min = 30;
                          } else{
                              $min = 00;
                          }
                        
                    } else{
                        $pm = 0;
                        $dummy = $endtime;
                        $var1 = intval($dummy);
                        $min = $dummy - $var1;
                          if($min == 0.5){
                              $min = 30;
                          } else{
                              $min = 00;
                          }
                    }

                    if($pm == 1){
                        $var2 = "PM";
                    } else{
                        $var2 = "AM";
                    }
 
                    if($rating == 1){
                        $rate = '<i class="fa fa-star" style="color:yellow !important;"></i>
                        <i class="fa fa-star" style="color:rgb(207, 196, 196) !important;"></i>
                        <i class="fa fa-star" style="color:rgb(207, 196, 196) !important;"></i>
                        <i class="fa fa-star" style="color:rgb(207, 196, 196) !important;"></i>
                        <i class="fa fa-star" style="color: rgb(207, 196, 196) !important;"></i>';
                    } else if($rating == 2){
                        $rate = '<i class="fa fa-star" style="color:yellow !important;"></i>
                        <i class="fa fa-star" style="color:yellow !important;"></i>
                        <i class="fa fa-star" style="color:rgb(207, 196, 196) !important;"></i>
                        <i class="fa fa-star" style="color:rgb(207, 196, 196) !important;"></i>
                        <i class="fa fa-star" style="color: rgb(207, 196, 196) !important;"></i>';
                    } else if($rating == 3){
                        $rate = '<i class="fa fa-star" style="color:yellow !important;"></i>
                        <i class="fa fa-star" style="color:yellow !important;"></i>
                        <i class="fa fa-star" style="color:yellow !important;"></i>
                        <i class="fa fa-star" style="color:rgb(207, 196, 196) !important;"></i>
                        <i class="fa fa-star" style="color: rgb(207, 196, 196) !important;"></i>';
                    } else if($rating == 4){
                        $rate = '<i class="fa fa-star" style="color:yellow !important;"></i>
                        <i class="fa fa-star" style="color:yellow !important;"></i>
                        <i class="fa fa-star" style="color:yellow !important;"></i>
                        <i class="fa fa-star" style="color:yellow !important;"></i>
                        <i class="fa fa-star" style="color: rgb(207, 196, 196) !important;"></i>';
                    } else {
                        $rate = '<i class="fa fa-star" style="color:yellow !important;"></i>
                        <i class="fa fa-star" style="color:yellow !important;"></i>
                        <i class="fa fa-star" style="color:yellow !important;"></i>
                        <i class="fa fa-star" style="color:yellow !important;"></i>
                        <i class="fa fa-star" style="color:yellow !important;"></i>';
                    }



                    $output = '<div class="card">
                    <div class="row card-text">
                        <div class="col-md-3 ml-2 mt-2">
                               <p class="text-secondary">'.$serviceid.'</p>
                               <p class="text-secondary font-weight-bold">'.$fname.' '.$lname.'</p>
                        </div>
                        <div class="col-md-3 ml-2 mt-2">
                              <p class="text-secondary font-weight-bold">
                              <img src="./assets/image/calendar2.png" alt="cal">    
                              '.$date.'</p>
                              <p class="text-secondary">
                              <img src="./assets/image/layer-712.png" alt="clock"> '.$stime.'-'.$var1.':'.$min.' '.$var2.'</p>
                        </div>
                        <div class="col-md-5 ml-2 mt-2">
                            <p class="text-center text-secondary font-weight-bold">rating : '.$rating.'</p>
                            <p class="text-center">'.$rate.'</p>
                        </div>
                     </div>
                     <hr>
                     <div class="comment ml-2 mb-2">
                         <a class="text-secondary font-weight-bold" data-toggle="collapse" href="#comment">Customer Comment</a>
                         <div id="comment" class="collapse">
                             <p>'.$comment.'</p>
                         </div>
                     </div>
                    </div>
                    <br>';

                    echo $output;
                }
            }
        }
    }

    public function getAllUserDetails()
    {
        if(isset($_POST))
        {
            $admin_id = $_POST['id'];
            $result = $this->model->getAllUserDetails($admin_id);
            if($result){
                foreach($result as $row){
                    $userid = $row['UserId'];
                    $fname = $row['FirstName'];
                    $lname = $row['LastName'];
                    $mobile = $row['Mobile'];
                    $zipcode = $row['ZipCode'];
                    $date = $row['CreatedDate'];
                    $usertype = $row['UserTypeId'];
                    $active = $row['IsActive'];

                    if($usertype == 1){
                        $user_type = "Customer";
                    } else{
                        $user_type = "Service Provider";
                    }

                    if($active == 0){
                        $status = '<p class="success font-weight-bold text-light text-center" name="'.$userid.'">Active</p>';
                    } else{
                        $status = '<p class="fail font-weight-bold text-light text-center" name="'.$userid.'">Inactive</p>';
                    }

                    $output = '<tr>
                    <td>'.$fname.' '.$lname.'</td>
                    <td> '.$user_type.' </td>
                    <td><img src="./assets/image/calendar2.png" alt="cal">'.$date.'</td>
                    <td>'.$mobile.'</td>
                    <td>'.$zipcode.'</td>
                    <td class="'.$active.'">'.$status.'</td>    
                    <td><img src="./assets/image/icon-more.png"></td>
                  </tr>
                  
                  ';

                  echo ($output);
                }
            }
        }
    }

    public function searchbyUsername()
    {
        if(isset($_POST))
        {
            $admin_id = $_POST['id'];
            $username = $_POST['username'];
            $result = $this->model->searchbyUsername($username,$admin_id);
            if($result){
                    foreach ($result as $row){
                        $fname = $row['FirstName'];
                        $lname = $row['LastName'];
                        $mobile = $row['Mobile'];
                        $zipcode = $row['ZipCode'];
                        $date = $row['CreatedDate'];
                        $usertype = $row['UserTypeId'];
                        $active = $row['IsActive'];
    
                        if($usertype == 1){
                            $user_type = "Customer";
                        } else{
                            $user_type = "Service Provider";
                        }
    
                        if($active == 0){
                            $status = '<p class="success">Active</p>';
                        } else{
                            $status = '<p class="fail">Inactive</p>';
                        }
    
                        $output = '<tr>
                        <td>'.$fname.' '.$lname.'</td>
                        <td> '.$user_type.' </td>
                        <td><img src="./assets/image/calendar2.png" alt="cal">'.$date.'</td>
                        <td>'.$mobile.'</td>
                        <td>'.$zipcode.'</td>
                        <td>'.$status.'</td>    
                        <td>:</td>
                      </tr>
                      
                      ';
    
                      echo ($output); 
                    }
            } else {
                $output = '<h3 class="text-center"> No records found</h3>';
                echo $output;
            }
        }
    }

    public function searchbyPhone()
    {
        if(isset($_POST))
        {
            $admin_id = $_POST['id'];
            $phone = $_POST['phone'];
            $result = $this->model->searchbyPhone($phone,$admin_id);
            if($result){
                    foreach ($result as $row){
                        $fname = $row['FirstName'];
                        $lname = $row['LastName'];
                        $mobile = $row['Mobile'];
                        $zipcode = $row['ZipCode'];
                        $date = $row['CreatedDate'];
                        $usertype = $row['UserTypeId'];
                        $active = $row['IsActive'];
    
                        if($usertype == 1){
                            $user_type = "Customer";
                        } else{
                            $user_type = "Service Provider";
                        }
    
                        if($active == 0){
                            $status = '<p class="success">Active</p>';
                        } else{
                            $status = '<p class="fail">Inactive</p>';
                        }
    
                        $output = '<tr>
                        <td>'.$fname.' '.$lname.'</td>
                        <td> '.$user_type.' </td>
                        <td><img src="./assets/image/calendar2.png" alt="cal">'.$date.'</td>
                        <td>'.$mobile.'</td>
                        <td>'.$zipcode.'</td>
                        <td>'.$status.'</td>    
                        <td>:</td>
                      </tr>
                      
                      ';
    
                      echo ($output); 
                    }
            } else {
                $output = '<h3 class="text-center"> No records found</h3>';
                echo $output;
            }
        }
    }

    public function searchbyCode()
    {
        if(isset($_POST))
        {
            $admin_id = $_POST['id'];
            $code = $_POST['code'];
            $result = $this->model->searchbyCode($code,$admin_id);
            if($result){
                    foreach ($result as $row){
                        $fname = $row['FirstName'];
                        $lname = $row['LastName'];
                        $mobile = $row['Mobile'];
                        $zipcode = $row['ZipCode'];
                        $date = $row['CreatedDate'];
                        $usertype = $row['UserTypeId'];
                        $active = $row['IsActive'];
    
                        if($usertype == 1){
                            $user_type = "Customer";
                        } else{
                            $user_type = "Service Provider";
                        }
    
                        if($active == 0){
                            $status = '<p class="success">Active</p>';
                        } else{
                            $status = '<p class="fail">Inactive</p>';
                        }
    
                        $output = '<tr>
                        <td>'.$fname.' '.$lname.'</td>
                        <td> '.$user_type.' </td>
                        <td><img src="./assets/image/calendar2.png" alt="cal">'.$date.'</td>
                        <td>'.$mobile.'</td>
                        <td>'.$zipcode.'</td>
                        <td>'.$status.'</td>    
                        <td>:</td>
                      </tr>
                      
                      ';
    
                      echo ($output); 
                    }
            } else {
                $output = '<h3 class="text-center"> No records found</h3>';
                echo $output;
            }
        }
    }
    public function searchbyUserType()
    {
        if(isset($_POST))
        {
            $admin_id = $_POST['id'];
            $type = $_POST['typeid'];
            $result = $this->model->searchbyUserType($type,$admin_id);
            if($result){
                    foreach ($result as $row){
                        $fname = $row['FirstName'];
                        $lname = $row['LastName'];
                        $mobile = $row['Mobile'];
                        $zipcode = $row['ZipCode'];
                        $date = $row['CreatedDate'];
                        $usertype = $row['UserTypeId'];
                        $active = $row['IsActive'];
    
                        if($usertype == 1){
                            $user_type = "Customer";
                        } else{
                            $user_type = "Service Provider";
                        }
    
                        if($active == 0){
                            $status = '<p class="success">Active</p>';
                        } else{
                            $status = '<p class="fail">Inactive</p>';
                        }
    
                        $output = '<tr>
                        <td>'.$fname.' '.$lname.'</td>
                        <td> '.$user_type.' </td>
                        <td><img src="./assets/image/calendar2.png" alt="cal">'.$date.'</td>
                        <td>'.$mobile.'</td>
                        <td>'.$zipcode.'</td>
                        <td>'.$status.'</td>    
                        <td>:</td>
                      </tr>
                      
                      ';
    
                      echo ($output); 
                    }
            } else {
                $output = '<h3 class="text-center"> No records found</h3>';
                echo $output;
            }
        }
    }

    public function changestatus()
    {
        if(isset($_POST))
        {
            $id = $_POST['id'];
            $status = $_POST['status'];
            $result = $this->model->changestatus($id,$status);
            if($result){
                echo 1;
            } else{
                echo 0;
            }
        }
    }

    public function getAllServiceDetails()
    {
        if(isset($_POST))
        {
            $admin_id = $_POST['id'];
            $result = $this->model->getAllServiceDetails($admin_id);
            if($result){
                foreach($result as $row){
                    $servicereqid = $row['ServiceRequestId'];
                    $serviceid = $row['ServiceId'];
                    $date = $row['ServiceDate'];
                    $hour = $row['ServiceHours'];
                    $fname = $row['FirstName'];
                    $lname = $row['LastName'];
                    $address_1 = $row['AddressLine1'];
                    $address_2 = $row['AddressLine2'];
                    $payment = $row['TotalCost'];
                    $status = $row['Status'];
                    $spname = $row['ServiceProviderId'];
                    $count = count($result);
                    $stime = $row['ServiceStartTime'];
                    $endtime = intval($stime)  + $hour;
                    if($endtime >= 12){
                        $pm = 1;
                        $dummy = $endtime - 12;
                        $var1 = intval($dummy);
                        $min = $dummy - $var1;
                          if($min == 0.5){
                              $min = 30;
                          } else{
                              $min = 00;
                          }
                        
                    } else{
                        $pm = 0;
                        $dummy = $endtime;
                        $var1 = intval($dummy);
                        $min = $dummy - $var1;
                          if($min == 0.5){
                              $min = 30;
                          } else{
                              $min = 00;
                          }
                    }

                    if($pm == 1){
                        $var2 = "PM";
                    } else{
                        $var2 = "AM";
                    }
                    if($spname != ''){
                        $sp_name = $this->model->GetSP($servicereqid);

                   } else {
                       $sp_name = '';
                   }
                    

                    if(($status == 'Pending') || ($status == 'Assigned')){
                        $set_status = '<p class="pending">'.$status.'</p>';
                        $action = '<a href="#" data-toggle="dropdown"><img src="./assets/image/icon-more.png"> </a>
                        <div class="dropdown-menu">
                            <a href="#" class="dropdown-item edit-reschedule">Edit & Reschedule</a>
                            <a href="#" class="dropdown-item">Refund</a>
                            <a href="#" class="dropdown-item">Cancel</a>
                            <a href="#" class="dropdown-item">Change SP</a>
                            <a href="#" class="dropdown-item">Escalate</a>
                            <a href="#" class="dropdown-item">History Log</a>
                            <a href="#" class="dropdown-item">Download Invoices</a>
                        </div>';
                    } else if($status == 'Completed'){
                        
                        $set_status = '<p class="success">Completed</p>';
                        $action = '<a href="#" data-toggle="dropdown"><img src="./assets/image/icon-more.png"> </a>
                        <div class="dropdown-menu">
                            <a href="#" class="dropdown-item">Refund</a>
                            <a href="#" class="dropdown-item">Escalate</a>
                            <a href="#" class="dropdown-item">History Log</a>
                            <a href="#" class="dropdown-item">Download Invoices</a>
                        </div>';
                    } else {
                        $set_status = '<p class="new">'.$status.'</p>';
                        $action = '<a href="#"><img src="./assets/image/icon-more.png"></a>';
                    }

                    $output ='<tr class="'.$servicereqid.'">
                    <td>'.$serviceid.'</td>
                    <td><img src="./assets/image/calendar2.png" alt=""> '.$date.' <br>
                    <img src="./assets/image/layer-712.png" alt="clock"> '.$stime.'-'.$var1.':'.$min.' '.$var2.'
                    </td>
                    <td> '.$fname.' '.$lname.'  <br>
                        <img src="./assets/image/layer-719.png" alt=""> '.$address_1.' '.$address_2.'
                    </td>
                    <td>
                        '.$sp_name.'
                    </td>
                    <td><i class="fas fa-dollar-sign"></i>'.$payment.'</td>
                    <td>'.$set_status.'</td>
                    <td class="text-center dropdown">'.$action.'</td>
              </tr>';

                echo ($output);
                }
            }
        }
    }

    public function searchbyServiceId()
    {
        if(isset($_POST))
        {
            $service_id = $_POST['serviceid'];
            $result = $this->model->searchbyServiceId($service_id);
            if($result){
                foreach($result as $row){
                    $servicereqid = $row['ServiceRequestId'];
                    $serviceid = $row['ServiceId'];
                    $date = $row['ServiceDate'];
                    $hour = $row['ServiceHours'];
                    $fname = $row['FirstName'];
                    $lname = $row['LastName'];
                    $address_1 = $row['AddressLine1'];
                    $address_2 = $row['AddressLine2'];
                    $payment = $row['TotalCost'];
                    $status = $row['Status'];
                    $count = count($result);
                    $stime = $row['ServiceStartTime'];
                    $endtime = intval($stime)  + $hour;
                    if($endtime >= 12){
                        $pm = 1;
                        $dummy = $endtime - 12;
                        $var1 = intval($dummy);
                        $min = $dummy - $var1;
                          if($min == 0.5){
                              $min = 30;
                          } else{
                              $min = 00;
                          }
                        
                    } else{
                        $pm = 0;
                        $dummy = $endtime;
                        $var1 = intval($dummy);
                        $min = $dummy - $var1;
                          if($min == 0.5){
                              $min = 30;
                          } else{
                              $min = 00;
                          }
                    }

                    if($pm == 1){
                        $var2 = "PM";
                    } else{
                        $var2 = "AM";
                    }

                    if(($status == 'Pending') || ($status == 'Assigned')){
                        $set_status = '<p class="pending">'.$status.'</p>';
                        $action = '<a href="#" data-toggle="dropdown"><img src="./assets/image/icon-more.png"> </a>
                        <div class="dropdown-menu">
                            <a href="#" class="dropdown-item">Edit & Reschedule</a>
                            <a href="#" class="dropdown-item">Refund</a>
                            <a href="#" class="dropdown-item">Cancel</a>
                            <a href="#" class="dropdown-item">Change SP</a>
                            <a href="#" class="dropdown-item">Escalate</a>
                            <a href="#" class="dropdown-item">History Log</a>
                            <a href="#" class="dropdown-item">Download Invoices</a>
                        </div>';
                    } else if($status == 'Completed'){
                        $set_status = '<p class="success">Completed</p>';
                        $action = '<a href="#" data-toggle="dropdown"><img src="./assets/image/icon-more.png"> </a>
                        <div class="dropdown-menu">
                            <a href="#" class="dropdown-item">Refund</a>
                            <a href="#" class="dropdown-item">Escalate</a>
                            <a href="#" class="dropdown-item">History Log</a>
                            <a href="#" class="dropdown-item">Download Invoices</a>
                        </div>';
                    } else {
                        $set_status = '<p class="new">'.$status.'</p>';
                        $action = '<a href="#"><img src="./assets/image/icon-more.png"> </a>';
                    }

                    $output ='<tr>
                    <td>'.$serviceid.'</td>
                    <td><img src="./assets/image/calendar2.png" alt=""> '.$date.' <br>
                    <img src="./assets/image/layer-712.png" alt="clock"> '.$stime.'-'.$var1.':'.$min.' '.$var2.'
                    </td>
                    <td> '.$fname.' '.$lname.'  <br>
                        <img src="./assets/image/layer-719.png" alt=""> '.$address_1.' '.$address_2.'
                    </td>
                    <td>
                        
                    </td>
                    <td><i class="fas fa-dollar-sign"></i>'.$payment.'</td>
                    <td>'.$set_status.'</td>
                    <td class="text-center dropdown">'.$action.'</td>
                  </tr>';

                   echo ($output);
                }
            }  else{
                $output = '<h3 class="text-center"> No records found</h3>';
                echo $output;
            }
        }
    }
    public function searchbyStatus()
    {
        if(isset($_POST))
        {
            $status = $_POST['status'];
            $result = $this->model->searchbyStatus($status);
            if($result){
                foreach($result as $row){
                    $servicereqid = $row['ServiceRequestId'];
                    $serviceid = $row['ServiceId'];
                    $date = $row['ServiceDate'];
                    $hour = $row['ServiceHours'];
                    $fname = $row['FirstName'];
                    $lname = $row['LastName'];
                    $address_1 = $row['AddressLine1'];
                    $address_2 = $row['AddressLine2'];
                    $payment = $row['TotalCost'];
                    $status = $row['Status'];
                    $count = count($result);
                    $stime = $row['ServiceStartTime'];
                    $endtime = intval($stime)  + $hour;
                    if($endtime >= 12){
                        $pm = 1;
                        $dummy = $endtime - 12;
                        $var1 = intval($dummy);
                        $min = $dummy - $var1;
                          if($min == 0.5){
                              $min = 30;
                          } else{
                              $min = 00;
                          }
                        
                    } else{
                        $pm = 0;
                        $dummy = $endtime;
                        $var1 = intval($dummy);
                        $min = $dummy - $var1;
                          if($min == 0.5){
                              $min = 30;
                          } else{
                              $min = 00;
                          }
                    }

                    if($pm == 1){
                        $var2 = "PM";
                    } else{
                        $var2 = "AM";
                    }

                    if(($status == 'Pending') || ($status == 'Assigned')){
                        $set_status = '<p class="pending">'.$status.'</p>';
                        $action = '<a href="#" data-toggle="dropdown"><img src="./assets/image/icon-more.png"></a>
                        <div class="dropdown-menu">
                            <a href="#" class="dropdown-item">Edit & Reschedule</a>
                            <a href="#" class="dropdown-item">Refund</a>
                            <a href="#" class="dropdown-item">Cancel</a>
                            <a href="#" class="dropdown-item">Change SP</a>
                            <a href="#" class="dropdown-item">Escalate</a>
                            <a href="#" class="dropdown-item">History Log</a>
                            <a href="#" class="dropdown-item">Download Invoices</a>
                        </div>';
                    } else if($status == 'Completed'){
                        $set_status = '<p class="success">Completed</p>';
                        $action = '<a href="#" data-toggle="dropdown"><img src="./assets/image/icon-more.png"> </a>
                        <div class="dropdown-menu">
                            <a href="#" class="dropdown-item">Refund</a>
                            <a href="#" class="dropdown-item">Escalate</a>
                            <a href="#" class="dropdown-item">History Log</a>
                            <a href="#" class="dropdown-item">Download Invoices</a>
                        </div>';
                    } else {
                        $set_status = '<p class="new">'.$status.'</p>';
                        $action = '<a href="#"><img src="./assets/image/icon-more.png"></a>';
                    }

                    $output ='<tr>
                    <td>'.$serviceid.'</td>
                    <td><img src="./assets/image/calendar2.png" alt=""> '.$date.' <br>
                    <img src="./assets/image/layer-712.png" alt="clock"> '.$stime.'-'.$var1.':'.$min.' '.$var2.'
                    </td>
                    <td> '.$fname.' '.$lname.'  <br>
                        <img src="./assets/image/layer-719.png" alt=""> '.$address_1.' '.$address_2.'
                    </td>
                    <td>
                        
                    </td>
                    <td><i class="fas fa-dollar-sign"></i>'.$payment.'</td>
                    <td>'.$set_status.'</td>
                    <td class="text-center dropdown">'.$action.'</td>
                  </tr>';

                   echo ($output);
                }
            }  else{
                $output = '<h3 class="text-center"> No records found</h3>';
                echo $output;
            }
        }
    }

    public function searchbyEmail()
    {
        if(isset($_POST))
        {
            $email = $_POST['email'];
            $result = $this->model->searchbyEmail($email);
            if($result){
                foreach($result as $row){
                    $servicereqid = $row['ServiceRequestId'];
                    $serviceid = $row['ServiceId'];
                    $date = $row['ServiceDate'];
                    $hour = $row['ServiceHours'];
                    $fname = $row['FirstName'];
                    $lname = $row['LastName'];
                    $address_1 = $row['AddressLine1'];
                    $address_2 = $row['AddressLine2'];
                    $payment = $row['TotalCost'];
                    $status = $row['Status'];
                    $count = count($result);
                    $stime = $row['ServiceStartTime'];
                    $endtime = intval($stime)  + $hour;
                    if($endtime >= 12){
                        $pm = 1;
                        $dummy = $endtime - 12;
                        $var1 = intval($dummy);
                        $min = $dummy - $var1;
                          if($min == 0.5){
                              $min = 30;
                          } else{
                              $min = 00;
                          }
                        
                    } else{
                        $pm = 0;
                        $dummy = $endtime;
                        $var1 = intval($dummy);
                        $min = $dummy - $var1;
                          if($min == 0.5){
                              $min = 30;
                          } else{
                              $min = 00;
                          }
                    }

                    if($pm == 1){
                        $var2 = "PM";
                    } else{
                        $var2 = "AM";
                    }

                    if(($status == 'Pending') || ($status == 'Assigned')){
                        $set_status = '<p class="pending">'.$status.'</p>';
                        $action = '<a href="#" data-toggle="dropdown"><img src="./assets/image/icon-more.png"></a>
                        <div class="dropdown-menu">
                            <a href="#" class="dropdown-item">Edit & Reschedule</a>
                            <a href="#" class="dropdown-item">Refund</a>
                            <a href="#" class="dropdown-item">Cancel</a>
                            <a href="#" class="dropdown-item">Change SP</a>
                            <a href="#" class="dropdown-item">Escalate</a>
                            <a href="#" class="dropdown-item">History Log</a>
                            <a href="#" class="dropdown-item">Download Invoices</a>
                        </div>';
                    } else if($status == 'Completed'){
                        $set_status = '<p class="success">Completed</p>';
                        $action = '<a href="#" data-toggle="dropdown"><img src="./assets/image/icon-more.png"> </a>
                        <div class="dropdown-menu">
                            <a href="#" class="dropdown-item">Refund</a>
                            <a href="#" class="dropdown-item">Escalate</a>
                            <a href="#" class="dropdown-item">History Log</a>
                            <a href="#" class="dropdown-item">Download Invoices</a>
                        </div>';
                    } else {
                        $set_status = '<p class="new">'.$status.'</p>';
                        $action = '<a href="#"><img src="./assets/image/icon-more.png"></a>';
                    }

                    $output ='<tr>
                    <td>'.$serviceid.'</td>
                    <td><img src="./assets/image/calendar2.png" alt=""> '.$date.' <br>
                    <img src="./assets/image/layer-712.png" alt="clock"> '.$stime.'-'.$var1.':'.$min.' '.$var2.'
                    </td>
                    <td> '.$fname.' '.$lname.'  <br>
                        <img src="./assets/image/layer-719.png" alt=""> '.$address_1.' '.$address_2.'
                    </td>
                    <td>
                        
                    </td>
                    <td><i class="fas fa-dollar-sign"></i>'.$payment.'</td>
                    <td>'.$set_status.'</td>
                    <td class="text-center dropdown">'.$action.'</td>
                  </tr>';

                   echo ($output);
                }
            }  else{
                $output = '<h3 class="text-center"> No records found</h3>';
                echo $output;
            }
        }
    }

    public function searchbyPostalCode()
    {
        if(isset($_POST))
        {
            $code = $_POST['code'];
            $result = $this->model->searchbyPostalCode($code);
            if($result){
                foreach($result as $row){
                    $servicereqid = $row['ServiceRequestId'];
                    $serviceid = $row['ServiceId'];
                    $date = $row['ServiceDate'];
                    $hour = $row['ServiceHours'];
                    $fname = $row['FirstName'];
                    $lname = $row['LastName'];
                    $address_1 = $row['AddressLine1'];
                    $address_2 = $row['AddressLine2'];
                    $payment = $row['TotalCost'];
                    $status = $row['Status'];
                    $count = count($result);
                    $stime = $row['ServiceStartTime'];
                    $endtime = intval($stime)  + $hour;
                    if($endtime >= 12){
                        $pm = 1;
                        $dummy = $endtime - 12;
                        $var1 = intval($dummy);
                        $min = $dummy - $var1;
                          if($min == 0.5){
                              $min = 30;
                          } else{
                              $min = 00;
                          }
                        
                    } else{
                        $pm = 0;
                        $dummy = $endtime;
                        $var1 = intval($dummy);
                        $min = $dummy - $var1;
                          if($min == 0.5){
                              $min = 30;
                          } else{
                              $min = 00;
                          }
                    }

                    if($pm == 1){
                        $var2 = "PM";
                    } else{
                        $var2 = "AM";
                    }

                    if(($status == 'Pending') || ($status == 'Assigned')){
                        $set_status = '<p class="pending">'.$status.'</p>';
                        $action = '<a href="#" data-toggle="dropdown"><img src="./assets/image/icon-more.png"></a>
                        <div class="dropdown-menu">
                            <a href="#" class="dropdown-item">Edit & Reschedule</a>
                            <a href="#" class="dropdown-item">Refund</a>
                            <a href="#" class="dropdown-item">Cancel</a>
                            <a href="#" class="dropdown-item">Change SP</a>
                            <a href="#" class="dropdown-item">Escalate</a>
                            <a href="#" class="dropdown-item">History Log</a>
                            <a href="#" class="dropdown-item">Download Invoices</a>
                        </div>';
                    } else if($status == 'Completed'){
                        $set_status = '<p class="success">Completed</p>';
                        $action = '<a href="#" data-toggle="dropdown"><img src="./assets/image/icon-more.png"> </a>
                        <div class="dropdown-menu">
                            <a href="#" class="dropdown-item">Refund</a>
                            <a href="#" class="dropdown-item">Escalate</a>
                            <a href="#" class="dropdown-item">History Log</a>
                            <a href="#" class="dropdown-item">Download Invoices</a>
                        </div>';
                    } else {
                        $set_status = '<p class="new">'.$status.'</p>';
                        $action = '<a href="#"><img src="./assets/image/icon-more.png"></a>';
                    }

                    $output ='<tr>
                    <td>'.$serviceid.'</td>
                    <td><img src="./assets/image/calendar2.png" alt=""> '.$date.' <br>
                    <img src="./assets/image/layer-712.png" alt="clock"> '.$stime.'-'.$var1.':'.$min.' '.$var2.'
                    </td>
                    <td> '.$fname.' '.$lname.'  <br>
                        <img src="./assets/image/layer-719.png" alt=""> '.$address_1.' '.$address_2.'
                    </td>
                    <td>
                        
                    </td>
                    <td><i class="fas fa-dollar-sign"></i>'.$payment.'</td>
                    <td>'.$set_status.'</td>
                    <td class="text-center dropdown">'.$action.'</td>
                  </tr>';

                   echo ($output);
                }
            }  else{
                $output = '<h3 class="text-center"> No records found</h3>';
                echo $output;
            }
        }
    }

    public function searchbyIssue()
    {
        if(isset($_POST))
        {
            $admin_id = $_POST['id'];
            $result = $this->model->searchbyIssue($admin_id);
            if($result){
                foreach($result as $row){
                    $servicereqid = $row['ServiceRequestId'];
                    $serviceid = $row['ServiceId'];
                    $date = $row['ServiceDate'];
                    $hour = $row['ServiceHours'];
                    $fname = $row['FirstName'];
                    $lname = $row['LastName'];
                    $address_1 = $row['AddressLine1'];
                    $address_2 = $row['AddressLine2'];
                    $payment = $row['TotalCost'];
                    $status = $row['Status'];
                    $count = count($result);
                    $stime = $row['ServiceStartTime'];
                    $endtime = intval($stime)  + $hour;
                    if($endtime >= 12){
                        $pm = 1;
                        $dummy = $endtime - 12;
                        $var1 = intval($dummy);
                        $min = $dummy - $var1;
                          if($min == 0.5){
                              $min = 30;
                          } else{
                              $min = 00;
                          }
                        
                    } else{
                        $pm = 0;
                        $dummy = $endtime;
                        $var1 = intval($dummy);
                        $min = $dummy - $var1;
                          if($min == 0.5){
                              $min = 30;
                          } else{
                              $min = 00;
                          }
                    }

                    if($pm == 1){
                        $var2 = "PM";
                    } else{
                        $var2 = "AM";
                    }

                    if(($status == 'Pending') || ($status == 'Assigned')){
                        $set_status = '<p class="pending">'.$status.'</p>';
                        $action = '<a href="#" data-toggle="dropdown"><img src="./assets/image/icon-more.png"></a>
                        <div class="dropdown-menu">
                            <a href="#" class="dropdown-item">Edit & Reschedule</a>
                            <a href="#" class="dropdown-item">Refund</a>
                            <a href="#" class="dropdown-item">Cancel</a>
                            <a href="#" class="dropdown-item">Change SP</a>
                            <a href="#" class="dropdown-item">Escalate</a>
                            <a href="#" class="dropdown-item">History Log</a>
                            <a href="#" class="dropdown-item">Download Invoices</a>
                        </div>';
                    } else if($status == 'Completed'){
                        $set_status = '<p class="success">Completed</p>';
                        $action = '<a href="#" data-toggle="dropdown"><img src="./assets/image/icon-more.png"> </a>
                        <div class="dropdown-menu">
                            <a href="#" class="dropdown-item">Refund</a>
                            <a href="#" class="dropdown-item">Escalate</a>
                            <a href="#" class="dropdown-item">History Log</a>
                            <a href="#" class="dropdown-item">Download Invoices</a>
                        </div>';
                    } else {
                        $set_status = '<p class="new">'.$status.'</p>';
                        $action = '<a href="#"><img src="./assets/image/icon-more.png"></a>';
                    }

                    $output ='<tr>
                    <td>'.$serviceid.'</td>
                    <td><img src="./assets/image/calendar2.png" alt=""> '.$date.' <br>
                    <img src="./assets/image/layer-712.png" alt="clock"> '.$stime.'-'.$var1.':'.$min.' '.$var2.'
                    </td>
                    <td> '.$fname.' '.$lname.'  <br>
                        <img src="./assets/image/layer-719.png" alt=""> '.$address_1.' '.$address_2.'
                    </td>
                    <td>
                        
                    </td>
                    <td><i class="fas fa-dollar-sign"></i>'.$payment.'</td>
                    <td>'.$set_status.'</td>
                    <td class="text-center dropdown">'.$action.'</td>
                  </tr>';

                   echo ($output);
                }
            }  else{
                $output = '<h3 class="text-center"> No records found</h3>';
                echo $output;
            }
        }
    }

    public function customer()
    {
        if(isset($_POST))
        {
            $admin_id = $_POST['id'];
            $result = $this->model->customer($admin_id);
            echo json_encode ($result);
        }
    }

    public function searchbycustomer()
    {
        if(isset($_POST))
        {
            $admin_id = $_POST['id'];
            $customer = $_POST['cust'];
            $result = $this->model->searchbycustomer($admin_id,$customer);
            if($result){
                foreach($result as $row){
                    $servicereqid = $row['ServiceRequestId'];
                    $serviceid = $row['ServiceId'];
                    $date = $row['ServiceDate'];
                    $hour = $row['ServiceHours'];
                    $fname = $row['FirstName'];
                    $lname = $row['LastName'];
                    $address_1 = $row['AddressLine1'];
                    $address_2 = $row['AddressLine2'];
                    $payment = $row['TotalCost'];
                    $status = $row['Status'];
                    $count = count($result);
                    $stime = $row['ServiceStartTime'];
                    $endtime = intval($stime)  + $hour;
                    if($endtime >= 12){
                        $pm = 1;
                        $dummy = $endtime - 12;
                        $var1 = intval($dummy);
                        $min = $dummy - $var1;
                          if($min == 0.5){
                              $min = 30;
                          } else{
                              $min = 00;
                          }
                        
                    } else{
                        $pm = 0;
                        $dummy = $endtime;
                        $var1 = intval($dummy);
                        $min = $dummy - $var1;
                          if($min == 0.5){
                              $min = 30;
                          } else{
                              $min = 00;
                          }
                    }

                    if($pm == 1){
                        $var2 = "PM";
                    } else{
                        $var2 = "AM";
                    }

                    if(($status == 'Pending') || ($status == 'Assigned')){
                        $set_status = '<p class="pending">'.$status.'</p>';
                        $action = '<a href="#" data-toggle="dropdown"><img src="./assets/image/icon-more.png"></a>
                        <div class="dropdown-menu">
                            <a href="#" class="dropdown-item">Edit & Reschedule</a>
                            <a href="#" class="dropdown-item">Refund</a>
                            <a href="#" class="dropdown-item">Cancel</a>
                            <a href="#" class="dropdown-item">Change SP</a>
                            <a href="#" class="dropdown-item">Escalate</a>
                            <a href="#" class="dropdown-item">History Log</a>
                            <a href="#" class="dropdown-item">Download Invoices</a>
                        </div>';
                    } else if($status == 'Completed'){
                        $set_status = '<p class="success">Completed</p>';
                        $action = '<a href="#" data-toggle="dropdown"><img src="./assets/image/icon-more.png"> </a>
                        <div class="dropdown-menu">
                            <a href="#" class="dropdown-item">Refund</a>
                            <a href="#" class="dropdown-item">Escalate</a>
                            <a href="#" class="dropdown-item">History Log</a>
                            <a href="#" class="dropdown-item">Download Invoices</a>
                        </div>';
                    } else {
                        $set_status = '<p class="new">'.$status.'</p>';
                        $action = '<a href="#"><img src="./assets/image/icon-more.png"></a>';
                    }

                    $output ='<tr>
                    <td>'.$serviceid.'</td>
                    <td><img src="./assets/image/calendar2.png" alt=""> '.$date.' <br>
                    <img src="./assets/image/layer-712.png" alt="clock"> '.$stime.'-'.$var1.':'.$min.' '.$var2.'
                    </td>
                    <td> '.$fname.' '.$lname.'  <br>
                        <img src="./assets/image/layer-719.png" alt=""> '.$address_1.' '.$address_2.'
                    </td>
                    <td>
                        
                    </td>
                    <td><i class="fas fa-dollar-sign"></i>'.$payment.'</td>
                    <td>'.$set_status.'</td>
                    <td class="text-center dropdown">'.$action.'</td>
                  </tr>';

                   echo ($output);
                }
            }  else{
                $output = '<h3 class="text-center"> No records found</h3>';
                echo $output;
            }
        }
    }

    public function serviceprovider()
    {
        if(isset($_POST))
        {
            $admin_id = $_POST['id'];
            $result = $this->model->serviceprovider($admin_id);
            echo json_encode ($result);
        }
    }

    public function searchbysp()
    {
        if(isset($_POST))
        {
            $admin_id = $_POST['id'];
            $sp = $_POST['sp'];
            $result = $this->model->searchbysp($admin_id,$sp);
            if($result){
                foreach($result as $row){
                    $servicereqid = $row['ServiceRequestId'];
                    $serviceid = $row['ServiceId'];
                    $date = $row['ServiceDate'];
                    $hour = $row['ServiceHours'];
                    $fname = $row['FirstName'];
                    $lname = $row['LastName'];
                    $address_1 = $row['AddressLine1'];
                    $address_2 = $row['AddressLine2'];
                    $payment = $row['TotalCost'];
                    $status = $row['Status'];
                    $count = count($result);
                    $stime = $row['ServiceStartTime'];
                    $endtime = intval($stime)  + $hour;
                    if($endtime >= 12){
                        $pm = 1;
                        $dummy = $endtime - 12;
                        $var1 = intval($dummy);
                        $min = $dummy - $var1;
                          if($min == 0.5){
                              $min = 30;
                          } else{
                              $min = 00;
                          }
                        
                    } else{
                        $pm = 0;
                        $dummy = $endtime;
                        $var1 = intval($dummy);
                        $min = $dummy - $var1;
                          if($min == 0.5){
                              $min = 30;
                          } else{
                              $min = 00;
                          }
                    }

                    if($pm == 1){
                        $var2 = "PM";
                    } else{
                        $var2 = "AM";
                    }

                    if(($status == 'Pending') || ($status == 'Assigned')){
                        $set_status = '<p class="pending">'.$status.'</p>';
                        $action = '<a href="#" data-toggle="dropdown"><img src="./assets/image/icon-more.png"></a>
                        <div class="dropdown-menu">
                            <a href="#" class="dropdown-item">Edit & Reschedule</a>
                            <a href="#" class="dropdown-item">Refund</a>
                            <a href="#" class="dropdown-item">Cancel</a>
                            <a href="#" class="dropdown-item">Change SP</a>
                            <a href="#" class="dropdown-item">Escalate</a>
                            <a href="#" class="dropdown-item">History Log</a>
                            <a href="#" class="dropdown-item">Download Invoices</a>
                        </div>';
                    } else if($status == 'Completed'){
                        $set_status = '<p class="success">Completed</p>';
                        $action = '<a href="#" data-toggle="dropdown"><img src="./assets/image/icon-more.png"> </a>
                        <div class="dropdown-menu">
                            <a href="#" class="dropdown-item">Refund</a>
                            <a href="#" class="dropdown-item">Escalate</a>
                            <a href="#" class="dropdown-item">History Log</a>
                            <a href="#" class="dropdown-item">Download Invoices</a>
                        </div>';
                    } else {
                        $set_status = '<p class="new">'.$status.'</p>';
                        $action = '<a href="#"><img src="./assets/image/icon-more.png"></a>';
                    }

                    $output ='<tr>
                    <td>'.$serviceid.'</td>
                    <td><img src="./assets/image/calendar2.png" alt=""> '.$date.' <br>
                    <img src="./assets/image/layer-712.png" alt="clock"> '.$stime.'-'.$var1.':'.$min.' '.$var2.'
                    </td>
                    <td> '.$fname.' '.$lname.'  <br>
                        <img src="./assets/image/layer-719.png" alt=""> '.$address_1.' '.$address_2.'
                    </td>
                    <td>
                        
                    </td>
                    <td><i class="fas fa-dollar-sign"></i>'.$payment.'</td>
                    <td>'.$set_status.'</td>
                    <td class="text-center dropdown">'.$action.'</td>
                  </tr>';

                   echo ($output);
                }
            }  else{
                $output = '<h3 class="text-center"> No records found</h3>';
                echo $output;
            }
        }
    }

    public function editmodeldetails()
    {
        if(isset($_POST))
        {
            $sp_id = $_POST['sp_id'];
            $result = $this->model->editmodeldetails($sp_id);
            if($result){
                foreach($result as $row){
                      $servicereqid = $row['ServiceRequestId'];
                      $date = $row['ServiceDate'];
                      $time = $row['ServiceStartTime'];
                      $sname = $row['AddressLine1'];
                      $house = $row['AddressLine2'];
                      $code = $row['zip'];
                      $city = $row['City'];

                      $array = [$servicereqid,$date,$time,$sname,$house,$code,$city];

                      echo json_encode($array);
                }
            }
        }
    }

    public function updateinfodetails()
    {
        if(isset($_POST))
        {
            $sp_id = $_POST['sp_id'];
            $time = $_POST['time'];
            $date = $_POST['date'];
            $sname = $_POST['sname'];
            $houseno = $_POST['houseno'];
            $city = $_POST['city'];
            $code = $_POST['code'];
            $reason = $_POST['reason'];
            $status = "Rescheduled";

            $array1 = [
               'sp_id' => $sp_id,
               'date' => $date,
               'time' => $time,
               'status' => $status,
               'reason' => $reason,
            ];
            $result1 = $this->model->updateinfodetails($array1);

            $array2 = [
                'sp_id' => $sp_id,
                'sname' => $sname,
                'houseno' => $houseno,
                'city' => $city,
                'code' => $code,
            ];
            $result2 = $this->model->insertaddress($array2);

            if(($result1 == 1) || ($result2 == TRUE)){
                echo 1;
            } else {
                echo 0;
            }
        }
    }

    public function searchbyDate()
    {
        if(isset($_POST))
        {
            $sdate = $_POST['sdate'];
            $edate = $_POST['edate'];

            $start = explode('-',$sdate);
            $sday = $start[2];
            $smonth = $start[1];
            $syear = $start[0];

            $end = explode('-',$edate);
            $eday = $end[2];
            $emonth = $end[1];
            $eyear = $end[0];

            $start_date = $sday ."/". $smonth ."/". $syear;
            $end_date = $eday ."/". $emonth ."/". $eyear;

            $result = $this->model->searchbyDate($start_date,$end_date);
            if($result){
                foreach($result as $row){
                    $servicereqid = $row['ServiceRequestId'];
                    $serviceid = $row['ServiceId'];
                    $date = $row['ServiceDate'];
                    $hour = $row['ServiceHours'];
                    $fname = $row['FirstName'];
                    $lname = $row['LastName'];
                    $address_1 = $row['AddressLine1'];
                    $address_2 = $row['AddressLine2'];
                    $payment = $row['TotalCost'];
                    $status = $row['Status'];
                    $count = count($result);
                    $stime = $row['ServiceStartTime'];
                    $endtime = intval($stime)  + $hour;
                    if($endtime >= 12){
                        $pm = 1;
                        $dummy = $endtime - 12;
                        $var1 = intval($dummy);
                        $min = $dummy - $var1;
                          if($min == 0.5){
                              $min = 30;
                          } else{
                              $min = 00;
                          }
                        
                    } else{
                        $pm = 0;
                        $dummy = $endtime;
                        $var1 = intval($dummy);
                        $min = $dummy - $var1;
                          if($min == 0.5){
                              $min = 30;
                          } else{
                              $min = 00;
                          }
                    }

                    if($pm == 1){
                        $var2 = "PM";
                    } else{
                        $var2 = "AM";
                    }

                    if(($status == 'Pending') || ($status == 'Assigned')){
                        $set_status = '<p class="pending">'.$status.'</p>';
                        $action = '<a href="#" data-toggle="dropdown"><img src="./assets/image/icon-more.png"></a>
                        <div class="dropdown-menu">
                            <a href="#" class="dropdown-item">Edit & Reschedule</a>
                            <a href="#" class="dropdown-item">Refund</a>
                            <a href="#" class="dropdown-item">Cancel</a>
                            <a href="#" class="dropdown-item">Change SP</a>
                            <a href="#" class="dropdown-item">Escalate</a>
                            <a href="#" class="dropdown-item">History Log</a>
                            <a href="#" class="dropdown-item">Download Invoices</a>
                        </div>';
                    } else if($status == 'Completed'){
                        $set_status = '<p class="success">Completed</p>';
                        $action = '<a href="#" data-toggle="dropdown"><img src="./assets/image/icon-more.png"> </a>
                        <div class="dropdown-menu">
                            <a href="#" class="dropdown-item">Refund</a>
                            <a href="#" class="dropdown-item">Escalate</a>
                            <a href="#" class="dropdown-item">History Log</a>
                            <a href="#" class="dropdown-item">Download Invoices</a>
                        </div>';
                    } else {
                        $set_status = '<p class="new">'.$status.'</p>';
                        $action = '<a href="#"><img src="./assets/image/icon-more.png"></a>';
                    }

                    $output ='<tr>
                    <td>'.$serviceid.'</td>
                    <td><img src="./assets/image/calendar2.png" alt=""> '.$date.' <br>
                    <img src="./assets/image/layer-712.png" alt="clock"> '.$stime.'-'.$var1.':'.$min.' '.$var2.'
                    </td>
                    <td> '.$fname.' '.$lname.'  <br>
                        <img src="./assets/image/layer-719.png" alt=""> '.$address_1.' '.$address_2.'
                    </td>
                    <td>
                        
                    </td>
                    <td><i class="fas fa-dollar-sign"></i>'.$payment.'</td>
                    <td>'.$set_status.'</td>
                    <td class="text-center dropdown">'.$action.'</td>
                  </tr>';

                   echo ($output);
                }
            }  else{
                $output = '<h3 class="text-center"> No records found</h3>';
                echo $output;
            }
        }
    }
}

