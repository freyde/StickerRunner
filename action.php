<?php
session_start();
$ip_add = getenv("REMOTE_ADDR");
include "db.php";

if (isset($_POST["categoryhome"])) {
    $category_query = "SELECT * FROM categories WHERE cat_id!=1";
    $run_query = mysqli_query($con, $category_query) or die(mysqli_error($con));
    echo "
        <!-- responsive-nav -->
        <div id='responsive-nav'>
            <!-- NAV -->
            <ul class='main-nav nav navbar-nav'>
                <li class='active'><a href='index.php'>Home</a></li>
                <li><a href='store.php'>All Products</a></li>
    ";
    if (mysqli_num_rows($run_query) > 0) {
        while ($row = mysqli_fetch_array($run_query)) {
            $cid = $row["cat_id"];
            $cat_name = $row["cat_title"];

            $sql = "SELECT COUNT(*) AS count_items FROM products,categories WHERE product_cat=cat_id";
            $query = mysqli_query($con, $sql);
            $row = mysqli_fetch_array($query);
            $count = $row["count_items"];

            echo "
                <li class='categoryhome' cid='$cid'><a href='store.php'>$cat_name</a></li>
            ";
        }
        echo "</ul>
            <!-- /NAV -->
        </div>
        <!-- /responsive-nav -->
    ";
    }
}

if (isset($_POST["page"])) {
    $sql = "SELECT * FROM products";
    $run_query = mysqli_query($con, $sql);
    $count = mysqli_num_rows($run_query);
    $pageno = ceil($count / 2);
    for ($i = 1; $i <= $pageno; $i++) {
        echo "
            <li><a href='#product-row' page='$i' id='page'>$i</a></li>
        ";
    }
}

if (isset($_POST["getProducthome"])) {
    $limit = 3;
    if (isset($_POST["setPage"])) {
        $pageno = $_POST["pageNumber"];
        $start = ($pageno * $limit) - $limit;
    } else {
        $start = 0;
    }
    $product_query = "SELECT * FROM products,categories WHERE product_cat=cat_id LIMIT $start,$limit";
    $run_query = mysqli_query($con, $product_query);
    if (mysqli_num_rows($run_query) > 0) {
        while ($row = mysqli_fetch_array($run_query)) {
            $pro_id    = $row['product_id'];
            $pro_cat   = $row['product_cat'];
            $pro_brand = $row['product_brand'];
            $pro_title = $row['product_title'];
            $pro_price = $row['product_price'];
            $pro_image = $row['product_image'];

            $cat_name = $row["cat_title"];

            echo "
                <div class='product-widget'>
                    <a href='product.php?p=$pro_id'> 
                        <div class='product-img'>
                            <img src='product_images/$pro_image' alt=''>
                        </div>
                        <div class='product-body'>
                            <p class='product-category'>$cat_name</p>
                            <h3 class='product-name'><a href='product.php?p=$pro_id'>$pro_title</a></h3>
                            <h4 class='product-price'>$pro_price PHP<del class='product-old-price'>$990.00 PHP</del></h4>
                        </div>
                    </a>
                </div>
            ";
        }
    }
}

if (isset($_POST["get_seleted_Category"]) || isset($_POST["selectBrand"]) || isset($_POST["search"])) {
    if (isset($_POST["get_seleted_Category"])) {
        $id = $_POST["cat_id"];
        $sql = "SELECT * FROM products,categories WHERE product_cat = '$id' AND product_cat=cat_id";
    } else if (isset($_POST["selectBrand"])) {
        $id = $_POST["brand_id"];
        $sql = "SELECT * FROM products,categories WHERE product_brand = '$id' AND product_cat=cat_id";
    } else {
        $keyword = $_POST["keyword"];
        header('Location: store.php');
        $sql = "SELECT * FROM products,categories WHERE product_cat=cat_id AND product_keywords LIKE '%$keyword%'";
    }

    $run_query = mysqli_query($con, $sql);
    while ($row = mysqli_fetch_array($run_query)) {
        $pro_id    = $row['product_id'];
        $pro_cat   = $row['product_cat'];
        $pro_brand = $row['product_brand'];
        $pro_title = $row['product_title'];
        $pro_price = $row['product_price'];
        $pro_image = $row['product_image'];
        $cat_name = $row["cat_title"];

        echo "
            <div class='col-md-4 col-xs-6'>
                <a href='product.php?p=$pro_id'>
                    <div class='product'>
                        <div class='product-img'>
                            <img src='product_images/$pro_image' style='max-height: 170px;' alt=''>
                            <div class='product-label'>
                                <span class='sale'>-30%</span>
                                <span class='new'>NEW</span>
                            </div>
                        </div>
                        <div class='product-body'>
                            <p class='product-category'>$cat_name</p>
                            <h3 class='product-name header-cart-item-name'><a href='product.php?p=$pro_id'>$pro_title</a></h3>
                            <h4 class='product-price'>$pro_price PHP<del class='product-old-price'>$990.00 PHP</del></h4>
                            <div class='product-rating'>
                                <i class='fa fa-star'></i>
                                <i class='fa fa-star'></i>
                                <i class='fa fa-star'></i>
                                <i class='fa fa-star'></i>
                                <i class='fa fa-star'></i>
                            </div>
                            <div class='product-btns'>
                                <button class='add-to-wishlist'><i class='fa fa-heart-o'></i><span class='tooltipp'>add to wishlist</span></button>
                                <button class='add-to-compare'><i class='fa fa-exchange'></i><span class='tooltipp'>add to compare</span></button>
                                <button class='quick-view'><i class='fa fa-eye'></i><span class='tooltipp'>quick view</span></button>
                            </div>
                        </div>
                        <div class='add-to-cart'>
                            <button pid='$pro_id' id='product' class='add-to-cart-btn block2-btn-towishlist'><i class='fa fa-shopping-cart'></i> add to cart</button>
                        </div>
                    </div>
                </a>
            </div>
        ";
    }
}

