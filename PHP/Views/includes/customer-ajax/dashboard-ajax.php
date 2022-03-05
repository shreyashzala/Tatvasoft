<script>
   id = "<?php echo $_SESSION['id']; ?>";
   
   $.ajax({
       url : 'http://localhost/Helperland/?controller=Helperland&function=dashboard',
       type : 'POST',
       // dataType: 'json',
       data :{ 
             'id' : id,
         },
       success:function(data2){
        
        $('#table-dashboard').html(data2);
        var record = $('#records').val(); 
        $('#total-records').html(record);
       }
   });

$(document).ready(function(){
 
// Showing Booking Details  
    $('tr').on("click",function(){
      reqid = $(this).attr('name');
      $.ajax({
          url:'http://localhost/Helperland/?controller=Helperland&function=bookingdetails',
          type : 'POST',
          data : { 
             'servicereqid' : reqid,
         },
         success:function(data){
           $("#booking-details").html(data);
         }
      });
      
      
    });
     
// Cancel Details
    $(".cancel-btn").on("click",function(){
          reqid = $(this).closest('tr').attr('name');
          
          $('#cancelnow').on("click",function(){
              issue = $('#cancelreq').val();
              if(issue.trim() == ""){
                 $("#errormsg").html('<p class="alert alert-danger">Please enter a reason to cancel</p>')  
              } else{
                $.ajax({
                  url:'http://localhost/Helperland/?controller=Helperland&function=cancelrequest',
                  type : 'POST',
                  data : { 
                       'servicereqid' : reqid,
                       'issue' : issue,
                    },
                  success:function(data){
                        
                         if(data == 1){
                            location.reload();
                         } else {
                           alert("Some Error Occured");
                         }
                    }
                });
              }
              
          });
    });
// Reschedule Request

$('.reschedule-btn').on("click",function(){
    reqid = $(this).closest('tr').attr('name');
       $('#reschedule').on("click", function(){
           newdate = $('#newdate').val();
           if(newdate.trim() == ""){
                 $("#reschedulemsg").html('<p class="alert alert-danger">Please select date </p>')  
              } else{
                $.ajax({
                  url:'http://localhost/Helperland/?controller=Helperland&function=reschedulerequest',
                  type : 'POST',
                  data : { 
                       'servicereqid' : reqid,
                       'newdate' : newdate,
                    },
                  success:function(data){
                        console.log(data);
                         if(data){
                            location.reload();
                            
                         } else {
                           alert("Some Error Occured");
                         }
                    }
                });
              }
     });
});

});

  
  </script>
