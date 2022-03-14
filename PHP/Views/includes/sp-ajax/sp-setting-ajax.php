<script>
$(document).ready(function(){

    sp_id = "<?php echo $_SESSION['id']; ?>";
    getAllSPdetails();


// Get All Details
function getAllSPdetails(){
      $.ajax({
            url : 'http://localhost/Helperland/?controller=Helperland&function=getallspdetails',
            type : 'POST',
            dataType: 'json',
            data :{ 
                'id' : sp_id,
            },
            success:function(data){
                
                $('#fname').val(data[0]);
                $('#lname').val(data[1]);
                $('#email').val(data[2]);
                $('#mobile').val(data[3]);
                $('#dateofbirth').val(data[4]);
                if(data[10] == 1){
                    $('input:radio[name="gender"]').filter('[value = "1"]').attr("checked",true);
                } else if (data[10] == 2){
                    $('input:radio[name="gender"]').filter('[value = "2"]').attr("checked",true);
                } else{
                    $('input:radio[name="gender"]').filter('[value = "3"]').attr("checked",true);
                }
                $('#nation').val(data[5]);
                $('#sname').val(data[6]);
                $('#houseno').val(data[7]);
                $('#code').val(data[8]);
                $('#city').val(data[9]);

                
            }
      });
}
    

// Change Password

$("#chpwd").on("click",function(){
      var oldpwd = $("#oldpwd").val();
      var newpwd = $("#newpwd").val();
      var conpwd = $("#conpwd").val();

    if((oldpwd.trim() == "") || (newpwd.trim() == "") || (conpwd.trim() == "")){
        $('#msg').html('<p class="alert alert-warning"> Please Enter All Details </p>');
    }else if (newpwd != conpwd){
        $('#msg').html('<p class="alert alert-warning"> Password Does not Match </p>');
    } else {
       $.ajax({
            url : 'http://localhost/Helperland/?controller=Helperland&function=changepassword',
            type : 'POST',
            data :{ 
                'id' : sp_id,
                'oldpwd' : oldpwd,
                'newpwd' : newpwd,
                'conpwd' : conpwd,
            },
            success:function(data){
                

                if(data == 0){
                    $('#msg').html('<p class="alert alert-warning"> Incorrect old Password </p>');
                } else{
                    $('#msg').html('<p class="alert alert-success"> Password Updated Successfully. </p>');
                }
            }
       });
    }
      
   });

// Update details

$("#updateinfo").on("click",function(){
    fname = $('#fname').val();
    lname = $('#lname').val();
    mobile = $('#mobile').val();
    gender = $('input[name="gender"]:checked').val();
    dateofbirth = $('#dateofbirth').val();
    nation =  $('#nation').val();
    street = $('#sname').val();
    houseno = $('#houseno').val();
    city = $('#city').val();
    code = $('#code').val();
    
    $.ajax({
             url : 'http://localhost/Helperland/?controller=Helperland&function=updatespinfo',
             type : 'POST',
             data :{ 
                'id' : sp_id,
                'fname': fname,
                'lname': lname,
                'mobile': mobile,
                'gender': gender,
                'dob': dateofbirth,
                'nation': nation,
                'sname' : street,
                'houseno': houseno,
                'code': code,
                'city': city,
            },
            success:function(data){
                  
                  if(data == 1){
                    $('#msg1').html('<p class="alert alert-success"> Updated Successfully. </p>');
                } else{
                    $('#msg1').html('<p class="alert alert-warning"> Some Error Occured </p>');
                }
            }
    });
});

});
</script>