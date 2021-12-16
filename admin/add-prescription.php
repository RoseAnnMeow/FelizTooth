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
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
        </div>
      </div>
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">Add Prescription</h3>
                        <a href="prescription.php" class="btn  btn-outline-danger btn-sm float-right">
                        <i class="fas fa-long-arrow-left"></i> &nbsp;&nbsp;Back</a>
                    </div>
                    <div class="card-body">
                        <form action="prescription_action.php" method="post">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Date</label>
                                    <span class="text-danger">*</span>
                                    <input type="text" autocomplete="off" name="date" class="form-control" id="presdate" required onkeypress="return false;">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Select Patient</label>
                                    <span class="text-danger">*</span>
                                    <select class="form-control select2 patient" id="edit_patient" name="select_patient" style="width: 100%;" required>
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
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Select Doctor</label>
                                    <span class="text-danger">*</span>
                                    <select class="form-control select2 doctor" name="select_doctor" style="width: 100%;" required>
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
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Medicine</label>
                                    <textarea id="medicine_note" name="medicine_note" >
                                    </textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Notes</label>
                                    <textarea id="advice_note" name="advice_note">                                
                                    </textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary" name="add_prescription">Save Prescription</button>
                            </div>
                        </div>                       
                        </form>
                    </div>
                </div>
            <!-- /.card-body -->
            </div>
          <!-- /.card -->
        </div>

    </div>
        <!-- /.row -->
</div><!-- /.container-fluid -->
</section>

</div>
<?php include('includes/scripts.php');?>
<script>
     $(function () {
    $('#medicine_note').summernote({
        height: 150,
    })
    $('#advice_note').summernote({
        height: 150,
    })

    $('.select2').select2()

      $(".patient").select2({
      placeholder: "Select Patient",
      allowClear: true
      });

      $(".doctor").select2({
      placeholder: "Select Doctor",
      allowClear: true
      });

    $('#presdate').datepicker({
      todayHighlight: true,
      clearBtn: true,
    })
  })
</script>
<?php include('includes/footer.php');?>