if (isset($_POST["addToCart"])) {
    $p_id = $_POST["proId"];

    if (isset($_SESSION["uid"])) {
        $user_id = $_SESSION["uid"];
        $sql = "SELECT * FROM cart WHERE p_id = '$p_id' AND user_id = '$user_id'";
        $run_query = mysqli_query($con, $sql);
        $count = mysqli_num_rows($run_query);
        if ($count > 0) {
            echo "
                <div class='alert alert-warning'>
                    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                    <b>Product is already added into the cart. Continue Shopping..!</b>
                </div>
            ";
        } else {
            $sql = "INSERT INTO `cart`(`p_id`, `ip_add`, `user_id`, `qty`) VALUES ('$p_id','$ip_add','$user_id','1')";
            if (mysqli_query($con, $sql)) {
                echo "
                    <div class='alert alert-success'>
                        <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                        <b>Product is Added to Cart..!</b>
                    </div>
                ";
            }
        }
    } else {
        $sql = "SELECT id FROM cart WHERE ip_add = '$ip_add' AND p_id = '$p_id' AND user_id = -1";
        $query = mysqli_query($con, $sql);
        if (mysqli_num_rows($query) > 0) {
            echo "
                <div class='alert alert-warning'>
                    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                    <b>Product is already added into the cart. Continue Shopping..!</b>
                </div>";
            exit();
        }
        $sql = "INSERT INTO `cart`(`p_id`, `ip_add`, `user_id`, `qty`) VALUES ('$p_id','$ip_add','-1','1')";
        if (mysqli_query($con, $sql)) {
            echo "
                <div class='alert alert-success'>
                    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                    <b>Your product is Added Successfully..!</b>
                </div>
            ";
            exit();
        }
    }
}

// Count User cart item
if (isset($_POST["count_item"])) {
    if (isset($_SESSION["uid"])) {
        $sql = "SELECT COUNT(*) AS count_item FROM cart WHERE user_id = $_SESSION[uid]";
    } else {
        $sql = "SELECT COUNT(*) AS count_item FROM cart WHERE ip_add = '$ip_add' AND user_id < 0";
    }

    $query = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($query);
    echo $row["count_item"];
    exit();
}

