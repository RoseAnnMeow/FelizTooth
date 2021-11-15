<?php
session_start();
include('includes/header.php');
if(isset($_SESSION['auth']))
{
    $_SESSION['status'] = "You are already logged in";
    header('Location: index.php');
    exit(0);
}
?>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="#" class="h4"><b>Feliz Tooth District Clinic</b></a>
        </div>
        <?php
        if(isset($_SESSION['auth_status']))
        {
            ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <?php echo $_SESSION['auth_status'];?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true"></span>
                </button>
            </div> 
            <?php
            unset($_SESSION['auth_status']);
        }
        ?>
        <?php
        include('admin/message.php');
        ?>
        <!-- /.login-logo -->
        <div class="card card-outline card-teal">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Sign in</p>

                <form action="logincode.php" method="post">
                    <div class="input-group mb-3">
                        <input type="email" name="email" class="form-control" placeholder="Email" required/>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" name="password" class="form-control" placeholder="Password" required/>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                        <div class="form-group">
                            <button type="submit" name="login_btn" class="btn btn-secondary btn-block">Log In</button>
                        </div>
                </form>

                <p class="mb-1 ">
                    <a href="forgot-password.html">Forgot password?</a>
                </p>
                <p class="mb-0">
                    <a href="register.php" class="text-center">Create Account</a>
                </p>
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>

<?php include('includes/scripts.php'); ?>
<?php include('includes/footer.php'); ?>