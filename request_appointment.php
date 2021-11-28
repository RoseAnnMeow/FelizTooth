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

      <section class="content">
         <div class="container-fluid">
            <div class="row">
                <form action="request_action.php" method="post">
                    <div class="col-sm-8">
                        <div class="card card-primary card-outline">
                            <div class="card-header">Appointment</div>
                                <div class="card-body">
                                    <p class="card-text">
                                    This questionnaire is designed with your safety in mind and must be answered honestly.
                                    Your answers will be reviewed prior to your appointment and a member of our team will contact you if we recommend rescheduling to a later date. An answer of YES does not exclude you from treatment. 
                                    Please answer YES or NO to each of the following questions. Thank you for your consideration and understanding.
                                    </p>
                                    <input type="hidden" name="userid" value="<?php echo $_SESSION['auth_user']['user_id'];?>">
                                    <div class="form-group">
                                        <label>Preferred Date & Time of Visit*</label>
                                        <input type="text" autocomplete="off" name="scheddate" class="form-control" id="scheddate" required onkeypress="return false;">
                                    </div>
                                    <div class="form-group">
                                        <label>Your concerns*</label>
                                        <div class="row mb-2">
                                            <div class="col-sm-6">                                     
                                                <div class="form-check">
                                                    <input class="form-check-input" name="concern[]" type="checkbox" value="Consultation">Consultation<br>
                                                    <input class="form-check-input" name="concern[]" type="checkbox" value="Cleaning">Cleaning<br>                                   
                                                    <input class="form-check-input" name="concern[]" type="checkbox" value="Filling">Filling<br>                                   
                                                    <input class="form-check-input" name="concern[]" type="checkbox" value="Invisalign">Invisalign<br>                                   
                                                    <input class="form-check-input" name="concern[]" type="checkbox" value="Teeth Whitening">Teeth Whitening<br>                                   
                                                    <input class="form-check-input" name="concern[]" type="checkbox" value="Root Canal Treatment">Root Canal Treatment<br>                                   
                                                    <input class="form-check-input" name="concern[]" type="checkbox" value="Orthodontic Treatment">Orthodontic Treatment<br>                                   
                                                    <input class="form-check-input" name="concern[]" type="checkbox" value="Crown">Crown<br>                                   
                                                    <input class="form-check-input" name="concern[]" type="checkbox" value="Bridge">Bridge<br>                                   
                                                    <input class="form-check-input" name="concern[]" type="checkbox" value="Veeners">Veeners<br>                                   
                                                    <input class="form-check-input" name="concern[]" type="checkbox" value="X-ray">X-ray<br>                                   
                                                </div>                                                                                                                                                                                                                
                                            </div>

                                            <div class="col-sm-6">
                                                <div class="form-check">
                                                <input class="form-check-input" name="concern[]" type="checkbox" value="Oral Surgery">Oral Surgery<br>                                                                                                                                                                                               
                                                <input class="form-check-input" name="concern[]" type="checkbox" value="Flouride Application">Flouride Application<br>                                                                                                                                                                                               
                                                <input class="form-check-input" name="concern[]" type="checkbox" value="Implant">Implant<br>                                                                                                                                                                                               
                                                <input class="form-check-input" name="concern[]" type="checkbox" value="Complete Denture">Complete Denture<br>                                                                                                                                                                                               
                                                <input class="form-check-input" name="concern[]" type="checkbox" value="Removable Denture">Removable Denture<br>                                                                                                                                                                                               
                                                <input class="form-check-input" name="concern[]" type="checkbox" value="Cosmetic Gum Surgery">Cosmetic Gum Surgery<br>                                                                                                                                                                                               
                                                <input class="form-check-input" name="concern[]" type="checkbox" value="CBCT Scan">CBCT Scan<br>                                                                                                                                                                                               
                                                <input class="form-check-input" name="concern[]" type="checkbox" value="Pediatric Dentistry/Pedodontics">Pediatric Dentistry/Pedodontics<br>                                                                                                                                                                                               
                                                <input class="form-check-input" name="concern[]" type="checkbox" value="Braces Treatment">Braces Treatment<br>                                                                                                                                                                                               
                                                <input class="form-check-input" name="concern[]" type="checkbox" value="Sealant">Sealant<br>                                                                                                                                                                                               
                                                <input class="form-check-input" name="concern[]" type="checkbox" value="Sealant">Bone Grafting<br>                                                                                                                                                                                               
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Vaccination Status*</label>
                                        <div class="form-check">                                    
                                            <input class="form-check-input" type="radio" name="radiovaccine" value="Not Vaccinated">Not Vaccinated<br>
                                            <input class="form-check-input" type="radio" name="radiovaccine" value="Partially Vaccinated">Partially Vaccinated<br>
                                            <input class="form-check-input" type="radio" name="radiovaccine" value="Fully Vaccinated">Fully Vaccinated<br>
                                        </div>
                                    </div>                                                              
                                </div>
                            </div>
                        </div>
                    
                        <div class="card card-primary card-outline">
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
                                <button type="submit" class="btn btn-primary" name="insertdata">Submit</button>
                            </div>                                
                        </div>
                    </div>                            
                </form>
            </div>
        <!-- /.container-fluid -->
        </section>
    <!-- /.content -->
    </div>
   <?php include('includes/scripts.php');?> 
   <?php include('includes/footer.php');?>