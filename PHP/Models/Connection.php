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
        
        $sql = "INSERT INTO user (FirstName,LastName,Email,Password,Mobile ,UserTypeId,token,CreatedDate)
        VALUES ( :firstname, :lastname, :email, :password, :mobile, :UserTypeId,:token,:CreatedDate)";
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
        
        $sql = "INSERT INTO servicerequest (UserId , ServiceId , ServiceDate, ZipCode, ServiceHourlyRate, ServiceHours, ExtraHours, SubTotal , Discount, TotalCost, Status, address,ServiceStartTime )
        VALUES (:userid,:service_id , :date,:code, :hour_rate, :total_hour, :extra_hour, :totalcost , :discount,:payment, :status, :addressId ,:servicestarttime)";
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

    public function spname($sp_id)
    {
        $sql = "SELECT DISTINCT(CONCAT(user.FirstName,user.LastName)) AS SP FROM `servicerequest` JOIN user ON servicerequest.ServiceProviderId = user.UserId WHERE servicerequest.Status = 'Completed' AND ServiceRequestId = '$sp_id'";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $sp_name = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if($sp_name){
            foreach($sp_name as $row){
                $sp = $row['SP'];
                return $sp;
            }
        } 
    }

    public function check_rating($reqid)
    {
       $sql = "SELECT * FROM rating WHERE ServiceRequestId = '$reqid'";
       $stmt =  $this->conn->prepare($sql);
       $stmt->execute();
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

    public function getServiceId($servicereqid)
    {
        $sql = "SELECT ServiceId FROM servicerequest WHERE ServiceRequestId = '$servicereqid'";
        $stmt =  $this->conn->prepare($sql);
        $stmt->execute();
        $result  = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if($result){
            foreach($result as $row){
                $service_id = $row['ServiceId'];
                return $service_id;
            }
        }

    }

    public function cancelrequest($servicereqid , $issue)
    {
        $sql="UPDATE servicerequest SET Status = 'Cancelled' , HasIssue = '$issue' WHERE ServiceRequestId = '$servicereqid'";
        $stmt =  $this->conn->prepare($sql);
        $result = $stmt->execute();
        $count = $stmt->rowCount();
        return $count;
        
    }

    public function reschedulerequest($servicereqid,$newdate,$newtime)
    {
        $sql="UPDATE servicerequest SET ServiceDate = '$newdate',ServiceStartTime = '$newtime',Status = 'Rescheduled' WHERE ServiceRequestId = '$servicereqid'";
        $stmt =  $this->conn->prepare($sql);
        $result = $stmt->execute();
        $count = $stmt->rowCount();
        return $count; 
        
    }

    public function newrequest($sp_id)
    {
        $sql = "SELECT ServiceRequestId,servicerequest.UserId,servicerequest.Status,user.FirstName,user.LastName,ServiceId,ServiceDate,ServiceHours,TotalCost,ServiceStartTime,ServiceProviderId,useraddress.AddressLine1,useraddress.AddressLine2 FROM `servicerequest` JOIN user ON servicerequest.UserId = user.UserId JOIN useraddress ON servicerequest.address = useraddress.AddressId WHERE servicerequest.Status = 'Pending'";
        $stmt =  $this->conn->prepare($sql);
        $stmt->execute();
        $result  = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;

    }

    public function block($sp_id)
    {
        $sql = "SELECT UserId ,TargetUserId, IsBlocked FROM `favoriteandblocked` WHERE UserId = '$sp_id'";
        $stmt =  $this->conn->prepare($sql);
        $stmt->execute();
        $result  = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if($result){
            foreach($result as $row){
                $targetid = $row['TargetUserId'];
                $isBlock = $row['IsBlocked'];
                return array($targetid,$isBlock);
            }
         }
         
    }

    public function blockrequest($targetid)
    {
        $sql = "SELECT ServiceRequestId,servicerequest.UserId,servicerequest.Status,user.FirstName,user.LastName,ServiceId,ServiceDate,ServiceHours,TotalCost,ServiceStartTime,ServiceProviderId,useraddress.AddressLine1,useraddress.AddressLine2 FROM `servicerequest` JOIN user ON servicerequest.UserId = user.UserId JOIN useraddress ON servicerequest.address = useraddress.AddressId LEFT JOIN `favoriteandblocked` ON servicerequest.UserId = favoriteandblocked.TargetUserId WHERE servicerequest.Status = 'Pending' AND servicerequest.UserId != '$targetid'";
        $stmt =  $this->conn->prepare($sql);
        $stmt->execute();
        $result  = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result; 
    }
    

    public function acceptrequestmodel($req_id)
    {
        $sql = "SELECT ServiceRequestId,servicerequest.Status,user.FirstName,user.LastName,ServiceId,ServiceDate,ServiceHours,TotalCost,ServiceStartTime,ServiceProviderId,useraddress.AddressLine1,useraddress.AddressLine2 FROM `servicerequest` JOIN user ON servicerequest.UserId = user.UserId JOIN useraddress ON servicerequest.address = useraddress.AddressId WHERE ServiceRequestId = '$req_id'";
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

    public function timeconflict($sp_id,$date)
    {
        $sql = "SELECT ServiceRequestId,servicerequest.Status,user.FirstName,user.LastName,ServiceId,ServiceDate,ServiceHours,TotalCost,ServiceStartTime,useraddress.AddressLine1,useraddress.AddressLine2 FROM `servicerequest` JOIN user ON servicerequest.UserId = user.UserId JOIN useraddress ON servicerequest.address = useraddress.AddressId WHERE ServiceDate = '$date' AND (ServiceProviderId = '$sp_id' OR ServiceProviderId = 1) AND servicerequest.Status = 'Assigned'";
        $stmt =  $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->rowCount();
        return $result;

    }

    public function upcomingservices($sp_id)
    {
        $sql = "SELECT ServiceRequestId,servicerequest.Status,user.FirstName,user.LastName,ServiceId,ServiceDate,ServiceHours,TotalCost,ServiceStartTime,useraddress.AddressLine1,useraddress.AddressLine2 FROM `servicerequest` JOIN user ON servicerequest.UserId = user.UserId JOIN useraddress ON servicerequest.address = useraddress.AddressId WHERE servicerequest.Status = 'Assigned' AND ServiceProviderId = '$sp_id'";
        $stmt =  $this->conn->prepare($sql);
        $stmt->execute();
        $result  = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function sp_history($sp_id)
    {
        $sql = "SELECT ServiceRequestId,servicerequest.Status,user.FirstName,user.LastName,ServiceId,ServiceDate,ServiceHours,TotalCost,ServiceStartTime,useraddress.AddressLine1,useraddress.AddressLine2 FROM `servicerequest` JOIN user ON servicerequest.UserId = user.UserId JOIN useraddress ON servicerequest.address = useraddress.AddressId WHERE servicerequest.Status = 'Completed' AND ServiceProviderId = '$sp_id'";
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
        $sql = "UPDATE servicerequest SET Status = 'Pending',ServiceProviderId = 1 WHERE ServiceRequestId = '$req_id'";
        $stmt =  $this->conn->prepare($sql);
        $result = $stmt->execute();
        $count = $stmt->rowCount();
        return $count;
    }

    public function getallspdetails($sp_id)
    {
        $sql ="SELECT user.FirstName,user.LastName,user.Email,user.Mobile,user.Gender,user.DateOfBirth,user.NationalityId,user.UserProfilePicture,useraddress.zip,useraddress.AddressLine1,useraddress.AddressLine2,useraddress.City FROM `user` JOIN useraddress ON user.userid = useraddress.UserId  WHERE user.UserId = '$sp_id'";
        $stmt =  $this->conn->prepare($sql);
        $stmt->execute();
        $result  = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function updatespdetails($array1)
    {
        $sql = "UPDATE `user` SET `FirstName` = :fname, `LastName` = :lname, `Mobile` = :mobile, `DateOfBirth` = :dob ,`Gender`= :gender, `NationalityId` = :nation , `ZipCode` = :code,`UserProfilePicture` = :img WHERE `UserId` = :sp_id ";
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
        $sql="SELECT Ratings,rating.Comments, servicerequest.ServiceId,user.FirstName,user.LastName,servicerequest.ServiceDate,servicerequest.ServiceHours,servicerequest.ServiceStartTime FROM rating JOIN servicerequest ON rating.ServiceRequestId = servicerequest.ServiceRequestId JOIN user ON servicerequest.UserId = user.UserId WHERE RatingTo = '$sp_id'";
        $stmt =  $this->conn->prepare($sql);
        $stmt->execute();
        $result  = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getAllUserDetails($admin_id)
    {
        $sql = "SELECT UserId,UserTypeId,FirstName,LastName,Mobile,ZipCode,IsActive,CreatedDate FROM user WHERE UserId != '$admin_id'";
        $stmt =  $this->conn->prepare($sql);
        $stmt->execute();
        $result  = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function searchbyUsername($username,$admin_id)
    {
        $sql = "SELECT UserTypeId,FirstName,LastName,Mobile,ZipCode,IsActive,CreatedDate FROM user WHERE ((`FirstName` LIKE '%{$username}%') OR (`LastName` LIKE '%{$username}%')) AND UserId != '$admin_id'";
        $stmt =  $this->conn->prepare($sql);
        $stmt->execute();
        $result  = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function searchbyPhone($phone,$admin_id)
    {
        $sql = "SELECT UserTypeId,FirstName,LastName,Mobile,ZipCode,IsActive,CreatedDate FROM user WHERE (`Mobile` LIKE '%{$phone}%')  AND UserId != '$admin_id'";
        $stmt =  $this->conn->prepare($sql);
        $stmt->execute();
        $result  = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public function searchbyCode($code,$admin_id)
    {
        $sql = "SELECT UserTypeId,FirstName,LastName,Mobile,ZipCode,IsActive,CreatedDate FROM user WHERE (`ZipCode` LIKE '%{$code}%')  AND UserId != '$admin_id'";
        $stmt =  $this->conn->prepare($sql);
        $stmt->execute();
        $result  = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public function searchbyUserType($type,$admin_id)
    {
        $sql = "SELECT UserTypeId,FirstName,LastName,Mobile,ZipCode,IsActive,CreatedDate FROM user WHERE (`UserTypeId` LIKE '%{$type}%')  AND UserId != '$admin_id'";
        $stmt =  $this->conn->prepare($sql);
        $stmt->execute();
        $result  = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function changestatus($id,$status)
    {
        if($status == 0){
            $change = 1;
        } else{
            $change = 0;
        }
        $sql = "UPDATE user SET IsActive = '$change' WHERE UserId = '$id' AND IsActive = '$status'";
        $stmt =  $this->conn->prepare($sql);
        $result = $stmt->execute();
        return $result;
    }

    public function getAllServiceDetails($admin_id)
    {
        $sql = "SELECT ServiceRequestId,servicerequest.Status,user.FirstName,user.LastName,ServiceId,ServiceDate,ServiceHours,TotalCost,ServiceStartTime,ServiceProviderId,useraddress.AddressLine1,useraddress.AddressLine2 FROM `servicerequest` JOIN user ON servicerequest.UserId = user.UserId JOIN useraddress ON servicerequest.address = useraddress.AddressId";
        $stmt =  $this->conn->prepare($sql);
        $stmt->execute();
        $result  = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function searchbyServiceId($service_id)
    {
        $sql = "SELECT ServiceRequestId,servicerequest.Status,user.FirstName,user.LastName,ServiceId,ServiceDate,ServiceHours,TotalCost,ServiceStartTime,useraddress.AddressLine1,useraddress.AddressLine2 FROM `servicerequest` JOIN user ON servicerequest.UserId = user.UserId JOIN useraddress ON servicerequest.address = useraddress.AddressId WHERE ServiceId LIKE '%{$service_id}%'";
        $stmt =  $this->conn->prepare($sql);
        $stmt->execute();
        $result  = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public function searchbyStatus($status)
    {
        $sql = "SELECT ServiceRequestId,servicerequest.Status,user.FirstName,user.LastName,ServiceId,ServiceDate,ServiceHours,TotalCost,ServiceStartTime,useraddress.AddressLine1,useraddress.AddressLine2 FROM `servicerequest` JOIN user ON servicerequest.UserId = user.UserId JOIN useraddress ON servicerequest.address = useraddress.AddressId WHERE servicerequest.Status LIKE '%{$status}%'";
        $stmt =  $this->conn->prepare($sql);
        $stmt->execute();
        $result  = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function searchbyDate($start_date,$end_date)
    {
        $sql = "SELECT ServiceRequestId,servicerequest.Status,user.FirstName,user.LastName,ServiceId,ServiceDate,ServiceHours,TotalCost,ServiceStartTime,useraddress.AddressLine1,useraddress.AddressLine2 FROM `servicerequest` JOIN user ON servicerequest.UserId = user.UserId JOIN useraddress ON servicerequest.address = useraddress.AddressId WHERE ServiceDate BETWEEN '$start_date' AND '$end_date'";
        $stmt =  $this->conn->prepare($sql);
        $stmt->execute();
        $result  = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function searchbyEmail($email)
    {
        $sql = "SELECT ServiceRequestId,servicerequest.Status,user.FirstName,user.LastName,ServiceId,ServiceDate,ServiceHours,TotalCost,ServiceStartTime,useraddress.AddressLine1,useraddress.AddressLine2 FROM `servicerequest` JOIN user ON servicerequest.UserId = user.UserId JOIN useraddress ON servicerequest.address = useraddress.AddressId WHERE user.Email = '$email'";
        $stmt =  $this->conn->prepare($sql);
        $stmt->execute();
        $result  = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public function searchbyPostalCode($code)
    {
        $sql = "SELECT ServiceRequestId,servicerequest.Status,user.FirstName,user.LastName,ServiceId,ServiceDate,ServiceHours,TotalCost,ServiceStartTime,useraddress.AddressLine1,useraddress.AddressLine2 FROM `servicerequest` JOIN user ON servicerequest.UserId = user.UserId JOIN useraddress ON servicerequest.address = useraddress.AddressId WHERE useraddress.zip = '$code'";
        $stmt =  $this->conn->prepare($sql);
        $stmt->execute();
        $result  = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function searchbyIssue($admin_id)
    {
        $sql = "SELECT ServiceRequestId,servicerequest.Status,user.FirstName,user.LastName,ServiceId,ServiceDate,ServiceHours,TotalCost,ServiceStartTime,useraddress.AddressLine1,useraddress.AddressLine2 FROM `servicerequest` JOIN user ON servicerequest.UserId = user.UserId JOIN useraddress ON servicerequest.address = useraddress.AddressId WHERE servicerequest.HasIssue != 'No'";
        $stmt =  $this->conn->prepare($sql);
        $stmt->execute();
        $result  = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function customer($admin_id)
    {
        $sql = "SELECT  CONCAT(FirstName,LastName) AS Customer FROM user WHERE UserId != '$admin_id' AND UserTypeId = 1";
        $stmt =  $this->conn->prepare($sql);
        $stmt->execute();
        $result  = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function searchbycustomer($admin_id,$customer)
    {
        $sql = "SELECT ServiceRequestId,servicerequest.Status,user.FirstName,user.LastName,ServiceId,ServiceDate,ServiceHours,TotalCost,ServiceStartTime,useraddress.AddressLine1,useraddress.AddressLine2 FROM `servicerequest` JOIN user ON servicerequest.UserId = user.UserId JOIN useraddress ON servicerequest.address = useraddress.AddressId WHERE (CONCAT(user.FirstName,user.LastName) = '$customer') AND (user.UserId != '$admin_id')";
        $stmt =  $this->conn->prepare($sql);
        $stmt->execute();
        $result  = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function serviceprovider($admin_id)
    {
        $sql = "SELECT  CONCAT(FirstName,LastName) AS SP FROM user WHERE UserId != '$admin_id' AND UserTypeId = 2";
        $stmt =  $this->conn->prepare($sql);
        $stmt->execute();
        $result  = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function searchbysp($admin_id,$sp)
    {
        $sql = "SELECT ServiceRequestId,servicerequest.Status,user.FirstName,user.LastName,ServiceId,ServiceDate,ServiceHours,TotalCost,ServiceStartTime,ServiceProviderId,useraddress.AddressLine1,useraddress.AddressLine2 FROM `servicerequest` JOIN user ON servicerequest.UserId = user.UserId JOIN useraddress ON servicerequest.address = useraddress.AddressId ";
        $stmt =  $this->conn->prepare($sql);
        $stmt->execute();
        $result  = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function editmodeldetails($sp_id)
    {
        $sql = "SELECT `ServiceRequestId`,`ServiceDate`,`ServiceStartTime`,`AddressLine1`,`AddressLine2`,`zip`,`City` FROM servicerequest JOIN useraddress ON servicerequest.address = useraddress.AddressId WHERE ServiceRequestId = '$sp_id'";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function updateinfodetails($array1)
    {
        $sql = "UPDATE servicerequest SET `ServiceDate` = :date, `ServiceStartTime` = :time, `HasIssue` = :reason ,`Status` = :status WHERE ServiceRequestId = :sp_id";
        $stmt =  $this->conn->prepare($sql);
        $result = $stmt->execute($array1);
        $count = $stmt->rowCount();
        return $count;
    }

    public function update_info_details($array1)
    {
        $sql = "UPDATE servicerequest SET `ServiceDate` = :date, `ServiceStartTime` = :time,`ZipCode` = :code  WHERE ServiceRequestId = :sp_id";
        $stmt =  $this->conn->prepare($sql);
        $result = $stmt->execute($array1);
        $count = $stmt->rowCount();
        return $count;
    }

    public function insertaddress($array2)
    {
        $sql = "INSERT INTO servicerequestaddress (ServiceRequestId,AddressLine1,AddressLine2,City,PostalCode) VALUES (:sp_id,:sname,:houseno,:city,:code)";
        $stmt =  $this->conn->prepare($sql);
        $result = $stmt->execute($array2);
        return $result;
    }

    public function GetSP($servicereqid)
    {
        $sql = "SELECT DISTINCT(CONCAT(user.FirstName,user.LastName)) AS SP FROM `servicerequest` JOIN user ON servicerequest.ServiceProviderId = user.UserId WHERE servicerequest.Status = 'Completed' AND ServiceRequestId = '$servicereqid'";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $sp_name = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if($sp_name){
            foreach($sp_name as $row){
                $sp = $row['SP'];
                return $sp;
            }
        }
        
    }

    public function GetRating($spname)
    {
        $sql= "SELECT AVG(Ratings) AS rating FROM rating JOIN servicerequest ON rating.ServiceRequestId =servicerequest.ServiceRequestId WHERE RatingTo = '$spname' AND servicerequest.Status = 'Completed'";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $rating = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if($rating){
            foreach($rating as $row){
                $avg = $row['rating'];
                return $avg;
            }
        }
    }

    public function serviceinfo($req_id)
    {
        $sql = "SELECT ServiceRequestId,servicerequest.Status,user.FirstName,user.LastName,ServiceId,ServiceDate,ServiceHours,TotalCost,ServiceStartTime,ServiceProviderId,useraddress.AddressLine1,useraddress.AddressLine2 FROM `servicerequest` JOIN user ON servicerequest.UserId = user.UserId JOIN useraddress ON servicerequest.address = useraddress.AddressId WHERE ServiceId = '$req_id'";
        $stmt =  $this->conn->prepare($sql);
        $stmt->execute();
        $result  = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;

    }
}
?>

