<nav class="main-header navbar navbar-expand-md navbar-light navbar-white sticky-top">
    <div class="container">
    <?php 
    $sql = "SELECT * FROM system_details LIMIT 1";
    $result = mysqli_query($conn,$sql);
    while($row = mysqli_fetch_array($result)){
    ?>
      <a href="admin/assets/index3.html" class="navbar-brand">
      <img src="upload/logo/<?=$row['logo']?>" alt="" class="brand-image img-circle" style="opacity: .8">
        <span class="brand-text font-weight-light"><b class="font-weight-bold text-danger"><?=$row['title'];}?></b></span>
      </a>
      <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse order-3" id="navbarCollapse">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a href="index.php" class="nav-link">Home</a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">About Us</a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">Services</a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">Fees</a>
          </li>
          <li class="nav-item">
            <a href="set-appointment.php" class="nav-link">Set an Appointments</a>
          </li>
          <li class="nav-item">
            <a href="login.php" class="nav-link">Login</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>