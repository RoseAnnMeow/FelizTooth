<?php
    include('authentication.php');
    include('config/dbconn.php');

    if(isset($_POST['userid']))
    {
        $id = $_POST['userid'];
        $sql = "SELECT a.*, CONCAT(p.fname,' ',p.lname) AS pname,p.phone,p.email,d.name AS dname FROM tblappointment as a JOIN tblpatient as p ON p.id = a.patient_id JOIN tbldoctor as d ON d.id = a.doc_id WHERE a.id = '$id' ";
        $query_run = mysqli_query($conn,$sql);
        
        if(mysqli_num_rows($query_run) > 0)
        {
            foreach($query_run as $row)
            {
                ?>
                <table class="table table-borderless table-responsive table-sm">
                    <thead>
                        <tr>
                            <th style="width: 40px"></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>                          
                            <th class="text-muted">Client:</th>
                            <td id="client-label" data-id='<?php echo $id; ?>'><a href=""><?php echo $row['pname'];?></a></br>
                            <?php echo $row['phone'];?></br>
                            <?php echo $row['email'];?></td>
                        </tr>
                        <tr>
                            <th class="text-muted">Doctor:</th>
                            <td><?php echo $row['dname'];?></td>
                        </tr>
                        <tr>
                            <th class="text-muted">Date:</th>
                            <td><?php echo date('F, j Y',strtotime($row['schedule'])); ?></td>
                        </tr>
                        <tr>
                            <th class="text-muted">Time:</th>
                            <td><?php echo date('h:i A',strtotime($row['starttime'])).' - '.date('h:i A',strtotime($row['endtime'])); ?></td>
                        </tr>
                        <tr>
                            <th class="text-muted">Reason:</th>
                            <td><?php echo $row['reason']; ?></td>
                        </tr>
                        <tr>
                            <th class="text-muted">Status:</th>
                            <td>
                                <?php 
                                    if($row['status'] == 'Confirmed')
                                    {
                                        echo $row['status'] = '<span class="badge badge-success">Confirmed</span>';
                                    }
                                ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <?php
            }
        }
        else{
            echo $return = "<h5> No Record Found</h5>";
        }
    }
    
?>
