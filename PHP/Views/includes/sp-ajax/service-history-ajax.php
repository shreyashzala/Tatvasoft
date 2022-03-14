<script>

   
    sp_id = "<?php echo $_SESSION['id']; ?>";


// table details

     $.ajax({
        url : 'http://localhost/Helperland/?controller=Helperland&function=sp_history',
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

</script>