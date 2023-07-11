<?php
include_once("header.php");
include_once("includes/signuppage.inc.php");
?>

<div class="content">
    <div class="userInfo mt-3" style="margin-left: 230px; margin-right: 100px; border: 1px solid gray; width: 920px;">
    <h3 style="padding-top: 10px; padding-left: 10px;">Finish setting up information</h3>

    <div class="viewFullUserInfo" style="height: 200px; margin-right: 20px; margin-left: 20px;">
                <?php
                    include_once("includes/signuppage.inc.php");
                    ?>
                            <div class="btn-group">
                                <div class="form-group" style="height: 75px; width: 270px; padding-right: 10px;">
                                    <small id="firstNameGuide" class="form-text fst-italic">First Name<span style="color: red;">*</span></small>
                                    <input type="text" name="firstName" class="form-control" id="firstName" value="<?php echo ucwords($_SESSION["first_name"]) ?>" disabled>
                                </div>
                                <div class="form-group" style="height: 75px; width: 270px; padding-right: 10px;">
                                    <small id="lastNameGuide" class="form-text fst-italic">Last Name<span style="color: red;">*</span></small>
                                    <input type="text" name="lastName" class="form-control" id="lastName" value="<?php echo ucwords($_SESSION["last_name"]) ?>" disabled>
                                </div>
                                <div class="form-group" style="height: 75px; width: 270px; padding-right: 10px;">
                                    <small id="emailAddGuide" class="form-text fst-italic">Email Address<span style="color: red;">*</span></small>
                                    <input type="text" name="emailAdd" class="form-control" id="emailAdd" value="<?php echo $_SESSION["email_add"] ?>" disabled>
                                </div>
                            </div>
                            <div class="btn-group">
                                <div class="form-group" style="height: 75px; width: 400px; padding-right: 10px;">
                                    <small id="emailAddGuide" class="form-text fst-italic">Password<span style="color: red;">*</span></small>
                                    <input type="password" name="user_password" class="form-control" id="user_password" value="<?php echo $_SESSION["userpassword"] ?>" disabled>
                                </div>
                                <div class="form-group" style="height: 75px; width: 400px; padding-right: 10px;">
                                    <small id="emailAddGuide" class="form-text fst-italic">Repeat Password<span style="color: red;">*</span></small>
                                    <input type="password" name="user_rPassword" class="form-control" id="user_rPassword" value="<?php echo $_SESSION["userpassword"] ?>" disabled>
                                </div>
                            </div>
                        <?php
                ?>
            </div>

    <form action="includes/signuppage.inc.php" method="post" style="margin-left: 20px;
    margin-top: 0px; height: 570px;">
        <h6 class="text-dark ps-3">Complete Address</h6>
            <div class="btn-group">
                <div class="form-group" style="height: 75px; width: 400px; padding-right: 10px;">
                    <small id="street_numGuide" class="form-text fst-italic">Street Number<span style="color: red;">*</span></small>
                    <input type="text" name="street_num" class="form-control" id="street_num" placeholder="Block, Section, Phase, Street No."
                    autocomplete="off">
                </div>
                <div class="provinceSelect">
                    <small id="provinceGuide" class="form-text fst-italic">Province<span style="color: red;">*</span></small>
                    <select class="form-select me-2" style="width: 150px; height: 38px;"
                    onchange="getCitiesMunicipalities(this.value)" name="provinces">
                        <option value="">Province</option>
                        <option value="Cavite">Cavite</option>
                        <!-- <option value="Marikina">Marikina</option>
                        <option value="Manila">Manila</option> -->
                    </select>
                </div>
                <div class="cityMunSelect">
                    <small id="cityMunGuide" class="form-text fst-italic">City/Municipality<span style="color: red;">*</span></small>
                    <select class="form-select me-2" style="width: 150px; height: 38px;"
                    onchange="getBarangay(this.value)" name="city_municipality" id="city_municipality" disabled>
                        <option value="">City/Municipality</option>
                    </select>
                </div>
                <div class="barangaySelect">
                    <small id="cityMunGuide" class="form-text fst-italic">Barangay<span style="color: red;">*</span></small>
                    <select class="form-select me-2" style="width: 150px; height: 38px;"
                    onchange="getBarangaysss(this.value)" name="barangay" id="barangay" disabled>
                        <option value="">Barangay</option>
                    </select>
                </div>  
            
            </div>

            <div class="btn-group">
                <div class="form-group" style="background-color: rgb(255, 255, 255); height: 75px; width: 200px;">
                    <!---   <label for="mobile_num">Mobile Number</label>  --->
                    <small id="cityMunGuide" class="form-text fst-italic">Mobile Number<span style="color: red;">*</span></small>
                    <input type="text" name="mobile_num" class="form-control" id="mobile_num" placeholder="Enter Mobile Number"
                    autocomplete="off">
                </div>
                <div class="form-group" style="background-color: rgb(255, 255, 255); height: 75px; width: 200px;">
                    <!--<label for="emailAddress">Birthday</label>-->
                    <small id="cityMunGuide" class="form-text fst-italic">Birthday<span style="color: red;">*</span></small>
                    <input type="date" name="bday" class="form-control" id="bday" aria-describedby="" placeholder="">
                </div>
                <div class="form-group" style="height: 75px; width: 200px; margin-top: -1px;">
                <small id="cityMunGuide" class="form-text fst-italic">Gender<span style="color: red;">*</span></small>
                <select class="form-select" name="user_gender" id="user_gender" style="width: 150px; height: 38px;" aria-label="Default select example">
                    <option selected>Gender</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
                </div>
            </div>
            <br>
                <button type="proceed" name="proceed" class="btn btn-primary" style="margin-left: 220px; width: 50%;
                margin-top: 40px; height: 50px;">Create Account</button>
    </form>
    </div>
