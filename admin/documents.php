<?php
include('authentication.php');
include('includes/header.php');
include('includes/topbar.php');
include('includes/sidebar.php');
include('config/dbconn.php');
?>

<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
  <div class="modal fade" id="AddDocumentrModal" >
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Add Document</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <form action="document_action.php" method="POST" enctype="multipart/form-data">
          <div class="modal-body">
            <div class="row">
              <div class="col-sm-12">
                <div class="form-group">
                  <label>Select Patient</label>
                  <span class="text-danger">*</span>
                  <select class="form-control patient" name="select_patient" style="width: 100%;" required>
                  <option selected disabled value="">Select Patient</option>
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
              <div class="col-sm-12">              
                <div class="form-group">
                    <label>Description</label>
                    <span class="text-danger">*</span>
                    <input type="text" name="description" class="form-control" required>
                </div>
              </div>     
              <div class="col-sm-6">
                <div class="form-group">
                  <label>File</label>
                  <input type="file" name="files" id="files">
                </div>
              </div>
            </div>         
          </div>            
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" name="insert_documents" class="btn btn-primary">Submit</button>
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
                    <input type="text" autocomplete="off" id="edit_dob" name="birthday" class="form-control" required>
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
            <input type="hidden" id="edit_password" name="edit_password" class="form-control" required>
            <input type="hidden" id="edit_confirmPassword" name="edit_confirmPassword" class="form-control" required>
          </div>
          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label for="doc_image">Upload Image</label>
                <input type="file" id="edit_docimage" name="edit_docimage"/>
                <input type="hidden" name="old_image" id="old_image"/>
                <div id="uploaded_image"></div>               
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
              <h5 class="modal-title">Delete Doctor</h5>
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


  <div class="content-wrapper">
    <div class="content-header">
      <section class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Documents</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active">Documents</li>
              </ol>
            </div>
          </div> 
        </section>
      </div>
      
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <?php
          include('message.php');
          ?>
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h3 class="card-title">Documents List</h3>
                <button type="button" class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#AddDocumentrModal">
                <i class="fa fa-plus"></i> &nbsp;&nbsp;Add Document</button>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                  <table id="example1" class="table table-borderless table-hover">
                    <thead class="bg-light">
                      <tr>
                        <th>Patient</th>
                        <th>Description</th>
                        <th>Document</th>
                        <th>Date</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        $sql = "SELECT d.*, CONCAT(p.fname,' ',p.lname) AS pname 
                        FROM documents d INNER JOIN tblpatient p 
                        WHERE p.id = d.patient_id";
                        $query_run = mysqli_query($conn, $sql);
                        
                        while($row = mysqli_fetch_array($query_run)){
                      ?>
                        <tr>                       
                        <td><?=$row['pname']?></td>
                        <td><?=$row['description']?></td>
                        <td><?=$row['document']?></td>
                        <td><?= date('d-M-Y',strtotime($row['date']))?></td>        
                        <td>
                          <button data-id="<?=$row['id']?>" class="btn btn-danger btn-sm deleteDoctorbtn"><i class="far fa-trash-alt"></i></button>
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

    $(".patient").select2({
    placeholder: "Select Patient",
    allowClear: true
    });
	});

</script>
  

<?php include('includes/footer.php');?>