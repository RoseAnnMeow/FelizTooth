<?php
    if(isset($_SESSION['status']))
    {
        echo $_SESSION['status'];
    ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <?php
        unset($_SESSION['status']);      
    }
?>