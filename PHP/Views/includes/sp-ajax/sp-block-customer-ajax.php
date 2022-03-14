<script>

 

    sp_id = "<?php echo $_SESSION['id']; ?>";
    customer();
    function customer(){
         $.ajax({
            url : 'http://localhost/Helperland/?controller=Helperland&function=getuserdetails',
            type : 'POST',
            data :{ 
                'id' : sp_id,
            },
            success:function(data){
                $('#customer-details').html(data);
            }
         });
    };



$(document).ready(function(){

    $(".customer").on("click",function(){
        btn = $(this).text();
        userid = $(this).closest('div').attr('name');
        if(btn == 'Block'){
           $.ajax({
               url : 'http://localhost/Helperland/?controller=Helperland&function=blockcustomer',
               type : 'POST',
               data :{ 
                  'id' : sp_id,
                  'userid': userid,
              },
                success:function(data){
                  if(data == 1){
                    swal("Done","You have successfully blocked this customer","success");
                       setInterval(function(){
                           location.reload()
                       },3000);
                      
                 } else{
                    alert("Some Error Occured");
                 }
               }
          });
       } else {
             $.ajax({
              url : 'http://localhost/Helperland/?controller=Helperland&function=unblockcustomer',
              type : 'POST',
              data :{ 
                  'id' : sp_id,
                  'userid': userid,
              },
                 success:function(data){
                    if(data == 1){
                        swal("Done","You Have Unblocked this customer","success");
                       setInterval(function(){
                           location.reload()
                       },3000);
                       
                  } else{
                       alert("Some Error Occured");
                 }
             }
           });   
       }

    });

});
 
</script>