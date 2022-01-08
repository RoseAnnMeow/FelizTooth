<?php
include('authentication.php');
include('config/dbconn.php');

date_default_timezone_set("Asia/Manila");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';

function sendEmail($pdf,$patient_name,$patient_lname,$patient_email,$patient_date,$patient_time,$patient_phone,$reason,$date_submission)
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
    $mail->addStringAttachment($pdf,"FTD-$patient_lname.pdf");
    // Content
    $mail->isHTML(true);                                  
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
                    <p>Print, sign and bring the attached PDF on the date of your appointment. This<br>
                    will serve also as proof of appointment.</p>
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
        $system_address = $systemdata['address'];
        $system_mobile = $systemdata['mobile'];
        $system_email = $systemdata['email'];

        $fulldata = "SELECT a.*, CONCAT(p.fname,' ',p.lname) AS pname,p.lname,p.phone,p.email,a.created_at FROM tblappointment a INNER JOIN tblpatient p WHERE p.id ='$patient_id'";
        $appdetails = mysqli_query($conn,$fulldata);
        $patient_data = mysqli_fetch_array($appdetails);
        $patient_name = $patient_data['pname'];
        $patient_lname = $patient_data['lname'];
        $date_submission = date('l, F j, Y',strtotime($patient_data['created_at']));
        $patient_email = $patient_data['email'];
        $patient_date = date('l, F j, Y',strtotime($patient_data['schedule']));
        $patient_phone = $patient_data['phone'];
        $patient_time = $s_time;

        if(!empty($_POST['send-email']))
        {
            $mpdf = new \Mpdf\Mpdf();
            $answer = array();
            $qanda = "SELECT h.answer,h.question_id,q.questions from health_declaration h INNER JOIN questionnaires q ON h.question_id = q.id WHERE h.patient_id = '$patient_id'";
            $query_run = mysqli_query($conn,$qanda);
            $data = '
            <html>

            <head>
              <style>
                body {
                  font-size: 12px;
                }
            
                .clearfix {
                  clear: both;
                }
            
                .img {
                  float: left;
                }
              </style>
            </head>
            
            <body>
              <div class="container-fluid">
                <div class="row">
                  <div class="col-md-8">
                    <div class="invoice p-3 mb-3" id="prescription">
                        <img src="../upload/logo/'.$system_logo.'" height="100" alt="Logo">
                      <br>
                      <table class="table" style="width:100%;">
                        <tr>
                          <td>Name: <b>'.$patient_name.'</b></td>
                          <td>Date Submitted: <b>'.$date_submission.'</b></td>
                        </tr>
                        <tr>
                          <td>Email: <b>'.$patient_email.'</b></td>
                          <td>Contact Number:<b>'.$patient_phone.'</b></td>
                        </tr>
                        <tr>
                          <td>Date of Visit: <b>'.$patient_date.'</b></td>
                          <td>Time of Visit: <b>'.$patient_time.'</b></td>
                        </tr>
                      </table>
                      <p>Your concern: '.$reason.'</p>
                      Health Declaration';
                      while($row = mysqli_fetch_array($query_run))
                      {
                      $data .= '<ul>
                        <li>'.$row['questions'].' <b>'.$row['answer'].'</b>
                        <li>
                      </ul>';
                      }
                      $data .='
                      <br>
                      <table class="table" style="width:100%;">
                        <tr>
                          <td>Patient\'s or Guardian\'s Full Name:</td>
                          <td>Signature:</td>
                        </tr>
                        <tr>
                          <td>Relationship to Patient:</td>
                          <td>Date Signed:</td>
                        </tr>
                        <tr>
                          <td>Confirmed Date & Time of Visit:</td>
                        </tr>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
              </div>
            </body>
            
            </html>                              
            ';
                      
            $mpdf->WriteHtml($data);
            $pdf = $mpdf->output("","S");
            sendEmail($pdf,$patient_name,$patient_lname,$patient_email,$patient_date,$patient_time,$patient_phone,$reason,$date_submission);  
        }


        $sql = "UPDATE tblappointment set patient_id='$patient_id',doc_id='$doctor_id',schedule='$schedule',starttime='$s_time',endtime='$e_time', reason='$reason',status='$status',bgcolor='$bgcolor' WHERE id='$id' ";
        $query_run = mysqli_query($conn,$sql);

        if($query_run)
        {
            $_SESSION['success'] = "Online Appointment Request Scheduled Successfully";
            header('Location:online-request.php');
        }
        else
        {
            $_SESSION['error'] = "Online Appointment Request Failed to Scheduled";
            header('Location:online-request.php');
        }
                
    }

    if(isset($_POST['deletedata']))
    {  
        $id = $_POST['delete_id'];
        
        $sql = "DELETE FROM tblappointment WHERE id='$id' ";
        $query_run = mysqli_query($conn,$sql);
        
        if ($query_run)
        {
            $_SESSION['success'] = "Online Appointment Request Successfully";
            header('Location:online-request.php');
        }
        else
        {
            $_SESSION['error'] = "Online Appointment Request Failed to Delete";
            header('Location:online-request.php');
        }
    }

?>