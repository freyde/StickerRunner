<?php

session_start();

if(isset($_SESSION['auth']) && $_SESSION == true){
    unset($_SESSION['auth']);
    unset($_SESSION["userEmailAdd"]);
    unset($_SESSION["user_Id"]);
}

session_unset();
session_destroy();


header("Location: ../loginpage.php");
exit();
?>