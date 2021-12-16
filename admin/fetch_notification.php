<?php
    include('authentication.php');
    include('config/dbconn.php');

    if(isset($_POST["view"])){
	
        if($_POST["view"] != ''){
            mysqli_query($conn,"update notification set seen_status='1' where seen_status='0'");
        }
        
        $query=mysqli_query($conn,"SELECT CONCAT(p.fname,' ',p.lname) AS pname,n.created_at FROM notification n INNER JOIN tblpatient p ON n.patient_id = p.id ORDER BY n.id desc limit 5");
        $output = '';
        $count = mysqli_num_rows($query);
     
        if(mysqli_num_rows($query) > 0){
        while($row = mysqli_fetch_array($query)){
        $output .= '
        
        
            <a href="#" class="dropdown-item">
            <div class="media">
              <img src="assets/dist/img/user8-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
              <h3 class="dropdown-item-title">
              '.$row['pname'].'
            </h3>
            <p class="text-sm">Request an Appointment</p>
            <p class="text-sm text-muted">'.date('d M \a\t g:i a',strtotime($row['created_at'])).'</p>
            </div>
            </div>
          </a>
        
        ';
        }
        }
        else{
        $output .= '<li><a href="#" class="text-bold text-italic">No Notification Found</a></li>';
        }
        
        $query1=mysqli_query($conn,"select * from notification where seen_status='0'");
        $count = mysqli_num_rows($query1);
        $data = array(
            'notification'   => $output,
            'unseen_notification' => $count
        );
        echo json_encode($data);
        
    }
?>