<?php require_once("../autoload.php");
if(!$getUser->admin_log_check()) {header('location:login'); exit();}else {$user_id=$_SESSION['user_id'];if(!$getUser->final_check($user_id)) {header('location:login'); exit();}}
?>
<?php include("header.php");

?>
<link href="assets/css/calendarstyle.css"
rel="stylesheet">
<script src="assets/js/fullcalendar5.11.0.js"></script>

                <?php include("sidebar.php");
                switch($postm) 
{
  case 'admin':
  ?> 
        <!-- page content -->
<div class="right_col" role="main">
          <div class="">
            

            <div class="clearfix"></div>

        

             <div class="row">
              <!-- form input mask -->
       

              <div class="col-md-12 col-sm-12"> 
                
                <div class="x_panel">
                  <div class="x_title">
                   
                   
                   
                  <div class="x_content">
<?php if(isset($_GET['detect'])) 
{
  $detect=$_GET['detect'];
}
else 
{
  $detect='default'; 
}
switch ($detect) {
  default:
// Dummy data for classroom table



?> 
<div class="row">
    <div class="col-sm-12">
  <div class="page-title">
              <div class="title_left">
                <h3>Calendar</h3>

              </div>

              <div class="title_right">
                
              </div>
            </div>
          </div>
        </div>

<div id="calendar"></div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
     var events = document.querySelectorAll('.fc-event-main');
    events.forEach(function(event) {
        var title = event.querySelector('.fc-event-title');
        var width = title.offsetWidth + 20; // Add 20px for padding
        event.style.width = width + 'px';
    });


    fetch('action?detect=calender')
        .then(response => response.json())
        .then(data => {
            var events = [];
            Object.keys(data).forEach(date => {
                data[date].forEach(event => {
                    events.push(event);
                });
            });
            var calendar = new FullCalendar.Calendar(calendarEl, {
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                initialView: 'timeGridWeek',
                slotDuration: '00:30', // 30-minute slots
                slotMinTime: '06:00',
                slotMaxTime: '23:30',
                events: events,
                eventTimeFormat: {
                    hour: '2-digit',
                    minute: '2-digit',
                    meridiem: false
                },
                dayHeaderFormat: {
                    weekday: 'long' // Display full day names
                },
                columnHeaderFormat: {
                    weekday: 'long' // Display full day names in header
                },
                slotLabelFormat: {
                    hour: '2-digit',
                    minute: '2-digit',
                    hour12: true, // Display 12-hour format
                    separator: ' - ', // Separator between start and end times
                    interval: '30' // Display 30-minute intervals
                },
                slotLabelInterval: '00:30', // 30-minute interval
                eventContent: function(info) {
    return {
        html: info.event.title.replace(/\n/g, '<br>')
    };
}


//           eventRender: function(info) {
//               var prof = info.event.name;
//     var classroom = info.event.title;
//     var name = info.event.name; // Access name property directly
//     var startTime = info.event.start.toLocaleTimeString();
//     var endTime = info.event.end.toLocaleTimeString();
//     info.el.innerHTML = `
//         <b>${classroom}</b>
//         <br><b>${prof}</b>
//         <br>${startTime} - ${endTime}
//     `;
// }


            });
            calendar.render();
        });
});







</script>

                      
<?php } ?>

                   </div>
  <?php
  break; 
  case 'user': 
  ?>

        <!-- page content -->
<div class="right_col" role="main">
          <div class="">
            

            <div class="clearfix"></div>

        

             <div class="row">
              <!-- form input mask -->
       

              <div class="col-md-12 col-sm-12"> 
                
                <div class="x_panel">
                  <div class="x_title">
                   
                   
                   
                  <div class="x_content">
<?php if(isset($_GET['detect'])) 
{
  $detect=$_GET['detect'];
}
else 
{
  $detect='default'; 
}
switch ($detect) {
  default:
// Dummy data for classroom table



?> 
<div class="row">
    <div class="col-sm-12">
  <div class="page-title">
              <div class="title_left">
                <h3>Calendar</h3>

              </div>

              <div class="title_right">
                
              </div>
            </div>
          </div>
        </div>

        
<div id="calendar"></div>
<script>
document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
     var events = document.querySelectorAll('.fc-event-main');
    events.forEach(function(event) {
        var title = event.querySelector('.fc-event-title');
        var width = title.offsetWidth + 20; // Add 20px for padding
        event.style.width = width + 'px';
    });


    fetch('action?detect=calenderuser')
        .then(response => response.json())
        .then(data => {
            var events = [];
            Object.keys(data).forEach(date => {
                data[date].forEach(event => {
                    events.push(event);
                });
            });
            var calendar = new FullCalendar.Calendar(calendarEl, {
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                initialView: 'timeGridWeek',
                slotDuration: '00:30', // 30-minute slots
                slotMinTime: '06:00',
                slotMaxTime: '23:30',
                events: events,
                eventTimeFormat: {
                    hour: '2-digit',
                    minute: '2-digit',
                    meridiem: false
                },
                dayHeaderFormat: {
                    weekday: 'long' // Display full day names
                },
                columnHeaderFormat: {
                    weekday: 'long' // Display full day names in header
                },
                slotLabelFormat: {
                    hour: '2-digit',
                    minute: '2-digit',
                    hour12: true, // Display 12-hour format
                    separator: ' - ', // Separator between start and end times
                    interval: '30' // Display 30-minute intervals
                },
                slotLabelInterval: '00:30', // 30-minute interval
                eventContent: function(info) {
    return {
        html: info.event.title.replace(/\n/g, '<br>')
    };
}


//           eventRender: function(info) {
//               var prof = info.event.name;
//     var classroom = info.event.title;
//     var name = info.event.name; // Access name property directly
//     var startTime = info.event.start.toLocaleTimeString();
//     var endTime = info.event.end.toLocaleTimeString();
//     info.el.innerHTML = `
//         <b>${classroom}</b>
//         <br><b>${prof}</b>
//         <br>${startTime} - ${endTime}
//     `;
// }


            });
            calendar.render();
        });
});







</script>

                      
<?php } ?>

                   </div>
   
  <?php 
  break; 

  default :
  header("location:index");
  break; 
  
}
                 ?>
        <!-- /top navigation -->

  
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>
   <script src="assets/vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/custom.min.js"></script>
  </body>
</html>