<?php
include('authentication.php');
include('includes/header.php');
include('includes/topbar.php');
include('includes/sidebar.php');
include('config/dbconn.php');
?>

<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

      <div class="modal fade" id="AppointmentDetails">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 id="modalTitle" class="modal-title">Appointment Details</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div id="modalBody" class="modal-body"> 
              <p>Hello</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
      </div>
    </div>

      
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Calendar</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Calendar</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">
            <div class="sticky-top mb-3">
              <div class="card card-teal card-outline">
                <div class="card-header">
                  <h4 class="card-title">Appointment</h4>
                </div>
                <div class="card-body">
                  <!-- Book Appointment -->
                  <a class="btn btn-success btn-block" data-toggle="modal" href="#addAppointmentModal">
                      <i class="fa fa-plus-circle"> </i> Request a Appointment
                  </a>
                  <!-- the events -->
                  <div id="external-events">
                    <div class="external-event bg-success">Lunch</div>
                    <div class="external-event bg-warning">Go home</div>
                    <div class="external-event bg-info">Do homework</div>
                    <div class="external-event bg-primary">Work on UI design</div>
                    <div class="external-event bg-danger">Sleep tight</div>
                    <div class="checkbox">
                      <label for="drop-remove">
                        <input type="checkbox" id="drop-remove">
                        remove after drop
                      </label>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Create Event</h3>
                </div>
                <div class="card-body">
                  <div class="btn-group" style="width: 100%; margin-bottom: 10px;">
                    <ul class="fc-color-picker" id="color-chooser">
                      <li><a class="text-primary" href="#"><i class="fas fa-square"></i></a></li>
                      <li><a class="text-warning" href="#"><i class="fas fa-square"></i></a></li>
                      <li><a class="text-success" href="#"><i class="fas fa-square"></i></a></li>
                      <li><a class="text-danger" href="#"><i class="fas fa-square"></i></a></li>
                      <li><a class="text-muted" href="#"><i class="fas fa-square"></i></a></li>
                    </ul>
                  </div>
                  <!-- /btn-group -->
                  <div class="input-group">
                    <input id="new-event" type="text" class="form-control" placeholder="Event Title">

                    <div class="input-group-append">
                      <button id="add-new-event" type="button" class="btn btn-primary">Add</button>
                    </div>
                    <!-- /btn-group -->
                  </div>
                  <!-- /input-group -->
                </div>
              </div>
            </div>
          </div>
          <!-- /.col -->
            <div class="col-md-9">
                <div class="card card-teal card-outline">
                    <div class="card-body">
                        <div class="card-body p-0">
                            <!-- THE CALENDAR -->
                            <div id="calendar"></div>
                        </div>
                    </div>
                </div>              
            </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>

