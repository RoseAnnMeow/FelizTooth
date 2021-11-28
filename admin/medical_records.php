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
<div class="modal fade" id="AddDoctorModal" >
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add Doctor</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form action="doctor_action.php" id="doctor_form" method="POST" enctype="multipart/form-data">
        <div class="modal-body">
            <div class="row">
              <div class="col-sm-6">
                <div class="form-group">
                  <label>Full Name</label>
                  <span class="text-danger">*</span>
                  <input type="text" name="fname" class="form-control" required>
                </div>
              </div>
              <div class="col-sm-6">              
                <div class="form-group">
                    <label>Birthdate</label>
                    <span class="text-danger">*</span>
                    <input type="text" autocomplete="off" name="birthday" class="form-control" id="datepicker" required onkeypress="return false;">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-6">
                <div class="form-group">
                  <label>Address</label>
                  <span class="text-danger">*</span>
                  <input type="text" name="address" class="form-control" required>
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
            <div class="col-sm-6">
              <div class="form-group">
                <label>Phone</label>
                <span class="text-danger">*</span>
                <input type="text" name="phone" class="form-control"  maxLength="11" minLength="11" required>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label>Email</label>
                <span class="text-danger">*</span>
                <input type="email" name="email" class="form-control email_id" required>
                <span class="email_error text-danger"></span>
              </div>             
            </div>
          </div>
          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label>Doctor Degree</label>
                  <span class="text-danger">*</span>
                  <input type="text" autocomplete="off" name="degree" class="form-control" required>
              </div>
            </div>
            <div class="col-sm-6">              
              <div class="form-group">
                  <label>Doctor Specialty</label>
                  <span class="text-danger">*</span>
                  <input type="text" autocomplete="off" name="specialty" class="form-control" required>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label>Password</label>
                <span class="text-danger">*</span>
                <input type="password" id="password" name="password" class="form-control" required>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label>Confirm Password</label>
                <span class="text-danger">*</span>
                <input type="password" id="confirmPassword" name="confirmPassword" class="form-control" required>
              </div>             
            </div>
          </div>
          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label for="doc_image">Upload Image</label>
                <input type="file" name ="doc_image" id="doc_image" name="image">
              </div>
            </div>
          </div>
        </div>
             
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" id="submit_button" name="insertdoctor" class="btn btn-primary">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!--View Modal-->
<div class="modal fade" id="ViewDoctorModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Doctor Info</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="doctor_viewing_data">
        </div>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
    </div>
  </div>
</div>

