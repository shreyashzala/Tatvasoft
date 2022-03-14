<script>
    sp_id = "<?php echo $_SESSION['id']; ?>";
    rating();
    function rating(){
         $.ajax({
            url : 'http://localhost/Helperland/?controller=Helperland&function=sprating',
            type : 'POST',
            data :{ 
                'id' : sp_id,
            },
            success:function(data){
                $('#rating').html(data);
            }
         });
    };
</script>