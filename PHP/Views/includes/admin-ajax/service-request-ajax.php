<script>

admin_id = <?php echo $_SESSION['id'] ?>;
    getServiceDetails();

    function getServiceDetails(){
          $.ajax({
              url : 'http://localhost/Helperland/?controller=Helperland&function=getAllServiceDetails',
              type : 'POST',
              data :{ 
                 'id' : admin_id,
               },
              success:function(data){
                     $('#service-details').html(data);
                     
                 }
          });  
    };

$(document).ready(function(){


// Search By ServiceId

    $('#serviceid').on("keyup",function(){
           serviceid = $(this).val();
           $.ajax({
                url : 'http://localhost/Helperland/?controller=Helperland&function=searchbyServiceId',
                 type : 'POST',
                 data :{ 
                      'serviceid' : serviceid,
                   },
                success:function(data){
                     $('#service-details').html(data);
                     
                 } 
           })
    });

// Search By Status

   $('#status').on("keyup",function(){
           status = $(this).val();
           $.ajax({
                url : 'http://localhost/Helperland/?controller=Helperland&function=searchbyStatus',
                 type : 'POST',
                 data :{ 
                      'status' : status,
                   },
                success:function(data){
                     $('#service-details').html(data);
                     
                 } 
           });
    });

// Search by email

   $('#email').on("keyup",function(){
           email = $(this).val();
           $.ajax({
                url : 'http://localhost/Helperland/?controller=Helperland&function=searchbyEmail',
                 type : 'POST',
                 data :{ 
                      'email' : email,
                   },
                success:function(data){
                     $('#service-details').html(data);
                     
                 } 
           });
    });
// Search by Code

   $('#code').on("keyup",function(){
           code = $(this).val();
           $.ajax({
                url : 'http://localhost/Helperland/?controller=Helperland&function=searchbyPostalCode',
                 type : 'POST',
                 data :{ 
                      'code' : code,
                   },
                success:function(data){
                     $('#service-details').html(data);
                     
                 } 
           });
    });

// Search by Customer

customer();

function customer(){
      $.ajax({
           url: 'http://localhost/Helperland/?controller=Helperland&function=customer',
           type: 'POST',
           dataType: 'json',
           data : {
               'id' : admin_id,
           },
           success:function(data){
               $.each(data,function(key,value){
                 $('#customer').append("<option value='"+value.Customer+"'>" + value.Customer +  "</option>");
               });
           }
      });
};

$('#customer').on("change",function(){
      customer = $(this).val();
      
      if(customer == ''){
         $('#service-details').html("");
      } else{
          $.ajax({
               url:'http://localhost/Helperland/?controller=Helperland&function=searchbycustomer',
               type: 'POST',
               data:{
                   'id': admin_id,
                   'cust': customer,
               },
               success: function(data){
                   $('#service-details').html(data);
               }
          });
      }

});
// Search by Service Provider

ServiceProvider();

function ServiceProvider(){
      $.ajax({
           url: 'http://localhost/Helperland/?controller=Helperland&function=serviceprovider',
           type: 'POST',
           dataType: 'json',
           data : {
               'id' : admin_id,
           },
           success:function(data){
               $.each(data,function(key,value){
                 $('#serviceprovider').append("<option value='"+value.SP+"'>" + value.SP +  "</option>");
               });
           }
      });
};

$('#serviceprovider').on("change",function(){
      sp = $(this).val();
      
      if(sp == ''){
         $('#service-details').html("");
      } else{
          $.ajax({
               url:'http://localhost/Helperland/?controller=Helperland&function=searchbysp',
               type: 'POST',
               data:{
                   'id': admin_id,
                   'sp': sp,
               },
               success: function(data){
                   $('#service-details').html(data);
               }
          });
      }

});


// Serch by checkbox

   $("#check").on("click",function(){
      
      
    if($(this).is(":checked")){
        $.ajax({
                url : 'http://localhost/Helperland/?controller=Helperland&function=searchbyIssue',
                type : 'POST',
                data :{ 
                      'id': admin_id,
                },
                success:function(data){
                     $('#service-details').html(data);       
             }
       });      
    } else {
        $('#service-details').html("");
        
    }
    
   });

// Search By Date
 
 $('#search').on("click",function(e){
      e.preventDefault();
      sdate = $('#sdate').val();
      edate = $('#edate').val();
        $.ajax({
               url : 'http://localhost/Helperland/?controller=Helperland&function=searchbyDate',
                type : 'POST',
                data :{ 
                      'sdate' : sdate,
                      'edate' : edate,
                },
                success:function(data){
                     $('#service-details').html(data);
                     
                }
           });
 });


// Edit And Reschedule Model

 $(".edit-reschedule").on("click",function(){
       $('#edit-reschedulemodal').modal('show');
       reqid = $(this).closest('tr').attr('class');
       
       $.ajax({
           url:'http://localhost/Helperland/?controller=Helperland&function=editmodeldetails',
           type: 'POST',
           dataType: 'json',
           data: {
               'sp_id': reqid,
           },
            success:function(data){
                $('#date').val(data[1]);
                $('#time').val(data[2]);
                $('#sname').val(data[3]);
                $('#houseno').val(data[4]);
                $('#code').val(data[5]);
                $('#city').val(data[6]);
                $('#i_sname').val(data[3]);
                $('#i_houseno').val(data[4]);
                $('#i_code').val(data[5]);
                $('#i_city').val(data[6]);
                
            }
       });

    // Update Service request
    
     $('#update').on("click",function(){
          date = $('#date').val();
          time = $('#time').val();
          sname = $('#sname').val();
          houseno = $('#houseno').val();
          city = $('#city').val();
          code = $('#code').val();
          reason = $('#reason').val();

          if(reason.trim() == ''){
              $('#msg').html('<p class="alert alert-danger">Please Enter reason to reschedule</p>');
          } else {
              $.ajax({
                   url:'http://localhost/Helperland/?controller=Helperland&function=updateinfodetails',
                   type: 'POST',
                   data:{
                     'sp_id' : reqid,
                     'date': date,
                     'time': time,
                     'sname' : sname,
                     'houseno': houseno,
                     'city': city,
                     'code': code,
                     'reason': reason,
                   },
                   success:function(data){
                    if(data == 1){
                      swal("Done","Your Details have been succesfully updated","success");
                       setInterval(function(){
                           location.reload()
                       },3000);
                   } else{
                        swal("Error","Something Went Wrong","error");
                     }
                   }
              });
          }
       });
   });


});    
</script>
