<?php
include('authentication.php');
include('includes/header.php');
include('includes/topbar.php');
include('includes/sidebar.php');
include('config/dbconn.php');
?>

<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

<div class="content-wrapper">
  <div class="content-header">
    </div>
      
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-6">
            <?php
            include('message.php');
            ?>
                <div class="card card-teal card-outline">
                  <div class="card-header">
                  <h3 class="card-title">Edit Appointment</h3>
                </div>
    
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-12">
                      <form action="appointment_action.php" method="post">
                        <?php
                        if(isset($_GET['id']))
                        {
                          $user_id = $_GET['id'];
                          $sql = "SELECT a.*, CONCAT(p.fname,' ',p.lname) AS pname FROM tblappointment a INNER JOIN tblpatient p WHERE p.id = a.patient_id AND a.id='$user_id' LIMIT 1";
                          $query_run = mysqli_query($conn,$sql);

                          if(mysqli_num_rows($query_run) > 0)
                          {
                            foreach($query_run as $row)
                            {
                              ?>
                              <div class="form-group">
                              <label>Select Patient</label>
                                <select class="form-control select2 patient" name="select_patient" id="edit_patient" value="<?php echo $row['pname'];?>" selected="selected" style="width: 100%;" required>
                                <option selected disabled value="">Select Patient</option>
                                  <?php
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
                              <div class="form-group">
                                  <label>Select Dentist</label>
                                  <select class="form-control select2 dentist" name="select_dentist" value="<?=$row['dentist'];?>" style="width: 100%;" required>
                                    <option selected disabled value="">Select Doctor</option>
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
                              <div class="form-group">
                                  <label>Appontment Date</label>
                                  <input type="text" autocomplete="off" name="scheddate" class="form-control" value="<?php echo $row['pname'];?>" required onkeypress="return false;">
                              </div>
                              <div class="form-group">
                                <label>Appointment Start Time</label>
                                  <div class="input-group date" id="starttime" data-target-input="nearest">
                                    <input type="text" autocomplete="off" name="start_time" value="<?=$row['starttime'];?>"  class="form-control datetimepicker-input" required data-target="#starttime"/>
                                    <div class="input-group-append" data-target="#starttime" data-toggle="datetimepicker">
                                      <div class="input-group-text"><i class="far fa-clock"></i></div>
                                    </div>
                                  </div>
                              </div>
                              <div class="form-group">
                                  <label>Appointment End Time</label>
                                  <div class="input-group date" id="endtime" data-target-input="nearest">
                                    <input type="text" autocomplete="off" name="end_time" value="<?=$row['endtime'];?>" class="form-control datetimepicker-input" required data-target="#endtime"/>
                                    <div class="input-group-append" data-target="#endtime" data-toggle="datetimepicker">
                                      <div class="input-group-text"><i class="far fa-clock"></i></div>
                                    </div>
                                  </div>
                              </div>
                              <div class="form-group">
                                <label>Reason</label>
                                <textarea class="form-control" rows="2" name="reason" value="<?=$row['reason'];?>" required placeholder="Enter ..."></textarea>
                              </div>
                              <div class="form-group">
                                <label for="inputStatus">Status</label>
                                <select id="inputStatus" value="<?=$row['status'];?>" class="form-control custom-select">
                                  <option>Pending</option>
                                  <option>Confirmed</option>
                                  <option>Treated</option>
                                  <option>Cancelled</option>
                                </select>
                              </div>
                              <div class="form-group">
                                <label for="color">Color</label>
                                <span class="text-sm">(Optional)</span>
                                <select id="color" value="<?=$row['color'];?>" class="form-control custom-select">
                                    <option style="color:#f39c12;" value="#f39c12">Yellow</option>
                                    <option style="color:#00c0ef;" value="#00c0ef"> Aqua</option>
                                    <option style="color:#0073b7;" value="#0073b7"> Blue</option>						  
                                    <option style="color:#00a65a;" value="#00a65a"> Green</option>
                                    <option style="color:#FF8C00;" value="#FF8C00"> Orange</option>
                                    <option style="color:#3c8dbc;" value="#3c8dbc"> Light Blue</option>
                                    <option style="color:#f56954;" value="#f56954"> Red</option>	
                                </select>
                              </div>

                              <?php

                            }
                          }
                        }

                        ?>
                       
                      </form>
                    </div>
                  </div>
                </div>

              </div>
            </div>
          </div>
        </div>
      </div> 
  </div>
</div>

<?php include('includes/scripts.php');?>
<script>
    $(document).ready(function () {

      $('.select2').select2()

      $(".patient").select2({
      placeholder: "Select Patient",
      allowClear: true
      });

      $(".dentist").select2({
      placeholder: "Select Dentist",
      allowClear: true
      });

      $('#starttime').datetimepicker({
          format: 'LT'
      });
      $('#endtime').datetimepicker({
          format: 'LT'
      });

      $('#edit_sched').datepicker({
          todayHighlight: true,
          clearBtn: true,
          autoclose: true,
          startDate: new Date()
      });

      const colorBox = document.getElementById('color');

      colorBox.addEventListener('change', (event) => {
        const color = event.target.value;
        event.target.style.color = color;
      }, false);


      $(document).on('click', '.viewbtn', function() {       
        var userid = $(this).data('id');

        $.ajax({
        url: 'patient_action.php',
        type: 'post',
        data: {userid: userid},
        success: function(response){ 
          
          $('.patient_viewing_data').html(response);
          $('#ViewPatientModal').modal('show'); 
        }
      });
    });

    $(document).on('click', '.editbtn', function() {          
      var user_id = $(this).data('id');

      $.ajax({
        type:'post',
        url: "patient_action.php",
        data:
        {
          'checking_editbtn':true,
          'user_id':user_id,
        },
        success: function (response) {
        $.each(response, function (key, value){
          $('#edit_id').val(value['id']);
          $('#edit_fname').val(value['fname']);
          $('#edit_lname').val(value['lname']);
          $('#edit_address').val(value['address']);
          $('#edit_dob').val(value['dob']);
          $('#edit_gender').val(value['gender']);
          $('#edit_phone').val(value['phone']);
          $('#edit_email').val(value['email']);
          $('#edit_password').val(value['password']);
          $('#edit_cpassword').val(value['password']);
        });

        $('#EditPatientModal').modal('show');
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