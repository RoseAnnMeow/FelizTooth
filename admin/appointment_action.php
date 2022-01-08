<?php
include('authentication.php');
include('config/dbconn.php');

date_default_timezone_set("Asia/Manila");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';

function sendEmail($patient_name,$patient_email,$patient_date,$patient_time,$patient_phone,$reason,$date_submission)
{
    $mail = new PHPMailer(true);
    $mail->isSMTP();                                         
    $mail->Host       = 'smtp.gmail.com'; 
    $mail->SMTPAuth   = true;                 
    $mail->Username   = 'feliztoothdev@gmail.com';                  
    $mail->Password   = 'felizdevelopers123';  

    $mail->SMTPSecure = 'tls';                                
    $mail->Port       = 587;                      

    $mail->setFrom('feliztoothdev@gmail.com','Feliz Tooth District');
    $mail->addAddress($patient_email);  
    
    $mail->isHTML(true);  $mail = new PHPMailer(true);
    $mail->isSMTP();                                         
    $mail->Host       = 'smtp.gmail.com'; 
    $mail->SMTPAuth   = true;                 
    $mail->Username   = 'feliztoothdev@gmail.com';                  
    $mail->Password   = 'felizdevelopers123';  

    $mail->SMTPSecure = 'tls';                                
    $mail->Port       = 587;                                      
    $mail->Subject = 'Set an Appointment | Feliz Tooth District Dental Clinic';
    $email_template = 
                    '<p>Appointment Submitted on ' .$date_submission.'</p>
                    <p>Appointment Details<br>
                    Name: ' .$patient_name. '<br>
                    Contact Number: ' .$patient_phone. '<br>
                    Email: ' .$patient_email. '<br>
                    Preferred Date: ' .$patient_date. '<br>
                    Time: ' .$patient_time. '</p>
                    <p>Your concerns: ' . $reason. '</p>
                    <p>Reminder: Do not forget to weak face mask to reduce the spread of the coronavirus</p>
                    <p>Thank you!<br>
                    Feliz Tooth District Team</p>'
                    ;
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

    if(isset($_POST['logout_btn']))
    {
        session_destroy();
        unset($_SESSION['auth']);
        unset($_SESSION['auth_role']);
        unset($_SESSION['auth_user']);

        $_SESSION['status'] = "Logged out successfully";
        header('Location: login.php');
        exit(0);
    }

    if(isset($_POST['insert_appointment']))
    {
        $patient_id = $_POST['select_patient'];
        $doctor_id = $_POST['select_dentist'];
        $schedule = $_POST['scheddate'];
        $s_time = $_POST['start_time'];
        $e_time = $_POST['end_time'];
        $reason = $_POST['reason'];
        $status = $_POST['status'];
        $bgcolor = $_POST['color'];
        $schedtype = 'Walk-in Schedule';
        $date_submitted = date('Y-m-d H:i:s');
        $send_email = $_POST['send-email'];

        $systemlogo = "SELECT * from system_details";
        $systemdetails = mysqli_query($conn,$systemlogo);
        $systemdata = mysqli_fetch_array($systemdetails);
        $system_logo = $systemdata['logo'];

        $fulldata = "SELECT a.*, CONCAT(p.fname,' ',p.lname) AS pname,p.phone,p.email,a.created_at FROM tblappointment a INNER JOIN tblpatient p WHERE p.id ='$patient_id'";
        $appdetails = mysqli_query($conn,$fulldata);
        $patient_data = mysqli_fetch_array($appdetails);
        $patient_name = $patient_data['pname'];
        $date_submission = date('l, F j, Y',strtotime($patient_data['created_at']));
        $patient_email = $patient_data['email'];
        $patient_date = date('l, F j, Y',strtotime($patient_data['schedule']));
        $patient_phone = $patient_data['phone'];
        $patient_time = $s_time;

        if(!empty($_POST['send-email']))
        {
            sendEmail($patient_name,$patient_email,$patient_date,$patient_time,$patient_phone,$reason,$date_submission);  
        }

        $sql = "INSERT INTO tblappointment (patient_id,doc_id,schedule,starttime,endtime,reason,schedtype,status,bgcolor,created_at) VALUES ('$patient_id','$doctor_id','$schedule','$s_time','$e_time','$reason','$schedtype','$status','$bgcolor','$date_submitted')";
        $query_run = mysqli_query($conn,$sql);

        if($query_run)
        {
            
            $_SESSION['success'] = "Appointment Added Successfully";
            header('Location:appointment.php');
        }
        else
        {
            $_SESSION['error'] = "Appointment Failed to Add";
            header('Location:appointment.php');
        }
                
    }

    if(isset($_POST['checking_editbtn']))
    {
        $s_id = $_POST['app_id'];
        $result_array = [];

        $sql = "SELECT * FROM tblappointment WHERE id='$s_id' ";
        $query_run = mysqli_query($conn,$sql);

        if(mysqli_num_rows($query_run) > 0)
        {
            foreach($query_run as $row)
            {
               array_push($result_array, $row);              
            }
            header('Content-type: application/json');
            echo json_encode($result_array);
        }
        else{
            echo $return = "<h5> No Record Found</h5>";
        }
    }

    if(isset($_POST['update_appointment']))
    {
        $id = $_POST['edit_id'];

        $patient_id = $_POST['select_patient'];
        $doctor_id = $_POST['select_dentist'];
        $schedule = $_POST['scheddate'];
        $s_time = $_POST['start_time'];
        $e_time = $_POST['end_time'];
        $reason = $_POST['reason'];
        $status = $_POST['status'];
        $bgcolor = $_POST['color'];
        $send_email = $_POST['send-email'];

        $systemlogo = "SELECT * from system_details";
        $systemdetails = mysqli_query($conn,$systemlogo);
        $systemdata = mysqli_fetch_array($systemdetails);
        $system_logo = $systemdata['logo'];

        $fulldata = "SELECT a.*, CONCAT(p.fname,' ',p.lname) AS pname,p.phone,p.email,a.created_at FROM tblappointment a INNER JOIN tblpatient p WHERE p.id ='$patient_id'";
        $appdetails = mysqli_query($conn,$fulldata);
        $patient_data = mysqli_fetch_array($appdetails);
        $patient_name = $patient_data['pname'];
        $date_submission = date('l, F j, Y',strtotime($patient_data['created_at']));
        $patient_email = $patient_data['email'];
        $patient_date = date('l, F j, Y',strtotime($patient_data['schedule']));
        $patient_phone = $patient_data['phone'];
        $patient_time = $s_time;

        if(!empty($_POST['send-email']))
        {
            sendEmail($patient_name,$patient_email,$patient_date,$patient_time,$patient_phone,$reason,$date_submission);  
        }


        $sql = "UPDATE tblappointment set patient_id='$patient_id',doc_id='$doctor_id',schedule='$schedule',starttime='$s_time',endtime='$e_time', reason='$reason',status='$status',bgcolor='$bgcolor' WHERE id='$id' ";
        $query_run = mysqli_query($conn,$sql);

        if($query_run)
        {
            $_SESSION['success'] = "Appointment Updated Successfully";
            header('Location:appointment.php');
        }
        else
        {
            $_SESSION['error'] = "Appointment Failed to Update";
            header('Location:appointment.php');
        }
                
    }

    if(isset($_POST['deletedata']))
    {  
        $id = $_POST['delete_id'];
        
        $sql = "DELETE FROM tblappointment WHERE id='$id' ";
        $query_run = mysqli_query($conn,$sql);
        
        if ($query_run)
        {
            $_SESSION['success'] = "Appointment Deleted Successfully";
            header('Location:appointment.php');
        }
        else
        {
            $_SESSION['error'] = "Appointment Failed to Delete";
            header('Location:appointment.php');
        }
    }

?>