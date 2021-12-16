<?php
include('authentication.php');
include('config/dbconn.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';

function sendEmail($pdf,$patient_name,$patient_email,$patient_date,$patient_time,$patient_phone,$reason)
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
    
    //Recipients
    $mail->addStringAttachment($pdf,"attachment.pdf");
    // Content
    $mail->isHTML(true);                                  
    $mail->Subject = 'Set an Appointment | Feliz Tooth District Dental Clinic';
    $email_template = 
                    '<p>Appointment Submitted on ' .$patient_date. ' - ' .$patient_time.'</p>
                    <p>Appointment Details<br>
                    Full name: ' .$patient_name. '<br>
                    Contact Number: ' .$patient_phone. '<br>
                    Email: ' .$patient_email. '<br>
                    Preferred Date: ' .$patient_date. '<br>
                    Time: ' .$patient_time. '</p>
                    <p>Your concerns: ' . $reason. '</p>
                    <p>Print, sign and bring the attached PDF on the date of your appointment. This<br>
                    will serve also as proof of appointment. We will confirm your appointment via<br>
                    email or call 2 to 3 days before your appointment date.</p>
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
        $send_email = $_POST['send-email'];

        $fulldata = "SELECT a.*, CONCAT(p.fname,' ',p.lname) AS pname,p.phone,p.email FROM tblappointment a INNER JOIN tblpatient p WHERE p.id ='$patient_id'";
        $appdetails = mysqli_query($conn,$fulldata);
        $patient_data = mysqli_fetch_array($appdetails);
        $patient_name = $patient_data['pname'];
        $patient_email = $patient_data['email'];
        $patient_date = date('D, F j, Y',strtotime($patient_data['schedule']));
        $patient_phone = $patient_data['phone'];
        $patient_time = $s_time;

        if(!empty($_POST['send-email']))
        {
            $mpdf = new \Mpdf\Mpdf();
            $data = "";
            $data .= "<h1>Your Details</h1>";
            $data .= "<strong>Name:</strong> " . $patient_name . "<br>";
            $data .= "<strong>Contact Number:</strong> " .$patient_phone. "<br>";
            $data .= "<strong>Email:</strong> " . $patient_email . "<br>";
            $data .= "<strong>Date & Time of Visit:</strong> " . $patient_date ." - ". $s_time ."<br>";
            $data .= "<strong>Date Submitted:</strong> " . date('F j, Y',strtotime($patient_data['created_at'])) ." - ". $s_time ."<br>";
            $mpdf->WriteHtml($data);
            $pdf = $mpdf->output("","S");
            sendEmail($pdf,$patient_name,$patient_email,$patient_date,$patient_time,$patient_phone,$reason);  
        }

        // $sql = "INSERT INTO tblappointment (patient_id,doc_id,schedule,starttime,endtime,reason,schedtype,status,bgcolor) VALUES ('$patient_id','$doctor_id','$schedule','$s_time','$e_time','$reason','$schedtype','$status','$bgcolor')";
        // $query_run = mysqli_query($conn,$sql);

        // if($query_run)
        // {
            
        //     $_SESSION['success'] = "Appointment Added Successfully";
        //     header('Location:appointment.php');
        // }
        // else
        // {
        //     $_SESSION['error'] = "Appointment Added Unsuccessfully";
        //     header('Location:appointment.php');
        // }
                
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

        $sql = "UPDATE tblappointment set patient_id='$patient_id',doc_id='$doctor_id',schedule='$schedule',starttime='$s_time',endtime='$e_time', reason='$reason',status='$status',bgcolor='$bgcolor' WHERE id='$id' ";
        $query_run = mysqli_query($conn,$sql);

        if($query_run)
        {
            $_SESSION['success'] = "Appointment Updated Successfully";
            header('Location:appointment.php');
        }
        else
        {
            $_SESSION['error'] = "Appointment Updated Unsuccessfully";
            header('Location:appointment.php');
        }
                
    }

    if(isset($_POST['editbtn_status']))
    {
        $new_status = $_POST['new_status'];
        $update_status = $_POST['update_status'];
        $extract_id = implode(',', $update_status);

        $sql = "UPDATE tblappointment set status='$new_status' WHERE id IN($extract_id) ";
        $query_run = mysqli_query($conn,$sql);

        if($query_run)
        {
            $_SESSION['success'] = "Appointment Status Updated Successfully";
            header('Location:appointment.php');
        }
        else
        {
            $_SESSION['error'] = "Appointment Status Updated Unsuccessfully";
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
            $_SESSION['error'] = "Appointment Deleted Unsuccessfully";
            header('Location:appointment.php');
        }
    }

?>