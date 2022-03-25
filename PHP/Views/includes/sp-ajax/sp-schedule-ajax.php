<script>
    id = "<?php echo $_SESSION['id']; ?>";


    document.addEventListener('DOMContentLoaded', function(){
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {

         eventClick:function(calEvent){
             var eventObj = calEvent.event;
             $('#detailsmodal').modal("show");
             $.ajax({
                  url : 'http://localhost/Helperland/?controller=Helperland&function=serviceinfo',
                  type : 'POST',
                  data :{ 
                       'reqid' : eventObj.id,
                    },
                 dataType: 'json', 
                 success:function(data){
                        
                        $('#bookdate').html(data[0]);
                        $('#booktime').html(data[1]);
                        $('#bookid').html(data[2]);
                        $('#bookrupees').html(data[3]);
                        $('#fname').html(data[4]);
                        $('#lname').html(data[5]);
                        $('#address1').html(data[6]);
                        $('#address2').html(data[7]);
                        
                        
                    }
             });
        },
        customButtons:{
            completed:{
                text:'Completed',
            },
            upcoming:{
                text:'upcoming',
            }
        },    
         headerToolbar: {
             left:'prev,next',
             center:'title',
             right:'completed,upcoming',
         },

         eventSources: [{
             url:"http://localhost/Helperland/?controller=Helperland&function=spdate&parameter=" + id,
             color: '#1d7a8c',
         },
         {
              url:"http://localhost/Helperland/?controller=Helperland&function=spalldates&parameter=" + id,
              color: '#efefef',
              textColor: 'black',
          },

         ],

        });
        calendar.render();
    });
     
        
</script>
