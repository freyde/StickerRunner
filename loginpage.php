<?php
session_start();

if (!isset($_SESSION["auth"])) {
  include_once("header.php");
?>

  <form action="includes/login.inc.php" method="post" style="margin-left: 500px; border: 1px solid gray; width: 400px; margin-top: 50px; height: 400px;">
    <h1 style="text-align: center;">Log In</h1>
    <div class="form-group" style="padding-top: 20px;">
      <label for="emailAddress">Email Address</label>
      <input type="email" name="email_add" class="form-control" id="email_add" aria-describedby="emailHelp" placeholder="Enter email" autocomplete="off">
      <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
    </div>
    <div class="form-group" style="padding-top: 20px;">
      <label for="password">Password</label>
      <input type="password" name="loginpass" class="form-control" id="loginpass" placeholder="Password">
    </div>
    <h6 class="text-dark text-center">Don't have an account? <span><a href="signuppage.php">Create Account</a></span></h6>
    <button type="submit" name="submit" class="btn btn-primary" style="margin-left: 100px; width: 50%; margin-top: 10px;">Log In</button>

    <?php
    if (isset($_GET["error"])) {
      if ($_GET["error"] == "emptyinput") {
        echo "<p>Fill in all fields!</p>";
      } else if ($_GET["error"] == "wronglogin") {
        echo "<p>Incorrect Login Information!</p>";
      }
    }
    ?>

  </form>
  <div class="footer" style="margin-top: 70px;">
    <div class="footer_row">
      <div class="footer_column">
        <h4 style="color: white;">About Sticker Runners</h1>
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
      
     
    </div>

    <hr style="color: white; background-color: white; height: 2px; width: 85%; margin-left: 100px;">

    <h6 style="margin-top: 130px; text-align: center;">(C) 2022 Stciker Runners Clothing. All Rights Reserved</h6>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
  </script>
<?php
} else {
  header("Location: ../index.php");
}
?>
</body>

</html>