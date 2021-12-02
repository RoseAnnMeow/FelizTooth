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
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Dashboard</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
              </ol>
            </div>
          </div>
        </div>
      </div>
      <section class="content">
        <div class="container-fluid">
          <?php
            if(isset($_SESSION['status']))
            {
              ?>
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?php echo $_SESSION['status'];?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"></span>
              </button>
              </div>
              <?php
                unset($_SESSION['status']);
            }
          ?>
    
          <div class="row">
            <div class="col-lg-3 col-6">
              <div class="small-box bg-info">
                <div class="inner">
                  <h3><?php
                    $sql = "SELECT id FROM tblpatient ORDER BY id";
                    $query_run = mysqli_query($conn,$sql);

                    $row = mysqli_num_rows($query_run);
                    echo $row;
                  ?></h3>

                  <p>Patients</p>
                </div>
                <div class="icon">
                  <i class="fas fa-user-friends"></i>
                </div>
                <a href="patients.php" class="small-box-footer">
                  More info <i class="fas fa-arrow-circle-right"></i>
                </a>
              </div>
            </div>
            <div class="col-lg-3 col-6">
              <div class="small-box bg-success">
                <div class="inner">
                  <h3><?php
                    $sql = "SELECT id FROM tblappointment ORDER BY id";
                    $query_run = mysqli_query($conn,$sql);

                    $row = mysqli_num_rows($query_run);
                    echo $row;
                  ?>
                </h3>

                  <p>Appointments</p>
                </div>
                <div class="icon">
                  <i class="fas fa-calendar-check"></i>
                </div>
                <a href="appointment.php" class="small-box-footer">
                  More info <i class="fas fa-arrow-circle-right"></i>
                </a>
              </div>
            </div>
            <div class="col-lg-3 col-6">
              <div class="small-box bg-warning">
                <div class="inner">
                  <h3>44</h3>

                  <p>User Registrations</p>
                </div>
                <div class="icon">
                  <i class="fas fa-user-plus"></i>
                </div>
                <a href="#" class="small-box-footer">
                  More info <i class="fas fa-arrow-circle-right"></i>
                </a>
              </div>
            </div>
            <div class="col-lg-3 col-6">
              <div class="small-box bg-danger">
                <div class="inner">
                  <h3>65</h3>

                  <p>Unique Visitors</p>
                </div>
                <div class="icon">
                  <i class="fas fa-chart-pie"></i>
                </div>
                <a href="#" class="small-box-footer">
                  More info <i class="fas fa-arrow-circle-right"></i>
                </a>
              </div>
            </div>
          </div>
          </div><!-- /.container-fluid -->
      </section>

</div>  
<?php include('includes/scripts.php');?> 
<?php include('includes/footer.php');?>
