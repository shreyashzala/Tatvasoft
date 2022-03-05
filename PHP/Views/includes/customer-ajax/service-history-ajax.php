<script>
   id = "<?php echo $_SESSION['id']; ?>";
//  Show Data  
   $.ajax({
       url : 'http://localhost/Helperland/?controller=Helperland&function=history',
       type : 'POST',
       // dataType: 'json',
       data :{ 
             'id' : id,
         },
       success:function(data2){
        $('#table-history').html(data2);
        var record = $('#records').val(); 
        $('#total-records').html(record);
       }
   });
 
$(document).ready(function(){

// Rating of SP

// Ontime Arrival

//   1 Star
   $("#ontime1").on("click", function(){
          $(this).attr("src", "./assets/image/star-filled.png");
          $("#info1").text("1");
   // 2nd Star
   $("#ontime2").on("click", function(){
          $(this).attr("src", "./assets/image/star-filled.png");
          $("#info1").text("2");
   //  3rd Star
   $("#ontime3").on("click", function(){
            $(this).attr("src", "./assets/image/star-filled.png");
            $("#info1").text("3");
   //  4th Star
   $("#ontime4").on("click", function(){
            $(this).attr("src", "./assets/image/star-filled.png");
            $("#info1").text("4");
   // 5 star 
   $("#ontime5").on("click", function(){
            $(this).attr("src", "./assets/image/star-filled.png");
            $("#info1").text("5");
         });
      });             
    });   
   });
 }); 


// Friendly

//   1 Star
$("#friendly1").on("click", function(){
          $(this).attr("src", "./assets/image/star-filled.png");
          $("#info2").text("1");
   // 2nd Star
   $("#friendly2").on("click", function(){
          $(this).attr("src", "./assets/image/star-filled.png");
          $("#info2").text("2");
   //  3rd Star
   $("#friendly3").on("click", function(){
            $(this).attr("src", "./assets/image/star-filled.png");
            $("#info2").text("3");
   //  4th Star
   $("#friendly4").on("click", function(){
            $(this).attr("src", "./assets/image/star-filled.png");
            $("#info2").text("4");
   // 5 star 
   $("#friendly5").on("click", function(){
            $(this).attr("src", "./assets/image/star-filled.png");
            $("#info2").text("5");
         });
      });             
    });   
   });
 }); 


// Quality Of Service

//   1 Star
$("#service1").on("click", function(){
          $(this).attr("src", "./assets/image/star-filled.png");
          $("#info3").text("1");
   // 2nd Star
   $("#service2").on("click", function(){
          $(this).attr("src", "./assets/image/star-filled.png");
          $("#info3").text("2");
   //  3rd Star
   $("#service3").on("click", function(){
            $(this).attr("src", "./assets/image/star-filled.png");
            $("#info3").text("3");
   //  4th Star
   $("#service4").on("click", function(){
            $(this).attr("src", "./assets/image/star-filled.png");
            $("#info3").text("4");
   // 5 star 
   $("#service5").on("click", function(){
            $(this).attr("src", "./assets/image/star-filled.png");
            $("#info3").text("5");
         });
      });             
    });   
   });
 }); 

$('.rating').on("click",function(){
   reqid = $(this).closest('tr').attr('name');
   console.log(reqid);

$("#submit").on("click", function(){
   info1 = $("#info1").text();
   info2 = $("#info2").text();
   info3 = $("#info3").text();
   total = parseFloat(info1) + parseFloat(info2) + parseFloat(info3);
   subtotal = total/3;
   total_rating = Math.floor(subtotal);
   comment = $('#feedback').val();
   
   
   
    $.ajax({
       url:'http://localhost/Helperland/?controller=Helperland&function=rating',
       type : 'POST',
       data : {
          'id' : id,
          'servicereqid' : reqid,
          'info1' : info1,
          'info2' : info2,
          'info3' : info3,
          'total_rating' : total_rating,
          'comment' : comment,
       },
       success:function(data){
            console.log(data);
            if(data == 1){
               $("#successmsg").html('<p class="alert alert-success">  Inserted Successfully </p>');
            } else {
               $("#successmsg").html('<p class="alert alert-warning"> Error </p>');
            }
       }
    });
  });
}); 
 

});
  </script>