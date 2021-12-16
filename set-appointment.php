
<?php 
include('main/header.php');
include('admin/config/dbconn.php');
?>
<body class="hold-transition layout-top-nav">
<div class="wrapper">
<?php include('main/topbar.php');?>
    <div class="content-wrapper py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <h3 class="text-header">Set an Appointment</h3><hr>
                    <p class="text-justify">Due to COVID-19 pandemic we are strictly by appointment only until further notice.
                    Please do not schedule an appointment if you have signs or symptoms of COVID-19. 
                    Wearing a face mask is a must to ensure the safety of Doctors and Patients.We will confirm your appointment via email or call 2 to 3 days before your appointment date. Please take note of the following:
                    </p>
                    <ul>
                        <li>Wearing face mask is a requirement</li>
                    </ul>
                    <p>This questionnaire is designed with your safety in mind and must be answered honestly. Your answers will be reviewed prior to your appointment and a member of our team will contact you if we recommend rescheduling to a later date. An answer of YES does not exclude you from treatment. Please answer YES or NO to each of the following questions. Thank you for your consideration and understanding.</p>
                    <form action="" method="post">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">First Name *</label>
                                    <input type="text" name="fname" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Last Name *</label>
                                    <input type="text" name="lname" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Contact Number *</label>
                                    <input type="text" class="form-control" name="contact" placeholder="+63 917 1234 567" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Email *</label>
                                    <input type="email" class="form-control" name="email" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Preferred Date*</label>
                            <input type="text" autocomplete="off" name="scheddate" class="form-control" id="scheddate" required>
                        </div>
                        <div class="form-group">
                            <label>Your concern*</label>
                            <?php
                                $sql = "SELECT * FROM procedures";
                                $query_run = mysqli_query($conn,$sql);
                                $check_services = mysqli_num_rows($query_run) > 0;

                                if($check_services)
                                {
                                while($row = mysqli_fetch_array($query_run))
                                {
                                    ?>
                                    <div class="col-md-6">
                                        <div class="form-check">
                                            <input class="form-check-input" name="concern[]" type="checkbox" value="<?=$row['procedures']?>"><?=$row['procedures']?><br>
                                        </div>

                                    </div>
                                    <?php
                                }
                                }
                                else
                                {
                                echo "<h5> No Record Found</h5>";
                                }
                            ?>
                        </div>
                    </form>
                </div>
                <div class="col-md-4">
                    <div class="card border-primary">
                        <div class="card-header">
                        <h3 class="card-title">Clinic info</h3>
                        </div>
                        <div class="card-body">
                        <div class="form-group">
                            <label for="inputEstimatedBudget">Estimated budget</label>
                            <input type="number" id="inputEstimatedBudget" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="inputSpentBudget">Total amount spent</label>
                            <input type="number" id="inputSpentBudget" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="inputEstimatedDuration">Estimated project duration</label>
                            <input type="number" id="inputEstimatedDuration" class="form-control">
                        </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                <!-- /.card -->
                </div>
            </div>
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
<?php include('main/scripts.php');?>
<script>
    $('#scheddate').datepicker({
        startDate: new Date()
      });
</script>
<?php include('main/footer.php');?>

