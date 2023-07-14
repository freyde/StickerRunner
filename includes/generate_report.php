<?php
require_once("dbh.inc.php");

$startDate = $_POST['startDate']." 00:00:00";
$endDate = $_POST['endDate']." 23:59:59";

$return_arr = array();
$query = "SELECT * FROM orders WHERE order_date BETWEEN '$startDate' AND '$endDate' AND payment_status = 'Paid' ORDER BY order_date ASC";
$queryResult = mysqli_query($conn, $query);
// return $queryResult;
foreach($queryResult as $result) {
    $formattedDate = date('F j, Y', strtotime($result["order_date"]));
    $return_arr[] = array(
                            // "order_date" => date('F j, Y', $result["order_date"]),
                            "order_date" => $formattedDate,
                            "order_id" => $result["order_id"],
                            "order_item_name" => $result["order_item_name"],
                            "order_item_price" => $result["order_item_price"],
                            "order_item_quantity" => $result["order_item_quantity"],
                            "payment_method" => $result["payment_method"],
                            "order_total_price" => $result["order_total_price"],

                        ); 
}
// echo $startDate;
echo json_encode($return_arr);
?>