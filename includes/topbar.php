<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li>
  </ul>    
  <form class="form-inline ml=3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
              <button class="btn btn-navbar" type="submit">
                <i class="fas fa-search fa-fw"></i>
              </button>
          </div>
      </div>
  </form>

  <ul class="navbar-nav ml-auto">
      <li class="nav-item dropdown">
        <a class="nav-link notification" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-danger navbar-badge count"></span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right dropdown-notif">
          <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>       
      </li> 
      <li class="nav-item dropdown user-menu">
        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
          <span><?php
          include_once('admin/config/dbconn.php');
          if(isset($_SESSION['auth']))
          {
            $sql = "SELECT * FROM tblpatient WHERE id = '".$_SESSION['auth_user']['user_id']."'";
            $query_run = mysqli_query($conn,$sql);
            while($row = mysqli_fetch_array($query_run))
            {
                echo '<img src="upload/patients/'.$row['image'].'" class="user-image img-circle elevation-2" alt="Doc Image">';
            ?>
          <span class="d-none d-md-inline">
            <?=$row['fname'].' '.$row['lname']?> 
          </span>
            <?php }                        
          }
          else
          {
            echo "Not Logged in";
          }
          
          ?>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a href="#" class="dropdown-item">
            <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
            Profile
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item logoutbtn">
            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
            Logout
          </a>
        </div>
      </li>
    </ul>
  </nav>