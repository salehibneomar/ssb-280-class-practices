<?php

    require '../config/config.php';

    if(isset($_POST['id'])){
        $id = $_POST['id'];

        $query     = "DELETE FROM todolist WHERE id='$id' LIMIT 1";
        $execution = mysqli_query($conn, $query);

        if($execution==true){
            $msgDetails  = "Your work is deleted successfully!";
            echo operationMessage($GLOBALS['succMsgTitle'], $msgDetails);
        }
        else{
            $msgDetails = "Error occured while deleting, try again!";
            echo operationMessage($GLOBALS['errMsgTitle'], $msgDetails);
        }
        
    }

    mysqli_close($conn);

?>