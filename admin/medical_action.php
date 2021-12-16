<?php
    include('authentication.php');
    include('config/dbconn.php');

    if(isset($_POST['dental_record']))
    {
        $patient = $_POST['patient'];
        $dentist = $_POST['dentist'];
        $visit = $_POST['visit'];

        $sql = "INSERT INTO dental_history (patient_id,dentist,visit) values ('$patient','$dentist','$visit')";
        $query_run = mysqli_query($conn,$sql);

        if($query_run)
        {
            $_SESSION['success'] = 'Dental Record Added Successfully';
            header('Location:patient-details.php?id='.$patient);
        }
        else
        {
            $_SESSION['error'] = 'Dental Record Added Unsuccessfull';
            header('Location:patient-details.php?id='.$patient);
        }
    }

    if(isset($_POST['dental_editbtn']))
    {
        $id = $_POST['user_id'];
        $result_array = [];

        $sql = "SELECT * FROM dental_history WHERE id='$id'";
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

    if(isset($_POST['update_dental']))
    {
        $id = $_POST['edit_id'];
        $userid = $_POST['userid'];
        $dentist = $_POST['dentist'];
        $visit = $_POST['visit'];

        $sql = "UPDATE dental_history set dentist='$dentist',visit='$visit' WHERE id='$id' ";
        $query_run = mysqli_query($conn,$sql);

        if($query_run)
        {
            $_SESSION['success'] = "Dental Record Updated Successfully";
            header('Location:patient-details.php?id='.$userid);
        }
        else 
        {
            $_SESSION['error'] = "Dental Record Updated Unsuccessfull";
            header('Location:patient-details.php?id='.$userid);
        }

    }

    if(isset($_POST['delete_dental']))
    {
        $patient = $_POST['patient'];
        $id = $_POST['user_id'];
        
        $sql = "DELETE FROM dental_history WHERE id='$id' ";
        $query_run = mysqli_query($conn,$sql);
        
        if ($query_run)
        {
            $_SESSION['success'] = "Dental Record Deleted Successfully";
            header('Location:patient-details.php?id='.$patient);
        }
        else
        {
            $_SESSION['error'] = "Dental Record Deleted Unsuccessfull";
            header('Location:patient-details.php?id='.$patient);
        }
    }
?>