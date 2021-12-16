<?php
    include('authentication.php');
    include('config/dbconn.php');

    if(isset($_POST['system_details']))
    {
        $sysname = $_POST['sysname'];
        $title = $_POST['title'];
        $address = $_POST['address'];
        $telephone = $_POST['telephone'];
        $email = $_POST['email'];
        $mobile = $_POST['mobile'];

        $old_image = $_POST['old_image'];
        $image = $_FILES['img_url']['name'];
        
        $update_filename ="";
        if($image!=null)
        {
            $image_extension = pathinfo($image, PATHINFO_EXTENSION);
            $allowed_file_format = array('jpg', 'png','jpeg');
            if(!in_array($image_extension, $allowed_file_format))
            {
                $_SESSION['error'] = "Upload valid file. jpg, png";
                header('Location:settings.php');
            }
            else if (($_FILES['img_url']['size'] > 5000000))
            {
                $_SESSION['error'] = "File size exceeds 5MB";
                header('Location:settings.php');
            }
            else 
            {
                $filename = time().'.'.$image_extension;
                $update_filename = $filename;
            }                      
        }
        else
        {
            $update_filename = $old_image;
        }
        if($_SESSION['error'] == '')
        {
            $sql = "UPDATE system_details SET sysname='$sysname',title='$title',address='$address',telno='$telephone',email='$email',mobile='$mobile',logo='$update_filename' WHERE id='1'";
            $query_run = mysqli_query($conn,$sql);

            if($query_run)
            {
                if($image != NULL)
                {
                    if(file_exists('../upload/logo/'.$old_image))
                    {
                        unlink("../upload/logo/".$old_image);
                    }
                    move_uploaded_file($_FILES['img_url']['tmp_name'], '../upload/logo/'.$update_filename);
                }
                $_SESSION['success'] = "Settings Updated Successfully";
                header('Location: settings.php');
            }
            else
            {
                $_SESSION['error'] = "Settings Update Failed";
                header('Location: settings.php');
            }
        }
    }


?>