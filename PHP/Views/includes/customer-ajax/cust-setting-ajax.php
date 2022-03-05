<script>

$(document).ready(function() {
    
    userid = "<?php echo $_SESSION['id']; ?>"; 
    userInfo();

// My Details Tab fetch Data

    function userInfo(){
        $.ajax({
            url : 'http://localhost/Helperland/?controller=Helperland&function=userdetails',
            type : 'POST',
            dataType: 'json',
            data :{ 
                'id' : userid,
            },
            success:function(data){
                $('#fname').val(data[0]);
                $('#lname').val(data[1]);
                $('#email').val(data[2]);
                $('#mobile').val(data[3]);
                $('#dateofbirth').val(data[4]);
                $('#language').val(data[5]);
            }
        });
    }

// Address Fetch Data

   $("#second").on("click",function(){
       
       $.ajax({
        url : 'http://localhost/Helperland/?controller=Helperland&function=showuseraddress',
        type : 'POST',
        // dataType: 'json',
        data :{ "id" : userid},
        success:function(data2){
          $('#address').html(data2);

        }
    });
   });

// Change Password Tab

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
                'id' : userid,
                'oldpwd' : oldpwd,
                'newpwd' : newpwd,
                'conpwd' : conpwd,
            },
            success:function(data){
                console.log(data);

                if(data == 0){
                    $('#msg').html('<p class="alert alert-warning"> Incorrect old Password </p>');
                } else{
                    $('#msg').html('<p class="alert alert-success"> Password Updated Successfully. </p>');
                }
            }
       });
    }
      
   });

// Update mydetails

   $("#updateinfo").on("click",function(){
        fname = $('#fname').val();
        lname = $('#lname').val();
        mobile = $('#mobile').val();
        dob = $('#dateofbirth').val();
        languageid = $('#language').val();       
        
        $.ajax({ 
          url : 'http://localhost/Helperland/?controller=Helperland&function=updateinfo',
            type : 'POST',
            data :{ 
                'id' : userid,
                'fname' : fname,
                'lname' : lname,
                'mobile' : mobile,
                'dob' : dob,
                'languageid' : languageid,
            },
            success:function(data){
                console.log(data);
                if(data == 1){
                    $('#msg1').html('<p class="alert alert-success">  Updated Successfully. </p>');
                } else{
                    $('#msg1').html('<p class="alert alert-warning"> Some Error Occured... Sorry. </p>');
                }
            }
        });
                
                
                
   });

// Delete Button
   
    $("#deletebtn").on("click", function(){
        addressid = $('input[name="radio"]:checked').val();
        if(addressid){
             
             $.ajax({
                  url : 'http://localhost/Helperland/?controller=Helperland&function=deleteaddress',
                  type : 'POST',
                  dataType: 'json',
                  data :{ 
                     'id' : addressid,
               },
               success:function(data){
                  if(data == 1){
                      
                      location.reload();
                  } else{
                      alert("Some Error...Sorry")
                  }
               }
             });
    } else{
        alert("Please Select One");
    }
  });


// Show Address Details in Modal

$('#address').on("click",function(){
    addressid = $('input[name="radio"]:checked').val();
    if(addressid){
        
        $.ajax({
                
                url : 'http://localhost/Helperland/?controller=Helperland&function=editaddress',
                type : 'POST',
                //   dataType: 'json',
                data :{ 
                     'id' : addressid,
               },
               success:function(data){
                    $('#demo').html(data);
               }
            });
    } else {
        
        $('#demo').html("<p>Please Select address to edit</p>");
    }
               
     
});

//   Edit Address

$("#editbtn").on("click", function(){
    
    var street = $("#street-name").val();
    var house = $("#house-no").val();
    var postcode = $("#postal-code").val();
    var city = $("#city-name").val();
    var mobile = $("#phone-no").val();
    addressid = $('input[name="radio"]:checked').val();
    
    $.ajax({
             url : 'http://localhost/Helperland/?controller=Helperland&function=updateaddress',
             type : 'POST',
             data :{ 
                 'id' : addressid,
                 'sname' : street,
                 'houseno' : house,
                 'zipcode' : postcode,
                 'city' : city,
                 'mobile' : mobile,
             },
             success:function(data){
                 if(data == 1){
                    $('#msg2').html('<p class="alert alert-success">  Updated Successfully. </p>');
                 } else {
                    $('#msg2').html('<p class="alert alert-warning"> Some Error Occured... Sorry. </p>');
                 }
             }
        });


});

// Add New Address

$('#addbtn').on("click",function(){
    userid = "<?php echo $_SESSION['id']; ?>";
    var street = $('#sname').val();
    var houseno = $('#houseno').val();
    var zip = $('#code').val();
    var city = $('#city').val();
    var mobile = $('#phone').val();

    if((street.trim() == "") || (houseno.trim() == "") || (zip.trim() == "") || (city.trim() == "") || (mobile.trim() == "")){
        $('#msg3').html('<p class="alert alert-warning"> Please Enter All Details </p>');
    } else{
        $.ajax({
            url: 'http://localhost/Helperland/?controller=Helperland&function=addadress',
            type : 'POST',
            dataType: 'json',
            data:{  
              "userid" : userid,
              "street" : street,
              "houseno": houseno,
              "zip" : zip,
              "city": city,
              "mobile": mobile,
            },
            success:function(data1){
                if(data1 == "Yes"){
                    $('#msg3').html('<p class="alert alert-success"> Ok Inserted Successfully </p>');
                    // location.reload();
                    
                    
                } else{
                    $('#msg3').html('<p class="alert alert-danger"> Enter Valid Address </p>');
                }
            }
        });
    }
});
   

   


});


</script>