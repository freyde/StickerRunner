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
                  <input type="email" name="email_add" class="form-control" id="email_add" aria-describedby="emailHelp" placeholder="example@gmail.com" autocomplete="off" required>
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
                <div class="form-check text-center">
                  <input type="checkbox" class="form-check-input" id="exampleCheck1" style="padding-bottom: -80px;" required>
                  <label class="form-check-label" for="savepassword" style="padding-bottom: -80px; font-size: 12px;">
                    I have read and agree to the
                    <button type="button" class="btn btn-sm" data-bs-toggle="modal" data-bs-target="#tosModal" style="font-size: 12px">
                      <u><b>Terms of Service</b></u>
                    </button>
                    and
                    <button type="button" class="btn btn-sm" data-bs-toggle="modal" data-bs-target="#policyModal" style="font-size: 12px">
                      <u><b>Privacy Policy</b></u>
                    </button>.
                  </label>
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

    <div class="modal fade" id="tosModal" tabindex="-1" aria-labelledby="tosModalLabel" aria-hidden="true">
      <div class="modal-dialog  modal-dialog-scrollable">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Terms of Service</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <ul>
              Welcome to Sticker Runners. By accessing and using our web-based e-commerce system, you agree to comply with the following Terms of Service. Please read these terms carefully before using our platform. If you do not agree to these terms, you should not use our services.
            </ul>
            <br>
            <ul>
              <h6>Acceptance of Terms</h6>
              <li>By using our e-commerce platform, you acknowledge that you have read, understood, and accepted these Terms of Service, as well as our Privacy Policy and any other guidelines or policies incorporated herein by reference. These terms apply to all users, including customers, sellers, merchants, and any other users accessing our platform. </li>
            </ul> <br>
            <ul>
              <h6>Use of the Platform</h6>
              <li>Eligibility: You must be at least 15 years old. By using our platform, you affirm that you are in required age to enter into this agreement or have the necessary legal consent to do so.</li>
              <li>Account Registration: In order to access certain features of our platform, you may be required to create an account. You are responsible for providing accurate and up-to-date information during the registration process. You must keep your account credentials confidential and are solely responsible for any activities that occur under your account.</li>
              <li>Prohibited Activities: You agree not to use our platform for any unlawful or unauthorized purpose, including but not limited to fraud, infringement of intellectual property rights, or distribution of harmful content. You may not interfere with or disrupt the security or integrity of our platform. </li>
            </ul><br>
            <ul>
              <h6>Buying on the Platform</h6>
              <li>Purchases: When purchasing products or services from sellers on our platform, you agree to abide by the seller's terms and conditions as well as any additional policies set forth by us. </li>
            </ul>
            <p>Please contact us at <b>stickerrunners@gmail.com/+63917-827-2293</b> if you have any questions or concerns regarding these Terms of Service.
            </p>
            <p>Last updated: July, 2023</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="policyModal" tabindex="-1" aria-labelledby="policyModalLabel" aria-hidden="true">
      <div class="modal-dialog  modal-dialog-scrollable">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Privacy Policy</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <p><b>Effective Date: July, 2023</b></p>
            <p>At Sticker Runners, we value your privacy and are committed to protecting your personal information. This Privacy Policy outlines how we collect, use, disclose, and safeguard your personal data when you visit our website or interact with our services. Please read this policy carefully to understand our practices and how your personal information will be treated.</p>
            <br>
            <ul><b>Information We Collect:</b>
              <li>Personal Information: We may collect various types of personal information from you, such as your name, email address, phone number, shipping address, billing information, and other relevant details necessary for providing our products and services.</li>
              <li>Usage Information: When you visit our website, we may automatically collect certain information about your device, browsing actions, and patterns. This information may include your IP address, browser type, referring/exit pages, operating system, date/time stamps, and clickstream data.</li>
              <li>Cookies and Similar Technologies: We use cookies and similar tracking technologies to enhance your experience on our website and improve our services. These technologies allow us to remember your preferences, understand how you use our website, and tailor content and advertisements to suit your interests.</li>
            </ul> <br>
            <ul><b>How We Use Your Information:</b>
              <li>Provide and Improve Services: We use the information collected to process and fulfill your orders, communicate with you, respond to your inquiries, and improve our products and services.</li>
              <li>Personalization: Your data allows us to personalize your shopping experience, recommend products, and provide tailored content and offers based on your preferences.</li>
              <li>Marketing: With your consent, we may use your contact information to send you promotional materials and updates about our latest products, sales, and special offers.</li>
              <li>Legal Compliance: We may use your information to comply with applicable legal obligations, resolve disputes, and enforce our policies.</li>
            </ul><br>
            <ul><b>Sharing Your Information:</b>
              <li>Third-Party Service Providers: We may share your personal information with trusted third-party service providers who assist us in operating our website, conducting business activities, and delivering services to you.</li>
              <li>Legal Requirements: We may disclose your information if required by law, to protect our rights, or in response to a valid legal request.</li>
              <li>Business Transactions: If our business undergoes a merger, acquisition, or sale, your personal information may be transferred as part of the transaction. We will notify you of any such change and provide options regarding your data.</li>
            </ul>
            <p><b>Contact Us:</b></p>
            <p>If you have any questions, concerns, or requests regarding this Privacy Policy or the way we handle your personal information, please contact us at:</p>
            <p><b>stickerrunners@gmail.com</b></p>
            <p><b>+63968-326-3991/+63917-827-2293</b></p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
          </div>
        </div>
      </div>
    </div>
    <script src="../jquery-3.6.3.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script>

    </script>
  <?php
} else {
  header("Location: ../index.php");
}
  ?>
  </body>

  </html>