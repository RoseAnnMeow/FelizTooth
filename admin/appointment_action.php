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
        $schedule = $_POST['scheddate'];
        $s_time = $_POST['start_time'];
        $e_time = $_POST['end_time'];
        $reason = $_POST['reason'];
        $status = $_POST['status'];

        $sql = "INSERT INTO tblappointment (patient_id,schedule,starttime,endtime,reason,status) VALUES ('$patient_id','$schedule','$s_time','$e_time','$reason','$status')";
        $query_run = mysqli_query($conn,$sql);

        if($query_run)
        {
            $_SESSION['status'] = "<div class='alert alert-success alert-dismissible fade show'>Doctor Schedule Added Successfully";
            header('Location:allappointment.php');
        }
        else
        {
            $_SESSION['status'] = "<div class='alert alert-danger alert-dismissible fade show'>Doctor Schedule Added Unsuccessfully";
            header('Location:allappointment.php');
        }
                
    }

    if(isset($_POST['checking_editbtn']))
    {
        $s_id = $_POST['sched_id'];
        $result_array = [];

        $sql = "SELECT * FROM tblschedule WHERE id='$s_id' ";
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

    if(isset($_POST['update_sched']))
    {
        $id = $_POST['edit_id'];

        $doc_id = $_POST['select_dentist'];
        $day = $_POST['select_day'];
        $s_time = $_POST['start_time'];
        $e_time = $_POST['end_time'];
        $duration = $_POST['select_duration'];

        $sql = "UPDATE tblschedule set doc_id='$doc_id',day='$day',starttime='$s_time',endtime='$e_time', duration='$duration' WHERE id='$id' ";
        $query_run = mysqli_query($conn,$sql);

        if($query_run)
        {
            $_SESSION['status'] = "<div class='alert alert-success alert-dismissible fade show'>Doctor Schedule Updated Successfully";
            header('Location:schedule.php');
        }
        else
        {
            $_SESSION['status'] = "<div class='alert alert-warning alert-dismissible fade show'>Doctor Schedule Updated Unsuccessfully";
            header('Location:schedule.php');
        }
                
    }

    if(isset($_POST['deletedata']))
    {  
        $id = $_POST['delete_id'];
        
        $sql = "DELETE FROM tblschedule WHERE id='$id' ";
        $query_run = mysqli_query($conn,$sql);
        
        if ($query_run)
        {
            $_SESSION['status'] = "<div class='alert alert-success alert-dismissible fade show'>Patient Deleted Successfully";
            header('Location:schedule.php');
        }
        else
        {
            $_SESSION['status'] = "<div class='alert alert-danger alert-dismissible fade show'>Patient Deleted Unsuccessfully";
            header('Location:schedule.php');
        }
    }

?>