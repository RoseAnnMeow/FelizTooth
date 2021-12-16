<?php
    include('authentication.php');
    include('config/dbconn.php');

    if(isset($_POST['insert_documents']))
    {
        $patient = $_POST['select_patient'];
        $description = $_POST['description'];

        $files = $_FILES['files']['name'];
        $file_extension = pathinfo($files, PATHINFO_EXTENSION);
        $filename = time().'.'.$file_extension;
        

        $sql = "INSERT INTO documents (patient_id,description,document) VALUES ('$patient','$description','$filename')";
        $query_run = mysqli_query($conn,$sql);

        if($query_run)
        {
            move_uploaded_file($_FILES['files']['tmp_name'], '../upload/documents/'.$filename);  
            $_SESSION['success'] = "Documents Added Successfully";
            header('Location: documents.php');
        }
        else 
        {
            $_SESSION['error'] = "Documents Added Unsuccessfull";
            header('Location: documents.php');
        }

    }

?>