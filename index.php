
<?php 
include('main/header.php');
include('admin/config/dbconn.php');
?>
<body class="hold-transition layout-top-nav">
<div class="wrapper">
<?php include('main/topbar.php');?>
  <header>
  <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
  </ol>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img class="d-block w-100" src="admin/assets/dist/img/header2.jpg" alt="First slide">
      <div class="carousel-caption">
        <h5 class="animated animate__fadeInDown" style="animation-delay:1s">Creative Agency</h5>
        <p class="animated animate__fadeInDown d-none d-md-block"  style="animation-delay:3s">More Info</p>
      </div>
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="admin/assets/dist/img/header2.jpg" alt="Second slide">
      <div class="carousel-caption">
        <h5 class="animated animate__bounceInLeft d-none d-md-block" style="animation-delay:1s">Creative Agency</h5>
        <p class="animated animate__bounceInLeft d-none d-md-block"  style="animation-delay:3s">More Info</p>
      </div>
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="admin/assets/dist/img/header2.jpg" alt="Third slide">
      <div class="carousel-caption">
        <h5 class="animated bounceInRight" style="animation-delay:1s">Creative Agency</h5>
        <p class="animated bounceInleft d-none d-md-block"  style="animation-delay:3s">More Info</p>
      </div>
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>

  </header>
  <div class="content-wrapper py-5">
      <div class="container">
        <div class="row mb-2">
          <div class="col-md-12 mb-3 text-center">
            <h1 class="my-3 text-header">Your Complete Dental Care Clinic</h1>
            <p class="text-justify m-3">We go beyond making sure your teeth and gums are healthy. Here, your smile gets the makeover that you need and desire through various dedicated treatments covering Cosmetic Dentistry, Prosthodontics Treatment, Oral Surgery, Periodontics, Orthodontic Treatment, Restorative Treatment, and Oral Prophylaxis</p>
            <p class="font-weight-bold p-2">Get the best dental treatment in the Philippines with a click.</p>
            <a href="set-appointment.php" class="btn bg-gradient-danger btn-lg">Set an Appointment</a>
          </div>
        </div>
        <div class="row mb-2">
          <div class="col-md-12 mb-3 text-center">
            <hr><h1 class="my-3 text-header">SERVICES</h1>
            <p class="text-justify m-3">We go beyond making sure your teeth and gums are healthy. Here, your smile gets the makeover that you need and desire through various dedicated treatments covering Cosmetic Dentistry, Prosthodontics Treatment, Oral Surgery, Periodontics, Orthodontic Treatment, Restorative Treatment, and Oral Prophylaxis</p>
          </div>
          <?php
            $sql = "SELECT * FROM services";
            $query_run = mysqli_query($conn,$sql);
            $check_services = mysqli_num_rows($query_run) > 0;

            if($check_services)
            {
              while($row = mysqli_fetch_array($query_run))
              {
                ?>
                <div class="col-md-4">
                  <div class="card p-2 shadow-none">
                    <a href=""><h5 class="text-header text-center"><?=$row['title']?></h5>
                    <img src="upload/service/<?=$row['image']?>" class="img-fluid card-img-top"></a>
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
        <!-- /.row -->
      </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->

   
<?php include('main/scripts.php');?>
<?php include('main/footer.php');?>

