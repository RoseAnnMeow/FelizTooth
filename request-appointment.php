<?php
   include('authentication.php');
   include('includes/header.php');
   include('includes/topbar.php');
   include('includes/sidebar.php');
   include('admin/config/dbconn.php');
   ?>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
   <div class="content-wrapper">
      <div class="content-header">
      </div>

      <div class="content">
         <div class="container-fluid">
            <form action="request_action.php" method="post">
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-body">
                            <h3 class="text-primary">Set an Appointment</h3><hr>
                            <p class="text-justify">Due to COVID-19 pandemic we are strictly by appointment only until further notice.
                            Please do not schedule an appointment if you have signs or symptoms of COVID-19. 
                            Wearing a face mask is a must to ensure the safety of Doctors and Patients.We will confirm your appointment via email or call 2 to 3 days before your appointment date. Please take note of the following:
                            </p>
                            <ul>
                                <li>Wearing face mask is a requirement</li>
                            </ul>
                            <p>This questionnaire is designed with your safety in mind and must be answered honestly. Your answers will be reviewed prior to your appointment and a member of our team will contact you if we recommend rescheduling to a later date. An answer of YES does not exclude you from treatment. Please answer YES or NO to each of the following questions. Thank you for your consideration and understanding.</p>
                                <input type="hidden" name="userid" value="<?php echo $_SESSION['auth_user']['user_id'];?>">
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
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                Health Declaration
                            </div>
                            <div class="card-body">
                            <?php
                                $sql = "SELECT * FROM questionnaires";
                                $query_run = mysqli_query($conn,$sql);
                                $check_services = mysqli_num_rows($query_run) > 0;

                                if($check_services)
                                {
                                while($row = mysqli_fetch_array($query_run))
                                {
                                    ?>
                                    <div class="form-group">
                                        <label for="" name="qid[<?php echo $row['id'] ?>]"><?=$row['questions']?> *</label>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="ans[<?php echo $row['id'] ?>" value="Yes">
                                            <label class="form-check-label">Yes</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="ans[<?php echo $row['id'] ?>" value="No">
                                            <label class="form-check-label" value="No">No</label>
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
                        </div>
                        <div class="row">
                            <div class="col-sm-12 mb-3">
                                <button type="submit" class="btn btn-primary" name="insertdata" id="checkBtn">Submit</button>
                            </div>                                
                        </div>                 
                    </div>
                    <div class="col-md-4">
                        <div class="card">
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
            </form>
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
    </div>
   <?php include('includes/scripts.php');?> 
   <script>
       $(document).ready(function () {
        $('#checkBtn').click(function() {
        checked = $("input[type=checkbox]:checked").length;

        if(!checked) {
            alert("Please, check at least one checkbox");
            return false;
        }

        });
    });
   </script>
   <?php include('includes/footer.php');?>