<!--Edit Modal-->
<div class="modal fade" id="EditDoctorModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Doctor</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="doctor_action.php" method="POST" enctype="multipart/form-data">
        <div class="modal-body">
            <div class="row">
              <div class="col-sm-6">
                <input type="hidden" name="edit_id" id="edit_id"> 
                <div class="form-group">
                  <label>Full Name</label>
                  <span class="text-danger">*</span>
                  <input type="text" name="fname" id="edit_fname" class="form-control" required>
                </div>
              </div>
              <div class="col-sm-6 auto">              
                <div class="form-group">
                    <label>Birthdate</label>
                    <span class="text-danger">*</span>
                    <input type="text" autocomplete="off" id="edit_dob" name="birthday" class="form-control" required onkeypress="return false;">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-6">
                <div class="form-group">
                  <label>Address</label>
                  <span class="text-danger">*</span>
                  <input type="text" name="address" id="edit_address" class="form-control" required>
                </div>
              </div>
              <div class="col-sm-6 auto">
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
            <div class="col-sm-6">
              <div class="form-group">
                <label>Phone</label>
                <span class="text-danger">*</span>
                <input type="text" name="phone" id="edit_phone" class="form-control"  maxLength="11" minLength="11" required>
              </div>
            </div>
            <div class="col-sm-6 auto">
              <div class="form-group">
                <label>Email</label>
                <span class="text-danger">*</span>
                <input type="email" name="email" id="edit_email" class="form-control email_id" required>
                <span class="email_error text-danger"></span>
              </div>             
            </div>
          </div>
          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label>Doctor Degree</label>
                  <span class="text-danger">*</span>
                  <input type="text" autocomplete="off" name="degree" id="edit_degree" class="form-control" required>
              </div>
            </div>
            <div class="col-sm-6 auto">              
              <div class="form-group">
                  <label>Doctor Specialty</label>
                  <span class="text-danger">*</span>
                  <input type="text" autocomplete="off" name="specialty" id="edit_specialty" class="form-control" required>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label>Password</label>
                <span class="text-danger">*</span>
                <input type="password" id="edit_password" name="edit_password" class="form-control" required>
              </div>
            </div>
            <div class="col-sm-6 auto">
              <div class="form-group">
                <label>Confirm Password</label>
                <span class="text-danger">*</span>
                <input type="password" id="edit_confirmPassword" name="edit_confirmPassword" class="form-control" required>
              </div>             
            </div>
          </div>
          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label for="doc_image">Upload Image</label>
                <input type="file" id="edit_docimage" name="edit_docimage">
                <div id="uploaded_image"></div>  
                <input type="hidden" name="hidden_doctor_profile_image" id="hidden_doctor_profile_image" />             
              </div>
            </div>
          </div>
        </div>
             
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" name="updatedoctor" class="btn btn-primary">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- delete modal pop up modal -->
      <div class="modal fade" id="DeleteDoctorModal">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Delete Patient</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div> 

            <form action="doctor_action.php" method="POST">
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
            <div class="row">
              <div class="col-sm-6">
                <h1 class="m-0">Doctor</h1>
              </div><!-- /.col -->
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                  <li class="breadcrumb-item active">Doctor</li>
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
                <h3 class="card-title">Doctor List</h3>
                <button type="button" class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#AddDoctorModal">
                <i class="fa fa-plus"></i> &nbsp;&nbsp;Add Doctor</button>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                  <table id="example1" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th class="text-center">#</th>
                        <th width="60">Photo</th>
                        <th>Doctor Name</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Doctor Specialty</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        $i = 1;
                        $sql = "SELECT * FROM tbldoctor";
                        $query_run = mysqli_query($conn, $sql);
                        
                        while($row = mysqli_fetch_array($query_run)){
                      ?>
                        <tr>
                        <td class="text-center"><?php echo $i++; ?></td>
                        <td>
                          <?php echo '<img src="'.$row['image'].'" class="img-thumbnail" width="60">'; ?>
                        </td>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['phone']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td><?php echo $row['specialty']; ?></td>     
                        <td>
                          <?php
                            if($row['status']==1){
                              echo '<button data-id="'.$row['id'].'" data-status="'.$row['status'].'" class="btn btn-sm btn-primary activatebtn">Active</button>';
                            }
                            else{
                              echo '<button data-id="'.$row['id'].'" data-status="'.$row['status'].'" class="btn btn-sm btn-danger activatebtn">Inactive</button>';
                            }
                          ?>
                        </td>     
                        <td>
                          <button data-id="<?php echo $row['id']; ?>" class="btn btn-sm btn-secondary viewDoctorbtn"><i class="fa fa-eye"></i></button>
                          <button data-id="<?php echo $row['id']; ?>" class="btn btn-sm btn-info editDoctorbtn"><i class="fas fa-edit"></i></button>
                          <input type="hidden" name="del_image" value="<?php echo $row['image'];?>">
                          <button data-id="<?php echo $row['id']; ?>" class="btn btn-danger btn-sm deleteDoctorbtn"><i class="far fa-trash-alt"></i></button>
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

    $(document).on('click', '.viewDoctorbtn', function() {       
    var userid = $(this).data('id');

    $.ajax({
    url: 'doctor_action.php',
    type: 'post',
    data: {
      'checking_viewDoctortbtn':true,
      'user_id':userid,
    },
    success: function(response){ 
      
      $('.doctor_viewing_data').html(response);
      $('#ViewDoctorModal').modal('show'); 
    }
  });
});

    //Doctor Edit Modal
    $(document).on('click', '.editDoctorbtn', function() {          
      var userid = $(this).data('id');

      $.ajax({
        type: "POST",
        url: "doctor_action.php",
        data:
        {
          'checking_editDoctorbtn':true,
          'user_id':userid,
        },
        success: function (response) {
        $.each(response, function (key, value){
          $('#edit_id').val(value['id']);
          $('#edit_fname').val(value['name']);
          $('#edit_address').val(value['address']);
          $('#edit_dob').val(value['dob']);
          $('#edit_gender').val(value['gender']);
          $('#edit_phone').val(value['phone']);
          $('#edit_email').val(value['email']);
          $('#edit_degree').val(value['degree']);
          $('#edit_specialty').val(value['specialty']);
          $('#uploaded_image').html('<img src="'+value['image']+'" class="img-fluid img-thumbnail" width="120" />');
          $('#hidden_doctor_profile_image').val(value['image']);
          $('#edit_password').val(value['password']);
          $('#edit_confirmPassword').val(value['password']);
        });

        $('#EditDoctorModal').modal('show');
        }
      });
    });

      //Doctor Delete Modal
    $(document).on('click','.deleteDoctorbtn', function(){
    
    var user_id = $(this).data('id');
    $('#delete_id').val(user_id);
    $('#DeleteDoctorModal').modal('show');
  });

    $(document).on('click','.activatebtn', function () { 
      var userid = $(this).data('id');
      var status = $(this).data('status');
      var next_status = 'Active';
      if(status == 1)
      {
        next_status = 'Inactive';
      }

      if(confirm("Are you sure you want to "+next_status+" it?"))
      {     
          $.ajax({
          type: "post",
          url: "doctor_action.php",
          data: 
          {
          'change_status':true,
            'user_id':userid,
            'status':status,
            'next_status':next_status
          },
          success: function (response) {
            location.reload();
          }
        });
      }    
    });
      
      
	});

</script>
  

<?php include('includes/footer.php');?>