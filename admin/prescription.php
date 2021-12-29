<?php
include('authentication.php');
include('includes/header.php');
include('includes/topbar.php');
include('includes/sidebar.php');
include('config/dbconn.php');
?>

<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
  <div class="modal fade" id="deletemodal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Delete Prescription</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div> 
        <form action="prescription_action.php" method="POST">
          <div class="modal-body">
            <input type="hidden" name="delete_id" id="delete_id">
            <p> Do you want to delete this data?</p>                          
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            <button type="submit" name="deletedata" class="btn btn-primary">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>   
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Prescription</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Prescription</li>
            </ol>
          </div>
        </div> 
      </div>
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
                  <h3 class="card-title">Prescription List</h3>
                    <a href="add-prescription.php" class="btn btn-primary btn-sm float-right">
                    <i class="fa fa-plus"></i> &nbsp;&nbsp;Add Prescription</a>
                </div>
                <div class="card-body">
                  <table id="example1" class="table table-borderless table-hover">
                    <thead class="bg-light">
                      <tr>
                        <th class="text-center">#</th>
                        <th>Date</th>
                        <th>Patient</th>
                        <th>Medicine</th>
                        <th>Notes</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        $i = 1;
                        $sql = "SELECT CONCAT(pat.fname,' ',pat.lname) as pname,doc.name,pres.medicine,pres.advice,pres.date,pres.id FROM prescription pres JOIN tblpatient pat ON pat.id = pres.patient_id JOIN tbldoctor doc ON doc.id = pres.doc_id";
                        $query_run = mysqli_query($conn, $sql);
                        
                        while($row = mysqli_fetch_array($query_run)){
                      ?>
                        <tr>
                          <td style="width:10px; text-align:center;"><?php echo $i++; ?></td>                       
                          <td width="15%"><?php echo date('d-M-Y',strtotime($row['date'])); ?></td>
                          <td><?php echo $row['pname']; ?></td>
                          <td><?php echo $row['medicine']; ?></td>
                          <td><?php echo $row['advice']; ?></td>
                          <td>
                            <a href="view-prescription.php?id=<?php echo $row['id'];?>" class="btn btn-sm btn-secondary viewbtn"><i class="fa fa-eye"></i></a>
                            <a href="edit-prescription.php?id=<?php echo $row['id'];?>" class="btn btn-sm btn-info editbtn"><i class="fas fa-edit"></i></a>
                            <button type="button" data-id="<?php echo $row['id'];?>" class="btn btn-danger btn-sm deletebtn"><i class="far fa-trash-alt"></i></button>
                          </td>
                        </tr>
                        <?php
                        }
                      ?>
                    </tbody>
                  </table>
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

    $(document).on('click','.deletebtn', function(){     
      var user_id = $(this).data('id');
      
      $('#delete_id').val(user_id);
      $('#deletemodal').modal('show');
      
      });
});
</script>

<?php include('includes/footer.php');?>