<?php
include_once("header.php");
?>

<body>


    <?php
    if (isset($_SESSION["user_Id"])) {
        $selectData = "SELECT * FROM users WHERE user_id ='{$_SESSION["user_Id"]}'";
        $query = mysqli_query($conn, $selectData);
        if (mysqli_num_rows($query)) {
            while ($users = mysqli_fetch_array($query)) {
                $first_name = $users["first_name"];
                $last_name = $users["last_name"];
                $email_address = $users["email_add"];
                $account_address = $users["street_number"] . "" . $users["barangay"] . "" . $users["citymunicipality"] . "" . $users["province"];
                $mobile_number = $users["mobile_number"];
                $birthday = $users["birthday"];
    ?>
                <input id="hiddenProv" type="text" hidden value="<?= $users['province'] ?>">
                <input id="hiddenCity" type="text" hidden value="<?= $users['citymunicipality'] ?>">
                <input id="hiddenBrgy" type="text" hidden value="<?= $users['barangay'] ?>">

                <form action="includes/update_account.php" method="post" style="height: 400px; width: 880px;
                                        margin-left: 120px; background-color: white; margin-top: 40px;">
                    <div class="edit_profile" style="padding-left: 10px; padding-top: 30px; ">
                        <h1>Edit My Account Info</h1>

                        <div class="row mt-3">
                            <div class="col-3" style="width: 220px;">
                                <label style="font-size: 14px;" for="firstName">First Name<span style="color: red;">*</span></label>
                                <input type="search" class="form-control" id="first_name" name="e_first_name" value="<?php echo $first_name; ?>" style="width: 200px;">
                            </div>
                            <div class="col-3" style="width: 220px;">
                                <label style="font-size: 14px;" for="lastName">Last Name<span style="color: red;">*</span></label>
                                <input type="search" class="form-control" id="last_name" name="e_last_name" value="<?php echo $last_name; ?>" style="width: 200px;">
                            </div>
                            <div class="col-7" style="width: 220px;">
                                <label style="font-size: 14px;" for="lastName">Street Number<span style="color: red;">*</span></label>
                                <input type="search" class="form-control" id="street_num" name="street_num" value="<?php echo $users["street_number"]; ?>" style="width: 400px;">
                            </div>

                        </div>

                        <div class="row mt-3">
                            <div class="col-3" style="width: 220px;">
                                <label style="font-size: 14px;" for="emailOrPhone">Email Address<span style="color: red;">*</span></label>
                                <input type="search" class="form-control" id="email_or_phone" name="e_email_or_phone" value="<?php echo $email_address; ?>" style="width: 200px;">
                            </div>
                            <div class="col-4" style="width: 220px;">
                                <label style="font-size: 14px;" for="contactNum">Contact Number<span style="color: red;">*</span></label>
                                <input type="search" class="form-control" id="contact_number" name="e_contact_number" value="<?php echo $mobile_number; ?>" style="width: 200px;">
                            </div>
                            <div class="col-4">
                                <div class="btn-group">
                                    <div class="provinceSelect">
                                        <small id="provinceGuide" class="form-text fst-italic">Province<span style="color: red;">*</span></small>
                                        <select class="form-select me-2" style="width: 120px; height: 34px;" onload="getCitiesMunicipalities('<?= $users['province'] ?>')" onchange="getCitiesMunicipalities(this.value)" name="provinces">
                                            <option value="">Province</option>
                                            <option value="Cavite" selected>Cavite</option>
                                        </select>
                                    </div>

                                    <div class="cityMunSelect">
                                        <small id="cityMunGuide" class="form-text fst-italic">City/Municipality<span style="color: red;">*</span></small>
                                        <select class="form-select me-2" style="width: 140px; height: 34px;" onload="getBarangay('<?= $users['citymunicipality'] ?>')" onchange="getBarangay(this.value)" name="city_municipality" id="city_municipality">
                                            <option value="">City/Municipality</option>
                                        </select>
                                    </div>

                                    <div class="barangaySelect">
                                        <small id="cityMunGuide" class="form-text fst-italic">Barangay<span style="color: red;">*</span></small>
                                        <select class="form-select me-2" style="width: 120px; height: 34px;" name="barangay" id="barangay">
                                            <option value="">Barangay</option>
                                        </select>
                                    </div>
                                </div>
                                <script>
                                    // getCitiesMunicipalities("Cavite");
                                    // getBarangay("Tanza");
                                    function getCitiesMunicipalities(province) {
                                        let citiesDropDown = document.querySelector("#city_municipality");

                                        if (province.trim() === "") {
                                            citiesDropDown.disabled = true;
                                            citiesDropDown.selectedIndex = 0;
                                            return false;
                                        }

                                        // AJAX request with fetch()
                                        fetch("provinces.json")
                                            .then(function(response) {
                                                return response.json();
                                            })
                                            .then(function(data) {
                                                let cities_municipalities = data[province];
                                                let out = "";
                                                out += `<option value="">City/Municipality</option>`;
                                                for (let cityMun of cities_municipalities) {
                                                    out += `<option value="${cityMun}">${cityMun}</option>`;
                                                }
                                                citiesDropDown.innerHTML = out;
                                                citiesDropDown.disabled = false;
                                            });
                                        return;
                                    }

                                    function getCitiesMunicipalitiesDefault(province, city) {
                                        let citiesDropDown = document.querySelector("#city_municipality");

                                        // if (province.trim() === "") {
                                        //     citiesDropDown.disabled = true;
                                        //     citiesDropDown.selectedIndex = 0;
                                        //     return false;
                                        // }

                                        // AJAX request with fetch()
                                        fetch("provinces.json")
                                            .then(function(response) {
                                                return response.json();
                                            })
                                            .then(function(data) {
                                                let cities_municipalities = data[province];
                                                let out = "";
                                                out += `<option value="">City/Municipality</option>`;
                                                for (let cityMun of cities_municipalities) {
                                                    if (city == cityMun)
                                                        out += `<option value="${cityMun}" selected>${cityMun}</option>`;
                                                    else
                                                        out += `<option value="${cityMun}">${cityMun}</option>`;
                                                }
                                                citiesDropDown.innerHTML = out;
                                                citiesDropDown.disabled = false;
                                            });
                                        return;
                                    }

                                    function getBarangay(sBrgy) {
                                        let barangayDropDown = document.querySelector("#barangay");

                                        if (sBrgy.trim() === "") {
                                            barangayDropDown.disabled = true;
                                            barangayDropDown.selectedIndex = 0;
                                            return false;
                                            document.write("FALSE PAR");
                                        }

                                        // AJAX request with fetch()
                                        fetch("barangays.json")
                                            .then(function(brgyresponse) {
                                                return brgyresponse.json();
                                            })
                                            .then(function(datas) {
                                                let brgys = datas[sBrgy];
                                                let out1 = "";
                                                out1 += `<option value="">Barangay</option>`;
                                                for (let specificbrgy of brgys) {
                                                    out1 += `<option value="${specificbrgy}">${specificbrgy}</option>`;
                                                }
                                                barangayDropDown.innerHTML = out1;
                                                barangayDropDown.disabled = false;
                                            });
                                    }

                                    function getBarangayDefault(sBrgy, brgy) {
                                        let barangayDropDown = document.querySelector("#barangay");

                                        if (sBrgy.trim() === "") {
                                            barangayDropDown.disabled = true;
                                            barangayDropDown.selectedIndex = 0;
                                            return false;
                                            document.write("FALSE PAR");
                                        }

                                        // AJAX request with fetch()
                                        fetch("barangays.json")
                                            .then(function(brgyresponse) {
                                                return brgyresponse.json();
                                            })
                                            .then(function(datas) {
                                                let brgys = datas[sBrgy];
                                                let out1 = "";
                                                out1 += `<option value="">Barangay</option>`;
                                                for (let specificbrgy of brgys) {
                                                    if (brgy == specificbrgy)
                                                        out1 += `<option value="${specificbrgy}" selected>${specificbrgy}</option>`;
                                                    else
                                                        out1 += `<option value="${specificbrgy}">${specificbrgy}</option>`;
                                                }
                                                barangayDropDown.innerHTML = out1;
                                                barangayDropDown.disabled = false;
                                            });
                                    }
                                </script>
                                <script>
                                    var prov = document.getElementById("hiddenProv").value;
                                    var city = document.getElementById("hiddenCity").value;
                                    var brgy = document.getElementById("hiddenBrgy").value;
                                    getCitiesMunicipalitiesDefault(prov, city);
                                    getBarangayDefault(city, brgy);
                                </script>
                            </div>
                        </div>


                        <button type="submit" name="save" class="btn btn-primary" style="margin-left: 1px; width: 25%;
                                            margin-top: 40px; height: 50px;">Save</button>
                    </div>

                    <br><br>
                    <br><br>
                </form>
    <?php
            }
        }
    } else {
        echo '<script>alert("Something went wrong!vaa")</script>';
    }

    ?>

    <button onclick="window.location.href='manage_account.php'" class="btn btn-primary" style="margin-left: 600px; width: 15%;
                                            margin-top: -127px; height: 50px;">Cancel</button>


    <!-- </div> -->
    <!-- </div>
    </div>
    </div> -->


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>