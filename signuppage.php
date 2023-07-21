<?php
session_start();

if (!isset($_SESSION["auth"])) {
  include_once("headerLog.php");
?>

  <div id="page-container">
    <div id="content-wrap">
      <div class="row pt-5">
        <div class="col-12">
          <div class="card col-3 mx-auto border-dark">
            <form action="includes/signuppage.inc.php" method="post">
              <div class="card-header bg-dark text-white text-center">
                <h5>Sign Up</h5>
              </div>
              <div class="card-body">
                <div class="form-group" style="height: 75px;">
                  <label for="firstName">First Name</label>
                  <input type="text" name="first_name" class="form-control" id="first_name" placeholder="Enter First Name" autocomplete="off" required>
                </div>
                <div class="form-group" style="background-color: rgb(255, 255, 255); height: 75px;">
                  <label for="lastName">Last Name</label>
                  <input type="text" name="last_name" class="form-control" id="last_name" placeholder="Enter Last Name" autocomplete="off" required>
                </div>
                <div class="form-group" style="background-color: rgb(255, 255, 255); height: 75px;">
                  <label for="emailAddress">Email address</label>
                  <input type="email" name="email_add" class="form-control" id="email_add" aria-describedby="emailHelp" placeholder="Enter email" autocomplete="off" required>
                  <small id="emailHelp" class="form-text text-muted"></small>
                </div>
                <div class="form-group" style="height: 75px;">
                  <label for="password">Password</label>
                  <input type="password" name="userpass" class="form-control" id="userpass" placeholder="Password" required>
                </div>
                <div class="form-group" style="height: 75px;">
                  <label for="Rpassword">Repeat Password</label>
                  <input type="password" name="repeatPass" class="form-control" id="repeatPass" placeholder=" Repeat Password" required>
                </div>
                <div class="form-check">
                  <input type="checkbox" class="form-check-input" id="exampleCheck1" style="padding-bottom: -80px;" required>
                  <label class="form-check-label" for="savepassword" style="padding-bottom: -80px; font-size: 12px;">I have read and agree to
                    the Terms of Service and Privacy Policy.</label>
                </div>
                <br>
                <h6 class="text-dark text-center">Already have an account? <span><a href="loginpage.php">Log In</a></span></h6>
                <div class="d-grid gap-2 col-6 mx-auto">
                  <button type="submit" name="submit" class="btn btn-outline-dark">Submit</button>
                </div>
              </div>
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
          </div>
        </div>
      </div>
    </div>
    <?php
    include("footer.php");
    ?>

    <!----Footer Section----->



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
  <?php
} else {
  header("Location: ../index.php");
}
  ?>
  </body>

  </html>