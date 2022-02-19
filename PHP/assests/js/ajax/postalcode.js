
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
    $('#addhour').html('<span>'+ hour +'</span>');
}
function extra1(){
    var tex1= $("#extra1").text();
    $('#addextra1').html('<p class="ml-3">'+ tex1 + '<span class="float-right mr-3"> 30 Min </span> </p>');
    $(".one").css({
        "border": "3px solid #1D7A8C"
    });
}
function extra2(){
    var tex2= $("#extra2").text();
    $('#addextra2').html('<p class="ml-3">'+ tex2 + '<span class="float-right mr-3"> 30 Min </span> </p>');
    $(".two").css({
        "border": "3px solid #1D7A8C"
    });
}
function extra3(){
    var tex3= $("#extra3").text();
    $('#addextra3').html('<p class="ml-3">'+ tex3 + '<span class="float-right mr-3"> 30 Min </span> </p>');
    $(".three").css({
        "border": "3px solid #1D7A8C"
    });
}
function extra4(){
    var tex4= $("#extra4").text();
    $('#addextra4').html('<p class="ml-3">'+ tex4 + '<span class="float-right mr-3"> 30 Min </span> </p>');
    $(".four").css({
        "border": "3px solid #1D7A8C"
    });
}
function extra5(){
    var tex5= $("#extra5").text();
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
    }
    
    // $(".tab-content .third-tab").removeClass('active');
    // $(".fourth-tab").addClass('active');
    // $(".tab-content .fourth-nav").addClass('active');
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
    var address1 = $('#addressline1').text();
    var address2 = $('#addressline2').text();
    var mobile = $('#mobile').text();
    
    
    
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
