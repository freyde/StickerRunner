<head>
    <link rel="stylesheet" type="text/css" href="styles/fontselect-default.css" />
    <script src="jquery.fontselect.js"></script>
</head>

<?php
session_start();

if (isset($_SESSION["auth"])) {
    include("headerCustom.php");
    include_once("includes/functions.inc.php");
?>
    <div class="p-5 bg-white rounded shadow mb-5">
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <a class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Home</a>
                <a class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Profile</a>
                <a class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Contact</a>
            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                <p>clicked home</p>
                <p>clicked home</p>
                <p>clicked home</p>
            </div>
            <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                <p>clicked profile</p>
                <p>clicked profile</p>
                <p>clicked profile</p>
            </div>
            <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                <p>clicked contact</p>
                <p>clicked contact</p>
                <p>clicked contact</p>
            </div>
        </div>
        <ul id="myTab2" role="tablist" class="nav nav-tabs nav-pills with-arrow lined flex-column flex-sm-row text-center">
            <li class="nav-item flex-sm-fill">
                <a id="home2-tab" data-toggle="tab" href="#home2" role="tab" aria-controls="home2" aria-selected="true" class="active nav-link text-uppercase font-weight-bold mr-sm-3 rounded-0 active">
                    <h5>Customize Your Shirt</h5>
                </a>
            </li>
            <li class="nav-item flex-sm-fill">
                <a id="profile2-tab" data-toggle="tab" href="#profile2" role="tab" aria-controls="profile2" aria-selected="false" class="nav-link text-uppercase font-weight-bold mr-sm-3 rounded-0">
                    <h5>Order Your Custom Shirt</h5>
                </a>
            </li>
        </ul>
        <div id="myTab2Content" class="tab-content">
            <div id="home2" role="tabpanel" aria-labelledby="home2-tab" class="tab-pane fade px-4 py-5 show active">
                <div class="row">
                    <div class="col-md-6 float-start">
                        <canvas id="c"></canvas>
                    </div>

                    <div class="col-md-6 float-end">
                        <h1>Customize Your Shirt</h1>
                        <form action="">
                            <hr>
                            <h4>Shirt</h4>
                            <div class="d-grid gap-2 col-6 mx-auto">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="shirtOrientaion" id="shirtOrientaionFront" value="front" checked>
                                    <label class="form-check-label" for="shirtOrientaionFront">
                                        Front
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="shirtOrientaion" id="shirtOrientaionBack" value="back">
                                    <label class="form-check-label" for="shirtOrientaionFront">
                                        Back
                                    </label>
                                </div>
                                <label for="shirtColorSelect">Color</label>
                                <select id="shirtColorSelect" class="form-select float-end" aria-label="Default select example">
                                    <option value="shirt/blackShirtFront.png" selected>Black</option>
                                    <option value="shirt/whiteShirtFront.png">White</option>
                                    <option value="shirt/redShirtFront.png">Red</option>
                                    <option value="shirt/greenShirtFront.png">Green</option>
                                    <option value="shirt/blueShirtFront.png">Blue</option>
                                    <option value="shirt/yellowShirtFront.png">Yellow</option>
                                    <option value="shirt/purpleShirtFront.png">Purple</option>
                                    <option value="shirt/grayShirtFront.png">Gray</option>
                                    <option value="shirt/brownShirtFront.png">Brown</option>
                                    <option value="shirt/navyShirtFront.png">Navy Blue</option>
                                    <option value="shirt/maroonShirtFront.png">Maroon</option>
                                    <option value="shirt/cyanShirtFront.png">Cyan</option>
                                </select>
                            </div>
                            <hr>

                            <h4>Text</h4>
                            <div class="d-grid gap-2 col-6 mx-auto">
                                <div class="input-group mb-3">
                                    <h5>Font:&nbsp&nbsp</h5>
                                    <input id="font" type="text" class="form-control" />
                                </div>
                                <div class="input-group mb-3">
                                    <h5>Color:&nbsp&nbsp</h5>
                                    <input class="ml-3" type="color" name="textColor" id="textColor" value="#FFFFFF">
                                </div>

                                <button id="addTextBtn" class="btn btn-primary" type="button">Add Text</button>

                            </div>
                            <hr>

                            <h4>Image</h4>
                            <div class="d-grid gap-2 col-6 mx-auto">
                                <div class="input-group">
                                    <input type="file" class="form-control" id="inputImageFile" accept="image/*">
                                    <!-- <button class="btn btn-outline-secondary" type="button" id="inputGroupFileAddon04">Button</button> -->
                                </div>
                            </div>
                            <hr>
                            <div class="d-grid gap-2 col-6 mx-auto">
                                <button id="delObjBtn" class="btn btn-primary" type="button">Delete Selected</button>
                                <button id="delAllBtn" class="btn btn-primary" type="button">Delete All</button>
                            </div>
                            <hr>
                            <div class="d-grid gap-2 col-6 mx-auto">
                                <button id="buyBtn" class="btn btn-primary" type="button">Download</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div id="profile2" role="tabpanel" aria-labelledby="profile-tab" class="tab-pane fade px-4 py-5">
                <p class="leade font-italic">BLorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute
                    irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                <p class="leade font-italic mb-0">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute
                    irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
            </div>
        </div>

        <script src="assets/fontselect.js"></script>
        <script>
            $(function() {
                $('#font').fontselect({
                    lookahead: 20,
                });
            });
            // create a wrapper around native canvas element (with id="c")
            // { preserveObjectStacking:true }
            var canvas = new fabric.Canvas('c');
            var printCanvas = new fabric.Canvas('c');
            canvas.setWidth(document.body.scrollWidth * 0.5);


            var canvasWidth = canvas.getWidth();
            var shirtImage;
            var shirtColor;

            // Add shirt------------------------------------------------------------------
            fabric.Image.fromURL('shirt/blackShirtFront.png', function(oImg) {
                shirtImage = oImg;
                oImg.scaleToWidth(canvasWidth);
                canvas.setBackgroundImage(oImg, canvas.renderAll.bind(canvas), {
                    scaleX: canvas.width / oImg.width,
                });
                canvas.setHeight(oImg.getScaledHeight());

            });


            // var text = new fabric.IText('Sample Text', {
            //     fill: 'green'
            // });

            //----------------------------------------------------------------------------------------------------------------------
            $(document).ready(function() {
                $(document).on('change', '#shirtColorSelect', function(e) {
                    shirtColor = $('#shirtColorSelect').find(":selected").val();

                    shirtImage.setSrc(
                        shirtColor,
                        function() {
                            canvas.renderAll();
                        }
                    );
                });
            });

            $(document).ready(function() {
                $('input[type=radio][name=shirtOrientaion]').change(function() {
                    var shirtColor = $('#shirtColorSelect').find(":selected").val();
                    if (this.value == 'front') {
                        $('#shirtColorSelect').html("<option selected hidden>Shirt Color</option>\
                <option value='shirt/blackShirtFront.png'>Black</option>\
                <option value='shirt/whiteShirtFront.png'>White</option>\
                <option value='shirt/redShirtFront.png'>Red</option>\
                <option value='shirt/greenShirtFront.png'>Green</option>\
                <option value='shirt/blueShirtFront.png'>Blue</option>\
                <option value='shirt/yellowShirtFront.png'>Yellow</option>\
                <option value='shirt/purpleShirtFront.png'>Purple</option>\
                <option value='shirt/grayShirtFront.png'>Gray</option>\
                <option value='shirt/brownShirtFront.png'>Brown</option>\
                <option value='shirt/navyShirtFront.png'>Navy Blue</option>\
                <option value='shirt/maroonShirtFront.png'>Maroon</option>\
                <option value='shirt/cyanShirtFront.png'>Cyan</option>");

                        shirtColor = shirtColor.replace("Back", "Front");
                    } else if (this.value == 'back') {
                        $('#shirtColorSelect').html("<option selected hidden>Shirt Color</option>\
                <option value='shirt/blackShirtBack.png'>Black</option>\
                <option value='shirt/whiteShirtBack.png'>White</option>\
                <option value='shirt/redShirtBack.png'>Red</option>\
                <option value='shirt/greenShirtBack.png'>Green</option>\
                <option value='shirt/blueShirtBack.png'>Blue</option>\
                <option value='shirt/yellowShirtBack.png'>Yellow</option>\
                <option value='shirt/purpleShirtBack.png'>Purple</option>\
                <option value='shirt/grayShirtBack.png'>Gray</option>\
                <option value='shirt/brownShirtBack.png'>Brown</option>\
                <option value='shirt/navyShirtBack.png'>Navy Blue</option>\
                <option value='shirt/maroonShirtBack.png'>Maroon</option>\
                <option value='shirt/cyanShirtBack.png'>Cyan</option>");

                        shirtColor = shirtColor.replace("Front", "Back");
                    }

                    $('#shirtColorSelect').val(shirtColor).change();

                    shirtImage.setSrc(
                        shirtColor,
                        function() {
                            canvas.renderAll();
                        }
                    );
                });
            });

            $(document).ready(function() {
                $(document).on('click', '#addTextBtn', function(e) {
                    var font = $('#font').val().replace(/\+/g, ' ');
                    var color = $('#textColor').val();
                    canvas.add(new fabric.IText('Sample Text', {
                        left: canvas.getWidth() / 3,
                        top: canvas.getHeight() / 3,
                        fill: color,
                        fontFamily: font,
                    }));
                });
            });

            $(document).ready(function() {
                $(document).on('click', '#delObjBtn', function(e) {
                    canvas.remove(canvas.getActiveObject());
                });
            });

            $(document).ready(function() {
                $(document).on('click', '#delAllBtn', function(e) {
                    if (confirm("Are you sure you want to clear the canvas?")) {
                        canvas.clear();
                        shirtColor = $('#shirtColorSelect').find(":selected").val();

                        fabric.Image.fromURL(shirtColor, function(oImg) {
                            shirtImage = oImg;
                            oImg.scaleToWidth(canvasWidth);
                            canvas.setBackgroundImage(oImg, canvas.renderAll.bind(canvas), {
                                scaleX: canvas.width / oImg.width,
                            });
                            canvas.setHeight(oImg.getScaledHeight());

                        });
                    }
                });
            });

            $(document).ready(function() {
                $(document).on('change', '#inputImageFile', function(e) {
                    var reader = new FileReader();
                    reader.onload = function(event) {
                        var imgObj = new Image();
                        imgObj.src = event.target.result;
                        imgObj.onload = function() {
                            // start fabricJS stuff

                            var image = new fabric.Image(imgObj, {
                                left: canvas.getWidth() / 3,
                                top: canvas.getHeight() / 3,
                            });

                            image.scaleToWidth(canvas.getWidth() / 4, false);

                            canvas.add(image);
                            c.renderAll.bind(c)

                            // end fabricJS stuff
                        }

                    }
                    reader.readAsDataURL(e.target.files[0]);
                });
            });

            $(document).ready(function() {
                $(document).on('click', '#buyBtn', function(e) {

                    const canvasDataURL = canvas.toDataURL({
                        width: canvas.width,
                        height: canvas.height,
                        format: 'jpg',
                    });

                    // alert(this.href);

                    // this.download = 'canvas.jpg';

                    // alert(this);

                    const link = document.createElement('a');
                    link.download = 'image.png';
                    link.href = canvasDataURL;
                    document.body.appendChild(link);
                    link.click();
                    document.body.removeChild(link);

                });
            });

            window.onbeforeunload = function() {
                return 'Are you sure you want to leave?';
            };
        </script>
    <?php
} else {
    header("Location: loginpage.php");
}
    ?>