<?php

    $host="localhost";
    $user="root";
    $password="";
    $database="ssb-280-sio";

    $conn = mysqli_connect($host, $user, $password, $database);

    if(!$conn){
        die("<br><b>Connection Error: </b> <br>".mysqli_connect_error());
    }

?>