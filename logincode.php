<?php
session_start();
include('admin/config/dbconn.php');

if(isset($_POST['login_btn']))
{
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM tblpatient WHERE email='$email'";
    $result = mysqli_query($conn,$sql);

    if(mysqli_num_rows($result) > 0)
    {
        while($row = mysqli_fetch_assoc($result))
        {
            $user_id = $row['id'];
            $user_fname = $row['fname'];
            $user_lname = $row['lname'];
            $user_address = $row['address'];
            $user_dob = $row['dob'];
            $user_gender = $row['gender'];
            $user_phone = $row['phone'];
            $user_email = $row['email'];
            $role_as = $row['role'];
            $ver_status = $row['verify_status'];

            if(password_verify($password, $row['password']))
            {
                if($ver_status == '1')
                {
                    $_SESSION['auth'] = true;
                    $_SESSION['auth_role'] = "$role_as";
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

                    // if($_SESSION['auth_role'] == '1') //1-admin
                    // {
                    //     header('Location: admin/index.php');
                    //     exit(0); 
                    // }
                    header('Location: dashboard.php');
                    exit(0);          
                }
                else
                {
                    $_SESSION['error'] = "You have not confirmed your account yet. Please check your inbox and verify your email.";
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