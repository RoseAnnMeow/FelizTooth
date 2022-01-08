<?php
session_start();
include('config/dbconn.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';

function send_password_reset($get_name,$get_email,$token)
{
    $mail = new PHPMailer(true);

    $mail->isSMTP();                                      
    $mail->Host       = 'smtp.gmail.com';                    
    $mail->SMTPAuth   = true;                                 
    $mail->Username   = 'feliztoothdev@gmail.com';                    
    $mail->Password   = 'felizdevelopers123';  

    $mail->SMTPSecure = 'tls';          
    $mail->Port       = 587;    
    
    $mail->setFrom('feliztoothdev@gmail.com', $get_name);
    $mail->addAddress($get_email);  

    $mail->isHTML(true); 
    $mail->Subject = 'Reset Password Notification';  
    
    $email_template = "
            <h2> Hello </h2> 
            <h3> You are receiving this email because we received a password reset request for your account.</h3>
            <p>Please click below to reset your password</p>
            <a href='http://localhost/php-admin-panel/Feliz-Tooth-District-Clinic/admin/password-change.php?token=$token&email=$get_email'> Click Here </a>
            ";

    $mail->Body = $email_template;
    try
    {
        $mail->send();
        echo "Message has been sent";
    }
    catch(Exception $e)
    {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
if(isset($_POST['password_reset_link']))
{
    $email = mysqli_real_escape_string($conn,$_POST['email']);
    $token = md5(rand());

    $check_email = "SELECT email FROM tbldoctor WHERE email='$email' LIMIT 1";
    $check_email_run = mysqli_query($conn,$check_email);

    if(mysqli_num_rows($check_email_run) > 0)
    {
        $row = mysqli_fetch_array($check_email_run);
        $get_name = $row['name'];
        $get_email = $row['email'];
        $get_status = $row['status'];

        $update_token = "UPDATE tbldoctor SET verify_token='$token' WHERE email='$get_email' LIMIT 1";
        $update_token_run = mysqli_query($conn,$update_token);

        if($update_token_run)
        {
            send_password_reset($get_name,$get_email,$token);
            $_SESSION['info'] = "We emailed you a password reset link";
            header("Location:password-reset.php");
            exit(0);
        }
        else
        {
            $_SESSION['error'] = "Something went wrong";
            header("Location:password-reset.php");
            exit(0);
        }
    }
    else
    {
        $_SESSION['error'] = "No Email Found";
        header("Location:password-reset.php");
        exit(0);
    }
}

if(isset($_POST['update_password']))
{
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $new_password =   mysqli_real_escape_string($conn, $_POST['newPassword']);
    $confirm_password =  mysqli_real_escape_string($conn, $_POST['confirmPassword']);

    $token = mysqli_real_escape_string($conn, $_POST['password_token']);

    if(!empty($token))
    {
        if(!empty($email) && !empty($new_password) && !empty($confirm_password))
        {
            $check_token = "SELECT verify_token FROM tbldoctor WHERE verify_token='$token' LIMIT 1";
            $check_token_run = mysqli_query($conn,$check_token);

            if(mysqli_num_rows($check_token_run))
            {
                if($new_password == $confirm_password)
                {
                    $hash = password_hash($new_password,PASSWORD_DEFAULT);   
                    $update_password = "UPDATE tbldoctor SET password='$hash' WHERE verify_token='$token' LIMIT 1";
                    $update_password_run = mysqli_query($conn,$update_password);
                    

                    if($update_password_run)
                    {
                        $new_token = md5(rand())."feliztooth";
                        $update_to_new_token = "UPDATE tbldoctor SET verify_token='$new_token' WHERE verify_token='$token' LIMIT 1";
                        $update_to_new_token_run = mysqli_query($conn,$update_to_new_token);
                        
                        $_SESSION['success'] = "Password has been changed";
                        header("Location:login.php");
                        exit(0);
                    }
                    else
                    {
                        $_SESSION['error'] = "Did not update password. Something went wrong!";
                        header("Location:password-change.php?token=$token&email=$email");
                        exit(0);
                    }
                }
                else
                {
                    $_SESSION['error'] = "Password and Confirm Password does not match";
                    header("Location:password-change.php?token=$token&email=$email");
                    exit(0);
                }
            }
            else
            {
                $_SESSION['error'] = "Invalid Token";
                header("Location:password-change.php?token=$token&email=$email");
                exit(0);
            }
        }
        else
        {
            $_SESSION['error'] = "Please Complete All Fields";
            header("Location:password-change.php?token=$token&email=$email");
            exit(0);
        }
    }
    else
    {
        $_SESSION['error'] = "No Token Available";
        header("Location:password-change.php");
        exit(0);
    }
}
?>