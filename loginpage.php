<?php
session_start();
if (!isset($_SESSION["auth"])) {
  include("headerLog.php");
?>
  <body>
    <div id="page-container">
      <div id="content-wrap">
        <div class="row pt-5">
          <div class="col-12">
            <div class="card col-3 mx-auto border-dark">
              <form action="includes/login.inc.php" method="post">
                <div class="card-header bg-dark text-white text-center">
                  <h5>Log In</h5>
                </div>
                <div class="card-body">
                  <div class="form-group">
                    <label for="emailAddress">
                      <h6>Email Address</h6>
                    </label>
                    <input type="email" name="email_add" class="form-control" id="email_add" aria-describedby="emailHelp" placeholder="example@gmail.com" autocomplete="off" required>
                  </div>
                  <br>
                  <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="loginpass" class="form-control" id="loginpass" placeholder="Password" required>
                  </div>
                  <br>
                  <h6 class="text-dark text-center">Don't have an account? <span><a href="signuppage.php">Create Account</a></span></h6>
                  <br>
                  <div class="d-grid gap-2 col-6 mx-auto">
                    <button type="submit" name="submit" class="btn btn-outline-dark"><b>Sign In</b></button>
                  </div>
                  <?php
                  if (isset($_GET["error"])) {
                    if ($_GET["error"] == "emptyinput") {
                      echo "<p>Fill in all fields!</p>";
                    } else if ($_GET["error"] == "wronglogin") {
                      echo "<p>Incorrect Login Information!</p>";
                    }
                  }
                  ?>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php
    include("footer.php");
    ?>
  <?php
} else {
  header("Location: ../index.php");
}
  ?>
  </body>

  </html>