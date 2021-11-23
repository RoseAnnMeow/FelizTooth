<?php
    include('authentication.php');
    include('config/dbconn.php');

    if(isset($_POST['logout_btn']))
    {
        session_destroy();
        unset($_SESSION['auth']);
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

        $sql = "INSERT INTO tblappointment (patient_id,doc_id,schedule,starttime,endtime,reason,status,bgcolor) VALUES ('$patient_id','$doctor_id','$schedule','$s_time','$e_time','$reason','$status','$bgcolor')";
        $query_run = mysqli_query($conn,$sql);

        if($query_run)
        {
            $_SESSION['success'] = "Appointment Added Successfully";
            header('Location:appointment.php');
        }
        else
        {
            $_SESSION['error'] = "Appointment Added Unsuccessfully";
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

        $sql = "UPDATE tblappointment set patient_id='$patient_id',doc_id='$doctor_id',schedule='$schedule',starttime='$s_time',endtime='$e_time', reason='$reason',status='$status' WHERE id='$id' ";
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