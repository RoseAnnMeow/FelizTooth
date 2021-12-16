<?php
include('authentication.php');
include('includes/header.php');
include('includes/topbar.php');
include('includes/sidebar.php');
include('config/dbconn.php');
?>

<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
    <div class="modal fade" id="AddDentalModal" >
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title">Add Dental Record</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <?php
                if(isset($_GET['id']))
                {
                    $user_id = $_GET['id'];
                    $user = "SELECT * FROM tblpatient WHERE id='$user_id'";
                    $users_run = mysqli_query($conn,$user);

                    if(mysqli_num_rows($users_run) > 0)
                    {
                        foreach($users_run as $user)
                        {                               
                ?>
                <form action="medical_action.php" method="POST">
                <div class="modal-body">
                    <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="">Previous Dentist</label>
                            <input type="hidden" name="patient" value="<?=$user['id']?>">
                            <input type="text" name="dentist" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Last Dental Visit</label>
                            <input type="text" name="visit" class="form-control">
                        </div>             
                    </div>
                    </div>         
                </div>            
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name="dental_record" class="btn btn-primary">Submit</button>
                </div>
                </form>
                <?php }
                    }
                }
                ?>
            </div>
        </div>
    </div>

    <div class="modal fade" id="EditDentalModal" >
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title">Edit Dental Record</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <form action="medical_action.php" method="POST">
                <div class="modal-body">
                    <div class="row">
                    <div class="col-sm-12">
                    <input type="hidden" name="edit_id" id="edit_id"> 
                    <input type="hidden" name="userid" id="patient_id"> 
                        <div class="form-group">
                            <label for="">Previous Dentist</label>
                            <input type="text" id="edit_dentist" name="dentist" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Last Dental Visit</label>
                            <input type="text" id="edit_visit" name="visit" class="form-control">
                        </div>             
                    </div>
                    </div>         
                </div>            
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name="update_dental" class="btn btn-primary">Submit</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
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
                        <div class="card card-primary card-outline card-tabs">
                            <div class="card-header p-0 pt-1 border-bottom-0">
                                <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="overview-tab" data-toggle="pill" href="#overview" role="tab" aria-controls="overview" aria-selected="true">Overview</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="history-tab" data-toggle="pill" href="#history" role="tab" aria-controls="history" aria-selected="false">Medical History</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="custom-tabs-one-messages-tab" data-toggle="pill" href="#custom-tabs-one-messages" role="tab" aria-controls="custom-tabs-one-messages" aria-selected="false">Treatments</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="custom-tabs-one-settings-tab" data-toggle="pill" href="#custom-tabs-one-settings" role="tab" aria-controls="custom-tabs-one-settings" aria-selected="false">Documents</a>
                                    </li>
                                    <li>
                                    <a href="patients.php" class="btn  btn-outline-danger btn-sm float-right">
                                <i class="fas fa-long-arrow-left"></i> &nbsp;&nbsp;Back</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-body">
                                <div class="tab-content" id="custom-tabs-one-tabContent">
                                    <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview-tab">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="card card-primary card-outline">
                                                    <?php
                                                    if(isset($_GET['id']))
                                                    {
                                                        $user_id = $_GET['id'];
                                                        $user = "SELECT * FROM tblpatient WHERE id='$user_id'";
                                                        $users_run = mysqli_query($conn,$user);

                                                        if(mysqli_num_rows($users_run) > 0)
                                                        {
                                                            foreach($users_run as $user)
                                                            {                               
                                                    ?>
                                                    <div class="card-body box-profile">
                                                        <div class="text-center">
                                                            <img class="profile-user-img img-fluid img-circle"
                                                            src="../upload/patients/<?=$user['image']?>"alt="User profile picture">
                                                        </div>
                                                        <h4 class="profile-username text-center"><?=$user['fname'].' '.$user['lname']?></h4>
                                                        <p class="text-muted text-center"><?=$user['email']?></p>
                                                        <ul class="list-group list-group-unbordered mb-3">
                                                            <li class="list-group-item">
                                                                <b>Gender</b> 
                                                                <p class="float-right text-muted m-0"><?=$user['gender']?></p>
                                                            </li>
                                                            <li class="list-group-item">
                                                                <b>Birthdate</b> 
                                                                <p class="float-right text-muted m-0"><?=$user['dob']?></p>
                                                            </li>
                                                            <li class="list-group-item">
                                                                <b>Phone</b> 
                                                                <p class="float-right text-muted m-0"><?=$user['phone']?></p>
                                                            </li>
                                                            <li class="list-group-item">
                                                                <b>Address</b> 
                                                                <p class="float-right text-muted m-0"><?=$user['address']?></p>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <?php
                                                            }
                                                        }
                                                    }
                                                    ?>
                                                <!-- /.card-body -->
                                                </div>
                                            </div>

                                            <div class="col-md-9">
                                                <div class="card">
                                                    <div class="card-header p-2">
                                                        <ul class="nav nav-pills" id="custom-tabs-three-tab" role="tablist">
                                                            <li class="nav-item">
                                                            <a class="nav-link active" href="appointment-tab" data-toggle="tab" data-target="#appointment" role="tab" aria-controls="appointment" aria-selected="true">Appointment</a>
                                                            </li>
                                                            <li class="nav-item">
                                                            <a class="nav-link" href=prescription-tab" data-toggle="tab" data-target="#prescription" role="tab" aria-controls="prescription" aria-selected="false">Prescription</a>
                                                            </li>
                                                            <li class="nav-item">
                                                            <a class="nav-link" href="confirmed-tab" data-toggle="tab" data-target="#confirmed" role="tab" aria-controls="confirmed" aria-selected="false">Documents</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                

                                                    <div class="card-body">
                                                        <div class="tab-content" id="custom-tabs-three-tabContent">
                                                            <div class="tab-pane fade show active" id="appointment" role="tabpanel" aria-labelledby="appointment-tab">
                                                                <!-- Appointment-->
                                                                <table id="appointmenttable" class="table table-hover table-borderless" style="width:100%;">
                                                                    <thead class="bg-light">
                                                                    <tr>
                                                                        <th>Date</th>
                                                                        <th>Time</th>
                                                                        <th>Doctor</th>
                                                                        <th>Status</th>
                                                                    </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                    <?php
                                                                    if(isset($_GET['id']))
                                                                    {
                                                                        $user_id = $_GET['id'];
                                                                        $user = "SELECT a.schedule,a.id,a.starttime,a.status,a.endtime,d.name as dname FROM tbldoctor d INNER JOIN tblappointment a WHERE a.doc_id = d.id AND a.patient_id ='$user_id' ORDER BY a.schedule";
                                                                        $users_run = mysqli_query($conn,$user);

                                                                        if(mysqli_num_rows($users_run) > 0)
                                                                        {
                                                                            foreach($users_run as $user)
                                                                            {                               
                                                                    ?>
                                                                        
                                                                    <tr>
                                                                        <td>
                                                                            <?=date('F j, Y',strtotime($user['schedule'])) ?></td>
                                                                        <td><?=$user['starttime'].' - '.$user['endtime']?></td>
                                                                        <td><?=$user['dname']?></td>
                                                                        <td>
                                                                            <?php
                                                                            if($user['status'] == 'Treated')
                                                                            {
                                                                                echo $user['status'] = '<span class="badge badge-primary">Treated</span>';
                                                                            }
                                                                            else if($user['status'] == 'Confirmed')
                                                                            {
                                                                                echo $user['status'] = '<span class="badge badge-success">Confirmed</span>';
                                                                            }
                                                                            else if($user['status'] == 'Pending')
                                                                            {
                                                                                echo $user['status'] = '<span class="badge badge-warning">Pending</span>';
                                                                            }
                                                                            else if($user['status'] == 'Cancelled')
                                                                            {
                                                                                echo $user['status'] = '<span class="badge badge-danger">Cancelled</span>';
                                                                            }
                                                                            else 
                                                                            {
                                                                                echo $user['status'] = '<span class="badge badge-secondary">No Show</span>';
                                                                            }
            
                                                                            ?>
                                                                        </td>
                                                                    </tr>
                                                                    <?php
                                                                            }
                                                                        }
                                                                    }
                                                                    ?>
                                                                    </tbody>
                                                                </table>    
                                                            </div>

                                                            <div class="tab-pane fade" id="prescription" role="tabpanel" aria-labelledby="prescription-tab">
                                                                <table id="prescriptiontable" class="table table-hover table-borderless" style="width:100%;">
                                                                    <thead class="bg-light">
                                                                    <tr>
                                                                        <th class="bg-light">Date</th>
                                                                        <th class="bg-light">Medicine</th>
                                                                        <th class="bg-light">Notes</th>
                                                                    </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                    <?php
                                                                    if(isset($_GET['id']))
                                                                    {
                                                                        $i = 1;
                                                                        $user_id = $_GET['id'];
                                                                        $user = "SELECT * FROM prescription WHERE patient_id='$user_id'";
                                                                        
                                                                        $users_run = mysqli_query($conn,$user);

                                                                        if(mysqli_num_rows($users_run) > 0)
                                                                        {
                                                                            foreach($users_run as $user)
                                                                            {                               
                                                                    ?>
                                                                        
                                                                    <tr>
                                                                        <td><?=date('F j, Y',strtotime($user['date'])) ?></td>
                                                                        <td><?=$user['medicine']?></td>
                                                                        <td><?=$user['advice']?></td>
                                                                    </tr>
                                                                    <?php
                                                                            }
                                                                        }
                                                                    }
                                                                    ?>
                                                                    </tbody>
                                                                </table>    
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="history" role="tabpanel" aria-labelledby="history-tab">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="card">
                                                    <div class="card-header border-bottom-0">
                                                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#AddDentalModal">
                                                        <i class="fa fa-plus"></i> &nbsp;&nbsp;Add Dental Record</button>
                                                    </div>
                                                    <div class="card-body p-0">
                                                        <div class="table-responsive">
                                                            <table class="table table-hover table-borderless" style="width:100%;">
                                                            <thead class="bg-light">
                                                                <tr>
                                                                    <th style="width:1%;">#</th>
                                                                    <th>Previous Dentist</th>
                                                                    <th>Last Dental Visit</th>
                                                                    <th>Action</th>
                                                                </tr>                                                       
                                                            </thead>
                                                            <tbody>
                                                            <?php
                                                            if(isset($_GET['id']))
                                                            {
                                                                $i = 1;
                                                                $user_id = $_GET['id'];
                                                                $user = "SELECT * FROM dental_history WHERE patient_id='$user_id'";
                                                                
                                                                $users_run = mysqli_query($conn,$user);

                                                                while($user = mysqli_fetch_array($users_run)){
                                                                ?>        
                                                                    <tr>
                                                                    <td><?php echo $i++; ?></td>
                                                                    <td><?=$user['dentist']?></td>
                                                                    <td><?=$user['visit']?></td>
                                                                    <td>
                                                                        <button data-id="<?=$user['id']?>" class="btn btn-sm btn-info editDentalbtn"><i class="fas fa-edit"></i></button>
                                                                        <button data-id="<?=$user['id']?>" class="btn btn-danger btn-sm deleteDentalbtn"><i class="far fa-trash-alt"></i></button>
                                                                    </td>
                                                                </tr>
                                                                <?php
                                                                }
                                                            }
                                                        ?>
                                                            </tbody>
                                                            </table>
                                                        </div>                                      
                                                    </div>
                                                </div>                                                 
                                            </div>
                                            <div class="col-md-6">
                                            <div class="card">
                                                    <div class="card-header border-bottom-0">
                                                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#AddDentalModal">
                                                        <i class="fa fa-plus"></i> &nbsp;&nbsp;Add Medical Record</button>
                                                    </div>
                                                    <div class="card-body p-0">
                                                        <div class="table-responsive">
                                                            <table class="table table-hover table-borderless" style="width:100%;">
                                                            <thead class="bg-light">
                                                                <tr>
                                                                    <th style="width:1%;">#</th>
                                                                    <th>Previous Dentist</th>
                                                                    <th>Last Dental Visit</th>
                                                                    <th>Action</th>
                                                                </tr>                                                       
                                                            </thead>
                                                            <tbody>
                                                            <?php
                                                            if(isset($_GET['id']))
                                                            {
                                                                $i = 1;
                                                                $user_id = $_GET['id'];
                                                                $user = "SELECT * FROM dental_history WHERE patient_id='$user_id'";
                                                                
                                                                $users_run = mysqli_query($conn,$user);

                                                                while($user = mysqli_fetch_array($users_run)){
                                                                ?>        
                                                                    <tr>
                                                                    <td><?php echo $i++; ?></td>
                                                                    <td><?=$user['dentist']?></td>
                                                                    <td><?=$user['visit']?></td>
                                                                    <td>
                                                                        <button data-id="<?=$user['id']?>" class="btn btn-sm btn-info editDentalbtn"><i class="fas fa-edit"></i></button>
                                                                        <button data-id="<?=$user['id']?>" class="btn btn-danger btn-sm deleteDentalbtn"><i class="far fa-trash-alt"></i></button>
                                                                    </td>
                                                                </tr>
                                                                <?php
                                                                }
                                                            }
                                                        ?>
                                                            </tbody>
                                                            </table>
                                                        </div>                                      
                                                    </div>
                                                </div>  
                                            </div>
                                        </div>
                                    </div>       
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
    </div>
