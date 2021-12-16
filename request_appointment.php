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
                                <div class="form-group">
                                    <label for="">Do you have a fever or temperature over 38 °C? *</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="radio1" value="Yes">
                                        <label class="form-check-label">Yes</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="radio1" value="No">
                                        <label class="form-check-label" value="No">No</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="">Have you experienced shortness of breathe or had trouble breathing? *</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="radio2" value="Yes">
                                        <label class="form-check-label">Yes</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="radio2" value="No">
                                        <label class="form-check-label">No</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="">Do you have a dry cough? *</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="radio3" value="Yes">
                                        <label class="form-check-label">Yes</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="radio3" value="No">
                                        <label class="form-check-label">No</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="">Do you have runny nose? *</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="radio4" value="Yes">
                                        <label class="form-check-label">Yes</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="radio4" value="No">
                                        <label class="form-check-label">No</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="">Have you recently lost or had a reduction in your sense of smell? *</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="radio5" value="Yes">
                                        <label class="form-check-label">Yes</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="radio5" value="No">
                                        <label class="form-check-label">No</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="">Do you have sore throat? *</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="radio6"value="Yes">
                                        <label class="form-check-label">Yes</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="radio6"value="No">
                                        <label class="form-check-label">No</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="">Do you have diarrhea? *</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="radio7" value="Yes">
                                        <label class="form-check-label">Yes</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="radio7" value="No">
                                        <label class="form-check-label">No</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="">Do you have Influenza-like symptoms? (headache, aches and pains, a rash on skin)*</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="radio8" value="Yes">
                                        <label class="form-check-label">Yes</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="radio8" value="No">
                                        <label class="form-check-label">No</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="">Do you have history of COVID-19 infection? *</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="radio9" value="Yes">
                                        <label class="form-check-label">Yes</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="radio9" value="No">
                                        <label class="form-check-label">No</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="">Do you have a member of your family who tested positive for COVID-19? *</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="radio10" value="Yes">
                                        <label class="form-check-label">Yes</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="radio10" value="No">
                                        <label class="form-check-label">No</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="">Have you been in contact with someone who has tested positive for COVID-19? *</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="radio11" value="Yes">
                                        <label class="form-check-label">Yes</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="radio11" value="No">
                                        <label class="form-check-label">No</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="">Have you traveled or lived in an area with a report of local transmission of COVID 19?*</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="radio12" value="Yes">
                                        <label class="form-check-label">Yes</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="radio12" value="No">
                                        <label class="form-check-label">No</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="">Have you traveled within the Philippines by air, bus, or train within the past 14 days? *</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="radio13" value="Yes">
                                        <label class="form-check-label">Yes</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="radio13" value="No">
                                        <label class="form-check-label">No</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="">Have you traveled outside the Philippines by air or cruise ship in the past 14 days? *</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="radio14" value="Yes">
                                        <label class="form-check-label">Yes</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="radio14" value="No">
                                        <label class="form-check-label">No</label>
                                    </div>
                                </div>
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