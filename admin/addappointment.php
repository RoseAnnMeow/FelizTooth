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
<div class="modal fade" id="AddScheduleModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Add Schedule</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form action="schedule_action.php" method="POST">
        <div class="modal-body">
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                <label>Select Dentist</label>
                  <select class="form-control select2bs4" name="select_dentist"required>
                    <?php
                      if(isset($_GET['id']))
                      {
                        echo $id = $_GET['id'];
                      } 
                      $sql = "SELECT * FROM tbldoctor";
                      $query_run = mysqli_query($conn,$sql);
                      if(mysqli_num_rows($query_run) > 0)
                      {
                        foreach($query_run as $rowhob)
                        {
                          ?>

                          <option value="<?php echo $rowhob['id'];?>">
                            <?php echo $rowhob['name'];?></option>
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
                  <label>Day</label>
                  <select class="form-control" name="select_day" required >
                    <option selected disabled value="">--Select Day--</option>
                    <option>Monday</option>
                    <option>Tuesday</option>
                    <option>Wednesday</option>
                    <option>Thursday</option>
                    <option>Friday</option>
                    <option>Saturday</option>
                  </select>
                </div>
              </div>       
              <div class="col-sm-6">              
                <div class="form-group">
                    <label>Start Time</label>
                    <input type="time" autocomplete="off" name="start_time" class="form-control" required>
                </div>
              </div>
              <div class="col-sm-6">              
                <div class="form-group">
                    <label>End Time</label>
                    <input type="time" autocomplete="off" name="end_time" class="form-control" required>
                </div>
              </div>       
              <div class="col-sm-12">
                <div class="form-group">
                  <label>Appointment Duration</label>
                  <select class="form-control" name="select_duration" required >
                    <option selected disabled value="">--Select Duration--</option>
                    <option>15 minutes</option>
                    <option>20 minutes</option>
                    <option>30 minutes</option>
                    <option>40 minutes</option>
                    <option>45 minutes</option>
                    <option>1 hour</option>
                  </select>
                </div>
              </div>      
            </div>
          </div>
            
      
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" name="insert_time" class="btn btn-info">Submit</button>
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
<div class="modal fade" id="EditScheduleModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Edit Patient</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
 
      <form action="schedule_action.php" method="POST">
        <div class="modal-body">
            <div class="row">
              <div class="col-sm-12">
                <input type="hidden" name="edit_id" id="edit_id"> 
                <div class="form-group">
                <label>Select Dentist</label>
                  <select class="form-control" style="width: 100%;" id="edit_dentist" name="select_dentist" required>
                  <option>--Select Dentist--</option>
                  <?php
                      if(isset($_GET['id']))
                      {
                        echo $id = $_GET['id'];
                      } 
                      $sql = "SELECT * FROM tbldoctor";
                      $query_run = mysqli_query($conn,$sql);
                      if(mysqli_num_rows($query_run) > 0)
                      {
                        foreach($query_run as $rowhob)
                        {
                          ?>

                          <option value="<?php echo $rowhob['id'];?>">
                            <?php echo $rowhob['name'];?></option>
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
                  <label>Day</label>
                  <select class="form-control form-select" id="edit_day" name="select_day" required>
                    <option selected disabled value="">Choose</option>
                    <option>Monday</option>
                    <option>Tuesday</option>
                    <option>Wednesday</option>
                    <option>Thursday</option>
                    <option>Friday</option>
                    <option>Saturday</option>
                  </select>
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
                  <label>Appointment Duration</label>
                  <select class="form-control" style="width: 100%;" id="edit_duration" name="select_duration" required >
                    <option selected disabled value="">Choose</option>
                    <option>15 minutes</option>
                    <option>20 minutes</option>
                    <option>30 minutes</option>
                    <option>40 minutes</option>
                    <option>45 minutes</option>
                    <option>1 hour</option>
                  </select>
                </div>
              </div>      
            </div>
          </div>
            

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <button type="submit" name="update_sched" class="btn btn-info">Submit</button>
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
              <h4 class="modal-title">Delete Schedule</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div> 

            <form action="schedule_action.php" method="POST">
              <div class="modal-body">
                <input type="hidden" name="delete_id" id="delete_id">
                <p> Do you want to delete this schedule?</p>                          
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
        <div class="col-md-6">
          <?php
            include('message.php');
          ?>
            <div class="card card-teal card-outline">
                <div class="card-header">
                    <h3 class="card-title">Add Appointment</h3>
                </div>
                <div class="card-body">                    
                    <div class="form-group">                       
                        <label for="select_patient">Select Patient</label>
                        <select class="form-control select2bs4" name="select_patient" required>
                        <option selected disabled>Search Patient</option>
                            <?php
                                if(isset($_GET['id']))
                                {
                                    echo $id = $_GET['id'];
                                } 
                                $sql = "SELECT * FROM tblpatient";
                                $query_run = mysqli_query($conn,$sql);
                                if(mysqli_num_rows($query_run) > 0)
                                {
                                    foreach($query_run as $rowhob)
                                    {
                                    ?>

                                    <option value="<?php echo $rowhob['id'];?>">
                                        <?php echo $rowhob['fname'].' '.$rowhob['lname'];?></option>
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
                    <div class="form-group">                       
                        <label for="select_dentist">Select Doctor</label>
                        <select class="form-control select2bs4" name="select_dentist"required>
                        <option selected disabled>Search Doctor</option>
                            <?php
                                if(isset($_GET['id']))
                                {
                                    echo $id = $_GET['id'];
                                } 
                                $sql = "SELECT * FROM tbldoctor";
                                $query_run = mysqli_query($conn,$sql);
                                if(mysqli_num_rows($query_run) > 0)
                                {
                                    foreach($query_run as $rowhob)
                                    {
                                    ?>

                                    <option value="<?php echo $rowhob['id'];?>">
                                        <?php echo $rowhob['name'];?></option>
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
                    <div class="form-group">
                        <label for="inputClientCompany">Remarks</label>
                        <input type="text" id="inputClientCompany" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="inputProjectLeader">Project Leader</label>
                        <input type="text" id="inputProjectLeader" class="form-control">
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <a href="#" class="btn btn-secondary">Cancel</a>
                            <input type="submit" value="Create new Porject" class="btn btn-info float-right">
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->               
            </div>
            <!-- /.card -->
            </div>
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

      $(document).on('click', '.viewbtn', function() {       
        var userid = $(this).data('id');

        $.ajax({
        url: 'schedule_action.php',
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
        url: "schedule_action.php",
        data:
        {
          'checking_editbtn':true,
          'sched_id':schedid,
        },
        success: function (response) {
        $.each(response, function (key, value){
          $('#edit_id').val(value['id']);
          $('#edit_dentist').val(value['doc_id']);
          $('#edit_day').val(value['day']);
          $('#edit_stime').val(value['starttime']);
          $('#edit_etime').val(value['endtime']);
          $('#edit_duration').val(value['duration']);
        });

        $('#EditScheduleModal').modal('show');
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