<?php
include_once("../includes/dbh.inc.php");
include_once("../includes/functions.inc.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Products</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
     integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- <link rel="stylesheet" href="page.css"> -->
    


</head>
    
<body>
    <div class="container shadow-lg bg-white" style="margin-top: 50px; width:100%;">
        <h1 class="text-start pt-3 pb-3">Orders List</h1>
            <ul class="nav nav-tabs nav-fill">
                <li class="nav-item">
                    <a class="nav-link" href="main_dashboard.php?orders">Orders List</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="main_dashboard.php?placed_orders">Placed Orders</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="main_dashboard.php?to_ship">To Ship</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="main_dashboard.php?in_transit">In-Transit</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="main_dashboard.php?delivered">Delivered</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="main_dashboard.php?cancelled">Cancelled</a>
                </li>
            </ul>                                
    </div>
    <div class="list-of-products">
        <?php
            $select_list = mysqli_query($conn, "SELECT * FROM orders");
        ?>

        <table class="table table-bordered table-striped border-primary">
            <thead class="text-center fw-bold">
                <tr>
                    <th>Package Number</th>
                    <!-- <th>Item Code</th> -->
                    <th>Item Image</th>
                    <th>Item Name</th>
                    <th>Item Total Price</th>
                    <th>Ordered At</th>
                    <th>Payment Method</th>
                    <th>Paid</th>
                    <th style="width:14%">Status</th>
                    <!-- <th colspan="2">Action</th> -->
                </tr>
            </thead>
            <?php
                while($row = mysqli_fetch_assoc($select_list)){
            ?>
                <tr style="font-size: 14px;">
                    <td class="text-center"><?php echo $row["package_num"] ?></td>
                    <td class="text-center">
                        <img src="../admin-interface/item_images/<?= $row["order_item_image"] ?>" height="50" width="50" alt="" />
                    </td>
                    <td><?php echo $row["order_item_name"] ?></td>
                    <td class="text-center">₱<?php echo $row["order_item_price"] + 45 ?>.00</td>
                    <td class="text-center"><?php echo $row["order_date"] ?></td>
                    <td class="text-center"><?php echo $row["payment_method"] ?></td>
                  

                    <td class="text-center" style="width:14%">

                    <select class="form-select" payment-id=<?php echo $row["order_item_code"];?>
                    payment-email=<?php echo $row["order_email_add"];?> name="payment_status_change" aria-label="Default select example">
                        <option value="<?php echo $row["payment_status"];?>" selected><?php echo $row["payment_status"];?></option>

                        <?php 

                            if($row["payment_status"] == "Paid"){
                                ?>
                                    <option value="Not Paid">Not Paid</option> 
                                <?php
                            } else if ($row["payment_status"] == "Not Paid") {
                                ?>
                                    <option value="Paid">Paid</option>
                                <?php
                            } 
                        ?>
                    </select>

                        <!-- <button type="button" name="paidBtn" id="paidBtn" value="<?php echo $row["order_item_code"] ?>" class="btn btn-success">Paid</button> -->
                    </td>

                   
                    <td class="text-center" style="width:15%">

                    <!-- <input type="hidden" value="<?php echo $row["order_item_code"] ?>" id="select_value" name="select_value"> -->
                    <select class="form-select" status-id=<?php echo $row["order_item_code"];?> 
                    status-email=<?php echo $row["order_email_add"];?> name="order_status_change" aria-label="Default select example">
                        <option value="<?php echo $row["order_status"];?>" selected><?php echo $row["order_status"];?></option>

                        <?php 

                            if($row["order_status"] == "Placed"){
                                ?>
                                    <option value="To Ship">To Ship</option>
                                    <option value="In-Transit">In-Transit</option>
                                    <option value="Delivered">Delivered</option>
                                    <option value="Cancelled">Cancelled</option>    
                                <?php
                            } else if ($row["order_status"] == "To Ship") {
                                ?>
                                    <option value="Placed">Placed</option>
                                    <option value="In-Transit">In-Transit</option>
                                    <option value="Delivered">Delivered</option>
                                    <option value="Cancelled">Cancelled</option>
                                <?php
                            } else if ($row["order_status"] == "In-Transit"){
                                ?>
                                     <option value="Placed">Placed</option>
                                     <option value="To Ship">To Ship</option>
                                     <option value="Delivered">Delivered</option>
                                     <option value="Cancelled">Cancelled</option>
                                <?php
                            } else if ($row["order_status"] == "Delivered"){
                                ?>
                                        <option value="Placed">Placed</option>
                                        <option value="To Ship">To Ship</option>
                                        <option value="In-Transit">In-Transit</option>
                                        <option value="Cancelled">Cancelled</option>
                                <?php
                            } else if ($row["order_status"] == "Cancelled"){
                                ?>
                                            <option value="Placed">Placed</option>
                                            <option value="To Ship">To Ship</option>
                                            <option value="In-Transit">In-Transit</option>
                                            <option value="Delivered">Delivered</option>
                                <?php
                            }
                        ?>
                    </select>

                    </td>
                    <!-- <td class="text-center"><button type="button" class="btn btn-link">Edit</button></td> -->
                    <!-- <td class="text-center" style="width:14%">
                        <button type="button" name="paidBtn" id="paidBtn" value="<?php echo $row["order_item_code"] ?>" class="btn btn-success">Paid</button>
                    </td> -->
                </tr>
                    
            <?php
                };
            ?>
        </table>
    </div>

                 
    
    <script src="../jquery-3.6.3.js"></script>
    <script src="../assets/paid_function.js"></script>

    <script>
        $(document).ready(function() {
            $('select[name="order_status_change"]').change(function() {
            var status = $(this).val();
            var getid = $(this).attr("status-id");
            var email = $(this).attr("status-email");

            // alert(status);
            // alert(getid);
            // alert(email);
            
            $.ajax({
                method: "POST",
                url: "../includes/change_status.php",
                data: {  
                    status: status,
                    getid: getid,
                    email: email
                },
                success: function(response){
                    alert("Successfully updated!");
                    location.reload();  
                },
                error: function(response) {
                    alert("Error");
                }
            });
            
            });
        }); 
    </script>

    <script>
        $(document).ready(function() {
            $('select[name="payment_status_change"]').change(function() {
            var Pstatus = $(this).val();
            var getcode = $(this).attr("payment-id");
            var email = $(this).attr("payment-email");

            // alert(Pstatus);
            // alert(getcode);
            // alert(email);
            
            $.ajax({
                method: "POST",
                url: "../includes/change_payment.php",
                data: {  
                    Pstatus: Pstatus,
                    getcode: getcode,
                    email: email
                },
                success: function(response){
                    alert("Successfully updated!");
                    location.reload();  
                },
                error: function(response) {
                    alert("Error");
                }
            });
            
            });
        }); 
    </script>

</body>
</html>