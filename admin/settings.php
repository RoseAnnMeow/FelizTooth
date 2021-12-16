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
                        <h1>Settings</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                            <li class="breadcrumb-item active">Settings</li>
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
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">System Information</h3>
                        </div>
                        <form action="settings_action.php" method="post" enctype="multipart/form-data">
                            <div class="card-body">
                                <?php 
                                    $sql = "SELECT * FROM system_details WHERE id='1' LIMIT 1";
                                    $result = mysqli_query($conn,$sql);

                                    while($row = mysqli_fetch_array($result))
                                    {                           
                                ?>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="">System Name</label>
                                        <input type="text" name="sysname" class="form-control" value="<?=$row['sysname']?>" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="">Title</label>
                                        <input type="text" name="title" class="form-control" value="<?=$row['title']?>" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="">Address</label>
                                        <input type="text" name="address" class="form-control" value="<?=$row['address']?>"required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="">Telephone No.</label>
                                        <input type="text" name="telephone" class="form-control" value="<?=$row['telno']?>"required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="">Email</label>
                                        <input type="email" name="email" class="form-control" value="<?=$row['email']?>"required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="">Mobile No</label>
                                        <input type="text" name="mobile" class="form-control" value="<?=$row['mobile']?>" required>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="">System Logo</label>
                                        <input type="file" name="img_url" placeholder="">
                                        <input type="hidden" name="old_image" value="<?=$row['logo']?>"/>
                                        <span class="direct-chat-timestamp text-sm">Recommended Size : 200x100</span>
                                    </div>
                                </div>
                                <?php 
                                    } 
                                ?>
                                <div class="row">
                                    <div class="col-md-6">
                                        <button type="submit" name="system_details" class="btn btn-primary">Submit</button>
                                    </div>                                
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include('includes/scripts.php');?>
<script>
</script>
<?php include('includes/footer.php');?>