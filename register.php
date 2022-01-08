<?php
session_start();
include('includes/header.php');
include('admin/config/dbconn.php');
if(isset($_SESSION['auth']))
{
    $_SESSION['status'] = "You are already logged in";
    header('Location: index.php');
    exit(0);
}
?>

<body class="hold-transition register-page">
<div class="py-3">
  <div class="container">
    <div class="row clearfix">
      <div class="col-md-12 col-md-offset-3 col-sm-6 col-sm-offset-3">
        <div class="card card-outline card-primary shadow" style="margin-top:50px;margin-bottom:50px;">
          <?php
          if(isset($_SESSION['auth_status']))
          {
              ?>
              <div class="alert alert-warning alert-dismissible fade show" role="alert">
                  <?php echo $_SESSION['auth_status'];?>
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true"></span>
                  </button>
              </div> 
              <?php
              unset($_SESSION['auth_status']);
          }
          ?>    
          <div class="card-body register-card-body">
            <h3 class="login-box-msg text-danger font-weight-bold">Feliz Tooth District <br><b class="text-secondary">Dental Clinic</b></h3>
            <p class="login-box-msg">Create your account by filling the form below</p>
            <?php include('admin/message.php');?>
            <form action="patientcode.php"  method="post" enctype="multipart/form-data">
              <div class="row">
                <div class="col-sm-6">
                  <div class="input-group mb-3">
                    <input type="text" class="form-control" name="fname" placeholder="First name" required>
                    <div class="input-group-append">
                      <div class="input-group-text">
                        <span class="fas fa-user"></span>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="input-group mb-3">
                    <input type="text" class="form-control" name="lname" placeholder="Last name" required>
                    <div class="input-group-append">
                      <div class="input-group-text">
                        <span class="fas fa-user"></span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-6">
                  <div class="input-group mb-3">
                  <input type="text" autocomplete="off" name="birthday" class="form-control" id="datepicker" placeholder="mm/dd/yyyy" required>
                    <div class="input-group-append">
                      <div class="input-group-text">
                        <span class="fas fa-calendar"></span>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-sm-6">
                    <select class="custom-select mb-3" name="gender" required>
                    <option selected disabled value="">Gender</option>
                        <option>Female</option>
                        <option>Male</option>
                        <option>Other</option>
                    </select>
                </div>
              </div>
              <div class="row">
                <div class="input-group col-sm-12 mb-3">
                  <input type="text" class="form-control" name="address" placeholder="Address" required>
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-map-marker-alt"></span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="input-group col-sm-12 mb-3">
                  <input type="tel" input id="phone" class="form-control" placeholder="+63 9XX XXX XXXX" name="phone" pattern="^(09|\+639)\d{9}$" required>
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-phone"></span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="input-group col-sm-12 mb-3">
                  <input type="email" class="form-control" name="email" placeholder="Email" required>
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-envelope"></span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="input-group col-sm-12">
                  <input type="password" class="form-control" id="password" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{8,}" title="Must contain at least one number and one uppercase and lowercase letter,at least one special character, and at least 8 or more characters" placeholder="Password" required>
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-lock"></span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <p>Password Strength: <span id="result"> </span></p>
                  <div class="progress">
                      <div id="password-strength" class="progress-bar bg-success progress-bar-striped" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
                      </div>
                  </div>
                  <ul class="list-unstyled">
                    <li class=""><span class="low-upper-case"><i class="fal fa-exclamation-triangle" aria-hidden="true"></i></span>&nbsp; Contain lowercase &amp;  uppercase</li>
                    <li class=""><span class="one-number"><i class="fal fa-exclamation-triangle" aria-hidden="true"></i></span> &nbsp;Contain number (0-9)</li>
                    <li class=""><span class="one-special-char"><i class="fal fa-exclamation-triangle" aria-hidden="true"></i></span> &nbsp;Contain Special Character (!@#$%^&*).</li>
                    <li class=""><span class="eight-character"><i class="fal fa-exclamation-triangle" aria-hidden="true"></i></span>&nbsp; Atleast 8 Character</li>
                  </ul>
                </div>
              </div>
              <div class="row">
                <div class="input-group col-sm-12 mb-3">
                  <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" placeholder="Confirm Password" required>
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-lock"></span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="form-group col-sm-6 mb-3">
                  <label for="">Profile Picture</label>
                  <input type="file" name="patient_image">
                </div>
                <div class="form-group col-sm-12">
                  <button type="submit" name="register_btn" id="register" class="btn btn-block btn-primary">Register</button>
                </div>
              </div>         
            </form>
            <a href="login.php" class="text-center">I already have an account</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
 
</body>
</html>
<?php include('includes/scripts.php'); ?>