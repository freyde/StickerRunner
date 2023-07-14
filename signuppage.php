<?php
session_start();

if (!isset($_SESSION["auth"])) {
  include_once("header.php");
?>

  <form action="includes/signuppage.inc.php" method="post" style="margin-left: 500px;
     border: 1px solid gray; width: 400px; margin-top: 20px; height: 570px;">
    <h1 style="text-align: center;">Sign Up</h1>
    <div class="form-group" style="height: 75px;">
      <label for="firstName">First Name</label>
      <input type="text" name="first_name" class="form-control" id="first_name" placeholder="Enter First Name" autocomplete="off">
    </div>
    <div class="form-group" style="background-color: rgb(255, 255, 255); height: 75px;">
      <label for="lastName">Last Name</label>
      <input type="text" name="last_name" class="form-control" id="last_name" placeholder="Enter Last Name" autocomplete="off">
    </div>
    <div class="form-group" style="background-color: rgb(255, 255, 255); height: 75px;">
      <label for="emailAddress">Email address</label>
      <input type="email" name="email_add" class="form-control" id="email_add" aria-describedby="emailHelp" placeholder="Enter email" autocomplete="off">
      <small id="emailHelp" class="form-text text-muted"></small>
    </div>
    <div class="form-group" style="height: 75px;">
      <label for="password">Password</label>
      <input type="password" name="userpass" class="form-control" id="userpass" placeholder="Password">
    </div>
    <div class="form-group" style="height: 75px;">
      <label for="Rpassword">Repeat Password</label>
      <input type="password" name="repeatPass" class="form-control" id="repeatPass" placeholder=" Repeat Password">
    </div>
    <div class="form-check">
      <input type="checkbox" class="form-check-input" id="exampleCheck1" style="padding-bottom: -80px;">
      <label class="form-check-label" for="savepassword" style="padding-bottom: -80px; font-size: 12px;">I have read and agree to
        the Terms of Service and Privacy Policy.</label>
    </div>
    <br>
    <h6 class="text-dark text-center">Already have an account? <span><a href="loginpage.php">Log In</a></span></h6>
    <button type="submit" name="submit" class="btn btn-primary" style="margin-left: 100px; width: 50%;
          margin-top: 10px;">Submit</button>

    <?php
    if (isset($_GET["error"])) {
      if ($_GET["error"] == "emptyinput") {
        echo "<p>Fill in all fields!</p>";
      } else if ($_GET["error"] == "invalidFirstName") {
        echo "<p>Invalid First Name!</p>";
      } else if ($_GET["error"] == "invalidLastName") {
        echo "<p>Invalid Last Name!</p>";
      } else if ($_GET["error"] == "invalidEmail") {
        echo "<p>Invalid Email!</p>";
      } else if ($_GET["error"] == "passwordsdontmatch") {
        echo "<p>Passwords dont match!</p>";
      } else if ($_GET["error"] == "emailaddresstaken") {
        echo "<p>Email Address Taken!</p>";
      } else if ($_GET["error"] == "stmtfailed") {
        echo "<p>Something went wrong, try again!</p>";
      } else if ($_GET["error"] == "none") {
        echo "<p>Successfully signed up!</p>";
      }
    }
    ?>
  </form>

  <!----Footer Section----->
  <div class="footer" style="margin-top: 70px;">
    <div class="footer_row">
      <div class="footer_column">
        <h4 style="color: white;">About Sticker Runner</h1>
          <h6>About Us</h6>
          <h6>Privacy Policy</h6>
          <h6>Terms of Use</h6>
          <h6>Contact Us</h6>
      </div>
      <div class="footer_column">
        <h4 style="color: white;">Info</h1>
          <h6>My Account</h6>
          <h6>My Cart</h6>
          <h6>Order Status</h6>
      </div>
      <div class="footer_column">
        <h4 style="color: white;">Help and FAQs</h1>
          <h6>Online Ordering</h6>
          <h6>Shipping</h6>
          <h6>Billing</h6>
          <h6>Return Item</h6>
      </div>
      <div class="footer_column">
        <h4 style="color: white;">Sticker Runner</h1>
      </div>
    </div>

    <hr style="color: white; background-color: white; height: 2px; width: 85%; margin-left: 100px;">

    <h6 style="margin-top: 130px; text-align: center;">(C) 2022 Sticker Runner. All Rights Reserved</h6>
  </div>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
  </script>
<?php
} else {
  header("Location: ../stickerrunner/index.php");
}
?>
</body>

</html>