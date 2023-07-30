<?php
include("headerCustom.php");
if (isset($_SESSION["auth"])) {
    include_once("includes/functions.inc.php");
?>

    <head>
        <link rel="stylesheet" type="text/css" href="styles/fontselect-default.css" />
        <script src="jquery.fontselect.js"></script>
    </head>
    <div id="page-container">
        <div id="content-wrap">
            <div class="p-5 bg-white rounded shadow mb-5">
                <ul id="myTab2" role="tablist" class="nav nav-tabs nav-pills with-arrow lined flex-column flex-sm-row text-center">
                    <li class="nav-item flex-sm-fill">
                        <a id="custom-tab" data-bs-toggle="tab" href="#custom" role="tab" aria-controls="custom" aria-selected="true" class="nav-link text-uppercase font-weight-bold mr-sm-3 rounded-0 active">
                            <h5>Customize Your Shirt</h5>
                        </a>
                    </li>
                    <li class="nav-item flex-sm-fill">
                        <a id="order-tab" data-bs-toggle="tab" href="#order" role="tab" aria-controls="order" aria-selected="false" class="nav-link text-uppercase font-weight-bold mr-sm-3 rounded-0">
                            <h5>Order Your Custom Shirt</h5>
                        </a>
                    </li>
                </ul>
                <div id="myTabContent" class="tab-content">
                    <div id="custom" role="tabpanel" aria-labelledby="custom-tab" class="tab-pane fade px-4 py-5 show active">
                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="col-md-10">
                                <h1>Customize Your Shirt</h1>
                                <div class="row">
                                    <div class="col-md-7 float-start">
                                        <canvas id="c"></canvas>
                                    </div>
                                    <div class="col-md-5 float-end">
                                        <form action="">
                                            <!-- <hr> -->
                                            <div class="d-grid gap-2 col-7 mx-auto">
                                                <h4>Shirt</h4>
                                            </div>
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
                                                <div class="d-grid gap-2 col-12 mx-auto">
                                                    <h6>Shirt Color</h6>
                                                </div>
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
                                            <div class="d-grid gap-2 col-7 mx-auto">
                                                <h4>Text</h4>
                                            </div>
                                            <div class="d-grid gap-2 col-6 mx-auto">
                                                <div class="input-group mb-3">
                                                    <h5>Font:&nbsp&nbsp</h5>
                                                    <input id="font" type="text" class="form-control" />
                                                </div>
                                                <div class="input-group mb-3">
                                                    <h5>Color:&nbsp&nbsp</h5>
                                                    <input class="form-control-color" type="color" name="textColor" id="textColor" value="#FFFFFF">
                                                </div>
                                                <button id="addTextBtn" class="btn btn-primary" type="button">Add Text</button>
                                            </div>
                                            <hr>
                                            <div class="d-grid gap-2 col-7 mx-auto">
                                                <h4>Image</h4>
                                            </div>
                                            <p class="float-start fs-6"><i>*Note: Please use PNG files for better experience.</i></p>

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
                                            <div class="d-grid gap-2 col-4 mx-auto">
                                                <button id="buyBtn" class="btn btn-success" type="button">Download</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-1"></div>
                        </div>
                    </div>
                    <!-- --------------------------------------------Order Tab------------------------------------ -->
                    <div id="order" role="tabpanel" aria-labelledby="profile-tab" class="tab-pane fade px-4 py-5">
                        <div class="row">
                            <div class="col-md 1"></div>
                            <div class="col-md-10">
                                <h1>Order Your Custom Shirt</h1>
                                <br><br>
                                <form method="post" action="submitCustom.php" enctype="multipart/form-data">
                                    <!-- <div class="gap-2 col-12 mx-auto">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="printScope" id="printScopeFB" value="frontback" checked>
                                            <label class="form-check-label" for="printScopeFB">
                                                <h5>Front and Back</h5>
                                            </label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="printScope" id="printScopeF" value="front">
                                            <label class="form-check-label" for="printScopeF">
                                                <h5>Front</h5>
                                            </label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="printScope" id="printScopeB" value="back">
                                            <label class="form-check-label" for="printScopeB">
                                                <h5>Back</h5>
                                            </label>
                                        </div>
                                    </div>
                                    <hr> -->
                                    <div class=" gap-2 col-12 mx-auto">
                                        <div class="row" id="frontUploadDiv">
                                            <div class="col-md-5">
                                                <h4>Final Design:</h4>
                                                <div class="d-grid gap-2 col-10 mx-auto">
                                                    <input id="finalDesignUpload" class="form-control" type="file" name="finalDesignUpload[]" accept="image/*" required multiple>
                                                </div>
                                                <br>
                                                <div class="d-grid gap-2 col-10 mx-auto overflow-auto max-vh-80" id="previewDiv">
                                                </div>
                                            </div>
                                            <div class="col-md-5">
                                                <h4>Assets:</h4>
                                                <div class="d-grid gap-2 col-10 mx-auto">
                                                    <input id="assetsUpload" class="form-control" type="file" name="assetsUpload[]" required multiple>
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        <!-- <div class="row" id="backUploadDiv">
                                            <div class="col-md-5">
                                                <h4>Back:</h4>
                                                <div class="d-grid gap-2 col-10 mx-auto">
                                                    <img class="img-fluid" id="backPrev" src="" alt="">
                                                </div>
                                                <div class="d-grid gap-2 col-10 mx-auto">
                                                    <input id="backUpload" class="form-control" type="file" name="backUpload" accept="image/*" required>
                                                </div>
                                            </div>
                                            <div class="col-md-5">
                                                <h4>Back Assets:</h4>
                                                <div class="d-grid gap-2 col-10 mx-auto">
                                                    <input id="backAssests" class="form-control" type="file" name="backAssests" accept="image/*" required multiple>
                                                </div>
                                            </div>
                                        </div> -->
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="gap-1 col-12">
                                            <div class="row">
                                                <div class="col-2">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="checkbox" name="customSize" id="customSizeXS" value="Extra Small">
                                                        <label class="form-check-label" for="customSizeXS">
                                                            <h5>Extra Small</h5>
                                                            <input id="xsQty" name="xsQty" class="form-control form-control-sm w-75" type="number" value="1">
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-2">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="checkbox" name="customSize" id="customSizeS" value="Small">
                                                        <label class="form-check-label" for="customSizeS">
                                                            <h5>Small</h5>
                                                            <input id="sQty" name="sQty" class="form-control form-control-sm w-75" type="number" value="1">
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-2">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="checkbox" name="customSize" id="customSizeM" value="Medium">
                                                        <label class="form-check-label" for="customSizeM">
                                                            <h5>Medium</h5>
                                                            <input id="mQty" name="mQty" class="form-control form-control-sm w-75" type="number" value="1">
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-2">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="checkbox" name="customSize" id="customSizeL" value="Large">
                                                        <label class="form-check-label" for="customSizeL">
                                                            <h5>Large</h5>
                                                            <input id="lQty" name="lQty" class="form-control form-control-sm w-75" type="number" value="1">
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-2">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="checkbox" name="customSize" id="customSizeXL" value="Extra Large">
                                                        <label class="form-check-label" for="customSizeXL">
                                                            <h5>Extra Large</h5>
                                                            <input id="xlQty" name="xlQty" class="form-control form-control-sm w-75" type="number" value="1">
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <p class="float-start"><i>*Note: Price of customized design of shirt may range Php 200.00 to Php 500.00 depending on print and size. Price basis may change wihtout prior notice.</i></p>
                                    <button class="btn btn-primary float-end" type="submit" id="submitBtn">Submit Order</button>
                                </form>
                            </div>
                            <div class="col-md 1"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
        include("footer.php");
        ?>
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

                const link = document.createElement('a');
                link.download = 'image.png';
                link.href = canvasDataURL;
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);

            });
        });

        $(document).ready(function() {
            $('#frontPrev').hide();
            $('#backPrev').hide();
            $('#xsQty').hide();
            $('#sQty').hide();
            $('#mQty').hide();
            $('#lQty').hide();
            $('#xlQty').hide();
            
            $('#xsQty').prop('disabled', true);
            $('#sQty').prop('disabled', true);
            $('#mQty').prop('disabled', true);
            $('#lQty').prop('disabled', true);
            $('#xlQty').prop('disabled', true);
            $(document).on('change', '#finalDesignUpload', function(e) {
                $('#previewDiv').empty();
                Array.from(this.files).forEach(file => {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#previewDiv').append("<img class='img-fluid' src='"+e.target.result+"'>");
                        console.log(file.name);
                    }
                    reader.readAsDataURL(file);
                });
            });
        });
        var submit = false;
        $(document).on('click', '#submitBtn', function(e) {
            submit = true
        });

        $(document).on('change', '#customSizeXS', function(e) {
            if($('#customSizeXS').is(':checked')) {
                $('#xsQty').show();
                $('#xsQty').prop('disabled', false);
            } else  {
                $('#xsQty').hide();
                $('#xsQty').prop('disabled', true);
            }
        });
        $(document).on('change', '#customSizeS', function(e) {
            if($('#sQty').is(':hidden')) {
                $('#sQty').show();
                $('#sQty').prop('disabled', false);
            } else  {
                $('#sQty').hide();
                $('#sQty').prop('disabled', true);
            }
        });
        $(document).on('change', '#customSizeM', function(e) {
            if($('#mQty').is(':hidden')) {
                $('#mQty').show();
                $('#mQty').prop('disabled', false);
            } else  {
                $('#mQty').hide();
                $('#mQty').prop('disabled', true);
            }
        });
        $(document).on('change', '#customSizeL', function(e) {
            if($('#lQty').is(':hidden')) {
                $('#lQty').show();
                $('#lQty').prop('disabled', false);
            } else  {
                $('#lQty').hide();
                $('#lQty').prop('disabled', true);
            }
        });
        $(document).on('change', '#customSizeXL', function(e) {
            if($('#xlQty').is(':hidden')) {
                $('#xlQty').show();
                $('#xlQty').prop('disabled', false);
            } else  {
                $('#xlQty').hide();
                $('#xlQty').prop('disabled', true);
            }
        });

        window.onbeforeunload = function() {
            if (!submit)
                return 'Are you sure you want to leave?';
        };
    </script>
<?php
} else {
?>
    <script>
        window.location.replace("loginpage.php")
    </script>
<?php
}
?>