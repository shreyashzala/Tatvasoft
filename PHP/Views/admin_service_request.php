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
    <title>Admin - Service Request</title>

    <link rel="stylesheet" href="./assets/css/admin_service_request.css">

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
   include("includes/admin-ajax/service-request-ajax.php");
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
                <a class="nav-link" href="#id1" data-toggle="collapse">Coupan Code Management</a>
                <div class="collapse" id="id1">
                     <li>Coupan Code</li>
                     <li>Usage History</li>
                </div>
                <a class="nav-link" href="#">Escalation Management</a>
                <a class="nav-link" href="#">Service Provider</a>
                <a class="nav-link active" href="#">Service Request</a>
                <a class="nav-link" href="admin_user_management.php">User Management</a>
                <a class="nav-link" href="#id2" data-toggle="collapse">Finace Module</a>
                    <div class="collapse" id="id2">
                         <li>All Transactions </li>
                         <li>Generate Payment</li>
                         <li>Customer Invoices</li>
                   </div>
                <a class="nav-link" href="#">Zip Code Management</a>
                <a class="nav-link" href="#">Rating Management</a>
                <a class="nav-link" href="#">Inquiry Management</a>
                <a class="nav-link" href="#">Newsletter Management</a>
                <a class="nav-link" href="#id3" data-toggle="collapse">Content Management</a>
                <div class="collapse" id="id3">
                    <li>Blog</li>
                    <li>FAQs</li>
               </div>
                
              </nav>
        </div>
      </div>        
    </div>
    <div class="col-md-10 topic">
        <h2>Service Request </h2>

        <div class="box">
          <form action="" method="post" class="d-inline"> 
            <input type="number" class="one" placeholder="Service Id" id="serviceid">
            <input type="email" class="two" id="email" placeholder="Email">
            <input type="number" class="two" id="code" placeholder="PostalCode">
            <select id="customer" class="two">
               <option value="">Select Customer</option>
            </select>
            <select id="serviceprovider" class="three">
               <option value="">Select SP</option>
            </select>
            
            <input type="text" class="four" placeholder="Status" id="status"><br>
            <input type="checkbox" class="ml-5" name="check" id="check"> HasIssue
            <input type="date" class="five" placeholder="from date" id="sdate">
            <input type="date" class="six" placeholder="to date" id="edate">
            <button class="btn btn-primary" id="search">Search</button>
            <button class="btn btn-outline-primary">Clear</button>
          </form>
        </div>
        <table class="table">
          <thead>
            <th>Service ID </th>
            <th>Service Date </th>
            <th>Customer Details </th>
            <th>Service Provider </th>
            <th>Payment</th>
            <th>Status </th>
            <th>Actions </th>
          </thead>
          <tbody id="service-details">
              
          </tbody>
        </table>
        <footer>
          <p>&copy;2018 helperland , All rights reserved.</p>
        </footer>
    </div>
</div>
      
</body>
</html>

<!-- Edit And Reschedule Modal -->

<div class="modal fade" id="edit-reschedulemodal" tabindex="-1" role="dialog" aria-labelledby="edit-reschedulemodalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="edit-reschedulemodalLabel">Edit & Reschedule</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="row">
            <div class="col-md-6">
                <div class="form-field">
                     <label class="text-secondary font-weight-bold">Date</label>
                     <input type="text" class="form-control" id="date">
                 </div>
            </div>
            <div class="col-md-6">
                   <div class="form-field">
                        <label class="text-secondary font-weight-bold">Time</label>
                        <select class="form-control" id="time">
                                    <option value="8:00 AM">8:00 AM</option>
                                    <option value="9:00 AM">9:00 AM</option>
                                    <option value="10:00 AM">10:00 AM</option>
                                    <option value="11:00 AM">11:00 AM</option>
                                    <option value="12:00 PM">12:00 PM</option>
                                    <option value="1:00 PM">1:00 PM</option>
                                    <option value="2:00 PM">2:00 PM</option>
                        </select>
                  </div>
            </div>
          </div>
          <p class="text-secondary font-weight-bold">Service Address</p>
          <div class="row">
             <div class="col-md-6">
                     <div class="form-field">
                         <label class="text-secondary font-weight-bold">Street Name</label>
                         <input type="text" class="form-control" id="sname">
                    </div>
                    <div class="form-field">
                         <label class="text-secondary font-weight-bold">Postal Code</label>
                         <input type="number" class="form-control" id="code">
                    </div>
             </div>
             <div class="col-md-6">
                     <div class="form-field">
                         <label class="text-secondary font-weight-bold">House No</label>
                         <input type="text" class="form-control" id="houseno">
                    </div>
                    <div class="form-field">
                         <label class="text-secondary font-weight-bold">City</label>
                         <input type="text" class="form-control" id="city">
                    </div>
             </div>
          </div>
          <p class="text-secondary font-weight-bold">Invoice Address</p>
          <div class="row">
             <div class="col-md-6">
                     <div class="form-field">
                         <label class="text-secondary font-weight-bold">Street Name</label>
                         <input type="text" class="form-control" id="i_sname">
                    </div>
                    <div class="form-field">
                         <label class="text-secondary font-weight-bold">Postal Code</label>
                         <input type="number" class="form-control" id="i_code">
                    </div>
             </div>
             <div class="col-md-6">
                     <div class="form-field">
                         <label class="text-secondary font-weight-bold">House No</label>
                         <input type="text" class="form-control" id="i_houseno">
                    </div>
                    <div class="form-field">
                         <label class="text-secondary font-weight-bold">City</label>
                         <input type="text" class="form-control" id="i_city">
                    </div>
             </div>
          </div>
          <p class="text-secondary font-weight-bold">Why Do you want to reschedule service request??</p>
          <textarea id="reason" style="width:100%;" required></textarea>
          <p class="text-secondary font-weight-bold">Call Center EMP Notes</p>
          <textarea id="emp_notes" style="width:100%;" required></textarea>
          <button class="btn btn-primary text-light btn-block save mt-4" id="update">Update</button>
          <div id="msg"></div>
      </div>
      
    </div>
  </div>
</div>