</div>
<?php
$query = $conn->query("SELECT a.*, CONCAT(p.fname,' ',p.lname) AS pname, CONCAT(a.schedule, ' ', a.starttime) as timestamp, CONCAT(a.schedule, ' ', a.endtime) as enddate FROM tblappointment a INNER JOIN tblpatient p WHERE p.id = a.patient_id AND status = 'Confirmed' ");
$sched_arr = json_encode($query->fetch_all(MYSQLI_ASSOC));
?>
<?php include('includes/scripts.php');?>
<script>
$(function () {

function ini_events(ele) {
  ele.each(function () {

    var eventObject = {
      title: $.trim($(this).text()) // use the element's text as the event title
    }

    $(this).data('eventObject', eventObject)

    $(this).draggable({
      zIndex        : 1070,
      revert        : true, // will cause the event to go back to its
      revertDuration: 0  //  original position after the drag
    })

  })
}

ini_events($('#external-events div.external-event'))

var date = new Date()
var d    = date.getDate(),
    m    = date.getMonth(),
    y    = date.getFullYear()
var scheds = $.parseJSON('<?php echo ($sched_arr) ?>');

var Calendar = FullCalendar.Calendar;
var Draggable = FullCalendar.Draggable;

var containerEl = document.getElementById('external-events');
var checkbox = document.getElementById('drop-remove');
var calendarEl = document.getElementById('calendar');

new Draggable(containerEl, {
  itemSelector: '.external-event',
  eventData: function(eventEl) {
    return {
      title: eventEl.innerText,
      backgroundColor: window.getComputedStyle( eventEl ,null).getPropertyValue('background-color'),
      borderColor: window.getComputedStyle( eventEl ,null).getPropertyValue('background-color'),
      textColor: window.getComputedStyle( eventEl ,null).getPropertyValue('color'),
    };
  }
});

var calendar = new Calendar(calendarEl, {
  headerToolbar: {
    left  : 'prev,next today',
    center: 'title',
    right : 'dayGridMonth,timeGridWeek,timeGridDay'
  },
  themeSystem: 'bootstrap',

  events:function(event,successCallback){
      var events = []
      Object.keys(scheds).map(k=>{
          var bg = 'var(--primary)';
          if(scheds[k].status == "Treated")
              bg = 'var(--primary)';
          if(scheds[k].status == "Confirmed")
              bg = 'var(--success)';
          console.log(bg)
          events.push({
              id          : scheds[k].id,
              title          : scheds[k].pname,
              start          : moment(scheds[k].timestamp).format('YYYY-MM-DD[T]HH:mm'),
              end             : moment(scheds[k].enddate).format('hh:mm'),
              backgroundColor: scheds[k].bgcolor, 
              borderColor: scheds[k].bgcolor 
              });
      })
      console.log(events)
      successCallback(events)

  },
  eventClick:  function(info) {
              alert(info.event.id);
        },
        // eventClick:  function(event, jsEvent, view) {
        //     $('#modalTitle').html(event.title);
        //     $('#modalBody').html(event.description);
        //     $('#eventUrl').attr('href',event.url);
        //     $('#AppointmentDetails').modal();
        // },
    
    // {
    //   title          : 'Long Event',
    //   start          : new Date(y, m, d - 5),
    //   end            : new Date(y, m, d - 2),
    //   backgroundColor: '#f39c12', //yellow
    //   borderColor    : '#f39c12' //yellow
    // },
    // {
    //   title          : 'Meeting',
    //   start          : new Date(y, m, d, 10, 30),
    //   allDay         : false,
    //   backgroundColor: '#0073b7', //Blue
    //   borderColor    : '#0073b7' //Blue
    // },
    // {
    //   title          : 'Lunch',
    //   start          : new Date(y, m, d, 12, 0),
    //   end            : new Date(y, m, d, 14, 0),
    //   allDay         : false,
    //   backgroundColor: '#00c0ef', //Info (aqua)
    //   borderColor    : '#00c0ef' //Info (aqua)
    // },
    // {
    //   title          : 'Birthday Party',
    //   start          : new Date(y, m, d + 1, 19, 0),
    //   end            : new Date(y, m, d + 1, 22, 30),
    //   allDay         : false,
    //   backgroundColor: '#00a65a', //Success (green)
    //   borderColor    : '#00a65a' //Success (green)
    // },
    // {
    //   title          : 'Click for Google',
    //   start          : new Date(y, m, 28),
    //   end            : new Date(y, m, 29),
    //   url            : 'https://www.google.com/',
    //   backgroundColor: '#3c8dbc', //Primary (light-blue)
    //   borderColor    : '#3c8dbc' //Primary (light-blue)
    // }
  // ],
  editable  : false,
  droppable : true, // this allows things to be dropped onto the calendar !!!
  drop      : function(info) {
    // is the "remove after drop" checkbox checked?
    if (checkbox.checked) {
      // if so, remove the element from the "Draggable Events" list
      info.draggedEl.parentNode.removeChild(info.draggedEl);
    }
  }
});

calendar.render();

var currColor = '#3c8dbc' //Red by default
// Color chooser button
$('#color-chooser > li > a').click(function (e) {
  e.preventDefault()
  // Save color
  currColor = $(this).css('color')
  // Add color effect to button
  $('#add-new-event').css({
    'background-color': currColor,
    'border-color'    : currColor
  })
})
$('#add-new-event').click(function (e) {
  e.preventDefault()
  // Get value and make sure it is not null
  var val = $('#new-event').val()
  if (val.length == 0) {
    return
  }

  // Create events
  var event = $('<div />')
  event.css({
    'background-color': currColor,
    'border-color'    : currColor,
    'color'           : '#fff'
  }).addClass('external-event')
  event.text(val)
  $('#external-events').prepend(event)

  // Add draggable funtionality
  ini_events(event)

  // Remove event from text input
  $('#new-event').val('')
})
})
</script>

<?php include('includes/footer.php');?>