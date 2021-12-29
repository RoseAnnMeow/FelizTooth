<?php
    include('authentication.php');
    include('admin/config/dbconn.php');

    if(isset($_POST['insertdata']))
    {
        $patient_id = $_POST['userid'];
        $schedule = $_POST['scheddate'];
        $status = 'Pending';
        $schedtype = "Online Schedule";
        $concern = $_POST['concern'];
        $item = implode(',',$concern);

        foreach($_POST as $key => $val)
        {
            if(substr($key, 0, 3) == 'ans')
            {
                $key = substr($key,4);
                $sql = "INSERT INTO health_declaration (patient_id,question_id,answer) VALUES ('$patient_id','$key','$val') ";
                $query_run = mysqli_query($conn,$sql);
            }
        }           
       

        $sql = "INSERT INTO tblappointment (patient_id,schedule,reason,schedtype,status) VALUES ('$patient_id','$schedule','$item','$schedtype','$status')";
        $query_run = mysqli_query($conn,$sql);

        if($query_run)
        {
            $_SESSION['success'] = "Appointment Submitted Successfully";
            header('Location: dashboard.php');
        }
        else{
            $_SESSION['error'] = "Appointment Submission Failed";
            header('Location: dashboard.php');
        }

        $sql = "INSERT INTO notification (patient_id) VALUES ('$patient_id')";
        $query_run = mysqli_query($conn,$sql);
    }


?>