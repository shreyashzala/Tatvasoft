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
        $customer = "http://localhost/Helperland/cust_dashboard";
        $sp = "http://localhost/Helperland/upcoming_service";
        

        $sql = "SELECT * FROM user WHERE Email = '$email' AND Password = '$password' ";
        $stmt =  $this->conn->prepare($sql);
        $stmt->execute();
        $row  = $stmt->fetch(PDO::FETCH_ASSOC);
        $count = $stmt->rowCount();
        return $row;
        
 
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
        $result = $stmt->execute();
        return $result;
        
    }

    public function checkcode($code)
    { 
        $sql = "SELECT * FROM zipcode WHERE ZipcodeValue = '$code' ";
        $stmt =  $this->conn->prepare($sql);
        $stmt->execute();
        $count = $stmt->rowCount();
        return $count;
    }

    public function addadress($address)
    {
        $sql = "INSERT INTO useraddress (UserId , AddressLine1 , AddressLine2 , City , zip , Mobile )
        VALUES (:userid, :street, :house, :city, :zip, :mobile)";
        $stmt =  $this->conn->prepare($sql);
        $result = $stmt->execute($address);
        return $result;
        
    }

    public function showaddress($userid)
    {
        $sql = "SELECT * FROM useraddress WHERE UserId = '$userid'";
        $stmt =  $this->conn->prepare($sql);
        $stmt->execute();
        $result  = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
        
        

    }

    public function booking($array)
    {
        
        $sql = "INSERT INTO servicerequest (UserId , ServiceId , ServiceDate, ZipCode, ServiceHourlyRate, ServiceHours, ExtraHours, SubTotal , Discount, TotalCost, Status, address )
        VALUES (:userid,:service_id , :date,:code, :hour_rate, :total_hour, :extra_hour, :totalcost , :discount,:payment, :status, :addressId )";
        $stmt =  $this->conn->prepare($sql);
        $result = $stmt->execute($array);
        return $result;
        
    }

    public function dashboard_details($userid)
    {
        $sql = "SELECT * FROM servicerequest WHERE UserId = '$userid' AND Status = 'Pending'";
        $stmt =  $this->conn->prepare($sql);
        $stmt->execute();
        $result_dashboard  = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $count = $stmt->rowCount();
        
        return $result_dashboard;
    }

    
    public function history($userid)
    {
        $sql = "SELECT * FROM servicerequest WHERE UserId = '$userid'";
        $stmt =  $this->conn->prepare($sql);
        $stmt->execute();
        $result  = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $count = $stmt->rowCount();
        return $result;
        
    }

    public function user_details($userid)
    {
        $sql = "SELECT * FROM user WHERE UserId = '$userid'";
        $stmt =  $this->conn->prepare($sql);
        $stmt->execute();
        $result  = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
        
    }

    public function showuseraddress($userid)
    {
        $deleted = '0';
        $sql = "SELECT * FROM useraddress WHERE UserId = '$userid' AND IsDeleted = '$deleted'";
        $stmt =  $this->conn->prepare($sql);
        $stmt->execute();
        $result  = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
        
        

    }

    public function updatepassword($userid,$newpwd,$oldpwd)
    {
        $sql = "UPDATE user SET Password = '$newpwd' WHERE UserId = '$userid' AND Password = '$oldpwd'";
        $stmt =  $this->conn->prepare($sql);
        $result = $stmt->execute();
        $count = $stmt->rowCount();
        return $count;
        
    }

    public function updateinfo($array)
    {
        $sql = "UPDATE `user` SET `FirstName` = :fname, `LastName` = :lname, `Mobile` = :mobile, `DateOfBirth` = :dob , `LanguageId` = :languageid WHERE `UserId` = :id ";
        $stmt =  $this->conn->prepare($sql);
        $result = $stmt->execute($array);
        $count = $stmt->rowCount();
        return $count;

        

    }

    public function deleteaddress($userid)
    {
        $sql = "UPDATE useraddress SET IsDeleted = 1 WHERE AddressId = '$userid'";
        $stmt =  $this->conn->prepare($sql);
        $result = $stmt->execute();
        $count = $stmt->rowCount();
        return $count;
        
    }

    public function editaddress($userid)
    {
        $sql = "SELECT * FROM useraddress WHERE AddressId = '$userid'";
        $stmt =  $this->conn->prepare($sql);
        $stmt->execute();
        $result  = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;   
    }

    public function updateaddress($array)
    {
        $sql ="UPDATE `useraddress` SET `AddressLine1` = :sname ,`AddressLine2` = :house, `City` = :city, `zip` = :zip, `Mobile` = :mobile WHERE `AddressId` = :id ";
        $stmt =  $this->conn->prepare($sql);
        $result = $stmt->execute($array);
        $count = $stmt->rowCount();
        return $count;

        
    }

    public function rating($array)
    {
        $ratingto = '5';
        $sql = "INSERT INTO rating(ServiceRequestId,RatingFrom,RatingTo,Ratings,Comments,RatingDate,OnTimeArrival,Friendly,QualityOfService) VALUES (:serviceid,:id,'$ratingto',:total,:comment,:ratingdate,:info1,:info2,:info3)";
        $stmt =  $this->conn->prepare($sql);
        $result = $stmt->execute($array);
        return $result;

    }

    public function bookingdetails($servicereqid)
    {
        $sql = "SELECT ServiceId,ServiceDate,ServiceHours,SubTotal,ExtraHours, user.Email,user.Mobile,useraddress.AddressLine1,useraddress.AddressLine2 FROM `servicerequest` JOIN `user` ON servicerequest.UserId = user.UserId JOIN `useraddress` ON servicerequest.address = useraddress.AddressId WHERE ServiceRequestId = '$servicereqid'";
        $stmt =  $this->conn->prepare($sql);
        $stmt->execute();
        $result  = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;

    }

    public function cancelrequest($servicereqid , $issue)
    {
        $sql="UPDATE servicerequest SET Status = 'Cancelled' , HasIssue = '$issue' WHERE ServiceRequestId = '$servicereqid'";
        $stmt =  $this->conn->prepare($sql);
        $result = $stmt->execute();
        $count = $stmt->rowCount();
        return $count;
        
    }

    public function reschedulerequest($servicereqid,$newdate)
    {
        $sql="UPDATE servicerequest SET ServiceDate = '$newdate',Status = 'Rescheduled' WHERE ServiceRequestId = '$servicereqid'";
        $stmt =  $this->conn->prepare($sql);
        $result = $stmt->execute();
        $count = $stmt->rowCount();
        return $count; 
        
    }

    public function newrequest($sp_id)
    {
        $sql = "SELECT ServiceRequestId,servicerequest.Status,user.FirstName,user.LastName,ServiceId,ServiceDate,ServiceHours,TotalCost,useraddress.AddressLine1,useraddress.AddressLine2 FROM `servicerequest` JOIN user ON servicerequest.UserId = user.UserId JOIN useraddress ON servicerequest.address = useraddress.AddressId WHERE servicerequest.Status = 'Pending'";
        $stmt =  $this->conn->prepare($sql);
        $stmt->execute();
        $result  = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;

    }

    public function acceptrequestmodel($req_id)
    {
        $sql = "SELECT ServiceRequestId,servicerequest.Status,user.FirstName,user.LastName,ServiceId,ServiceDate,ServiceHours,TotalCost,useraddress.AddressLine1,useraddress.AddressLine2 FROM `servicerequest` JOIN user ON servicerequest.UserId = user.UserId JOIN useraddress ON servicerequest.address = useraddress.AddressId WHERE ServiceRequestId = '$req_id'";
        $stmt =  $this->conn->prepare($sql);
        $stmt->execute();
        $result  = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;

    }

    public function acceptrequest($req_id,$sp_id)
    {
        $sql= "UPDATE servicerequest SET ServiceProviderId = '$sp_id', Status = 'Assigned' WHERE ServiceRequestId = '$req_id'";
        $stmt =  $this->conn->prepare($sql);
        $result = $stmt->execute();
        $count = $stmt->rowCount();
        return $count;
    }

    public function upcomingservices($sp_id)
    {
        $sql = "SELECT ServiceRequestId,servicerequest.Status,user.FirstName,user.LastName,ServiceId,ServiceDate,ServiceHours,TotalCost,useraddress.AddressLine1,useraddress.AddressLine2 FROM `servicerequest` JOIN user ON servicerequest.UserId = user.UserId JOIN useraddress ON servicerequest.address = useraddress.AddressId WHERE servicerequest.Status = 'Assigned' AND ServiceProviderId = '$sp_id'";
        $stmt =  $this->conn->prepare($sql);
        $stmt->execute();
        $result  = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function sp_history($sp_id)
    {
        $sql = "SELECT ServiceRequestId,servicerequest.Status,user.FirstName,user.LastName,ServiceId,ServiceDate,ServiceHours,TotalCost,useraddress.AddressLine1,useraddress.AddressLine2 FROM `servicerequest` JOIN user ON servicerequest.UserId = user.UserId JOIN useraddress ON servicerequest.address = useraddress.AddressId WHERE servicerequest.Status = 'Completed' AND ServiceProviderId = '$sp_id'";
        $stmt =  $this->conn->prepare($sql);
        $stmt->execute();
        $result  = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function completeservicereq($req_id)
    {
        $sql = "UPDATE servicerequest SET Status = 'Completed' WHERE ServiceRequestId = '$req_id'";
        $stmt =  $this->conn->prepare($sql);
        $result = $stmt->execute();
        $count = $stmt->rowCount();
        return $count;
    }
    public function cancelservicereq($req_id)
    {
        $sql = "UPDATE servicerequest SET Status = 'Pending' WHERE ServiceRequestId = '$req_id'";
        $stmt =  $this->conn->prepare($sql);
        $result = $stmt->execute();
        $count = $stmt->rowCount();
        return $count;
    }

    public function getallspdetails($sp_id)
    {
        $sql ="SELECT user.FirstName,user.LastName,user.Email,user.Mobile,user.Gender,user.DateOfBirth,user.NationalityId,useraddress.zip,useraddress.AddressLine1,useraddress.AddressLine2,useraddress.City FROM `user` JOIN useraddress ON user.userid = useraddress.UserId  WHERE user.UserId = '$sp_id'";
        $stmt =  $this->conn->prepare($sql);
        $stmt->execute();
        $result  = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function updatespdetails($array1)
    {
        $sql = "UPDATE `user` SET `FirstName` = :fname, `LastName` = :lname, `Mobile` = :mobile, `DateOfBirth` = :dob ,`Gender`= :gender, `NationalityId` = :nation WHERE `UserId` = :sp_id ";
        $stmt =  $this->conn->prepare($sql);
        $result = $stmt->execute($array1);
        $count = $stmt->rowCount();
        return $count; 
    }

    public function updatespaddress($array2)
    {
        $sql ="UPDATE `useraddress` SET `AddressLine1` = :sname ,`AddressLine2` = :houseno, `City` = :city, `zip` = :code WHERE `UserId` = :sp_id ";
        $stmt =  $this->conn->prepare($sql);
        $result = $stmt->execute($array2);
        $count = $stmt->rowCount();
        return $count;
    }

    public function getuserdetails($sp_id)
    {
        $sql = "SELECT DISTINCT user.UserId, user.FirstName,user.LastName,favoriteandblocked.IsBlocked FROM `servicerequest` JOIN user ON  servicerequest.UserId = user.UserId JOIN favoriteandblocked ON  servicerequest.UserId = favoriteandblocked.TargetUserId  WHERE servicerequest.Status = 'Completed' AND servicerequest.ServiceProviderId = '$sp_id'";
        $stmt =  $this->conn->prepare($sql);
        $stmt->execute();
        $result  = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    } 

    public function blockcustomer($sp_id,$userid)
    {
        $Isblock = 1;
        $sql = "SELECT * FROM  favoriteandblocked WHERE UserId = '$sp_id' AND TargetUserId = '$userid'";
        $stmt = $this->conn->prepare($sql);
        $result = $stmt->execute();
        $count = $stmt -> rowCount();

        if($count == 1){
            $sql = "UPDATE favoriteandblocked SET IsBlocked = '$Isblock' WHERE UserId = '$sp_id' AND TargetUserId = '$userid' ";
            $stmt =  $this->conn->prepare($sql);
            $result = $stmt->execute();
            return $result;
        } else {
            $sql = "INSERT INTO favoriteandblocked(`UserId`,`TargetUserId`,`IsFavorite`,`IsBlocked`) VALUES('$sp_id','$userid',0,1)";
            $stmt =  $this->conn->prepare($sql);
            $result = $stmt->execute();
            return $result;
        }
        
    }

    public function unblockcustomer($sp_id,$userid)
    {
        $Isblock = 0;
        $sql = "UPDATE favoriteandblocked SET IsBlocked = '$Isblock' WHERE UserId = '$sp_id' AND TargetUserId = '$userid' ";
        $stmt =  $this->conn->prepare($sql);
        $result = $stmt->execute();
        return $result;  
    }

    public function sprating($sp_id)
    {
        $sql="SELECT Ratings,rating.Comments, servicerequest.ServiceId,user.FirstName,user.LastName,servicerequest.ServiceDate,servicerequest.ServiceHours FROM rating JOIN servicerequest ON rating.ServiceRequestId = servicerequest.ServiceRequestId JOIN user ON servicerequest.UserId = user.UserId WHERE RatingTo = '$sp_id'";
        $stmt =  $this->conn->prepare($sql);
        $stmt->execute();
        $result  = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
}
?>

