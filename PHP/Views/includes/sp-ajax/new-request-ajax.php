<script>

   
    sp_id = "<?php echo $_SESSION['id']; ?>";


// table details

     $.ajax({
        url : 'http://localhost/Helperland/?controller=Helperland&function=newrequest',
       type : 'POST',
       data :{ 
             'id' : sp_id,
         },
       success:function(data){
        
        $('#table-details').html(data);
        var record = $('#records').val(); 
        $('#total-records').html(record);
       }
     });
   

$(document).ready(function(){

// Accept Req by sp

$(".open-btn").on("click",function(){
    req_id = $(this).closest('tr').attr("name");
    $.ajax({
        url : 'http://localhost/Helperland/?controller=Helperland&function=acceptrequestmodel',
        type : 'POST',
        data :{ 
             'reqid' : req_id,
         },
         success:function(data){
            $("#accept-details").html(data);
         }
    });
});

// Accepted btn clicked
$(".open-btn").on("click",function(){
    req_id = $(this).closest('tr').attr("name");
    $("#save-btn").on("click",function(){
        $.ajax({
             url : 'http://localhost/Helperland/?controller=Helperland&function=acceptrequest',
             type : 'POST',
             data :{ 
             'reqid' : req_id,
              'id' : sp_id,
             },
             success:function(data){
                
                   if(data == 1){
                       swal("Done","You have successfully accepted the service request","success");
                       setInterval(function(){
                           location.reload()
                       },3000);  
                   } else{
                       alert("error");
                   }
                    
               }
         });
    });
});    



});

</script>
