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
                        <h1>Profile</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                            <li class="breadcrumb-item active">User Profile</li>
                        </ol>
                    </div>
                </div> 
            </div>
        </div> 
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                    <?php
                    include('message.php');
                    ?>
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                            <li class="nav-item"><a class="nav-link active" href="#info" data-toggle="tab">Edit Profile</a></li>
                            <li class="nav-item"><a class="nav-link" href="#pass" data-toggle="tab">Password</a></li>
                            </ul>
                        </div>
                            <div class="card-body">
                                <div class="tab-content">
                                    <div class="active tab-pane" id="info">
                                        <form action="profile_action.php" method="post" enctype="multipart/form-data">
                                            <?php
                                            if(isset($_SESSION['auth']))
                                            {
                                                $sql = "SELECT * FROM tbldoctor WHERE id = '".$_SESSION['auth_user']['user_id']."'";
                                                $query_run = mysqli_query($conn,$sql);
                                                while($row = mysqli_fetch_array($query_run))
                                            {                                
                                            ?>                                      
                                            <div class="row">
                                                <input type="hidden" name="userid" value="<?=$_SESSION['auth_user']['user_id']?>">
                                                <div class="form-group col-md-6">
                                                    <label for="">Full Name</label>
                                                    <span class="text-danger">*</span>
                                                    <input type="text" name="name" class="form-control" value="<?=$row['name']?>" required>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="">Birthdate</label>
                                                    <span class="text-danger">*</span>
                                                    <input type="text" autocomplete="off" id="edit_dob" name="birthday" value="<?=$row['dob']?>" class="form-control" id="datepicker" required>
                                                </div>
                                                <div class="form-group col-md-2">
                                                    <label for="">Gender</label>
                                                    <span class="text-danger">*</span>                   
                                                        <?php $array = array("Female","Male","Others");
                                                        echo "<select class='custom-select' name='gender' required>";
                                                        foreach($array as $gender)
                                                        {
                                                            if($gender == $row['gender'])
                                                            {
                                                                echo "<option selected>$gender</option>";
                                                            }
                                                            else
                                                            {
                                                                echo "<option>$gender</option>";
                                                            }
                                                        }
                                                        echo "</select>";
                                                    ?>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="">Address</label>
                                                    <span class="text-danger">*</span>
                                                    <input type="text" name="address" class="form-control" value="<?=$row['address']?>"required>
                                                </div>
                                                <div class="form-group col-md-2">
                                                    <label for="">Contact Number</label>
                                                    <span class="text-danger">*</span>
                                                    <input type="tel" name="contact" class="form-control" value="<?=$row['phone']?>" placeholder="+63 917 1234 567" required>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="">Email</label>
                                                    <span class="text-danger">*</span>
                                                    <input type="email" name="email" class="form-control" value="<?=$row['email']?>" readonly>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="">Degree</label>
                                                    <span class="text-danger">*</span>
                                                    <input type="text" name="degree" class="form-control" value="<?=$row['degree']?>" required>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="">Specialty</label>
                                                    <span class="text-danger">*</span>
                                                    <input type="text" name="specialty" class="form-control" value="<?=$row['specialty']?>" required>
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label for="">Dentist Image</label>
                                                    <input type="file" name="img_url" placeholder="">
                                                    <input type="hidden" name="old_image" value="<?=$row['image']?>"/>
                                                    <div id="uploaded_image">
                                                    <img src="../upload/doctors/<?= $row['image']?>" class="img-thumbnail img-fluid" width="120" alt="Doctor Image">
                                                    </div>     
                                                </div>
                                            </div>
                                            <?php 
                                                } 
                                            }
                                            ?>               
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <button type="submit" name="profile_details" class="btn btn-danger float-right">Update</button>
                                                </div>                                
                                            </div>
                                        </form>
                                    </div>
                                    <div class="tab-pane" id="pass">
                                        <form action="profile_action.php" method="post">
                                            <div class="row">
                                            <input type="hidden" name="userid" value="<?=$_SESSION['auth_user']['user_id']?>">
                                                <div class="form-group col-md-6">
                                                    <label>Current password</label>
                                                    <input type="password" autocomplete="off" name="current_pass" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label>New Password</label>
                                                    <input type="password" autocomplete="new-password" name="new_pass" class="form-control" id="password" required>
                                                </div>
                                            </div>                                        
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label>Confirm Password</label>
                                                    <input type="password" autocomplete="new-password" name="confirm_pass" class="form-control" id="confirmPassword" required>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <button type="submit" name="change_password" class="btn btn-danger float-right">Update</button>
                                                </div>                                
                                            </div>    
                                        </form>                                                                             
                                    </div>
                                    <!-- /.tab-pane -->

                                </div>
                                <!-- /.tab-content -->
                            </div><!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </div>
</div>
<?php include('includes/scripts.php');?>
<script>
$(document).ready(function(){
//     $('.nav-pills a').click(function(e) {
//   e.preventDefault();
//   $(this).tab('show');
// });

// // store the currently selected tab in the hash value
// $("ul.nav-pills > li > a").on("shown.bs.tab", function(e) {
//   var id = $(e.target).attr("href").substr(1);
//   window.location.hash = id;
// });

// // on load of the page: switch to the currently selected tab
// var hash = window.location.hash;
// $('.nav-pills a[href="' + hash + '"]').tab('show');
    $('a[data-toggle="tab"]').on('show.bs.tab', function(e) {
        localStorage.setItem('activeTab', $(e.target).attr('href'));
    });
    var activeTab = localStorage.getItem('activeTab');
    if(activeTab){
        $('.nav-pills a[href="' + activeTab + '"]').tab('show');
    }
});
</script>
<?php include('includes/footer.php');?>