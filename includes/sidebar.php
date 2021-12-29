
<aside class="main-sidebar sidebar-dark-primary elevation-3">
<?php 
    $sql = "SELECT * FROM system_details LIMIT 1";
    $result = mysqli_query($conn,$sql);
    while($row = mysqli_fetch_array($result)){
  ?>

<a href="feliztoothdistrict.com" class="brand-link">
<img src="upload/logo/<?=$row['logo']?>" alt="Feliz Tooth District Logo" class="brand-image img-circle elevation-3">
    <span class="brand-text font-weight-light text-md"><?=$row['title'];}?></span>
  </a>


    <div class="sidebar">
      <nav class="mt-4">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
                <a href="index.php" class="nav-link active">
                  <i class="fa fa-home nav-icon"></i>
                  <p>Dashboard</p>
                </a>
              </li>
          <li class="nav-item">
            <a href="patients.php" class="nav-link">
              <i class="nav-icon fa fa-users-medical"></i>
              <p>Today's Appointment</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="schedule.php" class="nav-link">
              <i class="nav-icon fa fa-clock"></i>
              <p>Diagnosis Report</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="pages/widgets.html" class="nav-link">
              <i class="nav-icon fas fa-prescription"></i>
              <p>Prescription</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="pages/widgets.html" class="nav-link">
              <i class="nav-icon fa fa-medkit"></i>
              <p>Medicine</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="pages/widgets.html" class="nav-link">
              <i class="nav-icon fa fa-envelope"></i>
              <p>Fees</p>
            </a>
          </li>
        </ul>
      </nav>
    </div>
  </aside>