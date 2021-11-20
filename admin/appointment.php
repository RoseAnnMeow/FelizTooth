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
                  <select class="form-control" name="select_patient" required>
                  <option selected disabled value="">--Select Patient--</option>
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
                  <label>Select Dentist</label>
                  <select class="form-control" name="select_dentist" required>
                  <option selected disabled value="">--Select Doctor--</option>
                  <?php
                      if(isset($_GET['id']))
                      {
                        echo $id = $_GET['id'];
                      } 
                      $sql = "SELECT * FROM tbldoctor";
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
                    <label>Appointment Date</label>
                    <input type="text" autocomplete="off" name="scheddate" class="form-control" id="sched_date" required onkeypress="return false;">
                </div>
              </div>       
              <div class="col-sm-6">              
                <div class="form-group">
                    <label>Appointment Start Time</label>
                    <input type="time" autocomplete="off" name="start_time" class="form-control" required>
                </div>
              </div>
              <div class="col-sm-6">              
                <div class="form-group">
                    <label>Appointment End Time</label>
                    <input type="time" autocomplete="off" name="end_time" class="form-control" required>
                </div>
              </div>      
              <div class="col-sm-12">
                <div class="form-group">
                  <label>Reason</label>
                  <textarea class="form-control" rows="2" name="reason" placeholder="Enter ..."></textarea>
                </div>
              </div>
              <div class="col-sm-12">
                <div class="form-group">
                    <label>Appointment Status</label>
                    <select class="form-control form-select" name="status" required>
                        <option>Pending</option>
                        <option>Confirmed</option>
                        <option>Treated</option>
                        <option>Cancelled</option>
                    </select>
                </div>
              </div>      
            </div>
          </div>
            
      
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" name="insert_appointment" class="btn btn-info">Submit</button>
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
                <input type="hidden" name="edit_id" id="edit_id"> 
                <div class="form-group">
                <label>Select Patient</label>
                  <select class="form-control" id="edit_patient" name="select_patient" required>
                  <option selected disabled value="">--Select Patient--</option>
                  <?php
                      if(isset($_GET['id']))
                      {
                        echo $id = $_GET['id'];
                      } 
                      $sql = "SELECT * FROM tblpatient";
                      $patient_query_run = mysqli_query($conn,$sql);
                      if(mysqli_num_rows($query_run) > 0)
                      {
                        foreach($patient_query_run as $row)
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
                  <label>Select Dentist</label>
                  <select class="form-control"  id="edit_dentist" name="select_dentist" required>
                  <?php
                      if(isset($_GET['id']))
                      {
                        echo $id = $_GET['id'];
                      } 
                      $sql = "SELECT * FROM tbldoctor";
                      $doctor_query_run = mysqli_query($conn,$sql);
                      if(mysqli_num_rows($query_run) > 0)
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
                    <label>Appointment Date</label>
                    <input type="text" autocomplete="off" id="edit_sched" name="scheddate" class="form-control" required onkeypress="return false;">
                </div>
              </div>           
              <div class="col-sm-6">              
                <div class="form-group">
                    <label>Start Time</label>
                    <input type="time" autocomplete="off" id="edit_stime" name="start_time" class="form-control" required>
                </div>
              </div>
              <div class="col-sm-6">              
                <div class="form-group">
                    <label>End Time</label>
                    <input type="time" autocomplete="off" id="edit_etime" name="end_time" class="form-control" required>
                </div>
              </div>
              <div class="col-sm-12">
                <div class="form-group">
                  <label>Reason</label>
                  <textarea class="form-control" rows="2" id="edit_reason" name="reason" placeholder="Enter ..."></textarea>
                </div>
              </div>
              <div class="col-sm-12">
                <div class="form-group">
                    <label>Appointment Status</label>
                    <select class="form-control form-select" id="edit_status" name="status" required>
                        <option>Pending</option>
                        <option>Confirmed</option>
                        <option>Treated</option>
                        <option>Cancelled</option>
                    </select>
                </div>
              </div>      
            </div>
          </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <button type="submit" name="update_appointment" class="btn btn-info">Submit</button>
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
              <button type="submit" name="deletedata" class="btn btn-info ">Submit</button>
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
                <h1 class="m-0">Appointment</h1>
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
            <div class="card card-teal card-outline">
              <div class="card-header">
                <h3 class="card-title">Appointment List</h3>
                <button type="button" class="btn btn-info btn-sm float-right" data-toggle="modal" data-target="#AddAppointmentModal">
                <i class="fa fa-plus"></i> &nbsp;&nbsp;Add Appointment</button>
              </div>

              <div class="card-body">
                <div class="container-fluid">
                  <form action="appointment_action.php" method="POST">
			              <div class="row" id="selected_opt" style="display:none">
                      <div class="w-100 d-flex">
                        <div class="col-2">
                          <label for="" class="controllabel"> With Selected:</label>
                        </div>
                        <div class="col-2">
                          <select id="" name="new_status" class="custom-select select">
                            <option value="Pending">Pending</option>
                            <option value="Confirmed">Confirmed</option>
                            <option value="Cancelled">Cancelled</option>
                            <option value="Treated">Treated</option>
                          </select>
                        </div>
                          <div class="col">
                            <button type="submit" class="btn btn-primary" name="editbtn_status" id="">Go</button>
                          </div>
                      </div>
                    </div>
                        <table id="example1" class="table table-bordered table-hover" id="indi-list">
                          <thead>
                            <tr>
                              <th class="text-center">
                                <input type="checkbox" name="" value="" id="selectAll">
                              </th>
                              <th class="text-center">#</th>
                              <th>Patient</th>
                              <th>Day</th>
                              <th>Start Time</th>
                              <th>End Time</th>
                              <th>Status</th>
                              <th>Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                              $i = 1;
                              $sql = "SELECT a.*, CONCAT(p.fname,' ',p.lname) AS pname FROM tblappointment a,tblpatient p WHERE p.id = a.patient_id";
                              $query_run = mysqli_query($conn, $sql);
                              
                              while($row = mysqli_fetch_array($query_run)){
                            ?>
                              <tr>
                              <td style="width:10px; text-align:center;"><input type="checkbox" name="update_status[]" value="<?php echo $row['id']; ?>"></td>
                              <td style="width:10px; text-align:center;"><?php echo $i++; ?></td>
                              <td><?php echo $row['pname'];?></td>
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
                              else
                              {
                                echo $row['status'] = '<span class="badge badge-danger">Cancelled</span>';
                              }
                              ?>
                              </td>
                              </td>
                              <td>
                                <button type="button" data-id="<?php echo $row['id']; ?>" class="btn btn-sm btn-primary editbtn"><i class="fas fa-edit"></i></button>
                                <button type="button" data-id="<?php echo $row['id']; ?>" class="btn btn-danger btn-sm deletebtn"><i class="far fa-trash-alt"></i></button>
                              </td>
                              </tr>
                              <?php
                              }
                            ?>
                          </tbody>
                        </table>
                     
                    </div>
                  </form>
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
  var indiList;
    $(document).ready(function () {

      $('#sched_date').datepicker({
        todayHighlight: true,
        clearBtn: true,
        autoclose: true,
        startDate: new Date()
      });

      $('#edit_sched').datepicker({
          todayHighlight: true,
          clearBtn: true,
          autoclose: true,
          startDate: new Date()
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
          $('#edit_dentist').val(value['doc_id']);
          $('#edit_sched').val(value['schedule']);
          $('#edit_stime').val(value['starttime']);
          $('#edit_etime').val(value['endtime']);
          $('#edit_reason').val(value['reason']);
          $('#edit_status').val(value['status']);
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

      $('#selectAll').change(function(){
        if($(this).is(':checked'))
        {
          $('input[name="update_status[]"]').prop('checked',true);
        }
        else{
          $('input[name="update_status[]"]').each(function(){
            $(this).prop('checked',false);
          })
        }
      });

      $('input[type="checkbox"]').change(function() {
        if($(this).is(':checked')==true)
        {
          if($('#selected_opt').is(':visible') == false){
					$('#selected_opt').show('slow')
				}
        }
        else{
          if($('#selected_opt').is(':visible') == true){
						$('#selected_opt').hide('slow')
					}
        }
				});

 

    

});

</script>

<?php include('includes/footer.php');?>