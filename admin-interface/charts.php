<?php
include_once("../includes/dbh.inc.php");
global $conn;

if($_POST['type'] == "topSelling") {
    $query = "SELECT item_name, num_sold FROM items ORDER BY num_sold DESC LIMIT 10";
    // $query = "SELECT JSON_ARRAYAGG(
    //     JSON_OBJECT(
    //       'item_id', `item_id`,
    //       'item_name', `item_name`,
    //     )
    //   ) FROM items ORDER BY num_sold DESC LIMIT 10 ";
    $result = mysqli_query($conn, $query);
    $data[] = array();
    while($row =mysqli_fetch_assoc($result))
    {
        $data[] = $row;
    }
    echo json_encode($data);
}

if($_POST['type'] == "monthlySales") {
    $year = $_POST['year'];
    $query = "SELECT month(order_date),sum(order_total_price)
    from rodel_db.orders
    group by year(order_date),month(order_date)
    order by year(order_date),month(order_date)
    limit 12";

    $result = mysqli_query($conn, $query);
    $data[] = array();
    while($row =mysqli_fetch_assoc($result))
    {
        $data[] = $row;
    }
    echo json_encode($data);
}

if($_POST['type'] == "orderStatus") {
    $query = "SELECT order_status, count(order_status)
    from rodel_db.orders
    where order_status = 'cancelled' OR order_status = 'delivered'
    group by order_status
    order by sum(order_status)
    desc";

    $result = mysqli_query($conn, $query);
    $data[] = array();
    while($row =mysqli_fetch_assoc($result))
    {
        $data[] = $row;
    }
    echo json_encode($data);
}

?>