
function checkcode(){
     var code = $("#code").val();
    
    if(code.trim() == ""){
        $('#msg').html('<p class="alert alert-warning"> Please Enter Post Code </p>');   
    } else{
        $.ajax({
            url: 'http://localhost/Helperland/?controller=Helperland&function=checkcode',
            type : 'POST',
            dataType: 'json',
            data:{  
              "code" : code,
            },
            success:function(data){
                
                if(data == "Yes"){

                    $(".tab-content .first-nav").removeClass('active');
                    $(".second-tab").addClass('active');
                    $(".tab-content .second-nav").addClass('active');
                } else{
                    $('#msg').html('<p class="alert alert-danger"> Enter Valid Post Code </p>');
                }
            }
           });
    }

}

function bed(){
    var bed = $("#bed").val();
    $('#addbed').html('<span>'+bed+'</span>');
}
function bath(){
    var bath = $("#bath").val();
    $('#addbath').html('<span>'+bath+'</span>');
}
function time(){
    var time = $("#time").val();
    $('#addtime').html('<span>'+time+'</span>');
}

function hour(){
    var hour = $("#hours").val();
    amount = $("#amount").text();
    var pay = hour * amount;
    $('#totalPayment').html('<span>' + pay + '</span>');
    $('#addhour').html('<span>'+ hour +' hrs. </span>');
}
function extra1(){
    var tex1= $("#extra1").text();
    var hour = $("#hours").val();
    time1 = parseFloat(hour) + 0.5;
    amount = $("#amount").text();
    total_amount = amount * time1;
    $('#totalPayment').html('<span>' + total_amount + '</span>');
    $('#addextra1').html('<p class="ml-3">'+ tex1 + '<span class="float-right mr-3"> 30 Min </span> </p>');
    $(".one").css({
        "border": "3px solid #1D7A8C"
    });
    $('#totalservice').html('<span>' + time1 + '</span>');
}
function extra2(){
    var tex2= $("#extra2").text();
    var hour = $("#hours").val();
    if(typeof(time1) === 'undefined'){
         time2 = parseFloat(hour) + 0.5;
         
    }else{
         time2 = time1 + 0.5;
    }
    amount = $("#amount").text();
    total_amount = amount * time2;
    $('#totalPayment').html('<span>' + total_amount + '</span>');
    $('#totalservice').html('<span>' + time2 + '</span>');
    $('#addextra2').html('<p class="ml-3">'+ tex2 + '<span class="float-right mr-3"> 30 Min </span> </p>');
    $(".two").css({
        "border": "3px solid #1D7A8C"
    });
}
function extra3(){
    var tex3= $("#extra3").text();
    var hour = $("#hours").val();
    if(typeof(time1) && typeof(time2) === 'undefined'){
         time3 = parseFloat(hour) + 0.5;
    }else{
         time3 = time2 + 0.5;
    }
    amount = $("#amount").text();
    total_amount = amount * time3;
    $('#totalPayment').html('<span>' + total_amount + '</span>');
    $('#totalservice').html('<span>' + time3 + '</span>');
    $('#addextra3').html('<p class="ml-3">'+ tex3 + '<span class="float-right mr-3"> 30 Min </span> </p>');
    $(".three").css({
        "border": "3px solid #1D7A8C"
    });
}
function extra4(){
    var tex4= $("#extra4").text();
    var hour = $("#hours").val();
    if(typeof(time1) && typeof(time2) && typeof(time3) === 'undefined'){
         time4 = parseFloat(hour) + 0.5;
    }else{
         time4 = time3 + 0.5;
    }
    amount = $("#amount").text();
    total_amount = amount * time4;
    $('#totalPayment').html('<span>' + total_amount + '</span>');
    $('#totalservice').html('<span>' + time4 + '</span>');
    $('#addextra4').html('<p class="ml-3">'+ tex4 + '<span class="float-right mr-3"> 30 Min </span> </p>');
    $(".four").css({
        "border": "3px solid #1D7A8C"
    });
}
function extra5(){
    var tex5= $("#extra5").text();
    var hour = $("#hours").val();
    if(typeof(time1) && typeof(time2) && typeof(time3) && typeof(time4) === 'undefined'){
        time5 = parseFloat(hour) + 0.5;
   }else{
        time5 = time4 + 0.5;
   }
    amount = $("#amount").text();
    total_amount = amount * time5;
    $('#totalPayment').html('<span>' + total_amount + '</span>');
    $('#totalservice').html('<span>' + time5 + '</span>');
    $('#addextra5').html('<p class="ml-3">'+ tex5 + '<span class="float-right mr-3"> 30 Min </span> </p>');
    $(".five").css({
        "border": "3px solid #1D7A8C"
    });
}
function plan(){
    
    var id = $('#user_id').val();
    $.ajax({
        url : 'http://localhost/Helperland/?controller=Helperland&function=showaddress',
        type : 'POST',
        // dataType: 'json',
        data :{ "id" : id},
        success:function(data2){
          $('#address').html(data2);

        }
    });
    



    $(".tab-content .second-nav").removeClass('active');
    $(".third-tab").addClass('active');
    $(".tab-content .third-nav").addClass('active');
    var zip = $('#code').val();
    $('#zipcode').html(zip);
    
}



