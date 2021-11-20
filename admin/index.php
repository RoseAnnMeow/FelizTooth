<?php
include('authentication.php');
include('includes/header.php');
include('includes/topbar.php');
include('includes/sidebar.php');
include('config/dbconn.php');
?>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

     <!-- Main content -->
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
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-user-friends"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Patients</span>
                <span class="info-box-number">
                  <?php
                    $sql = "SELECT id FROM tblpatient ORDER BY id";
                    $query_run = mysqli_query($conn,$sql);

                    $row = mysqli_num_rows($query_run);
                    echo $row;
                  ?>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-calendar-check"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Appointments</span>
                <span class="info-box-number">
                  <?php
                    $sql = "SELECT id FROM tblappointment ORDER BY id";
                    $query_run = mysqli_query($conn,$sql);

                    $row = mysqli_num_rows($query_run);
                    echo $row;
                  ?>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

          <!-- fix for small devices only -->
          <div class="clearfix hidden-md-up"></div>

          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Treatment Plan</span>
                <span class="info-box-number">6</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-prescription"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Prescription</span>
                <span class="info-box-number">4</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
        </div>
        </div><!-- /.container-fluid -->
    </section>

</div>  
<?php include('includes/scripts.php');?> 
<?php include('includes/footer.php');?>
