<?php
if (isset($_POST["submit"])){
    $email_add = $_POST["email_add"];
    $userPassword = $_POST["loginpass"];

    require_once("dbh.inc.php");
    require_once("functions.inc.php");

    if(emptyInputLogin($email_add, $userPassword)){
        header("Location: ../loginpage.php?error=emptyinput");
    }

    loginUser($conn, $email_add, $userPassword);
}
else {
    header("Location: ../loginpage.php");
    exit();
}
?>