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
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
        </div>
      </div>
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <div class="invoice p-3 mb-3">
              <!-- title row -->
                  <div class="row d-flex justify-content-start">
                      <div class="col-md-9">
                        <?php 
                          $sql = "SELECT * FROM system_details LIMIT 1";
                          $result = mysqli_query($conn,$sql);
                          while($row = mysqli_fetch_array($result))
                          {
                        ?>
                          <h4 class="text-primary text-left top_title">
                          <?=$row['title'];?>
                          </h4>
                          <address class="text-left">
                            <?=$row['address'];?><br>
                            <?=$row['telno'];?><br>
                            <?=$row['mobile'];?><br>
                            <?=$row['email'];?>
                          </address>
                      </div>
                      <div class="col-md-3 d-flex justify-content-end"> 
                      <img src="../upload/logo/<?= $row['logo']?>" height="120" alt="">
                      </div>
                      <?php } ?>
                  </div>
                <hr>
                <?php
                if(isset($_GET['id']))
                {
                  $user_id = $_GET['id'];
                  $user = "SELECT pres.*, CONCAT(p.fname,' ',p.lname) AS pname, p.gender, p.address,
                  DATE_FORMAT(FROM_DAYS(DATEDIFF(now(),STR_TO_DATE(p.dob, '%c/%e/%Y'))), '%Y')+0 AS Age FROM prescription pres INNER JOIN tblpatient p WHERE p.id = pres.patient_id AND pres.id='$user_id' LIMIT 1";
                  $users_run = mysqli_query($conn,$user);

                  if(mysqli_num_rows($users_run) > 0)
                  {
                      foreach($users_run as $user)
                      {
                           
                ?>
                <div class="row mb-2 d-flex justify-content-start">                   
                    <div class="col-md-3">
                        Name: <?=$user['pname'];?>                       
                    </div>
                    <div class="col-md-7">
                        Addresss: <?=$user['address'];?>
                    </div>
                </div>
                <hr>
                <div class="row mb-2 d-flex justify-content-start">                   
                    <div class="col-md-3">
                    Gender: <?=$user['gender'];?>
                    
                    </div>
                    <div class="col-md-3">
                    Age: <?=$user['Age'];?> yrs old
                    </div>
                    <div class="col-md-3">
                    Date: <?=date('M j, Y',strtotime($user['date'])); ?>
                    </div>
                </div>
                <hr>

              <div class="row">
                <div class="col-md-8 mt-2">
                  <img src="assets/dist/img/prescriptionLogo.png" height="70" alt="">
                  <div class="table-responsive">
                    <table class="table table-borderless">                      
                        <thead>       
                            <th></th>
                            <th></th>
                            <th class="text-right"></th>    
                        </thead>
                        <tbody>
                        <tr>
                            <td class=""><?=$user['medicine'];?></td>
                        </tr>
                        </tbody>
                    </table>
                  </div>
                </div>                
                <!-- /.col -->
              </div>
              <?php
                  }
              }
              else
              {

              }
          }
          ?>
              <!-- /.row -->
              <div class="row">                   
                <div class="col-md-12 text-right mb-4" style="margin-top:60px;">
                    Signature over printed name<br>
                    Lic No: Rose Ann Bonador<br>
                    PTR No: Rose Ann Bonador<br>
                </div>                 
              </div>
              <div class="row no-print">
                <div class="col-md-4">
                  <a href="print-prescription.php" rel="noopener" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> Print</a>
                </div>
              </div>

              <!-- this row will not appear when printing -->
            </div>
            
            </div>
        </div>
  

    </div>
        <!-- /.row -->
</div><!-- /.container-fluid -->
</section>

</div>
<?php include('includes/scripts.php');?>
<?php include('includes/footer.php');?>