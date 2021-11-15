<?php
    session_start();
    include('config/dbconn.php');
    
    if(isset($_POST['insertdata']))
    {  
        $fname  = $_POST['fname'];
        $address = $_POST['address'];
        $dob = $_POST['birthday'];
        $gender = $_POST['gender'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
         
        $sql = "INSERT INTO tblpatient (fname,address,dob,gender,phone,email)
        VALUES ('$fname','$address','$dob','$gender','$phone','$email')";
        $patient_query_run = mysqli_query($conn,$sql);
        if ($patient_query_run)
        {      
            $_SESSION['status'] = "Adding Patient Successfully";
            header('Location:patients.php');
        }
        else
        {
            $_SESSION['status'] = "Adding Patient Failed";
            header('Location:patients.php');
        }
    }

    if(isset($_POST['userid']))
    {
        $s_id = $_POST['userid'];
        //echo $return = $s_id;

        $sql = "SELECT * FROM tblpatient WHERE id='$s_id' ";
        $query_run = mysqli_query($conn,$sql);

        if(mysqli_num_rows($query_run) > 0)
        {
            foreach($query_run as $row)
            {
                ?>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Name</label>
                            <p class="data-label"><?php echo $row['fname']; ?></p>
                            <label>Address</label>
                            <p class="data-label"><?php echo $row['address']; ?></p>
                            <label>Phone</label>
                            <p class="data-label"><?php echo $row['phone']; ?></p>
                        </div>
                    </div>
                    <div class="col-sm-6 auto">
                        <div class="form-group">
                            <label>Birthdate</label>
                            <p class="data-label"><?php echo $row['dob']; ?></p>
                            <label>Gender</label>
                            <p class="data-label"><?php echo $row['gender']; ?></p>
                            <label>Email</label>
                            <p class="data-label"><?php echo $row['email']; ?></p>
                        </div>
                    </div>
                </div>                               
                   <?php
            }
        }
        else{
            echo $return = "<h5> No Record Found</h5>";
        }
    }
    
        
    if(isset($_POST['checking_editbtn']))
    {
        $s_id = $_POST['user_id'];
        $result_array = [];

        $sql = "SELECT * FROM tblpatient WHERE id='$s_id' ";
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

    if(isset($_POST['updatedata']))
    {
        $id = $_POST['edit_id'];
        $fname  = $_POST['fname'];
        $address = $_POST['address'];
        $dob = $_POST['birthday'];
        $gender = $_POST['gender'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];

        $sql = "UPDATE tblpatient set fname='$fname',address='$address',dob='$dob', gender='$gender', phone='$phone', email='$email' WHERE id='$id' ";
        $query_run = mysqli_query($conn,$sql);

        if ($query_run)
        {
            $_SESSION['status'] = "Patient Updated Successfully";
            header('Location:patients.php');
        }
        else
        {
            $_SESSION['status'] = "Patient Updated Unsuccessfully";
        }
    }

    if(isset($_POST['deletedata']))
    {  
        $id = $_POST['delete_id'];
        
        $sql = "DELETE FROM tblpatient WHERE id='$id' ";
        $query_run = mysqli_query($conn,$sql);
        
        if ($query_run)
        {
            $_SESSION['status'] = "Patient Deleted Successfully";
            header('Location:patients.php');
        }
        else
        {
            $_SESSION['status'] = "Patient Deleted Unsuccessfully";
        }
    }
?>                                                                   