</div>  

    <!----Footer Section----->
    <div class="footer" style="margin-top: 70px;">
        <div class="footer_row">
            <div class="footer_column">
                <h4 style="color: white;">About TopBuds</h1>
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
                <h4 style="color: white;">TopBuds Clothing</h1>
            </div>
          </div>

          <hr style="color: white; background-color: white; height: 2px; width: 85%; margin-left: 100px;">

          <h6 style="margin-top: 130px; text-align: center;">(C) 2022 Topbuds Clothing. All Rights Reserved</h6>
      </div>

  
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
       integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    <script>
        function getCitiesMunicipalities(province){
        let citiesDropDown = document.querySelector("#city_municipality");
        
        if(province.trim() === ""){
            citiesDropDown.disabled = true;
            citiesDropDown.selectedIndex = 0;
            return false;
        }
        
        // AJAX request with fetch()
        fetch("provinces.json")
        .then(function(response){
            console.log(response);
            return response.json();
        })
        .then(function(data){
            let cities_municipalities = data[province];
            let out = "";
            out += `<option value="">City/Municipality</option>`;
            for(let cityMun of cities_municipalities){
                out += `<option value="${cityMun}">${cityMun}</option>`;
                console.log(cityMun);
            }
            citiesDropDown.innerHTML = out;
            citiesDropDown.disabled = false;
        });
        return;
        }

        function getBarangay(sBrgy){
            let barangayDropDown = document.querySelector("#barangay");
            
            if(sBrgy.trim() === ""){
                barangayDropDown.disabled = true;
                barangayDropDown.selectedIndex = 0;
                return false;
                document.write("FALSE PAR");
            }

            // AJAX request with fetch()
            fetch("barangays.json")
            .then(function(brgyresponse){
                return brgyresponse.json();
            })
            .then(function(datas){
                let brgys = datas[sBrgy];
                let out1 = "";
                out1 += `<option value="">--Barangay--</option>`;
                for(let specificbrgy of brgys){
                    out1 += `<option value="${specificbrgy}">${specificbrgy}</option>`;
                    console.log(specificbrgy);
                }
                barangayDropDown.innerHTML = out1;
                barangayDropDown.disabled = false;
            });
            }
    </script>

    <script>
        function displayFunction(){
            var x = document.getElementById("street_num").value;
            document.getElementById("street").innerHTML = x;
            return;
        }
    </script>
</html>