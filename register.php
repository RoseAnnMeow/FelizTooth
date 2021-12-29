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
            <h3 class="login-box-msg text-primary font-weight-bold">Sign Up</h3>
            <?php include('admin/message.php');?>
            <form action="patientcode.php"  method="post" id="validateForm">
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
                    <select class="form-control mb-3" name="gender" required>
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
                  <input type="text" input id="phone" class="form-control" placeholder="Mobile Number" name="phone" required>
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
                  <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
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
                      <li class=""><span class="low-upper-case"><i class="fal fa-exclamation-triangle" aria-hidden="true"></i></span>&nbsp; 1 lowercase &amp; 1 uppercase</li>
                      <li class=""><span class="one-number"><i class="fal fa-exclamation-triangle" aria-hidden="true"></i></span> &nbsp;1 number (0-9)</li>
                      <li class=""><span class="one-special-char"><i class="fal fa-exclamation-triangle" aria-hidden="true"></i></span> &nbsp;1 Special Character (!@#$%^&*).</li>
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
                <div class="form-group col-sm-12">
                  <button type="submit" name="register_btn" id="sign-up" class="btn btn-block btn-primary">Register</button>
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
<script>
  $(document).ready(function() {

$("#phone").inputmask({"mask": "(+99) 999-9999-999"});

        $('#email').blur(function() {
            var email = $('#email').val();
            if (IsEmail(email) == false) {
                $('#sign-up').attr('disabled', true);
                $('#popover-email').removeClass('hide');
            } else {
                $('#popover-email').addClass('hide');
            }
        });
        $('#password').keyup(function() {
            var password = $('#password').val();
            if (checkStrength(password) == false) {
                $('#sign-up').attr('disabled', true);
            }
        });
        $('#confirm-password').blur(function() {
            if ($('#password').val() !== $('#confirm-password').val()) {
                $('#popover-cpassword').removeClass('hide');
                $('#sign-up').attr('disabled', true);
            } else {
                $('#popover-cpassword').addClass('hide');
            }
        });
        $('#contact-number').blur(function() {
            if ($('#contact-number').val().length != 10) {
                $('#popover-cnumber').removeClass('hide');
                $('#sign-up').attr('disabled', true);
            } else {
                $('#popover-cnumber').addClass('hide');
                $('#sign-up').attr('disabled', false);
            }
        });
        $('#sign-up').hover(function() {
            if ($('#sign-up').prop('disabled')) {
                $('#sign-up').popover({
                    html: true,
                    trigger: 'hover',
                    placement: 'below',
                    offset: 20,
                    content: function() {
                        return $('#sign-up-popover').html();
                    }
                });
            }
        });

        function IsEmail(email) {
            var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            if (!regex.test(email)) {
                return false;
            } else {
                return true;
            }
        }

        function checkStrength(password) {
            var strength = 0;


            //If password contains both lower and uppercase characters, increase strength value.
            if (password.match(/([a-z].*[A-Z])|([A-Z].*[a-z])/)) {
                strength += 1;
                $('.low-upper-case').addClass('text-success');
                $('.low-upper-case i').removeClass('fa-exclamation-triangle').addClass('fa-check');
                $('#popover-password-top').addClass('hide');


            } else {
                $('.low-upper-case').removeClass('text-success');
                $('.low-upper-case i').addClass('fa-exclamation-triangle').removeClass('fa-check');
                $('#popover-password-top').removeClass('hide');
            }

            //If it has numbers and characters, increase strength value.
            if (password.match(/([a-zA-Z])/) && password.match(/([0-9])/)) {
                strength += 1;
                $('.one-number').addClass('text-success');
                $('.one-number i').removeClass('fa-exclamation-triangle').addClass('fa-check');
                $('#popover-password-top').addClass('hide');

            } else {
                $('.one-number').removeClass('text-success');
                $('.one-number i').addClass('fa-exclamation-triangle').removeClass('fa-check');
                $('#popover-password-top').removeClass('hide');
            }

            //If it has one special character, increase strength value.
            if (password.match(/([!,%,&,@,#,$,^,*,?,_,~])/)) {
                strength += 1;
                $('.one-special-char').addClass('text-success');
                $('.one-special-char i').removeClass('fa-exclamation-triangle').addClass('fa-check');
                $('#popover-password-top').addClass('hide');

            } else {
                $('.one-special-char').removeClass('text-success');
                $('.one-special-char i').addClass('fa-exclamation-triangle').removeClass('fa-check');
                $('#popover-password-top').removeClass('hide');
            }

            if (password.length > 7) {
                strength += 1;
                $('.eight-character').addClass('text-success');
                $('.eight-character i').removeClass('fa-exclamation-triangle').addClass('fa-check');
                $('#popover-password-top').addClass('hide');

            } else {
                $('.eight-character').removeClass('text-success');
                $('.eight-character i').addClass('fa-exclamation-triangle').removeClass('fa-check');
                $('#popover-password-top').removeClass('hide');
            }




            // If value is less than 2

            if (strength < 2) {
                $('#result').removeClass()
                $('#password-strength').addClass('bg-danger');

                $('#result').addClass('text-danger').text('Very Weak');
                $('#password-strength').css('width', '10%');
            } else if (strength == 2) {
                $('#result').addClass('good');
                $('#password-strength').removeClass('bg-danger');
                $('#password-strength').addClass('bg-warning');
                $('#result').addClass('text-warning').text('Weak')
                $('#password-strength').css('width', '60%');
                return 'Weak'
            } else if (strength == 4) {
                $('#result').removeClass()
                $('#result').addClass('strong');
                $('#password-strength').removeClass('bg-warning');
                $('#password-strength').addClass('bg-success');
                $('#result').addClass('text-success').text('Very Strong');
                $('#password-strength').css('width', '100%');

                return 'Strong'
            }

        }

    });
</script>