// Get Cart Item From Database to Dropdown menu
if (isset($_POST["Common"])) {

    if (isset($_SESSION["uid"])) {
        $sql = "SELECT a.product_id,a.product_title,a.product_price,a.product_image,b.id,b.qty FROM products a,cart b WHERE a.product_id=b.p_id AND b.user_id='$_SESSION[uid]'";
    } else {
        $sql = "SELECT a.product_id,a.product_title,a.product_price,a.product_image,b.id,b.qty FROM products a,cart b WHERE a.product_id=b.p_id AND b.ip_add='$ip_add' AND b.user_id < 0";
    }
    $query = mysqli_query($con, $sql);
    if (isset($_POST["getCartItem"])) {
        if (mysqli_num_rows($query) > 0) {
            $n = 0;
            $total_price = 0;
            while ($row = mysqli_fetch_array($query)) {
                $n++;
                $product_id = $row["product_id"];
                $product_title = $row["product_title"];
                $product_price = $row["product_price"];
                $product_image = $row["product_image"];
                $cart_item_id = $row["id"];
                $qty = $row["qty"];
                $total_price = $total_price + $product_price;

                echo '
                    <div class="product-widget">
                        <div class="product-img">
                            <img src="product_images/' . $product_image . '" alt="">
                        </div>
                        <div class="product-body">
                            <h3 class="product-name"><a href="#">' . $product_title . '</a></h3>
                            <h4 class="product-price"><span class="qty">' . $qty . '</span>' . $product_price . ' PHP</h4>
                        </div>
                    </div>
                ';
            }

            echo '
                <div class="cart-summary">
                    <small class="qty">' . $n . ' Item(s) selected</small>
                    <h5>' . $total_price . ' PHP</h5>
                </div>
            ';
            ?>
            <?php

            exit();
        }
    }

    if (isset($_POST["checkOutDetails"])) {
        if (mysqli_num_rows($query) > 0) {
            echo '
                <div class="main ">
                    <div class="table-responsive">
                        <form method="post" action="login_form.php">
                            <table id="cart" class="table table-hover table-condensed" id="">
                                <thead>
                                    <tr>
                                        <th style="width:50%">Product</th>
                                        <th style="width:10%">Price</th>
                                        <th style="width:8%">Quantity</th>
                                        <th style="width:7%" class="text-center">Subtotal</th>
                                        <th style="width:10%"></th>
                                    </tr>
                                </thead>
                                <tbody>
            ';
            $n = 0;
            while ($row = mysqli_fetch_array($query)) {
                $n++;
                $product_id = $row["product_id"];
                $product_title = $row["product_title"];
                $product_price = $row["product_price"];
                $product_image = $row["product_image"];
                $cart_item_id = $row["id"];
                $qty = $row["qty"];

                echo '
                    <tr>
                        <td data-th="Product" >
                            <div class="row">
                                <div class="col-sm-4 "><img src="product_images/' . $product_image . '" style="height: 70px;width:75px;"/>
                                    <h4 class="nomargin product-name header-cart-item-name"><a href="product.php?p=' . $product_id . '">' . $product_title . '</a></h4>
                                </div>
                                <div class="col-sm-6">
                                    <div style="max-width=50px;">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,</p>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <input type="hidden" name="product_id[]" value="' . $product_id . '"/>
                        <input type="hidden" name="" value="' . $cart_item_id . '"/>
                        <td data-th="Price"><input type="text" class="form-control price" value="' . $product_price . '" readonly="readonly"></td>
                        <td data-th="Quantity">
                            <input type="text" class="form-control qty" value="' . $qty . '" >
                        </td>
                        <td data-th="Subtotal" class="text-center">' . $product_price * $qty . '</td>
                        <td class="actions" data-th="">
                            <div class="text-right">
                                <button class="btn btn-white border-secondary bg-white btn-md btn-circle mb-2"><i class="fas fa-sync"></i></button>
                                <button class="btn btn-white border-secondary bg-white btn-md btn-circle mb-2"><i class="fas fa-trash"></i></button>
                            </div>
                        </td>
                    </tr>
                ';
            }
            echo '
                            </tbody>
                            <tfoot>
                                <tr class="visible-xs">
                                    <td class="text-center"><strong>Total ' . $total_price . '</strong></td>
                                </tr>
                                <tr>
                                    <td><a href="store.php" class="btn btn-warning"><i class="fa fa-angle-left"></i> Continue Shopping</a></td>
                                    <td colspan="2" class="hidden-xs"></td>
                                    <td class="hidden-xs text-center"><strong>Total ' . $total_price . '</strong></td>
                                    <td><a href="login_form.php" class="btn btn-success btn-block">Checkout <i class="fa fa-angle-right"></i></a></td>
                                </tr>
                            </tfoot>
                        </table>
                        </form>
                    </div>
                </div>
            ';
        }
    }
}

if (isset($_POST["removeFromCart"])) {
    $remove_id = $_POST["removeId"];

    if (isset($_SESSION["uid"])) {
        $sql = "DELETE FROM cart WHERE p_id = '$remove_id' AND user_id = '$_SESSION[uid]'";
    } else {
        $sql = "DELETE FROM cart WHERE p_id = '$remove_id' AND ip_add = '$ip_add'";
    }
    if (mysqli_query($con, $sql)) {
        echo "
            <div class='alert alert-danger'>
                <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                <b>Product is removed from Cart</b>
            </div>
        ";
        exit();
    }
}

