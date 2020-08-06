<?php

    require '../config/config.php';

    if(isset($_POST['update'])){
        $id         = $_POST['id'];
        $workName   = $_POST['workName'];
        $fromDate   = $_POST['fromDate'];
        $toDate     = $_POST['toDate'];

        $query     = "UPDATE todolist SET workName='$workName', fromDate='$fromDate', toDate='$toDate' 
                      WHERE id='$id' LIMIT 1";
        $execution = mysqli_query($conn, $query);
        
        if($execution==true){
            $msgDetails  = "Your work is updated successfully!";
            echo operationMessage($GLOBALS['succMsgTitle'], $msgDetails);
        }
        else{
            $msgDetails = "Error occured while updating, try again!";
            echo operationMessage($GLOBALS['errMsgTitle'], $msgDetails);
        }
    }

    mysqli_close($conn);

    

?>