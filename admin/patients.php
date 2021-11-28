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
<div class="modal fade" id="AddPatientModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Add Patient</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form action="patient_action.php" method="POST">
        <div class="modal-body">
            <div class="row">
              <div class="col-sm-6">
                <div class="form-group">
                  <label>First Name</label>
                  <span class="text-danger">*</span>
                  <input type="text" name="fname" class="form-control" required>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label>Last Name</label>
                  <span class="text-danger">*</span>
                  <input type="text" name="lname" class="form-control" required>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-6">              
                <div class="form-group">
                    <label>Birthdate</label>
                    <span class="text-danger">*</span>
                    <input type="text" autocomplete="off" name="birthday" class="form-control" id="datepicker" required onkeypress="return false;">
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label>Gender</label>
                  <span class="text-danger">*</span>
                  <select class="form-control form-select" name="gender" required>
                    <option selected disabled value="">Choose</option>
                    <option>Female</option>
                    <option>Male</option>
                    <option>Others</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-12">
                <div class="form-group">
                  <label>Address</label>
                  <span class="text-danger">*</span>
                  <input type="text" name="address" class="form-control" required>
                </div>
              </div>
            </div>           
            <div class="row">
              <div class="col-sm-6 mb-2">
                <div class="form-group">
                  <label>Phone</label>
                  <span class="text-danger">*</span>
                  <input type="phone" name="phone" class="form-control"  maxLength="11" minLength="11" required>
                </div>
              </div>
              <div class="col-sm-6 mb-2 auto">
                <div class="form-group">
                  <label>Email</label>
                  <span class="text-danger">*</span>
                  <input type="email" name="email" class="form-control" required>
                </div>             
              </div>
            </div>
            <div class="row">
              <div class="col-sm-6 mb-2">
                <div class="form-group">
                  <label>Password</label>
                  <span class="text-danger">*</span>
                  <input type="password" id="password" name="password" class="form-control" required>
                </div>
              </div>
              <div class="col-sm-6 mb-2 auto">
                <div class="form-group">
                  <label>Confirm Password</label>
                  <span class="text-danger">*</span>
                  <input type="password" id="confirmPassword" name="confirmPassword" class="form-control" required>
                </div>             
              </div>
            </div>
          </div>
      
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" name="insertpatient" class="btn btn-primary">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!--View Modal-->
<div class="modal fade" id="ViewPatientModal">
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
<div class="modal fade" id="EditPatientModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Edit Patient</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
 
      <form action="patient_action.php" method="POST">
        <div class="modal-body">
            <div class="row">
              <div class="col-sm-6 mb-2">
                <input type="hidden" name="edit_id" id="edit_id"> 
                <div class="form-group">
                  <label>First Name</label>
                  <span class="text-danger">*</span>
                  <input type="text" name="fname" id="edit_fname" class="form-control" required>
                </div>
              </div>
              <div class="col-sm-6 mb-2">
                <div class="form-group">
                  <label>Last Name</label>
                  <span class="text-danger">*</span>
                  <input type="text" name="lname" id="edit_lname" class="form-control" required>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-6 mb-2 auto">              
                <div class="form-group">
                    <label>Birthdate</label>
                    <span class="text-danger">*</span>
                    <input type="text" autocomplete="off" id="edit_dob" name="birthday" class="form-control" id="datepicker" required onkeypress="return false;">
                </div>
              </div>
              <div class="col-sm-6 mb-2">
                <div class="form-group">
                  <label>Gender</label>
                  <span class="text-danger">*</span>
                  <select class="form-control form-select" name="gender" id="edit_gender" required>
                    <option selected disabled value="">Choose</option>
                    <option>Female</option>
                    <option>Male</option>
                    <option>Others</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-12">
                <div class="form-group">
                  <label>Address</label>
                  <span class="text-danger">*</span>
                  <input type="text" name="address" id="edit_address" class="form-control" required>
                </div>
              </div>              
            </div>
            <div class="row">
              <div class="col-sm-6">
                <div class="form-group">
                  <label>Phone</label>
                  <span class="text-danger">*</span>
                  <input type="phone" name="phone" id="edit_phone" class="form-control"  maxLength="11" minLength="11" required>
                </div>
              </div>
              <div class="col-sm-6 mb-2">
                <div class="form-group">
                  <label>Email</label>
                  <span class="text-danger">*</span>
                  <input type="email" name="email" id="edit_email" class="form-control" required>
                  <span class="email_error text-danger"></span>
                </div>             
              </div>
            </div>
            <div class="row">
              <div class="col-sm-6 mb-2">
                <div class="form-group">
                  <label>Password</label>
                  <span class="text-danger">*</span>
                  <input type="password" id="edit_password" name="password" class="form-control" required>
                </div>
              </div>
              <div class="col-sm-6 mb-2">
                <div class="form-group">
                  <label>Confirm Password</label>
                  <span class="text-danger">*</span>
                  <input type="password" id="edit_cpassword" name="confirmPassword" class="form-control" required>
                </div>             
              </div>
            </div>
          </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <button type="submit" name="updatedata" class="btn btn-primary">Submit</button>
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

            <form action="patient_action.php" method="POST">
              <div class="modal-body">
                <input type="hidden" name="delete_id" id="delete_id">
                <p> Do you want to delete this data?</p>                          
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
                <h1 class="m-0">Patient</h1>
              </div><!-- /.col -->
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                  <li class="breadcrumb-item active">Patient</li>
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
                <h3 class="card-title">Patient List</h3>
                <button type="button" class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#AddPatientModal">
                <i class="fa fa-plus"></i> &nbsp;&nbsp;Add Patient</button>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                  <table id="example1" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th class="text-center">#</th>
                        <th>Name</th>
                        <th>Reg. Date</th>
                        <th>Mobile No.</th>
                        <th>Email</th>
                        <th width="25px;">Verification Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        $i = 1;
                        $sql = "SELECT * FROM tblpatient";
                        $query_run = mysqli_query($conn, $sql);
                        
                        while($row = mysqli_fetch_array($query_run)){
                      ?>
                        <tr>
                        <td class="text-center"><?php echo $i++; ?></td>
                        <td><?php echo $row['fname'].' '.$row['lname']; ?></td>
                        <td><?php echo date('d-M-Y',strtotime($row['created_at'])); ?></td>
                        <td><?php echo $row['phone']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td><?php 
                        if($row['verify_status'] == '1')
                        {
                          echo $row['verify_status'] = '<span class="badge badge-primary">Verified</span>';
                        }
                        else
                        {
                          echo $row['verify_status'] = '<span class="badge badge-warning">Not Verified</span>';
                        }
                        ?>
                        </td>
                        <td>
                          <button data-id="<?php echo $row['id']; ?>" class="btn btn-sm btn-secondary viewbtn"><i class="fa fa-eye"></i></button>
                          <button data-id="<?php echo $row['id']; ?>" class="btn btn-sm btn-info editbtn"><i class="fas fa-edit"></i></button>
                          <button data-id="<?php echo $row['id']; ?>" class="btn btn-danger btn-sm deletebtn"><i class="far fa-trash-alt"></i></button>
                        </td>
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
  </div> <!-- /.container -->
</div> <!-- /.content-wrapper -->

</div>

<?php include('includes/scripts.php');?>
<script>
    $(document).ready(function () {

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