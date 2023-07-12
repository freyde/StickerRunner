<?php
require_once("dbh.inc.php");

$sql = "DELETE FROM `items` WHERE `item_code` = ".$_POST['it_code'];
$success = mysqli_query($conn, $sql);
?>
