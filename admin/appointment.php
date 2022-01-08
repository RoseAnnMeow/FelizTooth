<?php
include('authentication.php');
include('includes/header.php');
include('includes/topbar.php');
include('includes/sidebar.php');
include('config/dbconn.php');
?>

<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
<!-- Add Modal -->
<div class="modal fade" id="AddAppointmentModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Add Appointment</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form action="appointment_action.php" method="POST">
        <div class="modal-body">
            <div class="row">
              <div class="col-sm-6">
                <div class="form-group">
                <label>Select Patient</label>
                <span class="text-danger">*</span>
                  <select class="form-control select2 patient" name="select_patient" style="width: 100%;" required>
                  <option selected disabled value="">Select Patient</option>
                    <?php
                      if(isset($_GET['id']))
                      {
                        echo $id = $_GET['id'];
                      } 
                      $sql = "SELECT * FROM tblpatient";
                      $query_run = mysqli_query($conn,$sql);
                      if(mysqli_num_rows($query_run) > 0)
                      {
                        foreach($query_run as $row)
                        {
                          ?>

                          <option value="<?php echo $row['id'];?>">
                          <?php echo $row['fname'].' '.$row['lname'];?></option>
                          <?php
                        }
                      }
                      else
                      {
                        ?>
                        <option value="">No Record Found"</option>
                        <?php
                      }
                      ?>                  
                  </select>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label>Select Doctor</label>
                  <span class="text-danger">*</span>
                  <select class="form-control select2 dentist" name="select_dentist" style="width: 100%;" required>
                  <option selected disabled value="">Select Doctor</option>
                  <?php
                      if(isset($_GET['id']))
                      {
                        echo $id = $_GET['id'];
                      } 
                      $sql = "SELECT * FROM tbldoctor WHERE status='1'";
                      $query_run = mysqli_query($conn,$sql);
                      if(mysqli_num_rows($query_run) > 0)
                      {
                        foreach($query_run as $row)
                        {
                          ?>

                          <option value="<?php echo $row['id'];?>">
                          <?php echo $row['name'];?></option>
                          <?php
                        }
                      }
                      else
                      {
                        ?>
                        <option value="">No Record Found"</option>
                        <?php
                      }
                      ?>     
                  </select>
                </div>
              </div>   
              <div class="col-sm-12">              
                <div class="form-group">
                    <label>Appontment Date</label>
                    <span class="text-danger">*</span>
                    <input type="text" autocomplete="off" name="scheddate" class="form-control" id="scheddate" required onkeypress="return false;">
                </div>
              </div>     
              <div class="col-sm-6">              
                <div class="form-group">
                    <label>Appointment Start Time</label>
                    <span class="text-danger">*</span>
                    <div class="input-group date" id="starttime" data-target-input="nearest">
                      <input type="text" autocomplete="off" name="start_time" class="form-control datetimepicker-input" required data-target="#starttime"/>
                      <div class="input-group-append" data-target="#starttime" data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="far fa-clock"></i></div>
                      </div>
                    </div>
                </div>
              </div>
              <div class="col-sm-6">              
                <div class="form-group">
                    <label>Appointment End Time</label>
                    <span class="text-danger">*</span>
                    <div class="input-group date" id="endtime" data-target-input="nearest">
                      <input type="text" autocomplete="off" name="end_time" class="form-control datetimepicker-input" required data-target="#endtime"/>
                      <div class="input-group-append" data-target="#endtime" data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="far fa-clock"></i></div>
                      </div>
                    </div>
                </div>
              </div>      
              <div class="col-sm-12">
                <div class="form-group">
                  <label>Reason</label>
                  <span class="text-danger">*</span>
                  <textarea class="form-control" rows="2" name="reason" required placeholder="Enter ..."></textarea>
                </div>
              </div>
              <div class="col-sm-12">
                <div class="form-group">
                    <label>Appointment Status</label>
                    <span class="text-danger">*</span>
                    <select class="form-control custom-select" name="status" id="show-checkbox" required>
                        <option value="Confirmed">Confirmed</option>
                    </select>
                </div>
              </div>
              <div class="col-sm-12">
                <div class="form-group">
                <label for="color">Color</label>
                <select name="color" class="form-control custom-select" id="color">
                    <option style="color:#f39c12;" value="#f39c12">Yellow</option>
                    <option style="color:#00c0ef;" value="#00c0ef"> Aqua</option>
                    <option style="color:#0073b7;" value="#0073b7"> Blue</option>						  
                    <option style="color:#00a65a;" value="#00a65a"> Green</option>
                    <option style="color:#FF8C00;" value="#FF8C00"> Orange</option>
                    <option style="color:#3c8dbc;" value="#3c8dbc"> Light Blue</option>
                    <option style="color:#f56954;" value="#f56954"> Red</option>						  
                  </select>
                </div>             
              </div>
              <div class="col-sm-12">
                <div class="custom-control custom-checkbox" id="show-email1">
                    <input class="custom-control-input" type="checkbox" name="send-email" id="customCheckbox2" checked>
                    <label for="customCheckbox2" class="custom-control-label">Send Email</label>
                  </div>
              </div>       
            </div>
          </div>
            
      
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" name="insert_appointment" class="btn btn-primary">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!--View Modal-->
<div class="modal fade" id="ViewScheduleModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Patient Info</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="patient_viewing_data">
        </div>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
    </div>
  </div>
