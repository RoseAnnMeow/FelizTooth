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
<div class="register-box">
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
      <?php
      include('message.php');
    ?>
      <div class="card card-outline card-primary">
        <div class="card-body register-card-body">
          <form action="patientcode.php" method="post">
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
                <input type="text" autocomplete="off" name="birthday" class="form-control" id="datepicker" placeholder="Birthday" required onkeypress="return false;">
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
            <div class="input-group mb-3">
              <input type="text" class="form-control" name="address" placeholder="Address" required>
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-map-marker-alt"></span>
                </div>
              </div>
            </div>
            <div class="input-group mb-3">
              <input type="text" class="form-control" name="phone" placeholder="Mobile number" maxLength="11" minLength="11" required>
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-phone"></span>
                </div>
              </div>
            </div>
            <div class="input-group mb-3">
              <input type="email" class="form-control" name="email" placeholder="Email" required>
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-envelope"></span>
                </div>
              </div>
            </div>
            <div class="input-group mb-3">
              <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-lock"></span>
                </div>
              </div>
            </div>
            <div class="input-group mb-3">
              <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" placeholder="Confirm Password" required>
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-lock"></span>
                </div>
              </div>
            </div>
              <div class="form-group">
                  <button type="submit" name="register_btn" class="btn btn-block btn-primary">Register</button>
              </div>
              <!-- /.col -->
          </form>

          <a href="login.php" class="text-center">I already have an account</a>
        </div>
        <!-- /.form-box -->
      </div><!-- /.card -->
    </div>
    <!-- /.register-box -->
<?php include('includes/scripts.php'); ?>
<?php include('includes/footer.php'); ?>