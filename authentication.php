<?php
session_start();
if(!isset($_SESSION['auth']))
{
    header('Location: login.php');
    exit(0);
}
else if($_SESSION['auth_role'] == "2")
{
    $_SESSION['error'] = "Access Denied";
    header('Location: admin/index.php');
    exit(0);
}
else{

}

?>