</div>

<!--Edit Modal-->
<div class="modal fade" id="EditAppointmentModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Edit Appointment</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
 
      <form action="appointment_action.php" method="POST">
        <div class="modal-body">
          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <input type="hidden" name="edit_id" id="edit_id">
              <label>Select Patient</label>
              <span class="text-danger">*</span>
                <select class="select2 patient" name="select_patient" id="edit_patient" style="width:100%;" required>
                  <?php
                    if(isset($_GET['id']))
                    {
                      echo $id = $_GET['id'];
                    } 
                    $sql = "SELECT * FROM tblpatient";
                    $query_run = mysqli_query($conn,$sql);
                    if(mysqli_num_rows($query_run) > 0)
                    {
                      foreach($query_run as $row)
                      {
                        ?>

                        <option value="<?php echo $row['id'];?>">
                        <?php echo $row['fname'].' '.$row['lname'];?></option>
                        <?php
                      }
                    }
                    else
                    {
                      ?>
                      <option value="">No Record Found"</option>
                      <?php
                    }
                    ?>                  
                </select>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label>Select Doctor</label>
                <span class="text-danger">*</span>
                <select class="form-control select2 dentist" name="select_dentist" id="edit_dentist" style="width:100%;" required>
                  <?php
                      if(isset($_GET['id']))
                      {
                        echo $id = $_GET['id'];
                      } 
                      $sql = "SELECT * FROM tbldoctor WHERE status='1'";
                      $doctor_query_run = mysqli_query($conn,$sql);
                      if(mysqli_num_rows($doctor_query_run) > 0)
                      {
                        foreach($doctor_query_run as $row)
                        {
                          ?>

                          <option value="<?php echo $row['id'];?>">
                          <?php echo $row['name'];?></option>
                          <?php
                        }
                      }
                      else
                      {
                        ?>
                        <option value="">No Record Found"</option>
                        <?php
                      }
                      ?>     
                  </select>
                </div>
              </div>   
              <div class="col-sm-12">              
                <div class="form-group">
                    <label>Appontment Date</label>
                    <span class="text-danger">*</span>
                    <input type="text" autocomplete="off" name="scheddate" class="form-control" id="edit_sched" required onkeypress="return false;">
                </div>
              </div>     
              <div class="col-sm-6">              
                <div class="form-group">
                    <label>Appointment Start Time</label>
                    <span class="text-danger">*</span>
                    <div class="input-group date" id="edit_stime" data-target-input="nearest">
                      <input type="text" autocomplete="off" name="start_time" class="form-control datetimepicker-input" required data-target="#edit_stime"/>
                      <div class="input-group-append" data-target="#edit_stime" data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="far fa-clock"></i></div>
                      </div>
                    </div>
                </div>
              </div>
              <div class="col-sm-6">              
                <div class="form-group">
                    <label>Appointment End Time</label>
                    <span class="text-danger">*</span>
                    <div class="input-group date" id="edit_etime" data-target-input="nearest">
                      <input type="text" autocomplete="off" name="end_time" class="form-control datetimepicker-input" required data-target="#edit_etime"/>
                      <div class="input-group-append" data-target="#edit_etime" data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="far fa-clock"></i></div>
                      </div>
                    </div>
                </div>
              </div>      
              <div class="col-sm-12">
                <div class="form-group">
                  <label>Reason</label>
                  <span class="text-danger">*</span>
                  <textarea class="form-control" rows="2" name="reason" id="edit_reason" required placeholder="Enter ..."></textarea>
                </div>
              </div>
              <div class="col-sm-12">
                <div class="form-group">
                    <label>Appointment Status</label>
                    <span class="text-danger">*</span>
                    <select class="form-control custom-select" name="status" id="edit_status" id="show-checkbox" required>
                        <option value="Confirmed">Confirmed</option>
                        <option value="Cancelled">Cancelled</option>
                        <option value="No Show">No Show</option>
                        <option value="Treated">Treated</option>
                    </select>
                </div>
              </div>
              <div class="col-sm-12">
                <div class="form-group">
                <label for="color">Color</label>
                <select name="color" class="form-control custom-select" id="edit_color">
                    <option style="color:#f39c12;" value="#f39c12">Yellow</option>
                    <option style="color:#00c0ef;" value="#00c0ef"> Aqua</option>
                    <option style="color:#0073b7;" value="#0073b7"> Blue</option>						  
                    <option style="color:#00a65a;" value="#00a65a"> Green</option>
                    <option style="color:#FF8C00;" value="#FF8C00"> Orange</option>
                    <option style="color:#3c8dbc;" value="#3c8dbc"> Light Blue</option>
                    <option style="color:#f56954;" value="#f56954"> Red</option>						  
                  </select>
                </div>             
              </div>
              <div class="col-sm-12">
                <div class="custom-control custom-checkbox" id="show-email2">
                  <input class="custom-control-input ck" type="checkbox" id="customCheckbox3" name="send-email" disabled>
                  <label for="customCheckbox3" class="custom-control-label">Send Email</label>
                </div>
              </div>       
            </div>
          </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <button type="submit" name="update_appointment" class="btn btn-primary">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!--/edit modal -->

