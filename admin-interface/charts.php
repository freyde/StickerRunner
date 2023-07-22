    <?php
    include_once("../includes/dbh.inc.php");
    global $conn;

    if($_POST['type'] == "topSelling") {
        $query = "SELECT item_name, num_sold FROM items ORDER BY num_sold DESC LIMIT 10";

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
        $query = "SELECT month(order_date),sum(order_total_price) FROM orders GROUP BY year(order_date),month(order_date) ORDER BY year(order_date),month(order_date) LIMIT 12";

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
        from orders
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