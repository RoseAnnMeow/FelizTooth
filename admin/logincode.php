<?php
session_start();
include('config/dbconn.php');

if(isset($_POST['login_btn']))
{
    $error='';
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM tbldoctor WHERE email='$email'";
    $result = mysqli_query($conn,$sql);

    if(mysqli_num_rows($result) > 0)
    {
        while($row = mysqli_fetch_assoc($result))
        {
            $user_id = $row['id'];
            $user_fname = $row['name'];
            $user_email = $row['email'];
            $role_as = $row['role'];
            $user_status = $row['status'];

            if(password_verify($password, $row['password']))
            {
                if($user_status == '1')
                {
                    $_SESSION['auth'] = true;
                    $_SESSION['auth_role'] = "$role_as";
                    $_SESSION['auth_user'] = [
                    'user_id'=>$user_id,
                    'user_fname'=>$user_fname,
                    'user_email'=>$user_email
                    ];
    
                    header('Location: index.php');   
                }
                else
                {
                    $_SESSION['danger'] = "Sorry your account is temporarily disabled. Please contact the admin.";
                    header('Location: login.php');
                }                                                               
            }
            else
            {
                $_SESSION['error'] = "Incorrect Email or Password";
                header('Location: login.php');
            }
        }            
    }
    else
    {
        $_SESSION['error'] = "Incorrect Email or Password";
        header('Location: login.php');
    }    
}
else 
{
    $_SESSION['error'] = "Access Denied";
    header('Location: patients.php');
}
?>