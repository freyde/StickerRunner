<?php
    $server = "localhost";
    $user = "qeofiudr_root";
    $pass = "iPong5s*";
    $db = "qeofiudr_rodel_db";
    $conn = mysqli_connect($server, $user, $pass, $db);
    if(!$conn)
    {
        die ("Connection Error... " . mysqli_connect_error());
    }
?>