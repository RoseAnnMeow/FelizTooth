<?php
session_start();
include('includes/header.php');
?>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="#" class="h4"><b>Feliz Tooth District Clinic</b></a>
        </div>
        <?php
        include('message.php');
        ?>
        <!-- /.login-logo -->
        <div class="card card-outline card-primary">
            <div class="card-body login-card-body">
                <p class="login-box-msg">You are only one step a way from your new password, recover your password now.</p>
                    <form action="password-reset-code.php" method="post">
                        <input type="hidden" name="password_token" value="<?php if(isset($_GET['token'])){echo $_GET['token'];}?>">
                        <div class="input-group mb-3">
                            <input type="email" name="email" value="<?php if(isset($_GET['email'])){echo $_GET['email'];}?>" class="form-control" placeholder="Email" required>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <input type="password" name="newPassword"class="form-control" placeholder="New Password" required>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <input type="password" name="confirmPassword" class="form-control" placeholder="Confirm Password" required>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <button type="submit" name="update_password" class="btn btn-primary btn-block">Change password</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

<?php include('includes/scripts.php'); ?>
<?php include('includes/footer.php'); ?>