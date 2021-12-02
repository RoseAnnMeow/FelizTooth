<?php
include('authentication.php');
include('includes/header.php');
include('includes/topbar.php');
include('includes/sidebar.php');
include('config/dbconn.php');
?>

<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
 <!-- Content Header (Page header) -->
    <div class="content-header">
        <section class="container-fluid">
            <div class="row">
              <div class="col-sm-6">
                <h1 class="m-0">Medical History</h1>
              </div><!-- /.col -->
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                  <li class="breadcrumb-item active">Medical History</li>
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