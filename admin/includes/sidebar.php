<aside class="main-sidebar sidebar-dark-primary elevation-3">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="assets/dist/img/feliztooth.png" alt="Feliz Tooth District Logo" class="brand-image img-circle elevation-3">
      <span class="brand-text font-weight-light text-md">
        <?php 
        $sql = "SELECT * FROM system_details LIMIT 1";
        $result = mysqli_query($conn,$sql);
        while($row = mysqli_fetch_array($result)){
          echo $row['title'];
        }
        ?></span>
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
            <a href="doctors.php" class="nav-link <?= $page == 'doctors.php' ? 'active':''?>">
              <i class="nav-icon fa fa-users-medical"></i>
              <p>Doctors</p>
            </a>
          </li>   
          <li class="nav-item">
            <a href="#" class="nav-link <?= $page == 'patients.php' || $page == 'medical_history.php'? 'active':''?>">
              <i class="nav-icon fa fa-users-medical"></i>
              <p>Patients</p>
              <i class="fas fa-angle-left right"></i>
            </a>
            <ul class="nav nav-treeview <?= $page == 'patients.php' || $page == 'medical_history.php' ? 'show':''?>">
              <li class="nav-item">
                <a href="patients.php" class="nav-link <?= $page == 'patients.php' ? 'active':''?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Patient List</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="medical_history.php" class="nav-link <?= $page == 'medical_history.php' ? 'active':''?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Medical History</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link <?= $page == 'appointment.php' || $page == 'calendar.php' ? 'active':''?>">
              <i class="nav-icon fas fa-calendar"></i>
              <p>
                Appointment
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview <?= $page == 'appointment.php' || $page == 'calendar.php' ? 'show':''?>">
              <li class="nav-item">
                <a href="appointment.php" class="nav-link <?= $page == 'appointment.php' ? 'active':''?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Appointment List</p>
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
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-teeth"></i>
              <p>
                Dental Chart
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="pages/charts/chartjs.html" class="nav-link">
                  <i class="far fa-list-alt nav-icon"></i>
                  <p>Treatment Plan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/charts/flot.html" class="nav-link">
                  <i class="far fa-list-alt nav-icon"></i>
                  <p>Flot</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/charts/inline.html" class="nav-link">
                  <i class="far fa-list-alt nav-icon"></i>
                  <p>Inline</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="prescription.php" class="nav-link <?= $page == 'prescription.php' ? 'active':''?>">
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
              <p>Email</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="pages/widgets.html" class="nav-link">
              <i class="nav-icon fa fa-comments-alt"></i>
              <p>SMS</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="settings.php" class="nav-link">
              <i class="nav-icon fa fa-cog"></i>
              <p>Settings</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="pages/widgets.html" class="nav-link">
              <i class="nav-icon fa fa-user-alt"></i>
              <p>Profile</p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>