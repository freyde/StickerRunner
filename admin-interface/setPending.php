<?php
include_once("../includes/dbh.inc.php");
global $conn;

$custom_id = $_POST['custom_id'];
$custom_price = $_POST['price'];

$query = "UPDATE custom_shirt SET custom_price = '$custom_price' WHERE custom_id = '$custom_id'";

mysqli_query($conn, $query);

echo "Price Updated";
?>