<?php
  session_start();
      if(isset($_SESSION['name'])){
          $name = $_SESSION['name'];
          $userid = $_SESSION['id'];
      } else{
           $base_url = "http://localhost/Helperland/";
           header('Location:' . $base_url);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - User Management</title>

    <link rel="stylesheet" href="./assets/css/admin_user_management.css">

    <link rel="stylesheet" href="./assets/css/bootstrap.min.css">

    <link rel="stylesheet" href="./assets/css/all.min.css">

    <!-- js Files -->

    <script src="./assets/js/jquery.min.js"></script>
    <script src="./assets/js/poper.min.js"></script>
    <script src="./assets/js/bootstrap.min.js"></script>
    <script src="./assets/js/all.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


</head>
<?php
   include("includes/admin-ajax/user-manage-ajax.php");
?>
<body>
    
 <div class="wrapper">
    <nav class="navbar navbar-expand-lg navbar-light bg-primary">
        <a class="navbar-brand text-light" href="#">helperland</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav menu">
            <li class="nav-item">
              <a class="nav-link" href="#"><img src="./assets/image/admin-user.png" class="admin" alt="admin"></a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-light ml-2 mr-3 username" href="#"><?php echo $name; ?></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="http://localhost/Helperland/?controller=Helperland&function=logout"><img src="./assets/image/logout.png" class="logout" alt="logout"></a>
            </li>
          </ul>
        </div>
      </nav>

</div>    
<!-- Vertical Nav & Table -->
<div class="row">
    <div class="col-md-2">
      <div class="card">
        <div class="card-text">
            <nav class="nav flex-column v-nav">
                <a class="nav-link" href="#">Service Management</a>
                <a class="nav-link" href="#">Role Management</a>
                <a class="nav-link" href="#">Coupan Code Management</a>
                <a class="nav-link" href="#">Escalation Management</a>
                <a class="nav-link" href="#">Service Provider</a>
                <a class="nav-link" href="admin_service_request.php">Service Request</a>
                <a class="nav-link active" href="#">User Management</a>
                <a class="nav-link" href="#">Finace Module</a>
                <a class="nav-link" href="#">Zip Code Management</a>
                <a class="nav-link" href="#">Rating Management</a>
                <a class="nav-link" href="#">Inquiry Management</a>
                <a class="nav-link" href="#">Newsletter Management</a>
                <a class="nav-link" href="#">Content Management</a>
                
              </nav>
        </div>
      </div>        
    </div>
    <div class="col-md-10 topic">
        <h2>User Management  <span><a href="#" class="btn btn-primary">Add New User</a></span></h2>

        <div class="box">
          <form action="" method="post" class="d-inline"> 
            <input type="text" class="one" placeholder="Username" id="username">
            <input type="text" class="two" placeholder="UserTypeId" id="typeid">
            <input type="number" class="three" placeholder="Phone number" id="phone">
            <input type="number" class="four" placeholder="Zip Code" id ="code">
            
            <button class="btn btn-outline-primary">Clear</button>
          </form>
        </div>
        <table class="table">
          <thead>
            <th>User Name</th>
            <th>User Type</th>
            <th>Date Of Registration</th>
            <th>Phone</th>
            <th>Postal Code</th>
            <th>User Status</th>
            <th>Action</th>
          </thead>
          <tbody id="user-details">
            
            
            
             
          </tbody>
          
        </table>
        <footer>
          <p>&copy;2018 helperland , All rights reserved.</p>
        </footer>
    </div>
</div>
      
</body>
</html>

<!-- Status Model -->


<div class="modal fade" id="deletemodal" tabindex="-1" role="dialog" aria-labelledby="deletemodalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deletemodalLabel">Change Status</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <h6>Are you sure to want change the Status ??</h6>
          <button class="btn btn-primary text-light btn-block save mt-4" id="changebtn">Change</button>
      </div>
      
    </div>
  </div>
</div>
