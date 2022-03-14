<script>

   
    sp_id = "<?php echo $_SESSION['id']; ?>";


// table details

     $.ajax({
        url : 'http://localhost/Helperland/?controller=Helperland&function=upcomingservices',
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
 
// See details in table row
       $('tr').on("click",function(){
          req_id = $(this).attr("name");
           $.ajax({
                  url : 'http://localhost/Helperland/?controller=Helperland&function=acceptrequestmodel',
                  type : 'POST',
                  data :{ 
                       'reqid' : req_id,
                    },
                  success:function(data){
                        $('#data-details').html(data);
                    }
           });
       })

 
$('tr').on("click",function(){
    req_id = $(this).attr("name");

    // Complete Request
      $('#complete').on("click",function(){
        $.ajax({
            url : 'http://localhost/Helperland/?controller=Helperland&function=completeservicereq',
            type : 'POST',
            data :{ 
              'reqid' : req_id,
            },
            success:function(data){
               if(data == 1){
                swal("Success","This service request is Completed","success");
                 setInterval(function(){
                       location.reload()
                    },3000);
               } else{
                 alert("Error occured");
               }
            }
        });
    });

  // Cancel Request 
    $('#cancel-req').on("click",function(){
      $.ajax({
            url : 'http://localhost/Helperland/?controller=Helperland&function=cancelservicereq',
            type : 'POST',
            data :{ 
              'reqid' : req_id,
            },
            success:function(data){
               if(data == 1){
                swal("Done","This service request is cancelled","info");
                 setInterval(function(){
                      location.reload()
                    },3000);
               } else{
                 alert("Error occured");
               }
            }
        });
    });   
});


// Cancel req through table button
$(".cancel-req").on("click",function(){
   req_id = $(this).attr("name");
   $.ajax({
            url : 'http://localhost/Helperland/?controller=Helperland&function=cancelservicereq',
            type : 'POST',
            data :{ 
              'reqid' : req_id,
            },
            success:function(data){
               if(data == 1){
                 swal("Done","This service request is cancelled","info");
                 setInterval(function(){
                           location.reload()
                    },3000);
               } else{
                 alert("Error occured");
               }
            }
        });
        
}); 



});

</script>