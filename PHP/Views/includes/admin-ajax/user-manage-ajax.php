<script>
    admin_id = <?php echo $_SESSION['id'] ?>;
    getUserDetails();

    function getUserDetails(){
          $.ajax({
              url : 'http://localhost/Helperland/?controller=Helperland&function=getAllUserDetails',
              type : 'POST',
              data :{ 
                 'id' : admin_id,
               },
              success:function(data){
                     $('#user-details').html(data);
                     
                 }
          });  
    };


$(document).ready(function(){
   
// Search By UserName

    $('#username').on("keyup",function(){
           username = $(this).val();
           $.ajax({
                url : 'http://localhost/Helperland/?controller=Helperland&function=searchbyUsername',
                 type : 'POST',
                 data :{ 
                      'id' : admin_id,
                      'username' : username,
                   },
                success:function(data){
                     $('#user-details').html(data);
                     
                 } 
           })
    });

// Search by Phone no.

$('#phone').on("keyup",function(){
           phone = $(this).val();
           $.ajax({
                url : 'http://localhost/Helperland/?controller=Helperland&function=searchbyPhone',
                 type : 'POST',
                 data :{ 
                      'id' : admin_id,
                      'phone' : phone,
                   },
                success:function(data){
                     $('#user-details').html(data);
                     
                 } 
           })
    });

// Search by Postal Code.

$('#code').on("keyup",function(){
           code = $(this).val();
           $.ajax({
                url : 'http://localhost/Helperland/?controller=Helperland&function=searchbyCode',
                 type : 'POST',
                 data :{ 
                      'id' : admin_id,
                      'code' : code,
                   },
                success:function(data){
                     $('#user-details').html(data);
                     
                 } 
           })
    });

// Search By User Type

$('#typeid').on("keyup",function(){
           typeid = $(this).val();
           $.ajax({
                url : 'http://localhost/Helperland/?controller=Helperland&function=searchbyUserType',
                 type : 'POST',
                 data :{ 
                      'id' : admin_id,
                      'typeid' : typeid,
                   },
                success:function(data){
                     $('#user-details').html(data);
                     
                 } 
           })
    });
// Active And Inactive user

$(".fail").on("click",function(){
     user_id = $(this).attr("name");
     status = $(this).closest('td').attr("class");
     $("#deletemodal").modal('show');

     $("#changebtn").on("click",function(){
         $.ajax({
              url:'http://localhost/Helperland/?controller=Helperland&function=changestatus',
              type: 'POST',
              data :{
                 'id' : user_id,
                 'status' : status,
              },
              success:function(data){
                   if(data == 1){
                      swal("Done","You have successfully changed the user status","success");
                       setInterval(function(){
                           location.reload()
                       },3000);
                   } else{
                       swal("Error","Something Went Wrong","error");
                   }
              }
         });
     });
});
$(".success").on("click",function(){
     user_id = $(this).attr("name");
     status = $(this).closest('td').attr("class");
     
     $("#deletemodal").modal('show');

     $("#changebtn").on("click",function(){
        $.ajax({
              url:'http://localhost/Helperland/?controller=Helperland&function=changestatus',
              type: 'POST',
              data :{
                 'id' : user_id,
                 'status' : status,
              },
              success:function(data){
                   if(data == 1){
                      swal("Done","You have successfully changed the user status","success");
                       setInterval(function(){
                           location.reload()
                       },3000);
                   } else{
                       swal("Error","Something Went Wrong","error");
                   }
              }
         });
     });
});

});
</script>