<!-- delete modal pop up modal -->
<div class="modal fade" id="deletemodal">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Delete Appointment</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div> 

            <form action="appointment_action.php" method="POST">
              <div class="modal-body">
                <input type="hidden" name="delete_id" id="delete_id">
                <p> Do you want to delete this Appointment?</p>                          
              </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
              <button type="submit" name="deletedata" class="btn btn-primary ">Submit</button>
            </div>
            </form>
          </div>
        </div>
      </div>
      <!--/delete modal -->

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
 <!-- Content Header (Page header) -->
    <div class="content-header">
        <section class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1>Appointment</h1>
              </div><!-- /.col -->
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                  <li class="breadcrumb-item active">Appointment</li>
                </ol>
              </div> <!-- /.col -->
            </div> <!-- /.row -->
          </section><!-- /.container-fluid -->
      </div> <!--/.content-header-->
      

  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <?php
            include('message.php');
          ?>
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h3 class="card-title">All Appointment List</h3>
                <button type="button" class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#AddAppointmentModal">
                <i class="fa fa-plus"></i> &nbsp;&nbsp;Add Appointment</button>
              </div>
                <div class="card-body">
                  <form action="" method="get">
                    <div class="row">
                      <div class="w-100 d-flex mb-2">
                        <div class="form-group col-sm-2">
                        <input type="text" autocomplete="off" name="scheddate1" placeholder="mm/dd/yyyy" class="form-control" id="scheddate1" required value="<?php if(isset($_GET['scheddate1'])){ echo $_GET['scheddate1']; } else {} ?>" />
                        </div>
                        <div class="col-sm-2">
                          <input type="text" autocomplete="off" name="scheddate2" placeholder="mm/dd/yyyy" class="form-control" id="scheddate2" required value="<?php if(isset($_GET['scheddate2'])){ echo $_GET['scheddate2']; } else {} ?>" />
                        </div>
                        <div class="col-sm-6">
                          <button type="submit" class="btn btn-success"><i class="fas fa-search"></i></button>
                          <a href="appointment.php" type="button" class="btn btn-secondary"><i class="fad fa-sync-alt"></i></a>
                        </div>
                      </div>
                    </div>
                  </form>

                      
                  <form action="appointment_action.php" method="POST">
                  <table id="alltable" class="table table-borderless table-hover" style="width:100%">
                    <thead class="bg-light">
                      <tr>
                        <th class="text-center">#</th>
                        <th>Patient</th>
                        <th>Date Submitted</th>
                        <th>Appointment Date</th>
                        <th>Start Time</th>
                        <th>End Time</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                    if(isset($_GET['scheddate1']) && isset($_GET['scheddate2']))
                    {
                      $i = 1;
                      $from_date = date("Y-m-d", strtotime($_GET['scheddate1']));
                      $to_date = date("Y-m-d", strtotime($_GET['scheddate2']));
                      $sql = "SELECT a.*, CONCAT(p.fname,' ',p.lname) AS pname FROM tblappointment a INNER JOIN tblpatient p ON p.id = a.patient_id WHERE a.created_at BETWEEN '$from_date' AND '$to_date' AND a.schedtype='Walk-in Schedule' ORDER BY a.id";
                      $query_run = mysqli_query($conn, $sql);

                      if(mysqli_num_rows($query_run) > 0)
                      {
                        foreach($query_run as $row)
                        {
                            ?>
                            <tr>
                              <td style="width:10px; text-align:center;"><?php echo $i++; ?></td>
                              <td><?php echo $row['pname'];?></td>
                              <td><?php echo date('F j, Y',strtotime($row['created_at'])); ?></td>
                              <td><?php echo date('F j, Y',strtotime($row['schedule'])); ?></td>
                              <td><?php echo date('h:i A',strtotime($row['starttime'])); ?></td>
                              <td><?php echo date('h:i A',strtotime($row['endtime'])); ?></td>
                              <td><?php
                              if($row['status'] == 'Confirmed')
                              {
                                echo $row['status'] = '<span class="badge badge-success">Confirmed</span>';
                              }
                              else if($row['status'] == 'Pending')
                              {
                                echo $row['status'] = '<span class="badge badge-warning">Pending</span>';
                              }
                              else if($row['status'] == 'Treated')
                              {
                                echo $row['status'] = '<span class="badge badge-primary">Treated</span>';
                              }
                              else if($row['status'] == 'No Show')
                              {
                                echo $row['status'] = '<span class="badge badge-secondary">No Show</span>';
                              }
                              else
                              {
                                echo $row['status'] = '<span class="badge badge-danger">Cancelled</span>';
                              }?>
                              </td>
                              <td>
                                <button type="button" data-id="<?php echo $row['id']; ?>" class="btn btn-sm btn-info editbtn"><i class="fas fa-edit"></i></button>
                                <button type="button" data-id="<?php echo $row['id']; ?>" class="btn btn-danger btn-sm deletebtn"><i class="far fa-trash-alt"></i></button>
                              </td>
                            </tr>
                            <?php }
                            }
                      }
                      else
                      {
                        $i = 1;
                        $sql = "SELECT a.*, CONCAT(p.fname,' ',p.lname) AS pname FROM tblappointment a INNER JOIN tblpatient p ON p.id = a.patient_id WHERE a.schedtype='Walk-in Schedule' ORDER BY a.id";
                        $query_run = mysqli_query($conn, $sql);
                        while($row = mysqli_fetch_array($query_run)){
                            ?>
                        <tr>                              
                        <td style="width:10px; text-align:center;"><?php echo $i++; ?></td>
                        <td><?php echo $row['pname'];?></td>
                        <td><?php echo date('F j, Y',strtotime($row['created_at'])); ?></td>
                        <td><?php echo date('F j, Y',strtotime($row['schedule'])); ?></td>
                        <td><?php echo date('h:i A',strtotime($row['starttime'])); ?></td>
                        <td><?php echo date('h:i A',strtotime($row['endtime'])); ?></td>
                        <td><?php
                        if($row['status'] == 'Confirmed')
                        {
                          echo $row['status'] = '<span class="badge badge-success">Confirmed</span>';
                        }
                        else if($row['status'] == 'Pending')
                        {
                          echo $row['status'] = '<span class="badge badge-warning">Pending</span>';
                        }
                        else if($row['status'] == 'Treated')
                        {
                          echo $row['status'] = '<span class="badge badge-primary">Treated</span>';
                        }
                        else if($row['status'] == 'No Show')
                        {
                          echo $row['status'] = '<span class="badge badge-secondary">No Show</span>';
                        }
                        else
                        {
                          echo $row['status'] = '<span class="badge badge-danger">Cancelled</span>';
                        }
                        ?>
                        </td>
                        </td>
                        <td>
                          <button type="button" data-id="<?php echo $row['id']; ?>" class="btn btn-sm btn-info editbtn"><i class="fas fa-edit"></i></button>
                          <button type="button" data-id="<?php echo $row['id']; ?>" class="btn btn-danger btn-sm deletebtn"><i class="far fa-trash-alt"></i></button>
                        </td>
                        </tr>
                            <?php
                        }
                      }
                    ?>	
                    </tbody>
                  </table>
               
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
    <!-- /.container-fluid -->
  </div> <!-- /.container -->
