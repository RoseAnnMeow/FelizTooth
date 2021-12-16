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
   <script>
    $(document).ready(function () {
      getData();

    $('#datepicker').datepicker({
    todayHighlight: true,
    clearBtn: true,
    autoclose: true,
    endDate: new Date()
    })

    $('.addDoctor').click(function (e) { 
      e.preventDefault();

      var doc_fname = $('.fname').val();
      var doc_address = $('.address').val();
      var doc_dob = $('.birthday').val();
      var doc_gender = $('.gender').val();
      var doc_phone = $('.phone').val();
      var doc_email = $('.email').val();
      var doc_degree = $('.degree').val();
      var doc_specialty = $('.specialty').val();
      var password = $('.password').val();
      var confirmPassword = $('.confirmPassword').val();
      var doctor_profile_image = $('doc_image').val();

      
      // if(doc_fname != '' & doc_dob != '' & doc_address !='' & doc_gender !='' & doc_phone !='' & doc_email !='' & doc_degree !='' & doc_specialty !='' &  password !='' &  confirmPassword !='')
      if(doc_fname != '' & doc_dob != '' & doc_address !='' & doc_gender !='' & doc_phone !='')
      {
          $.ajax({
          type: "POST",
          url: "doctor_action.php",
          data: {
            'insertdoctor':true,
            'fname':doc_fname,
            'birthday':doc_dob,
            'address':doc_address,
            'gender':doc_gender,
            'phone':doc_phone,
            'email':doc_email,
            'degree':doc_degree,
            'specialty':doc_specialty,
            'password':password,
            'confirmPassword':confirmPassword,
            'doc_image':doctor_profile_image,
            },
          success: function (response) {
            $('#AddDoctorModal').modal('hide');
            $('.message-show').append('\
                <div class="alert alert-success alert-dismissible fade show" role="alert">\
                '+response+'\
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">\
                  <span aria-hidden="true">&times;</span>\
                </button>\
              </div>\
        ');
           // $('.doctor_data').html("");
            //getData();
          }
        });
      }
      else
      {
        // console.log("Please enter all fields");
        $('.error-message').append('\
            <div class="alert alert-warning alert-dismissible fade show" role="alert">\
            Please enter all fields.\
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">\
              <span aria-hidden="true">&times;</span>\
            </button>\
          </div>\
        ');
      }     
    });

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
    //     $("#selectAll").change(function(){
  //    var checked = $(this).is(':checked');
  //    if(checked){
  //      $('input[name="update_status[]"]').each(function(){
  //        $(this).prop("checked",true);
  //      });
  //    }else{
  //      $('input[name="update_status[]"]').each(function(){
  //        $(this).prop("checked",false);
  //      });
  //    }
  //  });
      // Changing state of CheckAll checkbox 
      

      //Doctor Delete Modal
    $(document).on('click','.deleteDoctorbtn', function(){
    
    var user_id = $(this).data('id');
    $('#delete_id').val(user_id);
    $('#DeleteDoctorModal').modal('show');
    
    });

  });
  function getData()
    {
      $.ajax({
        type: "POST",
        url: "doctor_action.php",
        data: {
            'fetch':true,
            },
        success: function (response) {
          $.each(response, function (key, value)
          {
            
            $('.doctor_data').append('<tr>'+
            '<td><img src="'+value['image']+'" class="img-thumbnail" width="60"/></td>\
            <td>'+value['name']+'</td>\
            <td>'+value['phone']+'</td>\
            <td>'+value['email']+'</td>\
            <td>'+value['specialty']+'</td>\
            <td>\
              <button data-id="'+value['id']+'" class="btn btn-sm btn-secondary viewDoctorbtn"><i class="fa fa-eye"></i></button>\
              <button data-id="'+value['id']+'" class="btn btn-sm btn-primary editDoctorbtn"><i class="fas fa-edit"></i></button>\
              <button data-id="'+value['id']+'" class="btn btn-danger btn-sm deleteDoctorbtn"><i class="far fa-trash-alt"></i></button>\
            </td>\
            </tr>');
          });
          
        }
      });
    }
</script>

<nav class="main-header navbar navbar-expand navbar-white navbar-light">
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li>
  </ul>    
  <form class="form-inline ml=3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
              <button class="btn btn-navbar" type="submit">
                <i class="fas fa-search fa-fw"></i>
              </button>
          </div>
      </div>
  </form>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto"> 
      <li class="nav-item dropdown user-menu">
        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
          <span><?php
          if(isset($_SESSION['auth']))
          {
              echo '<img src="'.$_SESSION['auth_user']['user_image'].'" class="user-image img-circle elevation-2" alt="Doc Image">';
          }
          else
          {
            echo "Not Logged in";
          }
          ?>
          <span class="d-none d-md-inline">
            <?php echo $_SESSION['auth_user']['user_fname'];?> 
          </span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a href="#" class="dropdown-item">
            <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
            Profile
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item logoutbtn">
            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
            Logout
          </a>
        </div>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->