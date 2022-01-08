<?php
session_start();
include('includes/header.php');
?>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="card card-outline card-primary shadow">
            <div class="card-body login-card-body">
                <p class="login-box-msg">You are only one step a way from your new password, recover your password now.</p>
                <?php
                include('admin/message.php');
                ?>
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
                    <div class="input-group">
                        <input type="password" name="newPassword" id="password" class="form-control" placeholder="New Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{8,}" title="Must contain at least one number and one uppercase and lowercase letter,at least one special character, and at least 8 or more characters" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row show_hide">
                        <div class="col-md-12">
                            <small>Password Strength: <span id="result"> </span></small>
                        </div>
                    </div>
                    <div class="input-group mt-3 mb-3">
                        <input type="password" name="confirmPassword" id="confirmPassword" class="form-control" placeholder="Confirm Password" required>
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
    </div>
</body>
</html>
<?php include('includes/scripts.php'); ?>