</div>
<?php include('includes/scripts.php');?>
<script>
    $(document).ready(function () {

    var table1 = $('#appointmenttable').DataTable( {
      responsive: true,
      searching: false, paging: false, info: false,
    } );
    var table2 = $('#prescriptiontable').DataTable( {
      responsive: true,
      searching: false, paging: false, info: false,
    } );

    $('.nav-pills a').on('shown.bs.tab', function (event) {
      var tabID = $(event.target).attr('data-target');
      if( tabID === '#appointment') {
        table1.columns.adjust().responsive.recalc();
      }
      if (tabID === '#prescription') {
        table2.columns.adjust().responsive.recalc();
      }
    });

    $(document).on('click','.deleteDentalbtn', function(){   
    var userid = $(this).data('id');
    
    if(confirm("Are you sure you want to delete this data?"))
    {
        $.ajax({
            type: "post",
            url: "medical_action.php",
            data: 
            {
                'delete_dental':true,
                'user_id':userid,
            },
            success: function (response) {
                location.reload();
            }
        });
    }
  });

    $(document).on('click','.editDentalbtn', function(){   
    var userid = $(this).data('id');

    $.ajax({
        type: "post",
        url: "medical_action.php",
        data:
        {
          'dental_editbtn':true,
          'user_id':userid,
        },
        success: function (response) {
        $.each(response, function (key, value){
        $('#edit_id').val(value['id']);
        $('#patient_id').val(value['patient_id']);
        $('#edit_dentist').val(value['dentist']);
        $('#edit_visit').val(value['visit']);
        $('#EditDentalModal').modal('show');  
        });
    }
    });

  });
});
</script>
<?php include('includes/footer.php');?>