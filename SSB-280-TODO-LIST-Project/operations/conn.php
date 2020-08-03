<?php
    $host   = "127.0.0.1";
    $user    = "root";
    $pass   = "";
    $db     = "ssb280_todo_list_project";

    $conn   = mysqli_connect($host, $user, $pass, $db);

    if(!$conn){
        die("<br><b>Error: Couldn't connect to database!</b><br>Error report:<br>".mysqli_connect_error());
    }
?>