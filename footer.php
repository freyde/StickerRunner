
<div class="footer bg-secondary">
    <div class="row">
    <div class="col-md-2"></div>
        <div class="col-md-3">
            <figure class="text-end">
                <h4 style="color: white;">Sticker Runners</h4>
                <a class="link-dark link-offset-2 link-underline link-underline-opacity-0" href="aboutus.php">About Us</a><br>
                <a class="link-dark link-offset-2 link-underline link-underline-opacity-0" href="privacypolicy.php">Privacy Policy</a><br>
                <a class="link-dark link-offset-2 link-underline link-underline-opacity-0" href="">Terms of Use</a><br>
            </figure>
        </div>
        <div class="col-md-2">
            <figure class="text-center">
                <h4 style="color: white;">My Account</h4>
                <a class="link-dark link-offset-2 link-underline link-underline-opacity-0" href="manage_account.php">My Account</a><br>
                <?php
                if(isset($_SESSION['userEmailAdd'])){
                    ?>
                        <a class="link-dark link-offset-2 link-underline link-underline-opacity-0" href="shoppingcartpage.php?email_add=<?= $_SESSION['userEmailAdd'] ?>">My Cart</a><br>

                    <?php
                }
                else{
                    ?>
                        <a class="link-dark link-offset-2 link-underline link-underline-opacity-0" href="loginpage.php">My Cart</a><br>
                    <?php
                }
                ?>
                <a class="link-dark link-offset-2 link-underline link-underline-opacity-0" href="my_orders.php">Order Status</a>
            </figure>
        </div>
        <div class="col-md-3">
            <figure class="text-start">
                <h4 style="color: white;">Contact Us</h4>
                <a class="link-dark link-offset-2 link-underline link-underline-opacity-0" href="mailto:stickerrunners@gmail.com">stickerrunners@gmail.com</a><br>
                <a class="link-dark link-offset-2 link-underline link-underline-opacity-0" href="https://www.facebook.com/profile.php?id=100093969124011">Facebook</a><br>
                <a class="link-dark link-offset-2 link-underline link-underline-opacity-0" href="my_orders.php">+63968-326-3991, +63917-827-2293</a>
            </figure>
        </div>
        <div class="col-md-2"></div>
        <hr style="color: white; background-color: white;">
        <h6 style="text-align: center;">© 2023 Sticker Runners. All Rights Reserved</h6>
        <a class="link-dark link-offset-2 link-underline link-underline-opacity-0" href="my_orders.php"></a>
    </div>
</div>