if (isset($_POST["updateProduct"])) {
    $update_id = $_POST["updateId"];
    $qty = $_POST["qty"];

    if (isset($_SESSION["uid"])) {
        $sql = "UPDATE cart SET qty = '$qty' WHERE p_id = '$update_id' AND user_id = '$_SESSION[uid]'";
    } else {
        $sql = "UPDATE cart SET qty = '$qty' WHERE p_id = '$update_id' AND ip_add = '$ip_add'";
    }
    if (mysqli_query($con, $sql)) {
        echo "
            <div class='alert alert-success'>
                <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                <b>Product is Updated</b>
            </div>
        ";
        exit();
    }
}

if (isset($_POST["get_cart_product"])) {
    if (isset($_SESSION["uid"])) {
        $sql = "SELECT a.product_id,a.product_title,a.product_price,a.product_image,b.id,b.qty FROM products a,cart b WHERE a.product_id=b.p_id AND b.user_id='$_SESSION[uid]'";
    } else {
        $sql = "SELECT a.product_id,a.product_title,a.product_price,a.product_image,b.id,b.qty FROM products a,cart b WHERE a.product_id=b.p_id AND b.ip_add='$ip_add' AND b.user_id < 0";
    }
    $query = mysqli_query($con, $sql);
    $n = 0;
    if (mysqli_num_rows($query) > 0) {
        while ($row = mysqli_fetch_array($query)) {
            $n++;
            $product_id = $row["product_id"];
            $product_title = $row["product_title"];
            $product_price = $row["product_price"];
            $product_image = $row["product_image"];
            $cart_item_id = $row["id"];
            $qty = $row["qty"];

            echo '
                <div class="row">
                    <div class="col-md-3">' . $n . '</div>
                    <div class="col-md-3"><img src="product_images/' . $product_image . '" style="width: 60px;"></div>
                    <div class="col-md-3">' . $product_title . '</div>
                    <div class="col-md-3">' . $product_price . '</div>
                </div>
            ';
        }
        ?>
        <?php
        exit();
    }
}

if (isset($_POST["cart_checkout"])) {
    if (isset($_SESSION["uid"])) {
        $sql = "SELECT a.product_id,a.product_title,a.product_price,a.product_image,b.id,b.qty FROM products a,cart b WHERE a.product_id=b.p_id AND b.user_id='$_SESSION[uid]'";
    } else {
        $sql = "SELECT a.product_id,a.product_title,a.product_price,a.product_image,b.id,b.qty FROM products a,cart b WHERE a.product_id=b.p_id AND b.ip_add='$ip_add' AND b.user_id < 0";
    }
    $query = mysqli_query($con, $sql);
    $n = 0;
    $total_amt = 0;
    if (mysqli_num_rows($query) > 0) {
        while ($row = mysqli_fetch_array($query)) {
            $n++;
            $product_id = $row["product_id"];
            $product_title = $row["product_title"];
            $product_price = $row["product_price"];
            $product_image = $row["product_image"];
            $cart_item_id = $row["id"];
            $qty = $row["qty"];
            $total = $row["product_price"] * $qty;
            $total_amt = $total_amt + $total;

            echo '
                <div class="row">
                    <div class="col-md-2">' . $n . '</div>
                    <div class="col-md-2"><img src="product_images/' . $product_image . '" style="width: 60px;"></div>
                    <div class="col-md-2">' . $product_title . '</div>
                    <div class="col-md-2"><input type="text" class="form-control qty" pid="' . $product_id . '" id="qty-' . $product_id . '" value="' . $qty . '"></div>
                    <div class="col-md-2"><input type="text" class="form-control price" pid="' . $product_id . '" id="price-' . $product_id . '" value="' . $product_price . '" readonly="readonly"></div>
                    <div class="col-md-2"><input type="text" class="form-control total" pid="' . $product_id . '" id="total-' . $product_id . '" value="' . $total . '" readonly="readonly"></div>
                </div>
            ';
        }

        echo '
            <div class="row">
                <div class="col-md-8"></div>
                <div class="col-md-4">
                    <b>Total: ' . $total_amt . ' PHP</b>
                </div>
            </div>
        ';

        ?>
        <?php
        exit();
    }
}

if (isset($_POST["removeFromCart"])) {
    $remove_id = $_POST["removeId"];

    if (isset($_SESSION["uid"])) {
        $sql = "DELETE FROM cart WHERE p_id = '$remove_id' AND user_id = '$_SESSION[uid]'";
    } else {
        $sql = "DELETE FROM cart WHERE p_id = '$remove_id' AND ip_add = '$ip_add'";
    }
    if (mysqli_query($con, $sql)) {
        echo "
            <div class='alert alert-success'>
                <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                <b>Product is removed from Cart</b>
            </div>
        ";
        exit();
    }
}

