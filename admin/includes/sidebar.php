
  <aside class="main-sidebar sidebar-dark-primary elevation-3">
  <?php 
    $sql = "SELECT * FROM system_details LIMIT 1";
    $result = mysqli_query($conn,$sql);
    while($row = mysqli_fetch_array($result)){
  ?>
  <a href="feliztoothdistrict.com" class="brand-link">
    <img src="../upload/<?=$row['logo'];}?>" alt="Feliz Tooth District Logo" class="brand-image img-circle elevation-3">
    <span class="brand-text font-weight-light">Feliz Tooth District</span>
  </a>
  <?php $page = substr($_SERVER['SCRIPT_NAME'],strrpos($_SERVER['SCRIPT_NAME'],"/")+1);?>
  <div class="sidebar">
    <nav class="mt-4">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
          <a href="index.php" class="nav-link <?= $page == 'index.php' ? 'active':''?>">
            <i class="fa fa-home nav-icon"></i>
            <p>Dashboard </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="dentist.php" class="nav-link <?= $page == 'dentist.php' ? 'active':''?>">
            <i class="nav-icon fa fa-users-medical"></i>
            <p>Dentist</p>
          </a>
        </li>          
        <li class="nav-item <?= $page == 'patients.php' || $page == 'documents.php' || $page == 'patient-details.php' ? 'menu-open' : '' ?>">
          <a href="#" class="nav-link <?= $page == 'patients.php' || $page == 'documents.php' || $page == 'patient-details.php' ? 'active' : '' ?>">
            <i class="nav-icon fa fa-users-medical"></i>
            <p>Patients</p>
            <i class="fas fa-angle-left right"></i>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="patients.php" class="nav-link <?= $page == 'patients.php' || $page == 'patient-details.php' ? 'active' : '' ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Patient List</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="documents.php" class="nav-link <?= $page == 'documents.php' ? 'active' : '' ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Documents</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item <?= $page == 'appointment.php' || $page == 'calendar.php' || $page == 'online-request.php' ? 'menu-open':''?>">
          <a href="#" class="nav-link <?= $page == 'appointment.php' || $page == 'calendar.php' || $page == 'online-request.php' ? 'active':''?>">
            <i class="nav-icon fas fa-calendar"></i>
            <p>
              Appointment
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="appointment.php" class="nav-link <?= $page == 'appointment.php' ? 'active':''?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Appointment List</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="online-request.php" class="nav-link <?= $page == 'online-request.php' ? 'active':''?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Online Request</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="calendar.php" class="nav-link <?= $page == 'calendar.php' ? 'active':''?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Calendar</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <a href="prescription.php" class="nav-link <?= $page == 'prescription.php' || $page == 'add-prescription.php' || $page == 'view-prescription.php' || $page == 'edit-prescription.php' ? 'active':''?>">
            <i class="nav-icon fas fa-prescription"></i>
            <p>Prescription</p>
          </a>
        </li>
        <li class="nav-item <?= $page == 'about.php' || $page == 'services.php' || $page == 'procedures.php' || $page == 'health-declaration.php' || $page == 'review.php' || $page == 'gallery.php'|| $page == 'featured-dentist.php' || $page == 'settings.php' ? 'menu-open':''?>">
          <a href="#" class="nav-link <?= $page == 'about.php' || $page == 'services.php' || $page == 'procedures.php' || $page == 'health-declaration.php' || $page == 'review.php' || $page == 'gallery.php'|| $page == 'featured-dentist.php' || $page == 'settings.php' ? 'active':''?>">
            <i class="nav-icon fas fa-globe"></i>
            <p>Website</p>
            <i class="fas fa-angle-left right"></i>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="about.php" class="nav-link <?= $page == 'about.php' ? 'active':''?>">
                <i class="far fa-circle nav-icon"></i>
                <p>About Us</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="services.php" class="nav-link <?= $page == 'services.php' ? 'active':''?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Services</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="procedures.php" class="nav-link <?= $page == 'procedures.php' ? 'active':''?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Procedures and Prices</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="health-declaration.php" class="nav-link <?= $page == 'health-declaration.php' ? 'active':''?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Questionnaire</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="review.php" class="nav-link <?= $page == 'review.php' ? 'active':''?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Review</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="gallery.php" class="nav-link <?= $page == 'gallery.php' ? 'active':''?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Gallery</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="featured-dentist.php" class="nav-link <?= $page == 'featured-dentist.php' ? 'active':''?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Featured Dentist</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="settings.php" class="nav-link <?= $page == 'settings.php' ? 'active':''?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Website Settings</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <a href="profile.php" class="nav-link <?= $page == 'profile.php' ? 'active':''?>">
            <i class="nav-icon fa fa-user-alt"></i>
            <p>Profile</p>
          </a>
        </li>
      </ul>
    </nav>
  </div>
</aside>