<?php
include('authentication.php');
include('includes/header.php');
include('includes/topbar.php');
include('includes/sidebar.php');
include('admin/config/dbconn.php');
?>

<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

      <!-- Request Appointment -->
      <div class="modal fade" id="addAppointmentModal">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Request Appointment</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <p>One fine body&hellip;</p>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary">Save changes</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
      
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
          <div class="col-md-4">
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
          <div class="col-md-8">
            <div class="card card-teal card-outline">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active nav-link" href="#appointment" data-toggle="tab">Book Appointment</a></li>
                  <li class="nav-item"><a class="nav-link" href="#myappointment" data-toggle="tab">My Appointment</a></li>
                  <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Settings</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="active tab-pane" id="appointment">
                        <div class="card-body p-0">
                          <!-- THE CALENDAR -->
                          <div id="calendar"></div>
                        </div>
                    </div>
                      <!-- /.tab-pane -->
                    <div class="tab-pane" id="myappointment">
                      <!-- My Appointment -->
                      <div class="card-body table-responsive p-0">
                        <table id="example1" class="table table-bordered table-hover">
                          <thead>
                            <tr>
                              <th>Date</th>
                              <th>Time Slot</th>
                              <th>Doctor</th>
                              <th>Status</th>
                              <th>Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                              $sql = "SELECT * FROM tbldoctor";
                              $query_run = mysqli_query($conn, $sql);
                              
                              while($row = mysqli_fetch_array($query_run)){
                            ?>
                              <tr>
                              <td class="user_id"><?php echo $row['id']; ?></td>
                              <td><?php echo $row['fname']; ?></td>
                              <td><?php echo $row['phone']; ?></td>
                              <td><?php echo $row['email']; ?></td>
                              <td>
                                <button data-id="<?php echo $row['id']; ?>" class="btn btn-block btn-outline-danger btn-sm cancelbtn">Cancel</button>
                              </td>
                              </tr>
                              <?php
                              }
                            ?>
                          </tbody>
                        </table>
                      </div>
                    </div>
                    <!-- /.tab-pane -->

              </div>            
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>

</div>

<?php include('includes/scripts.php');?>
<script>
    $(document).ready(function () {
      $(document).on('click','.deletebtn', function(){
      
      var user_id = $(this).data('id');
      $('#delete_id').val(user_id);
      $('#deletemodal').modal('show');
      
      });

    });
  </script>

<?php include('includes/footer.php');?>