<?php

    require '../config/config.php';

    $successMsg = '<div class="header">Success</div><div class="content">
                        <p>Your work is created successfully!</p>
                    </div>
                    <div class="actions">
                        <div class="ui cancel blue button cancel-btn">Okay</div>
                    </div>';

    $errorMsg   = '<div class="header">Error</div><div class="content">
                        <p>Error occured, try again!</p>
                    </div>
                    <div class="actions">
                        <div class="ui cancel red button cancel-btn">Okay</div>
                    </div>';                

    if(isset($_POST['create'])){
        $workName   = $_POST['title'];
        $fromDate   = $_POST['fromDate'];
        $toDate     = $_POST['toDate'];

        $query = "INSERT INTO todolist(workName, fromDate, toDate) 
                              VALUES('$workName', '$fromDate', '$toDate')";

        $execution = mysqli_query($conn, $query);
        
        if($execution==true){
            echo $successMsg;
        }
        else{
            echo $errorMsg;
        }
    }

    mysqli_close($conn);

?>