function add(){
    var userid = $('#userid').val();
    var street = $('#sname').val();
    var houseno = $('#houseno').val();
    var zip = $('#code').val();
    var city = $('#city').val();
    var mobile = $('#phone').val();

    if((street.trim() == "") || (houseno.trim() == "") || (zip.trim() == "") || (city.trim() == "") || (mobile.trim() == "")){
        $('#msg1').html('<p class="alert alert-warning"> Please Enter All Details </p>');
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
                    $('#msg1').html('<p class="alert alert-success"> Ok Inserted Successfully </p>');
                    
                    
                } else{
                    $('#msg1').html('<p class="alert alert-danger"> Enter Valid Address </p>');
                }
            }
        });
    }
}

function yourdetails(){

    var id = $('#address input[name = "radio"]:checked').val();
    console.log(id);

    if(id == 'on'){
        $(".tab-content .third-tab").removeClass('active');
        $(".fourth-tab").addClass('active');
        $(".tab-content .fourth-nav").addClass('active');
    } else{
        console.log("sorry you have to enter address");
        alert("Please Select atleast one address");
    }

}
function promocode(){
    var promocode = $('#promocode').val();
    var correctpromocode = "helper123";
  
    if(promocode == correctpromocode){
        $('#promo').html('<p class="alert alert-success"> Ok ,Promocode is apply </p>');
    }else{
        $('#promo').html('<p class="alert alert-danger"> Enter Valid Promocode </p>');
    }
}
function payment(){
    var card = $('#cardnumber').val();
    var month = $('#month').val();
    var cvv = $('#cvv').val();
    var userid = $('#userid').val();
    var zip = $('#code').val();
    var date = $("#date").text();
    var total_hour = $('#totalservice').text();
    var hour_rate = $("#amount").text();
    var total = $('#totalPayment').text();
    var hour = $("#hours").val();
    var extra_hour = total_hour - hour; 
    
    
    
    if(card.trim().length == '12'){
        if(month.trim() != "") {
            if(cvv.trim().length == '3'){
                
                $.ajax({
                    url : 'http://localhost/Helperland/?controller=Helperland&function=booking',
                    type : 'POST',
                    // dataType: 'json',
                    data :{ 
                        "userid" : userid,
                        "zip" : zip,
                        "date" : date,
                        "totalhours" : total_hour,
                        "payment" : total,
                        "extrahour" : extra_hour,
                        "hour_rate" : hour_rate,
                    },
                    success:function(data2){
                      alert("Your Booking Is Confirmed & Your Service Id is : "+ data2);
            
                    }
                });
            } else{
                $('#pay').html('<p class="alert alert-danger"> CVV is wrong</p>');
            }
        } else{
            $('#pay').html('<p class="alert alert-danger"> Month is not correct</p>');
        }
    } else{
        $('#pay').html('<p class="alert alert-danger"> Card Number is invalid </p>');
    }
    
}