if (isset($_POST["updateCartItem"])) {
    $update_id = $_POST["updateId"];
    $qty = $_POST["qty"];

    if (isset($_SESSION["uid"])) {
        $sql = "UPDATE cart SET qty = '$qty' WHERE p_id = '$update_id' AND user_id = '$_SESSION[uid]'";
    } else {
        $sql = "UPDATE cart SET qty = '$qty' WHERE p_id = '$update_id' AND ip_add = '$ip_add'";
    }
    if (mysqli_query($con, $sql)) {
        echo "
            <div class='alert alert-success'>
                <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                <b>Product is Updated</b>
            </div>
        ";
        exit();
    }
}

if (isset($_POST["createOrder"])) {
    if (!isset($_SESSION["uid"])) {
        header("location: index.php");
    } else {
        $date = date("Y-m-d");
        $total_amt = $_POST["total_amt"];
        $trx_id = "ORD" . mt_rand();

        $sql = "INSERT INTO orders (user_id,order_status,total_amount,trx_id,trx_date) VALUES ('$_SESSION[uid]','Order Placed','$total_amt','$trx_id','$date')";
        mysqli_query($con, $sql);
        $order_id = mysqli_insert_id($con);

        $sql = "SELECT * FROM cart WHERE user_id = '$_SESSION[uid]'";
        $run_query = mysqli_query($con, $sql);
        while ($row = mysqli_fetch_array($run_query)) {
            $pro_id = $row["p_id"];
            $pro_qty = $row["qty"];
            $pro_price = $row["price"];

            $sql = "INSERT INTO order_details (order_id,product_id,qty,price) VALUES ('$order_id','$pro_id','$pro_qty','$pro_price')";
            mysqli_query($con, $sql);
        }

        $sql = "DELETE FROM cart WHERE user_id = '$_SESSION[uid]'";
        if (mysqli_query($con, $sql)) {
            echo "
                <div class='alert alert-success'>
                    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                    <b>Your order has been placed successfully..!</b>
                </div>
            ";
            exit();
        }
    }
}

if (isset($_POST["getCustomerOrder"])) {
    if (isset($_SESSION["uid"])) {
        $sql = "SELECT * FROM orders WHERE user_id = '$_SESSION[uid]' ORDER BY order_id DESC";
        $run_query = mysqli_query($con, $sql);
        if (mysqli_num_rows($run_query) > 0) {
            $n = 0;
            while ($row = mysqli_fetch_array($run_query)) {
                $n++;
                $order_id = $row["order_id"];
                $total_amount = $row["total_amount"];
                $order_status = $row["order_status"];
                $date = $row["trx_date"];

                echo '
                    <div class="row">
                        <div class="col-md-2">' . $n . '</div>
                        <div class="col-md-2">' . $date . '</div>
                        <div class="col-md-2">' . $order_id . '</div>
                        <div class="col-md-2">' . $total_amount . '</div>
                        <div class="col-md-2">' . $order_status . '</div>
                        <div class="col-md-2"><a href="order_details.php?id=' . $order_id . '" style="color:#333; font-weight:bold;">View Details</a></div>
                    </div>
                ';
            }
        }
    }
}

if (isset($_POST["getCustomerOrderDetails"])) {
    $order_id = $_POST["order_id"];
    $sql = "SELECT * FROM order_details WHERE order_id = '$order_id'";
    $run_query = mysqli_query($con, $sql);
    if (mysqli_num_rows($run_query) > 0) {
        $n = 0;
        while ($row = mysqli_fetch_array($run_query)) {
            $n++;
            $pro_id = $row["product_id"];
            $pro_qty = $row["qty"];
            $pro_price = $row["price"];

            $sql = "SELECT * FROM products WHERE product_id = '$pro_id'";
            $run_query1 = mysqli_query($con, $sql);
            $row1 = mysqli_fetch_array($run_query1);
            $product_image = $row1["product_image"];
            $product_title = $row1["product_title"];

            echo '
                <div class="row">
                    <div class="col-md-2">' . $n . '</div>
                    <div class="col-md-2"><img src="product_images/' . $product_image . '" style="width: 60px;"></div>
                    <div class="col-md-2">' . $product_title . '</div>
                    <div class="col-md-2">' . $pro_price . '</div>
                    <div class="col-md-2">' . $pro_qty . '</div>
                    <div class="col-md-2">' . $pro_price * $pro_qty . '</div>
                </div>
            ';
        }
    }
}

?>
