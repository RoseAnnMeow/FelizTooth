<?php
session_start();
include('admin/config/dbconn.php');

if(isset($_POST['login_btn']))
{
    $email = $_POST['email'];
    $password = $_POST['password'];

    $log_query = "SELECT * FROM tblpatient WHERE email='$email' AND password='$password' LIMIT 1";
    $log_query_run = mysqli_query($conn,$log_query);

    if(mysqli_num_rows($log_query_run) > 0)
    {
        foreach($log_query_run as $row)
        {
            $user_id = $row['id'];
            $user_fname = $row['fname'];
            $user_lname = $row['lname'];
            $user_address = $row['address'];
            $user_dob = $row['dob'];
            $user_gender = $row['gender'];
            $user_phone = $row['phone'];
            $user_email = $row['email'];
        }

        $_SESSION['auth'] = true;
        $_SESSION['auth_user'] = [
            'user_id'=>$user_id,
            'user_fname'=>$user_fname,
            'user_lname'=>$user_lname,
            'user_address'=>$user_address,
            'user_dob'=>$user_dob,
            'user_gender'=>$user_gender,
            'user_phone'=>$user_phone,
            'user_email'=>$user_email
            
        ];
        
        //$_SESSION['status'] = "Logged in Successfully";
        header('Location: index.php');

    }
    else
    {
        $_SESSION['error'] = "Incorrect email or password";
        header('Location: login.php');

    }
}
else 
{
    $_SESSION['error'] = "Access Denied";
    header('Location: patients.php');
}
?>