<?php
if (isset($_POST["submit"])) {
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $email_add = $_POST["email_add"];
    $userPassword = $_POST["userpass"];
    $repeatPass = $_POST["repeatPass"];

    require_once('dbh.inc.php');
    require_once('functions.inc.php');

    if (emptyInputSignup($first_name, $last_name, $email_add, $userPassword, $repeatPass)) {
        header("Location: ../signuppage.php?error=emptyinput");
        exit();
    }

    $diff = abs(strtotime($bday)) - strtotime(date('Y-m-d'));
    $years = floor($diff / (365 * 60 * 60 * 24));

    if ($years < 16) {
        header("Location: ../signuppage.php?error=invalidAge");
        exit();
    }

    if (invalidFirstName($first_name)) {
        header("Location: ../signuppage.php?error=invalidFirstName");
        exit();
    }

    if (invalidLastName($last_name)) {
        header("Location: ../signuppage.php?error=invalidLastName");
        exit();
    }

    if (invalidEmail($email_add)) {
        header("Location: ../signuppage.php?error=invalidEmail");
        exit();
    }

    if (checkPasswordMatch($userPassword, $repeatPass)) {
        header("Location: ../signuppage.php?error=passwordsdontmatch");
        exit();
    }

    if (userExists($conn, $email_add)) {
        header("Location: ../signuppage.php?error=emailaddresstaken");
        exit();
    }
    session_start();
    $_SESSION["first_name"] = $first_name;
    $_SESSION["last_name"] = $last_name;
    $_SESSION["email_add"] = $email_add;
    $_SESSION["userpassword"] = $userPassword;
    header("Location: ../continueSignUp.php");
    exit();
}

if (isset($_POST["proceed"])) {
    $bday = $_POST["bday"];
    $diff = abs(strtotime($bday) - strtotime(date('Y-m-d')));
    $years = floor($diff / (365 * 60 * 60 * 24));

    if ($years < 15) {
        header("Location: ../continueSignUp.php?error=invalidAge&age=$years");
        echo "<script>alert($years)</script>";
        exit();
    } else {
        session_start();
        $first_name = ucwords($_SESSION["first_name"]);
        $last_name = ucwords($_SESSION["last_name"]);
        $email_add = $_SESSION["email_add"];
        $userPassword = $_SESSION["userpassword"];
        $street_number = ucwords($_POST["street_num"]);
        $province = $_POST["provinces"];
        $cityormunicipality = $_POST["city_municipality"];
        $barangay = $_POST["barangay"];
        $mobile_number = $_POST["mobile_num"];
        $birthday = $_POST["bday"];
        $gender = $_POST["user_gender"];

        require_once('dbh.inc.php');
        require_once('functions.inc.php');

        createUserAccount($conn, $first_name, $last_name, $email_add, $userPassword, $street_number, $cityormunicipality, $barangay, $province, $mobile_number, $birthday, $gender);
        exit();
    }
}
