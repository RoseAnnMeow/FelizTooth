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
        
        <div class="card card-outline card-primary">
            <div class="card-body login-card-body">
                <div class="text-center">
                    <a href="https://feliztoothdistrict.com"><img src="assets/dist/img/betalogo.png" class="img-circle" width="120" alt=""></a>
                </div>
                <h5 class="login-box-msg"><b class="text-danger">Feliz Tooth District</b><br>Dental Clinic</h5>
                <?php include('message.php'); ?>

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
                            <button type="submit" name="login_btn" class="btn btn-primary btn-block">Log In</button>
                        </div>
                </form>
                <p class="mb-1 ">
                    <a href="password-reset.php">Forgot password?</a>
                </p>
            </div>
        </div>
    </div>
</div>
</body>
</html>
<?php include('includes/scripts.php'); ?>
