<?php
    require '../config/config.php';

    if(isset($_POST['id'])){
        $id = $_POST['id'];

        $query     = "SELECT * FROM todolist WHERE id='$id' LIMIT 1";
        $execution = mysqli_query($conn, $query);
        $result    = mysqli_fetch_assoc($execution);

        echo json_encode($result);
        
    }

    mysqli_close($conn);
?>