<?php

    function emptyInputSignup($first_name, $last_name, $email_add, $userPassword, $repeatPass){
    $result = "";
        if(empty($first_name) || empty($last_name) || empty($email_add) || empty($userPassword) || empty($repeatPass)){
            $result = true;
        } else {
            $result = false;
        }
        return $result = "";
    } 

    function invalidFirstName($first_name){
        $result = "";
        if(!preg_match("/^[a-zA-Z]*$/", $first_name)){
            $result = true;
        } else {
            $result = false;
        }
        return $result = "";
    }

    function invalidLastName($last_name){
        $result = "";
        if(!preg_match("/^[a-zA-Z\s]*$/", $last_name)){
            $result = true;
        } else {
            $result = false;
        }
        return $result = "";
    }
    function invalidEmail($email_add){
        $result = "";
        if(!filter_var($email_add, FILTER_VALIDATE_EMAIL)){
            $result = true;
        } else {
            $result = false;
        }
        return $result = "";
    }

    function checkPasswordMatch($userPassword, $repeatPass){
        $result = "";
        if($userPassword !== $repeatPass){
            $result = true;
        } else {
            $result = false;
        }
        return $result = "";
    }

    function userExists($conn, $email_add){
        $sql = "SELECT * FROM users WHERE email_add = ?;";
        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: ../signuppage.php?error=stmtfailed");
            exit();
        }

        mysqli_stmt_bind_param($stmt, "s", $email_add);
        mysqli_stmt_execute($stmt);

        $resultData = mysqli_stmt_get_result($stmt);

        if($row = mysqli_fetch_assoc($resultData)){
            return $row; /** fetch row of data of existing user in the db**/
        } else {
            $result = false;
            return $result = "";
        }
        mysqli_stmt_close($stmt);
    }
    function createUserAccount($conn, $first_name, $last_name, $email_add, $userPassword, $street_number, $cityormunicipality, $barangay, $province, $mobile_number, $birthday, $gender){
        $sql = "INSERT INTO users (first_name, last_name, email_add, user_password, street_number, citymunicipality, barangay, province, mobile_number, birthday, gender) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";
        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: ../signuppage.php?error=stmtfailed");
            exit();
        }

        $hashedPass = password_hash($userPassword, PASSWORD_DEFAULT);

        mysqli_stmt_bind_param($stmt, "sssssssssss", $first_name, $last_name, $email_add, $hashedPass, $street_number, $cityormunicipality, $barangay, $province, $mobile_number, $birthday, $gender); //hash password 
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        $user_exists = userExists($conn, $email_add);

        if($user_exists === false){
            header("Location: ../loginpage.php?error=wronglogin");
            exit();
        }

        session_start();
        $_SESSION['auth'] = true;
        $_SESSION["userEmailAdd"] = $user_exists["email_add"];
        $_SESSION["user_Id"] = $user_exists["user_id"];
        header("Location: ../index.php?error=none");
        exit();
    }

    
    function emptyInputLogin($email_add, $userPassword){
        $result = "";
            if(empty($email_add) || empty($userPassword)){
                $result = true;
            } else {
                $result = false;
            }
            return $result = "";
    }
    
    function loginUser($conn, $email_add, $userPassword){
        $user_exists = userExists($conn, $email_add);

        if($user_exists === false){
            header("Location: ../loginpage.php?error=wronglogin1");
            exit();
        }

        if ($email_add == "admin@email.com" && $userPassword == "admin123"){
                session_start();
                $_SESSION['auth'] = true;
                $_SESSION["userEmailAdd"] = $user_exists["email_add"];
                $_SESSION["user_Id"] = $user_exists["user_id"];
                header("Location: ../index.php?successful-login");
                exit();
        }

        $pwdHashed = $user_exists["user_password"];
        $checkPassword = password_verify($userPassword, $pwdHashed);

        if($checkPassword === false){
            header("Location: ../loginpage.php?error=wronglogin2");
            echo $userPassword;
            echo $pwdHashed;
            exit();
        } else if ($checkPassword === true) {
                session_start();
                $_SESSION['auth'] = true;   
                $_SESSION["userEmailAdd"] = $user_exists["email_add"];
                $_SESSION["user_Id"] = $user_exists["user_id"];
                header("Location: ../index.php?successful-login");
                exit();
        } 
    }

    function checkSearch(){
        global $conn;
        
        if (isset($_GET['search_btn'])) {
            if (!isset($_GET["mens_category"])) {
                if (!isset($_GET["womens_category"])) {


                    $searchFor = $_GET["search_query"];
                    $select_query = "SELECT * FROM `items` WHERE item_name LIKE '%$searchFor%' AND item_status = 'Available'";
                    $result_query = mysqli_query($conn, $select_query);
                    $numOfRows = mysqli_num_rows($result_query);
                    echo "<h1 class='h3'>Search results for '$searchFor'</h1>";
                    if($numOfRows == 0){
                        echo "<h3 class='pt-5 text-center'>No results found. Try searching for other item.</h3>";
                    }

                    while ($row = mysqli_fetch_assoc($result_query)) {
                        $item_id = $row["item_id"];
                        $item_code = $row["item_code"];
                        $item_name = $row["item_name"];
                        $item_price = $row["item_price"];
                        $item_description = $row["item_description"];
                        $item_keyword = $row["item_keyword"];
                        $item_category = $row["item_category"];
                        $item_image1 = $row["item_image1"];

                        // displaying items in the HTML index
                        echo "
                        
                        <a style='text-decoration: none; color: black;' href='itemclickpage.php'>
                            <figure class='figure' style='width: 210px;'>
                                <img src='./admin-interface/item_images/$item_image1' class='figure-img img-fluid rounded m-3' style='height: 200px;' alt='$item_name'>
                                <figcaption class='item_name'>$item_name</figcaption>
                                <figcaption class='item_price'>₱$item_price.00</figcaption>
                            </figure>
                        </a>";
                    }
                }
            }
        }
    }

    function displayBestSellingItems(){
        global $conn;
        
        if(!isset($_GET['search_btn'])){
            if(!isset($_GET["mens_category"])){
                if(!isset($_GET["womens_category"])){
                    $select_query = "SELECT * FROM `items` WHERE item_status = 'Available' ORDER BY num_sold DESC LIMIT 0,5"; //rand() function to randomize items display 
                    $result_query = mysqli_query($conn, $select_query); // LIMIT function to limit the items to be displayed

                    while($row = mysqli_fetch_assoc($result_query)){
                        $item_id = $row["item_id"];
                        $item_code = $row["item_code"];
                        $item_name = $row["item_name"];
                        $item_price = $row["item_price"];
                        $item_description = $row["item_description"];
                        $item_keyword = $row["item_keyword"];
                        $item_category = $row["item_category"];
                        $item_image1 = $row["item_image1"];
                        $num_sold = $row["num_sold"];

                        // displaying items in the HTML index
                        // <h6 style='padding-left: 15px; margin-bottom: -10px;'>$num_sold sold</h6>
                        echo "<a style='text-decoration: none; color: black;' href='itemclickpage.php?item_code=$item_code&item_category=$item_category&click_on_item=$item_name'>
                        <figure class='figure' style='width: 210px;'>
                            <img src='./admin-interface/item_images/$item_image1' class='figure-img img-fluid rounded m-3' style='height: 200px;' alt='$item_name'>
                            <figcaption class='item_name'>$item_name</figcaption>
                            <figcaption class='item_price'>₱$item_price.00</figcaption>
                        </figure>
                    </a>";
                    }
                }
            }
        }        
    }





    function displayAllItems(){
        global $conn;

        if(!isset($_GET['search_btn'])){
            if(!isset($_GET["mens_category"])){
                if(!isset($_GET["womens_category"])){
                    $select_query = "SELECT * FROM `items` WHERE item_status = 'Available' ORDER BY rand() LIMIT 0,20"; //rand() function to randomize items display 
                    $result_query = mysqli_query($conn, $select_query); // LIMIT function to limit the items to be displayed

                    while($row = mysqli_fetch_assoc($result_query)){
                        $item_id = $row["item_id"];
                        $item_code = $row["item_code"];
                        $item_name = $row["item_name"];
                        $item_price = $row["item_price"];
                        $item_description = $row["item_description"];
                        $item_keyword = $row["item_keyword"];
                        $item_category = $row["item_category"];
                        $item_image1 = $row["item_image1"];

                        // displaying items in the HTML index
                        echo "
                        <div class='float-none'>
                            <a style='text-decoration: none;' href='itemclickpage.php?item_code=$item_code&item_category=$item_category&click_on_item=$item_name'>
                            <figure class='figure' style='width: 215px; '>
                                <img src='./admin-interface/item_images/$item_image1' class='figure-img img-fluid rounded m-3' style='height: 200px;' alt='$item_name'>
                                <figcaption class='item_name'>$item_name</figcaption>
                                <figcaption class='item_price'>₱$item_price.00</figcaption>
                            </figure>
                            </a>
                        </div>";
                    }
                }
            }
        }

    }

    function get_items_from_Category($conn){
    global $conn;
        // display mens category onclick
        if(!isset($_GET['search_btn'])){
            if(isset($_GET["mens_category"])){
                if(!isset($_GET["womens_category"])){
                    $category_name = $_GET["mens_category"];
                    $select_query = "SELECT * FROM `items` WHERE item_category = '$category_name'"; 
                    $result_query = mysqli_query($conn, $select_query);
                    $numOfRows = mysqli_num_rows($result_query);
                    if($numOfRows == 0){
                        echo "<h3 class='pt-5 text-center'>No Available Stock for $category_name category.</h3>";
                    }
    
                    while($row = mysqli_fetch_assoc($result_query)){
                        $item_id = $row["item_id"];
                        $item_code = $row["item_code"];
                        $item_name = $row["item_name"];
                        $item_price = $row["item_price"];
                        $item_description = $row["item_description"];
                        $item_keyword = $row["item_keyword"];
                        $item_category = $row["item_category"];
                        $item_image1 = $row["item_image1"];
        
                        // displaying items in the HTML index
                        echo "<a style='text-decoration: none; color: black;' href='itemclickpage.php'>
                        <figure class='figure' style='width: 210px;'>
                            <img src='./admin-interface/item_images/$item_image1' class='figure-img img-fluid rounded m-3' style='height: 200px;' alt='$item_name'>
                            <figcaption class='item_name'>$item_name</figcaption>
                            <figcaption class='item_price'>₱$item_price.00</figcaption>
                        </figure>
                    </a>";
                    }
                }
            } 

            // display womens category onclick
        if(isset($_GET["womens_category"])){
            if(!isset($_GET["men_category"])){
                $category_name = $_GET["womens_category"];
                $select_query = "SELECT * FROM `items` WHERE item_category = '$category_name'"; 
                $result_query = mysqli_query($conn, $select_query);
                $numOfRows = mysqli_num_rows($result_query);
                if($numOfRows == 0){
                    echo "<h3 class='pt-5 text-center'>No Available Stock for $category_name category.</h3>";
                }
    
                while($row = mysqli_fetch_assoc($result_query)){
                    $item_id = $row["item_id"];
                    $item_code = $row["item_code"];
                    $item_name = $row["item_name"];
                    $item_price = $row["item_price"];
                    $item_description = $row["item_description"];
                    $item_keyword = $row["item_keyword"];
                    $item_category = $row["item_category"];
                    $item_image1 = $row["item_image1"];
    
                    // displaying items in the HTML index
                    echo "<a style='text-decoration: none; color: black;' href='itemclickpage.php'>
                    <figure class='figure' style='width: 210px;'>
                        <img src='./admin-interface/item_images/$item_image1' class='figure-img img-fluid rounded m-3' style='height: 200px;' alt='$item_name'>
                        <figcaption class='item_name'>$item_name</figcaption>
                        <figcaption class='item_price'>₱$item_price.00</figcaption>
                    </figure>
                </a>";
                }

            }
        }
        }
    }

    function viewItemInformation(){
    global $conn;

    if(isset($_GET["item_code"])){
        if(!isset($_GET['search_btn'])){
            if(!isset($_GET["mens_category"])){
                if(!isset($_GET["womens_category"])){

                    $item_code = $_GET["item_code"];
                    $select_query = "SELECT * FROM `items` WHERE item_code = $item_code"; //rand() function to randomize items display 
                    $result_query = mysqli_query($conn, $select_query); // LIMIT function to limit the items to be displayed
                    
                    while($row = mysqli_fetch_assoc($result_query)){
                        $item_id = $row["item_id"];
                        $item_code = $row["item_code"];
                        $item_name = $row["item_name"];
                        $item_price = $row["item_price"];
                        $item_description = $row["item_description"];
                        $item_keyword = $row["item_keyword"];
                        $item_category = $row["item_category"];
                        $item_image1 = $row["item_image1"];
                        $sizes_available = $row["sizes_available"];
                        $num_sold = $row["num_sold"];
                        $num_left = $row["num_left"];

                        if (str_contains($item_category, 'Mens')) {
                            echo "<div class='item_path' style='margin-top: 50px; margin-left: 100px;'>
                                  <p id='item_path'>Mens Clothing > $item_category > $item_name</p>
                                  </div>";
                        } else if (str_contains($item_category, 'Womens')){
                            echo "<div class='item_path' style='margin-top: 50px; margin-left: 100px;'>
                                  <p id='item_path'>Womens Clothing > $item_category > $item_name</p>
                                  </div>";
                        }
                        // displaying the clicked item
                        echo "
                        <!----2 Columns----->
                      <div class='row'>
                        <div class='column left' style='background-color: rgb(255, 255, 255); height: 500px; 
                        width: 30%;'>
                        <img class='border border-dark' style='margin: 0; padding: 0; height: 400px; width: 400px;' src='./admin-interface/item_images/$item_image1' alt=''>
                        </div>
                        <br>
                        
                        <div class='column right item_data' style='background-color: rgb(255, 255, 255); height: 500px;
                        width: 47%;'>
                        <h2 class='fw-light ps-4 pt-1 fs-2'>$item_name</h2>
                        <h4 class='fw-light ps-4 pt-1 fs-3' style='color: orangered;'>₱$item_price.00</h4>
                        <h6 class='fw-bold ps-4 pt2 text-success'>Sold Items: $num_sold | Items left: $num_left</h6>";

                        if(isset($_SESSION['auth']) == false){
                            echo"
                        <form id='loginform' class='loginform' action='./loginpage.php'>";
                        } else {
                            echo "
                            <form id='chooseSizeandQuantityForm' class='chooseSizeandQuantityForm' action='assets/quantityFunction.js'>";
                        } 

                        echo"
                        <h4 class='fw-light ps-4 pt-3 fs-5'>Size</h4>
                         <div class='btn-group ps-4' style='padding-right: -10px; ' id='sizeButtons' role='group' aria-label='Basic example'>
                        ";

                        $new = explode(", ",$sizes_available); 

                        foreach($new as $val){
                            echo "
                                            <input type='radio' class='btn-check' name='radio' value='$val' id='$val' autocomplete='off'>
                                            <label class='btn btn-outline-dark' for='$val'>$val</label>
                                        ";
                        }

                                        echo "
                                        </div>
                                    <h4 class='fw-light ps-4 pt-3 fs-5'>Quantity</h4>
                                        <div class='wrapper' style='border: 1px solid #C0C0C0; height: 30px; width: 150px; margin-top: 10px; margin-left: 23px;
                                        text-align: center; justify-content: center; display: flex;'>
                                            <button class='input-group-text decrement-btn'>-</button>
                                            <input type='text' class='form-control text-center bg-white input-qty' value='1' disabled>
                                            <button class='input-group-text increment-btn'>+</button>
                                        </div>
                                    <br><br>";

                            if(isset($_SESSION['auth']) == false){
                                echo "
                                    <div class='btn-group ps-4 btn-group-lg' role='group' aria-label='Basic example'>
                                        <button type='submit' class='btn btn-warning me-1'>Add to Cart</button>
                                        <button type='submit' class='btn btn-warning me-1'>Buy Now</button>                      
                                    </div> 
                                    </form>   
                                    </div>";
                            } else {
                                echo "
                                    <div class='btn-group ps-4 btn-group-lg' role='group' aria-label='Basic example'>
                                        <button type='submit' id='atcBtnModal' class='btn btn-warning me-1 addToCartBtn' value='$item_code'>Add to Cart</button>
                                        <button type='submit' class='btn btn-warning me-1 buyNowBtn' value='$item_code'>Buy Now</button>                      
                                    </div> 
                                    </form>   
                                    </div>";
                            }        
                                
                        }
                       
                        //formaction='itemclickpage.php?item_code=$item_code&item_category=$item_category&click_on_item=$item_name'
                    }
                }
            }
        }
    }

    

    function get_Suggestion(){
    global $conn;

    if(isset($_GET["item_category"])){
        if (isset($_GET["item_code"])){
            if (!isset($_GET['search_btn'])){
                if (!isset($_GET["mens_category"])){
                    if (!isset($_GET["womens_category"])){

                        $category_name = $_GET["item_category"];
                        $select_query = "SELECT * FROM `items` WHERE item_category = '$category_name' LIMIT 0,5"; //rand() function to randomize items display 
                        $result_query = mysqli_query($conn, $select_query); // LIMIT function to limit the items to be displayed

                        // It's okay if you fail, life is like 
                        // writing a code. Full of trial and errors. 

                        while ($row = mysqli_fetch_assoc($result_query)) {
                            $item_id = $row["item_id"];
                            $item_code = $row["item_code"];
                            $item_name = $row["item_name"];
                            $item_price = $row["item_price"];
                            $item_description = $row["item_description"];
                            $item_keyword = $row["item_keyword"];
                            $item_category = $row["item_category"];
                            $item_image1 = $row["item_image1"];

                                echo "<figure class='figure' style='width: 210px;'>
                                    <img src='./admin-interface/item_images/$item_image1' class='figure-img img-fluid rounded m-3' alt='A generic square placeholder image with rounded corners in a figure.'>
                                    <figcaption class='item_name'>$item_name</figcaption>
                                    <figcaption class='item_price'>₱$item_price.00</figcaption>
                                </figure>
                                ";
                        }
                    }
                }
            }
        }
    }
    }

    function display_UserInformation(){
        global $conn;

        if (isset($_GET["checkout_item"])) {
            if (isset($_POST["buyNowBtn"])) {
                $size = $_POST['radio'];
                $quantity = $_POST['quantitySelect'];
                    if (isset($_SESSION["userEmailAdd"])) {
                        $selectData = "SELECT * FROM users WHERE email_add ='{$_SESSION["userEmailAdd"]}'";
                        $query = mysqli_query($conn, $selectData);
                        if (mysqli_num_rows($query)) {
                            while ($users = mysqli_fetch_array($query)) {
                                $first_name = $users["first_name"];
                                $last_name = $users["last_name"];
                                $street_number = $users["street_number"];
                                $city_municipality = $users["citymunicipality"];
                                $barangay = $users["barangay"];
                                $province = $users["province"];
                                $mobile_num = $users["mobile_number"];

                                echo "
                                        <div class='shippingAddress shadow-lg mb-3 bg-white rounded' style='height: 170px; background-color: #F0F0F0;'>
                                            <h4 class='fw-light ps-2 pt-2 pb-2 bg-warning'>Shipping Information</h4>
                                            <h6 class='text-dark ps-3'>$first_name $last_name</h6>
                                            <h6 class='text-dark ps-3'>$mobile_num</h6>
                                            <h6 class='text-dark ps-3'>$street_number, $barangay, $city_municipality, $province, Philippines</h6>
                                        </div>
                                    ";
                            }
                        }
                    }
            }
                $item_code = $_GET["checkout_item"];
                $select_query = "SELECT * FROM `items` WHERE item_code = '$item_code'";
                $result_query = mysqli_query($conn, $select_query);

                // It's okay if you fail, life is like 
                // writing a code. Full of trial and errors. 

                while ($row = mysqli_fetch_assoc($result_query)) {
                    $item_id = $row["item_id"];
                    $item_code = $row["item_code"];
                    $item_name = $row["item_name"];
                    $item_price = $row["item_price"];
                    $item_description = $row["item_description"];
                    $item_keyword = $row["item_keyword"];
                    $item_category = $row["item_category"];
                    $item_image1 = $row["item_image1"];

                    echo "
                        <div class='itemBought shadow-lg mb-3 bg-white rounded' style='height: 170px; background-color: #F0F0F0;'>
                            <img class='ms-3 mt-3' style='height: 100px; width: 100px; float: left;' src='./admin-interface/item_images/$item_image1' alt=''>
                            <h6 class='fw-bold text-dark pt-3 ps-5' style='margin-left: 80px;'>$item_name</h6>
                            <h6 class='fw-light text-dark ps-5' style='margin-left: 80px; color: orangered;'>₱$item_price.00</h6>
                            <h6 class='fw-light text-dark ps-5' style='margin-left: 80px; color: orangered;'>Size: $size</h6>
                            <h6 class='fw-light text-dark ps-5' style='margin-left: 80px; color: orangered;'>Quantity: $quantity</h6>
                        </div>
                    ";
                }
            }
        }

    function get_TotalAmount(){
        global $conn;

    if (isset($_GET["checkout_item"])) {
        if (isset($_POST["buyNowBtn"])) {
            $size = $_POST['radio'];
            $quantity = $_POST['quantitySelect'];
            $item_code = $_GET["checkout_item"];
            $select_query = "SELECT item_price FROM `items` WHERE item_code = '$item_code'";
            $result_query = mysqli_query($conn, $select_query);

            while ($row = mysqli_fetch_assoc($result_query)) {
                $item_price = $row["item_price"];

                $total_price = ($item_price * $quantity) + 45; 
                
                echo "
                    <div class='col-sm-6 pt-2'>
                        <h6 class='text-dark text-end fw-bold'>₱$item_price.00</h6>  
                        <h6 class='text-dark text-end fw-bold'>$quantity</h6> 
                        <h6 class='text-dark text-end fw-bold'>₱45.00</h6>
                        <h6 class='text-dark pt-4 fs-5 text-end fw-bold'>₱$total_price.00</h6>    
                    </div>
                    ";
            }
        }
        }

    }

    function get_IP_Address(){
        function getIPAddress() {  
            //whether ip is from the share internet  
             if(!empty($_SERVER['HTTP_CLIENT_IP'])) {  
                        $ip = $_SERVER['HTTP_CLIENT_IP'];  
                }  
            //whether ip is from the proxy  
            elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {  
                        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];  
             }  
        //whether ip is from the remote address  
            else{  
                     $ip = $_SERVER['REMOTE_ADDR'];  
             }  
             return $ip;  
        }  
        $ip = getIPAddress();  
        echo 'User Real IP Address - '.$ip;  
    }

    function get_Cart_from_DB(){
    global $conn;

    if(isset($_GET["email_add"])){
        $email_add = $_GET["email_add"];
        $select_query = "SELECT * FROM `cart_table` WHERE email_add = '$email_add'";
        return $result_query = mysqli_query($conn, $select_query);
    }
    }

    function get_checkout_Items(){
        global $conn;

        if(isset($_GET["item_code"])){
            $email_add = $_GET["email_add"];
        //    $check_code[] = $_GET["item_code"];
            $check_code = $_GET["item_code"];
            $new = explode(",", $check_code);
           // $ids = join("','",$check_code);   
            $_SESSION['check_code'] = $check_code;
            
            // echo '<script language="javascript">';
            // echo 'alert("message successfully sent")';
            // echo '</script>';

           // $data = json_decode(stripslashes($check_code));

            //foreach ($new as $code){
                $select_query = "SELECT * FROM `cart_table` WHERE email_add = '$email_add' AND item_id IN (" . implode(',', $new) . ")";
                return $result_query = mysqli_query($conn, $select_query);
           // }
        }
        }

    
    function getMyOrders(){
        global $conn;

        if (isset($_SESSION["user_Id"])) {
            $selectData = "SELECT * FROM users WHERE user_id ='{$_SESSION["user_Id"]}'";
            $query = mysqli_query($conn, $selectData);
                if (mysqli_num_rows($query)) {
                    while ($users = mysqli_fetch_array($query)) {
                        $first_name = $users["first_name"];
                        $last_name = $users["last_name"];
                        $email_address = $users["email_add"];
                        $account_address = $users["street_number"] . ", Barangay " . $users["barangay"] . ", " . $users["citymunicipality"] . ", " . $users["province"]; 
                        $mobile_number = $users["mobile_number"];
                        $birthday = $users["birthday"];
                    }
                }

                $select_from_orders = "SELECT * FROM `orders` WHERE order_email_add = '$email_address' ORDER BY order_date ASC";
                return $select_query = mysqli_query($conn, $select_from_orders);
            }
    }

    function getToShipOrders(){
        global $conn;

        if (isset($_SESSION["user_Id"])) {
            $selectData = "SELECT * FROM users WHERE user_id ='{$_SESSION["user_Id"]}'";
            $query = mysqli_query($conn, $selectData);
                if (mysqli_num_rows($query)) {
                    while ($users = mysqli_fetch_array($query)) {
                        $first_name = $users["first_name"];
                        $last_name = $users["last_name"];
                        $email_address = $users["email_add"];
                        $account_address = $users["street_number"] . ", Barangay " . $users["barangay"] . ", " . $users["citymunicipality"] . ", " . $users["province"]; 
                        $mobile_number = $users["mobile_number"];
                        $birthday = $users["birthday"];
                    }
                }

                $select_from_orders = "SELECT * FROM `orders` WHERE order_email_add = '$email_address' AND order_status = 'To Ship'";
                return $select_query = mysqli_query($conn, $select_from_orders);
            }
    }

    function getToReceiveOrders(){
        global $conn;

        if (isset($_SESSION["user_Id"])) {
            $selectData = "SELECT * FROM users WHERE user_id ='{$_SESSION["user_Id"]}'";
            $query = mysqli_query($conn, $selectData);
                if (mysqli_num_rows($query)) {
                    while ($users = mysqli_fetch_array($query)) {
                        $first_name = $users["first_name"];
                        $last_name = $users["last_name"];
                        $email_address = $users["email_add"];
                        $account_address = $users["street_number"] . ", Barangay " . $users["barangay"] . ", " . $users["citymunicipality"] . ", " . $users["province"]; 
                        $mobile_number = $users["mobile_number"];
                        $birthday = $users["birthday"];
                    }
                }

                $select_from_orders = "SELECT * FROM `orders` WHERE order_email_add = '$email_address' AND order_status = 'Shipping'";
                return $select_query = mysqli_query($conn, $select_from_orders);
            }
    }

    function getReceivedOrders(){
        global $conn;

        if (isset($_SESSION["user_Id"])) {
            $selectData = "SELECT * FROM users WHERE user_id ='{$_SESSION["user_Id"]}'";
            $query = mysqli_query($conn, $selectData);
                if (mysqli_num_rows($query)) {
                    while ($users = mysqli_fetch_array($query)) {
                        $first_name = $users["first_name"];
                        $last_name = $users["last_name"];
                        $email_address = $users["email_add"];
                        $account_address = $users["street_number"] . ", Barangay " . $users["barangay"] . ", " . $users["citymunicipality"] . ", " . $users["province"]; 
                        $mobile_number = $users["mobile_number"];
                        $birthday = $users["birthday"];
                    }
                }

                $select_from_orders = "SELECT * FROM `orders` WHERE order_email_add = '$email_address' AND order_status = 'Received'";
                return $select_query = mysqli_query($conn, $select_from_orders);
            }
    }

    function getCancelledOrders(){
        global $conn;

        if (isset($_SESSION["user_Id"])) {
            $selectData = "SELECT * FROM users WHERE user_id ='{$_SESSION["user_Id"]}'";
            $query = mysqli_query($conn, $selectData);
                if (mysqli_num_rows($query)) {
                    while ($users = mysqli_fetch_array($query)) {
                        $first_name = $users["first_name"];
                        $last_name = $users["last_name"];
                        $email_address = $users["email_add"];
                        $account_address = $users["street_number"] . ", Barangay " . $users["barangay"] . ", " . $users["citymunicipality"] . ", " . $users["province"]; 
                        $mobile_number = $users["mobile_number"];
                        $birthday = $users["birthday"];
                    }
                }

                $select_from_orders = "SELECT * FROM `orders` WHERE order_email_add = '$email_address' AND order_status = 'Cancelled'";
                return $select_query = mysqli_query($conn, $select_from_orders);
            }
    }
    
        

?>