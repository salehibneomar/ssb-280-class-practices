<?php

    require '../config/config.php';
             
    if(isset($_POST['create'])){
        $workName   = $_POST['title'];
        $fromDate   = $_POST['fromDate'];
        $toDate     = $_POST['toDate'];

        $query     = "INSERT INTO todolist(workName, fromDate, toDate) 
                                    VALUES('$workName', '$fromDate', '$toDate')";
        $execution = mysqli_query($conn, $query);
        
        if($execution==true){
            $msgDetails  = "Your work is created successfully!";
            echo operationMessage($GLOBALS['succMsgTitle'], $msgDetails);
        }
        else{
            $msgDetails = "Error occured while creating, try again!";
            echo operationMessage($GLOBALS['errMsgTitle'], $msgDetails);
        }
    }

    mysqli_close($conn);

?>