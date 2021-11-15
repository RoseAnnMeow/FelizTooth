<?php
session_start();
include('includes/header.php');
include('includes/topbar.php');
include('includes/sidebar.php');
include('config/dbconn.php');
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

<!-- Add Schedule -->
<div class="modal fade" id="AddScheduleModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Schedule</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                <form>
                    <div class="form-group">
                        <label>Weekday</label>
                        <select class="form-control rounded-0">
                            <option>Monday</option>
                            <option>Tuesday</option>
                            <option>Wednesday</option>
                            <option>Thursday</option>
                            <option>Friday</option>
                            <option>Saturday</option>
                        </select>
                        </div>
                        <div>
        <div class="form-group">
           <div class="input-group date" id="datetimepicker7" data-target-input="nearest">
                <input type="text" class="form-control datetimepicker-input" data-target="#datetimepicker7"/>
                <div class="input-group-append" data-target="#datetimepicker7" data-toggle="datetimepicker">
                    <div class="input-group-text"><i class="fa fa-clock-o"></i></div>
                </div>
            </div>
        </div>
    </div>
    <div>
        <div class="form-group">
           <div class="input-group date" id="datetimepicker8" data-target-input="nearest">
                <input type="text" class="form-control datetimepicker-input" data-target="#datetimepicker8"/>
                <div class="input-group-append" data-target="#datetimepicker8" data-toggle="datetimepicker">
                    <div class="input-group-text"><i class="fa fa-clock-o"></i></div>
                </div>
            </div>
        </div>
    </div>
                <div class="form-group">
                    <label>Appointment Duration</label>
                    <select class="form-control rounded-0">
                        <option>15 Minutes</option>
                        <option>20 Minutes</option>
                        <option>30 Minutes</option>
                        <option>40 Minutes</option>
                        <option>50 Minutes</option>
                        <option>1 Hour</option>
                    </select>
                </div>
            </form>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-info btn-flat">Submit</button>
        </div>
        </div>
    </div>
    </div>

<!--View Modal-->
<div class="modal fade" id="ViewPatientModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Patient Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="patient_viewing_data">
          
        </div>
      </div>
    </div>
  </div>
</div>

<!--Edit Modal-->
<div class="modal fade" id="EditPatientModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Edit Patient</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
 
      <form action="insertcode.php" method="POST">
        <div class="modal-body">
          <div class="row">
            <div class="col-sm-6">
            <input type="hidden" name="edit_id" id="edit_id">  
              <div class="form-group">
                <label>Name</label>
                <input type="text" name="fname" id="edit_fname" class="form-control rounded-0">
              </div>
            </div>
            <div class="col-sm-6 auto">
              <div class="form-group">
                <label>Age</label>
                <input type="text" name="age" id="edit_age" class="form-control rounded-0">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label>Address</label>
                <input type="text" name="address" id="edit_address" class="form-control rounded-0">
              </div>
            </div>
            <div class="col-sm-6 auto">
              <div class="form-group">
                <label>Email</label>
                <input type="text" name="email" id="edit_email" class="form-control rounded-0">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label>Phone</label>
                <input type="text" name="phone" id="edit_phone" class="form-control rounded-0">
              </div>
            </div>
            <div class="col-sm-6 auto">
              <div class="form-group">
                <label>Sex</label>
                <select class="form-control rounded-0" id="edit_gender" name="gender">
                  <option>Female</option>
                  <option>Male</option>
                </select>
              </div>
            </div>
          </div>               
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" name="updatedata" class="btn btn-primary">Update</button>
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
              <h4 class="modal-title">Delete Patient</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div> 

            <form action="insertcode.php" method="POST">
              <div class="modal-body">
                <input type="hidden" name="delete_id" id="delete_id">
                <p> Do you want to delete this data?</p>                          
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

 <!-- Content Header (Page header) -->
 <div class="content-header">
      <section class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Schedule</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Schedule</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
</section><!-- /.container-fluid -->
</div>
  <!--/.content-header-->

  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <?php
              if(isset($_SESSION['status']))
              {
                ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                  <?php echo $_SESSION['status'];?>
                </div>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true"></span>
              </button>
                <?php
                  unset($_SESSION['status']);
              }
            ?>
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Time Schedule</h3>
              <button type="button" class="btn btn-info btn-sm float-right" data-toggle="modal" data-target="#AddScheduleModal">
              <i class="fa fa-plus"></i> &nbsp;&nbsp;Add Schedule</button>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="example1" class="table table-bordered table-light table-hover">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Weekday</th>
                      <th>Start Time</th>
                      <th>End Time</th>
                      <th>Duration</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $sql = "SELECT * FROM tblschedule";
                      $query_run = mysqli_query($conn, $sql);

                      if(mysqli_num_rows($query_run) > 0)
                      {
                        foreach($query_run as $row)
                        {
                          ?>
                            <tr>
                            <td>1</td>
                            <td><?php echo $row['weekday']; ?></td>
                            <td><?php echo $row['starttime']; ?></td>
                            <td><?php echo $row['endtime']; ?></td>
                            <td><?php echo $row['duration']; ?></td>
                            <td>
                              <button type="button" class="btn btn-danger btn-sm deletebtn"><i class="fa fa-trash"></i>&nbsp;&nbsp;Delete</button>
                            </td>
                            </tr>
                          <?php
                        }
                      }
                      else
                      {
                        ?>
                          <tr>
                            <td>No record found</td>
                          </tr>
                          <?php
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

    </div>
  </div>


</div>
<?php include('includes/scripts.php');?>
<script>
    $(document).ready(function () {
      $(document).on('click','.deletebtn', function(){

        $('#deletemodal').modal('show');

        $tr = $(this).closest('tr');
        var data = $tr.children("td").map(function() {
          return $(this).text();
        }).get();

        console.log(data)

        $('#delete_id').val(data[0]);

      });

    });
  </script>
<?php include('includes/footer.php');?>