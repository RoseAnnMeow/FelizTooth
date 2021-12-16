<?php
   include('admin/config/dbconn.php');
   include('authentication.php');
   include('includes/header.php');
   include('includes/topbar.php');
   include('includes/sidebar.php');
   ?>
<body class="hold-transition sidebar-mini layout-fixed">
   <div class="wrapper">
    <div class="content-wrapper">
      <div class="content-header">
    
      </div>
      <section class="content">
         <div class="container-fluid">
            <div class="row">
               <div class="col-md-12">
                  <?php
                  include('admin/message.php');
                  ?>
               </div>
               <div class="col-md-3">
                  <!-- Profile Image -->
                  <div class="card card-primary card-outline">
                     <div class="card-header">
                        <h5 class="card-title m-0">Patient Info</h5>
                     </div>
                     <div class="card-body box-profile">
                        <div class="text-center">
                           <img class="profile-user-img img-fluid img-circle"
                              src="admin/assets/dist/img/user4-128x128.jpg"
                              alt="User profile picture">
                        </div>
                        <h3 class="profile-username text-center"><?php echo $_SESSION['auth_user']['user_fname'].' '.$_SESSION['auth_user']['user_lname'];?></h3>
                        <p class="text-muted text-center"><?php echo $_SESSION['auth_user']['user_email'];?></p>
                        <ul class="list-group list-group-unbordered mb-3">
                           <li class="list-group-item">
                              <b>Gender</b> 
                              <p class="float-right text-muted m-0"><?php echo $_SESSION['auth_user']['user_gender'];?></p>
                           </li>
                           <li class="list-group-item">
                              <b>Birthdate</b> 
                              <p class="float-right text-muted m-0"><?php echo $_SESSION['auth_user']['user_dob'];?></p>
                           </li>
                           <li class="list-group-item">
                              <b>Phone</b> 
                              <p class="float-right text-muted m-0"><?php echo $_SESSION['auth_user']['user_phone'];?></p>
                           </li>
                           <li class="list-group-item">
                              <b>Address</b> 
                              <p class="float-right text-muted m-0"><?php echo $_SESSION['auth_user']['user_address'];?></p>
                           </li>
                        </ul>
                     </div>    
                  </div>
               </div>
         
               <div class="col-md-9">
                  <div class="card card-primary card-outline card-tabs">
                     <div class="card-header p-0 pt-1 border-bottom-0">
                        <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                           <li class="nav-item">
                           <a class="nav-link active" id="custom-tabs-three-home-tab" data-toggle="pill" href="#custom-tabs-three-home" role="tab" aria-controls="custom-tabs-three-home" aria-selected="true">Request</a>
                           </li>
                           <li class="nav-item">
                           <a class="nav-link" id="custom-tabs-three-profile-tab" data-toggle="pill" href="#custom-tabs-three-profile" role="tab" aria-controls="custom-tabs-three-profile" aria-selected="false">Appointment List</a>
                           </li>
                           <li class="nav-item">
                           <a class="nav-link" id="custom-tabs-three-messages-tab" data-toggle="pill" href="#custom-tabs-three-messages" role="tab" aria-controls="custom-tabs-three-messages" aria-selected="false">Messages</a>
                           </li>
                           <li class="nav-item">
                           <a class="nav-link" id="custom-tabs-three-settings-tab" data-toggle="pill" href="#custom-tabs-three-settings" role="tab" aria-controls="custom-tabs-three-settings" aria-selected="false">Settings</a>
                           </li>
                        </ul>
                     </div>
                     <div class="card-body">
                        <div class="tab-content" id="custom-tabs-three-tabContent">
                           <div class="tab-pane fade show active" id="custom-tabs-three-home" role="tabpanel" aria-labelledby="custom-tabs-three-home-tab">
                           <div class="row">
                              <div class="col-sm-12 mb-2">
                                 <a class="btn btn-primary" href="request_appointment.php">
                                 <i class="fa fa-plus-circle"> </i> Request a Appointment
                                 </a>
                              </div>
                           </div>                             
                           <div class="col-sm-12 mb-2">                             
                              <div class="table-responsive">
                                 <table class="table table-borderless table-sm">
                                    <?php
                                       $sql = "SELECT * FROM tblappointment WHERE patient_id = '". $_SESSION['auth_user']['user_id']."' ORDER BY id DESC LIMIT 1";
                                       $query_run = mysqli_query($conn,$sql);

                                       while($row = mysqli_fetch_array($query_run)){
                                    ?>
                                    <p class="lead text-success">Your Appointment Details</p>
                                    <tr>
                                       <th style="width:25%">Name</th>
                                       <td><?php echo $_SESSION['auth_user']['user_fname'].' '. $_SESSION['auth_user']['user_lname'];?></td>
                                    </tr>
                                    <tr>
                                       <th>Appointment Date</th>
                                       <td><?php echo date('l, d M Y',strtotime($row['schedule']));?></td>
                                    </tr>
                                    <tr>
                                       <th>Time:</th>
                                       <td><?php
                                       if($row['starttime'] == '')
                                       {
                                          echo '--';
                                       }
                                       else
                                       {
                                          echo $row['starttime'];
                                       }
                                       ?></td>
                                    </tr>
                                    <tr>
                                       <th>Status:</th>
                                       <td><?php
                                       if($row['status'] == 'Confirmed')
                                       {
                                       echo $row['status'] = '<span class="badge badge-success">Confirmed</span>';
                                       }
                                       else if($row['status'] == 'Pending')
                                       {
                                       echo $row['status'] = '<span class="badge badge-warning">Pending</span>';
                                       }
                                       else if($row['status'] == 'Treated')
                                       {
                                       echo $row['status'] = '<span class="badge badge-primary">Treated</span>';
                                       }
                                       else
                                       {
                                       echo $row['status'] = '<span class="badge badge-danger">Cancelled</span>';
                                       }
                                       ?>
                                       </td>                                 
                                    </tr>
                                    <?php } ?>
                                 </table>
                              </div>
                           </div>
               
                           </div>
                           <div class="tab-pane fade" id="custom-tabs-three-profile" role="tabpanel" aria-labelledby="custom-tabs-three-profile-tab">
                              <div class="card-body col-sm-12 p-0 mt-3">
                                 <div class="table-responsive overflow-hidden">
                                    <table id="appointmenttable" class="table table-hover" style="width:100%;">
                                       <thead>
                                       <tr>
                                          <th class="bg-light">Date</th>
                                          <th class="bg-light">Time</th>
                                          <th class="bg-light">Doctor</th>
                                          <th class="bg-light">Status</th>
                                       </tr>
                                       </thead>
                                       <tbody>
                                          <?php
                                             $id = $_SESSION['auth_user']['user_id']; 
                                             $sql = "SELECT a.schedule,a.starttime,a.status,a.endtime,d.name as dname FROM tbldoctor d INNER JOIN tblappointment a WHERE a.doc_id = d.id AND a.patient_id ='$id' ORDER BY a.id DESC";
                                             $query_run = mysqli_query($conn,$sql);
                                             while($row = mysqli_fetch_array($query_run)){
                                          ?>
                                       <tr>
                                          <td><?php echo date('F j, Y',strtotime($row['schedule'])); ?></td>
                                          <td><?php echo $row['starttime'].' - '.$row['endtime'];?></td>
                                          <td><?php echo $row['dname'];?></td>
                                          <td>
                                             <?php
                                             if($row['status'] == 'Confirmed')
                                             {
                                             echo $row['status'] = '<span class="badge badge-success">Confirmed</span>';
                                             }
                                             else if($row['status'] == 'Pending')
                                             {
                                             echo $row['status'] = '<span class="badge badge-warning">Pending</span>';
                                             }
                                             else if($row['status'] == 'Treated')
                                             {
                                             echo $row['status'] = '<span class="badge badge-primary">Treated</span>';
                                             }
                                             else
                                             {
                                             echo $row['status'] = '<span class="badge badge-danger">Cancelled</span>';
                                             }
                                             ?>
                                          </td>
                                       </tr>
                                       <?php } ?>
                                       </tbody>
                                    </table>
                                 </div>
                                 
                              </div>
                           </div>
                           <div class="tab-pane fade" id="custom-tabs-three-messages" role="tabpanel" aria-labelledby="custom-tabs-three-messages-tab">
                              Morbi turpis dolor, vulputate vitae felis non, tincidunt congue mauris. Phasellus volutpat augue id mi placerat mollis. Vivamus faucibus eu massa eget condimentum. Fusce nec hendrerit sem, ac tristique nulla. Integer vestibulum orci odio. Cras nec augue ipsum. Suspendisse ut velit condimentum, mattis urna a, malesuada nunc. Curabitur eleifend facilisis velit finibus tristique. Nam vulputate, eros non luctus efficitur, ipsum odio volutpat massa, sit amet sollicitudin est libero sed ipsum. Nulla lacinia, ex vitae gravida fermentum, lectus ipsum gravida arcu, id fermentum metus arcu vel metus. Curabitur eget sem eu risus tincidunt eleifend ac ornare magna.
                           </div>
                           <div class="tab-pane fade" id="custom-tabs-three-settings" role="tabpanel" aria-labelledby="custom-tabs-three-settings-tab">
                              Pellentesque vestibulum commodo nibh nec blandit. Maecenas neque magna, iaculis tempus turpis ac, ornare sodales tellus. Mauris eget blandit dolor. Quisque tincidunt venenatis vulputate. Morbi euismod molestie tristique. Vestibulum consectetur dolor a vestibulum pharetra. Donec interdum placerat urna nec pharetra. Etiam eget dapibus orci, eget aliquet urna. Nunc at consequat diam. Nunc et felis ut nisl commodo dignissim. In hac habitasse platea dictumst. Praesent imperdiet accumsan ex sit amet facilisis.
                           </div>
                        </div>
                     </div>
                  <!-- /.card -->
               </div>             
         </div>
         <!-- /.container-fluid -->
      </section>
      <!-- /.content -->
   </div>
<?php include('includes/footer.php');?>
<?php include('includes/scripts.php');?> 