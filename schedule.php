<?php
   include('authentication.php');
   include('includes/header.php');
   include('includes/topbar.php');
   include('includes/sidebar.php');
   include('admin/config/dbconn.php');
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
                  <div class="callout callout-danger">
                     <h5 class="text-danger"><i class="icon fas fa-info"></i> Reminder</h5>
                     <p>Due to COVID-19 pandemic we are strictly by appointment only until further notice.
                        Please do not schedule an appointment if you have signs or symptoms of COVID-19. 
                        Wearing a face mask is a must to ensure the safety of Doctors and Patients.
                     </p>
                  </div>
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
                  <div class="card card-primary card-outline">
                     <div class="card-header p-2">
                        <ul class="nav nav-pills">
                           <li class="nav-item"><a class="nav-link active" href="#appointment" data-toggle="tab">Appointment</a></li>
                           <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Timeline</a></li>
                           <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Settings</a></li>
                        </ul>
                     </div>

                     <div class="card-body">
                        <div class="tab-content">
                           <div class="active tab-pane" id="appointment">                           
                              <a class="btn btn-outline-success" href="request_appointment.php">
                                <i class="fa fa-plus-circle"> </i> Request a Appointment
                              </a>
                                 <div class="card-brody p-0 mt-4">
                                 <table class="table table-hover">
                                    <thead>
                                    <tr>
                                       <th class="bg-light">Date</th>
                                       <th class="bg-light">Time</th>
                                       <th class="bg-light">Doctor</th>
                                       <th class="bg-light" style="width: 40px">Status</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                       <td></td>
                                       <td></td>
                                       <td></td>
                                       <td></td>
                                    </tr>
                                    </tbody>
                                 </table>
                           
                                 </div>
                                
                           
                           </div>
                           <!-- /.tab-pane -->
                           <div class="tab-pane" id="timeline">
                              <!-- The timeline -->
                              <div class="timeline timeline-inverse">
                                 <!-- timeline time label -->
                                 <div class="time-label">
                                    <span class="bg-danger">
                                    10 Feb. 2014
                                    </span>
                                 </div>
                                 <!-- /.timeline-label -->
                                 <!-- timeline item -->
                                 <div>
                                    <i class="fas fa-envelope bg-primary"></i>
                                    <div class="timeline-item">
                                       <span class="time"><i class="far fa-clock"></i> 12:05</span>
                                       <h3 class="timeline-header"><a href="#">Support Team</a> sent you an email</h3>
                                       <div class="timeline-body">
                                          Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,
                                          weebly ning heekya handango imeem plugg dopplr jibjab, movity
                                          jajah plickers sifteo edmodo ifttt zimbra. Babblely odeo kaboodle
                                          quora plaxo ideeli hulu weebly balihoo...
                                       </div>
                                       <div class="timeline-footer">
                                          <a href="#" class="btn btn-primary btn-sm">Read more</a>
                                          <a href="#" class="btn btn-danger btn-sm">Delete</a>
                                       </div>
                                    </div>
                                 </div>
                                 <!-- END timeline item -->
                                 <!-- timeline item -->
                                 <div>
                                    <i class="fas fa-user bg-info"></i>
                                    <div class="timeline-item">
                                       <span class="time"><i class="far fa-clock"></i> 5 mins ago</span>
                                       <h3 class="timeline-header border-0"><a href="#">Sarah Young</a> accepted your friend request
                                       </h3>
                                    </div>
                                 </div>
                                 <!-- END timeline item -->
                                 <!-- timeline item -->
                                 <div>
                                    <i class="fas fa-comments bg-warning"></i>
                                    <div class="timeline-item">
                                       <span class="time"><i class="far fa-clock"></i> 27 mins ago</span>
                                       <h3 class="timeline-header"><a href="#">Jay White</a> commented on your post</h3>
                                       <div class="timeline-body">
                                          Take me to your leader!
                                          Switzerland is small and neutral!
                                          We are more like Germany, ambitious and misunderstood!
                                       </div>
                                       <div class="timeline-footer">
                                          <a href="#" class="btn btn-warning btn-flat btn-sm">View comment</a>
                                       </div>
                                    </div>
                                 </div>
                                 <!-- END timeline item -->
                                 <!-- timeline time label -->
                                 <div class="time-label">
                                    <span class="bg-success">
                                    3 Jan. 2014
                                    </span>
                                 </div>
                                 <!-- /.timeline-label -->
                                 <!-- timeline item -->
                                 <div>
                                    <i class="fas fa-camera bg-purple"></i>
                                    <div class="timeline-item">
                                       <span class="time"><i class="far fa-clock"></i> 2 days ago</span>
                                       <h3 class="timeline-header"><a href="#">Mina Lee</a> uploaded new photos</h3>
                                       <div class="timeline-body">
                                          <img src="https://placehold.it/150x100" alt="...">
                                          <img src="https://placehold.it/150x100" alt="...">
                                          <img src="https://placehold.it/150x100" alt="...">
                                          <img src="https://placehold.it/150x100" alt="...">
                                       </div>
                                    </div>
                                 </div>
                                 <!-- END timeline item -->
                                 <div>
                                    <i class="far fa-clock bg-gray"></i>
                                 </div>
                              </div>
                           </div>
                           <!-- /.tab-pane -->
                           <div class="tab-pane" id="settings">
                              <form class="form-horizontal">
                                 <div class="form-group row">
                                    <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                                    <div class="col-sm-10">
                                       <input type="email" class="form-control" id="inputName" placeholder="Name">
                                    </div>
                                 </div>
                                 <div class="form-group row">
                                    <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                                    <div class="col-sm-10">
                                       <input type="email" class="form-control" id="inputEmail" placeholder="Email">
                                    </div>
                                 </div>
                                 <div class="form-group row">
                                    <label for="inputName2" class="col-sm-2 col-form-label">Name</label>
                                    <div class="col-sm-10">
                                       <input type="text" class="form-control" id="inputName2" placeholder="Name">
                                    </div>
                                 </div>
                                 <div class="form-group row">
                                    <label for="inputExperience" class="col-sm-2 col-form-label">Experience</label>
                                    <div class="col-sm-10">
                                       <textarea class="form-control" id="inputExperience" placeholder="Experience"></textarea>
                                    </div>
                                 </div>
                                 <div class="form-group row">
                                    <label for="inputSkills" class="col-sm-2 col-form-label">Skills</label>
                                    <div class="col-sm-10">
                                       <input type="text" class="form-control" id="inputSkills" placeholder="Skills">
                                    </div>
                                 </div>
                                 <div class="form-group row">
                                    <div class="offset-sm-2 col-sm-10">
                                       <div class="checkbox">
                                          <label>
                                          <input type="checkbox"> I agree to the <a href="#">terms and conditions</a>
                                          </label>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="form-group row">
                                    <div class="offset-sm-2 col-sm-10">
                                       <button type="submit" class="btn btn-danger">Submit</button>
                                    </div>
                                 </div>
                              </form>
                           </div>
                           <!-- /.tab-pane -->
                        </div>
                        <!-- /.tab-content -->
                     </div>
                     <!-- /.card-body -->
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