</div> <!-- /.content-wrapper -->

</div>

<?php include('includes/scripts.php');?>
<script>
    $(document).ready(function () {

      var table1 = $('#alltable').DataTable( {
      responsive: true,
    } );

    var table2 = $('#pendingtable').DataTable( {
      responsive: true,
    } );

    var table3 = $('#confirmedtable').DataTable( {
      responsive: true,
    } );
    var table4 = $('#cancelledtable').DataTable( {
      responsive: true,
    } );
    var table5 = $('#treatedtable').DataTable( {
      responsive: true,
    } );
    var table6 = $('#requesttable').DataTable( {
      responsive: true,
    } );

    $('.nav-tabs a').on('shown.bs.tab', function (event) {
      var tabID = $(event.target).attr('data-target');
      if( tabID === '#alltable') {
        table1.columns.adjust().responsive.recalc();
      }
      if (tabID === '#pending') {
        table2.columns.adjust().responsive.recalc();
      }
      if( tabID === '#confirmed') {
        table3.columns.adjust().responsive.recalc();
      }
      if( tabID === '#cancelled') {
        table4.columns.adjust().responsive.recalc();
      }
      if( tabID === '#treated') {
        table5.columns.adjust().responsive.recalc();
      }
      if( tabID === '#requested') {
        table6.columns.adjust().responsive.recalc();
      }
    } );


      $('#scheddate').datepicker({
        startDate: new Date()
      });
      $('#scheddate1').datepicker({
      });
      $('#scheddate2').datepicker({
      });
      $('#starttime').datetimepicker({
          format: 'LT'
      });
      $('#endtime').datetimepicker({
          format: 'LT'
      });
      $('#edit_stime').datetimepicker({
          format: 'LT'
      });
      $('#edit_etime').datetimepicker({
          format: 'LT'
      });

      $('#edit_sched').datepicker({
          todayHighlight: true,
          clearBtn: true,
          autoclose: true,
          startDate: new Date()
      });

      $('.select2').select2()

      $(".patient").select2({
      placeholder: "Select Patient",
      allowClear: true
      });

      $(".dentist").select2({
      placeholder: "Select Dentist",
      allowClear: true
      });

      const colorBox = document.getElementById('edit_color');

      colorBox.addEventListener('change', (event) => {
        const color = event.target.value;
        event.target.style.color = color;
      }, false);

      document.getElementById('color').addEventListener('change', function() {
          this.style.color = this.value 
      });
    
      $(document).on('click', '.viewbtn', function() {       
        var userid = $(this).data('id');

        $.ajax({
        url: 'appointment_action.php',
        type: 'post',
        data: {userid: userid},
        success: function(response){ 
          
          $('.patient_viewing_data').html(response);
          $('#ViewPatientModal').modal('show'); 
        }
      });
    });

    $("#edit_status").on('change', function() {
    var val = $(this).val();
    if (this.value == "Confirmed") {
        $('.ck').prop("disabled", false)
    }
    else
    {
      $('.ck').prop("disabled", true)
    }
 });


    $(document).on('click', '.editbtn', function() {          
      var schedid = $(this).data('id');

      $.ajax({
        type:'post',
        url: "appointment_action.php",
        data:
        {
          'checking_editbtn':true,
          'app_id':schedid,
        },
        success: function (response) {
        $.each(response, function (key, value){
          $('#edit_id').val(value['id']);
          $('#edit_patient').val(value['patient_id']);
          $('#edit_patient').select2().trigger('change');
          $('#edit_dentist').val(value['doc_id']);
          $('#edit_dentist').select2().trigger('change');
          $('#edit_sched').val(value['schedule']);
          $('#edit_stime').find("input").val(value['starttime']);    
          $("#edit_etime").find("input").val(value['endtime']);        
          $('#edit_reason').val(value['reason']);
          $('#edit_status').val(value['status']);
          $('#edit_color').val(value['bgcolor']);
        });

        $('#EditAppointmentModal').modal('show');
        }
      });
    });

    $(document).on('click','.deletebtn', function(){     
      var user_id = $(this).data('id');
      $('#delete_id').val(user_id);
      $('#deletemodal').modal('show');
      
      });

});

</script>

<?php include('includes/footer.php');?>