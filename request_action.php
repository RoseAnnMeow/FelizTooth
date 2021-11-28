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

        $sql = "INSERT INTO tblappointment (patient_id,schedule,reason,schedtype,status) VALUES ('$patient_id','$schedule','$item','$schedtype','$status')";
        $query_run = mysqli_query($conn,$sql);

        if($query_run)
        {
            $_SESSION['success'] = "Appointment Submitted Successfully";
            header('Location: index.php');
        }
        else{
            $_SESSION['error'] = "Appointment Submission Failed";
            header('Location: index.php');
        }
    }

?>