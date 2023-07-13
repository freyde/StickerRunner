<?php
require_once("dbh.inc.php");

$startDate = $_POST['startDate']." 00:00:00";
$endDate = $_POST['endDate']." 23:59:59";

$return_arr = array();
$query = "SELECT * FROM orders WHERE order_date BETWEEN '$startDate' AND '$endDate'" ;
$queryResult = mysqli_query($conn, $query);
// return $queryResult;
foreach($queryResult as $result) {
    $return_arr[] = array("order_id" => $result["order_id"],
                        "order_item_code" => $result["order_item_code"],
                        "order_date" => $result["order_date"]); 
}
// echo $startDate;
echo json_encode($return_arr);
?>