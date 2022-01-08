<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';

$success="";
function sendEmail($name,$email,$subject,$message)
{
    $mail = new PHPMailer(true);
    $mail->isSMTP();                                         
    $mail->Host       = 'smtp.gmail.com'; 
    $mail->SMTPAuth   = true;                 
    $mail->Username   = 'feliztoothdev@gmail.com';                  
    $mail->Password   = 'felizdevelopers123';  

    $mail->SMTPSecure = 'tls';                                
    $mail->Port       = 587;      
    $mail->setFrom($email,$name);
    $mail->addAddress('feliztoothdev@gmail.com'); 
    $mail->addReplyTo($email,$name); 
    $mail->isHTML(true);
    $mail->Subject = 'Contact Form | ' .$subject;
    $mail->Body = '<p>Name: '.$name.'<br> 
                        Email: '.$email.'<br>
                        Message: '.$message.'</h3>';
    try
    {
        $mail->send();
    }
    catch(Exception $e)
    {
        $success =  "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
if(isset($_POST['submit']))
{
    $results = '';
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    sendEmail($name,$email,$subject,$message); 
    if($success == '')
    {
        $data =  'Thanks';
        header('Location: contact-us.php');
    }

}
?>