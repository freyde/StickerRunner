<?php
    $server = "localhost:4306";
    $user = "root";
    $pass = "";
    $db = "rodel_db";

    $conn = mysqli_connect($server, $user, $pass, $db);

    if(!$conn)
    {
        die ("Connection Error... " . mysqli_connect_error());
    }
?>
