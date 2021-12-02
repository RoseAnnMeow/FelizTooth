<?php
    include('authentication.php');
    include('config/dbconn.php');
    
    if(isset($_POST['logout_btn']))
    {
        session_destroy();
        unset($_SESSION['auth']);
        unset($_SESSION['auth_role']);
        unset($_SESSION['auth_user']);

        $_SESSION['success'] = "Logged out successfully";
        header('Location: login.php');
        exit(0);
    }

    if(isset($_POST['insertpatient']))
    {  
        $fname  = $_POST['fname'];
        $lname  = $_POST['lname'];
        $address = $_POST['address'];
        $dob = $_POST['birthday'];
        $gender = $_POST['gender'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $role ='';
        $password = $_POST['password'];
        $confirmPassword = $_POST['confirmPassword'];
        
        if($password == $confirmPassword)
        {
            $hash = password_hash($password,PASSWORD_DEFAULT);
            $checkemail = "SELECT email FROM tblpatient WHERE email='$email' ";
            $checkemail_run = mysqli_query($conn, $checkemail);

            if(mysqli_num_rows($checkemail_run) > 0)
            {           
                $_SESSION['error'] = "Email Already Exist";
                header('Location:patients.php');
            }
            else
            {
                $sql = "INSERT INTO tblpatient (fname,lname,address,dob,gender,phone,email,password,role)
                VALUES ('$fname','$lname','$address','$dob','$gender','$phone','$email','$hash','3')";
                $patient_query_run = mysqli_query($conn,$sql);
                if ($patient_query_run)
                {      
                    $_SESSION['success'] = "Adding Patient Successfully";
                    header('Location:patients.php');
                }
                else
                {
                    $_SESSION['error'] = "Adding Patient Failed";
                    header('Location:patients.php');
                }
            }           
            
        }
        else
        {
            $_SESSION['error'] = "Password does not match";
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
                <h3 class="profile-username text-center"><?php echo $row['fname'].' '.$row['lname']; ?></h3>
                <p class="text-muted text-center">Patient</p>
                <ul class="list-group list-group-unbordered mb-2">
                    <li class="list-group-item">
                        <b>Email</b> <p class="float-right text-muted"><?php echo $row['email']; ?></p>
                    </li>
                    <li class="list-group-item">
                        <b>Phone</b> <p class="float-right text-muted"><?php echo $row['phone']; ?></p>
                    </li>
                    <li class="list-group-item">
                        <b>Address</b> <p class="float-right text-muted"><?php echo $row['address']; ?></p>
                    </li>
                    <li class="list-group-item">
                        <b>Birthday</b> <p class="float-right text-muted"><?php echo $row['dob']; ?></p>
                    </li>
                    <li class="list-group-item">
                        <b>Gender</b> <p class="float-right text-muted"><?php echo $row['gender']; ?></p>
                    </li>  
                </ul>                 
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
        $lname  = $_POST['lname'];
        $address = $_POST['address'];
        $dob = $_POST['birthday'];
        $gender = $_POST['gender'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirmPassword = $_POST['confirmPassword'];

        if($password == $confirmPassword)
        {
            $checkemail = "SELECT email FROM tblpatient WHERE email='$email' AND id != '$id' ";
            $checkemail_run = mysqli_query($conn, $checkemail);
    
            if(mysqli_num_rows($checkemail_run) > 0)
            {           
                $_SESSION['error'] = "Email Already Exist";
                header('Location:patients.php');
            }
            else
            {
                $sql = "UPDATE tblpatient set fname='$fname',lname='$lname',address='$address',dob='$dob', gender='$gender', phone='$phone', email='$email', password='$password' WHERE id='$id' ";
                $query_run = mysqli_query($conn,$sql);
    
                if ($query_run)
                {
                    $_SESSION['success'] = "Patient Updated Successfully";
                    header('Location:patients.php');
                }
                else
                {
                    $_SESSION['error'] = "Patient Updated Unsuccessfully";
                    header('Location:patients.php');
                }
            }
    
        }
        else
        {
            $_SESSION['error'] = "Password does not match";
            header('Location:patients.php');
        }

   
        
    }

    if(isset($_POST['deletedata']))
    {  
        $id = $_POST['delete_id'];
        
        $sql = "DELETE FROM tblpatient WHERE id='$id' ";
        $query_run = mysqli_query($conn,$sql);
        
        if ($query_run)
        {
            $_SESSION['success'] = "Patient Deleted Successfully";
            header('Location:patients.php');
        }
        else
        {
            $_SESSION['error'] = "Patient Deleted Unsuccessfully";
        }
    }


?>                                                                   
