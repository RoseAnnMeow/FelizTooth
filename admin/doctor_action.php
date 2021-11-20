<?php
    include('authentication.php');
    include('config/dbconn.php');
     
    if(isset($_POST['logout_btn']))
    {
        session_destroy();
        unset($_SESSION['auth']);
        unset($_SESSION['auth_user']);

        $_SESSION['success'] = "Logged out successfully";
        header('Location: login.php');
        exit(0);
    }

    if(isset($_POST['deletedata']))
    {  
        $id = $_POST['delete_id'];
        $del_image = $_POST['del_image'];
        
        $sql = "DELETE FROM tbldoctor WHERE id='$id' ";
        $query_run = mysqli_query($conn,$sql);
        
        if ($query_run)
        {
            $_SESSION['success'] = "Doctor Deleted Successfully";
            header('Location:doctors.php');
        }
        else
        {
            $_SESSION['error'] = "Doctor Deleted Unsuccessfully";
            header('Location:doctors.php');
        }
    }

    if(isset($_POST['updatedoctor']))
    {
        $id = $_POST['edit_id'];
        $fname  = $_POST['fname'];
        $address = $_POST['address'];
        $dob = $_POST['birthday'];
        $gender = $_POST['gender'];
        $phone = $_POST['phone'];
        $doc_email = $_POST['email'];
        $doc_degree = $_POST['degree'];
        $doc_specialty = $_POST['specialty'];
        $password = $_POST['edit_password'];
        $confirmPassword = $_POST['edit_confirmPassword'];
        
        $checkemail = "SELECT email FROM tbldoctor WHERE email='$doc_email' AND id != '$id' ";
        $checkemail_run = mysqli_query($conn, $checkemail);

        if($password == $confirmPassword)
        {
            if(mysqli_num_rows($checkemail_run) > 0)
            {     
                $_SESSION['error'] = "Email Already Exist";
                header('Location:doctors.php');      
            }
            else
            {
                $doctor_profile_image = $_POST["hidden_doctor_profile_image"];

                if($_FILES['edit_docimage']['name'] != '')
                {
                    $allowed_file_format = array('jpg', 'png','jpeg');
    
                    $file_extension = pathinfo($_FILES["edit_docimage"]["name"], PATHINFO_EXTENSION);
    
                    if(!in_array($file_extension, $allowed_file_format))
                    {
                        $_SESSION['error'] = "Upload valiid file. jpg, png";
                        header('Location:doctors.php');
                    }
                    else if (($_FILES["edit_docimage"]["size"] > 2000000))
                    {
                        $_SESSION['error'] = "File size exceeds 2MB";
                        header('Location:doctors.php');
                    }
                    else 
                    {
                        $new_name = rand() . '.' . $file_extension;
    
                        $destination = '../upload/' . $new_name;
    
                        move_uploaded_file($_FILES['edit_docimage']['tmp_name'], $destination);
    
                        $doctor_profile_image = $destination;
                    }
                }
                if($_SESSION['error'] == '')
                {
                    $sql = "UPDATE tbldoctor set name='$fname',address='$address',dob='$dob', gender='$gender', phone='$phone', email='$doc_email', degree='$doc_degree', specialty='$doc_specialty', password='$password', image='$doctor_profile_image' WHERE id='$id' ";
                    $query_run = mysqli_query($conn,$sql);
        
                    if ($query_run)
                    {                   
                        if($_FILES['edit_docimage']['name'] != '')
                        {
                            
                        }      
                        $_SESSION['success'] = "Doctor Updated Successfully";
                        header('Location:doctors.php');
                    }
                    else
                    {
                        $_SESSION['error'] = "Doctor Updated Unsuccessfully";
                        header('Location:doctors.php');
                    }
                }               
               
            }
        }
        else
        {
            $_SESSION['error'] = "Password does not match";
            header('Location:doctors.php');
        }      
    }

    if(isset($_POST['checking_editDoctorbtn']))
    {
        $s_id = $_POST['user_id'];
        $result_array = [];

        $sql = "SELECT * FROM tbldoctor WHERE id='$s_id' ";
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

    if(isset($_POST['checking_viewDoctortbtn']))
    {
        $s_id = $_POST['user_id'];

        $sql = "SELECT * FROM tbldoctor WHERE id='$s_id' ";
        $query_run = mysqli_query($conn,$sql);

        if(mysqli_num_rows($query_run) > 0)
        {
            foreach($query_run as $row)
            {
                ?>
                    <div class="text-center">
                        <?php echo '<img src="'.$row['image'].'" class="img-fluid img-thumbnail" width="120">';?>
                    </div>
                    <h3 class="profile-username text-center"><?php echo $row['name']; ?></h3>
                    <p class="text-muted text-center">Dentist</p>
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
                        <li class="list-group-item">
                            <b>Degree</b> <p class="float-right text-muted"><?php echo $row['degree']; ?></p>
                        </li>
                        <li class="list-group-item">
                            <b>Specialty</b> <p class="float-right text-muted"><?php echo $row['specialty']; ?></>
                        </li>
                    </ul>                        
                   <?php
            }
        }
        else{
            echo $return = "<h5> No Record Found</h5>";
        }
    }
    
    if(isset($_POST['insertdoctor']))
    {
        $doc_fname  = $_POST['fname'];
        $doc_address = $_POST['address'];
        $doc_dob = $_POST['birthday'];
        $doc_gender = $_POST['gender'];
        $doc_phone = $_POST['phone'];
        $doc_email = $_POST['email'];
        $doc_degree = $_POST['degree'];
        $doc_specialty = $_POST['specialty'];
        $password = $_POST['password'];
        $confirmPassword = $_POST['confirmPassword'];

        if($password == $confirmPassword)
        {       
            $checkemail = "SELECT email FROM tbldoctor WHERE email='$doc_email' ";
            $checkemail_run = mysqli_query($conn, $checkemail);

            if(mysqli_num_rows($checkemail_run) > 0)
            {     
                $_SESSION['error'] = "Email Already Exist";
                header('Location:doctors.php');      
            }
            else
            {
                if($_FILES['doc_image']['name'] != '')
                {
                    $allowed_file_format = array('jpg', 'png','jpeg');

                    $doctor_profile_image = $_FILES['doc_image']['name'];

                    $file_extension = pathinfo($doctor_profile_image, PATHINFO_EXTENSION);

                    if(!in_array($file_extension, $allowed_file_format))
                    {
                        $_SESSION['error'] = "Upload valid file. jpg, png";
                        header('Location:doctors.php');
                    }
                    else if (($_FILES['doc_image']['size'] > 2000000))
                    {
                        $_SESSION['error'] = "File size exceeds 2MB";
                        header('Location:doctors.php');
                    }
                    else
                    {
                        $new_name = rand() . '.' . $file_extension;

                        $destination = '../upload/' . $new_name;

                        move_uploaded_file($_FILES['doc_image']['tmp_name'], $destination);

                        $doctor_profile_image = $destination;
                    }
                }
                else
                {
                    $character = $_POST["fname"][0];
                    $path = "../upload/". time() . ".png";
                    $image = imagecreate(200, 200);
                    $red = rand(0, 255);
                    $green = rand(0, 255);
                    $blue = rand(0, 255);
                    imagecolorallocate($image, 230, 230, 230);  
                    $textcolor = imagecolorallocate($image, $red, $green, $blue);
                    imagettftext($image, 100, 0, 55, 150, $textcolor, 'font/arial.ttf', $character);
                    imagepng($image, $path);
                    imagedestroy($image);
                    $doctor_profile_image = $path;
                }

                if($_SESSION['error'] == '')
                {
                    $sql = "INSERT INTO tbldoctor (name,address,dob,gender,phone,email,degree,specialty,image,password)
                    VALUES ('$doc_fname','$doc_address','$doc_dob','$doc_gender','$doc_phone','$doc_email','$doc_degree','$doc_specialty','$doctor_profile_image','$password')";
                    $doctor_query_run = mysqli_query($conn,$sql);
                    if ($doctor_query_run)
                    {     
                        $_SESSION['success'] = "Adding Doctor Successfully";
                        header('Location:doctors.php');
                    }
                    else
                    {
                        $_SESSION['error'] = "Adding Doctor Failed";
                        header('Location:doctors.php');
                    }
                }
              
            }
        }
        else
        {
            $_SESSION['error'] = "Password does not match";
            header('Location:doctors.php');
        }
}
    ?>  