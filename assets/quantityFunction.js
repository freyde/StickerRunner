function resetForm() {
    $('#chooseSizeandQuantityForm')[0].reset();
}

$(document).ready(function () {

    $(document).on('click', '.increment-btn', function (e) {
        e.preventDefault();

        var qty = $(this).closest('.item_data').find('.input-qty').val();

        var value = parseInt(qty, 10);
        value = isNaN(value) ? 0 : value;
        if (value < 10) {
            value++;
            $(this).closest('.item_data').find('.input-qty').val(value);
        }
    });

    $(document).on('click', '.increment-custom-btn', function (e) {
        e.preventDefault();

        var qty = $(this).closest('.item_data').find('.input-custom-qty').val();

        var value = parseInt(qty, 10);
        value = isNaN(value) ? 0 : value;
        if (value < 10) {
            value++;
            $(this).closest('.item_data').find('.input-custom-qty').val(value);
        }
    });

    $(document).on('click', '.decrement-btn', function (e) {
        e.preventDefault();

        var qty = $(this).closest('.item_data').find('.input-qty').val();

        var value = parseInt(qty, 10);
        value = isNaN(value) ? 0 : value;
        if (value > 1) {
            value--;
            $(this).closest('.item_data').find('.input-qty').val(value);
        }
    });

    $(document).on('click', '.decrement-custom-btn', function (e) {
        e.preventDefault();

        var qty = $(this).closest('.item_data').find('.input-custom-qty').val();

        var value = parseInt(qty, 10);
        value = isNaN(value) ? 0 : value;
        if (value > 1) {
            value--;
            $(this).closest('.item_data').find('.input-custom-qty').val(value);
        }
    });

    $(document).on('click', '.addToCartBtn', function (e) {
        e.preventDefault();

        var qty = $(this).closest('.item_data').find('.input-qty').val();
        // var ses_status = $(this).closest('.item_data').find('.login-btn').val();
        var item_code = $(this).val();
        var size = $(".btn-check:checked").val();

        if (size != null) {
            $.ajax({
                method: "POST",
                url: "includes/handle_cart.php",
                data: {
                    "item_code": item_code,
                    "item_qty": qty,
                    "item_size": size,
                    "scope": "add"
                },
                success: function (response) {
                    alert("Item has been added to your cart!");
                    // setInterval('location.reload()', 7000);
                    resetForm();
                    location.reload(true);
                },
                error: function (response) {
                    alert("Something went wrong");
                }
            });
        } else {
            alert("Please select size before adding to cart.");
        }
    });


    $(document).on('click', '.buyNowBtn', function (e) {
        e.preventDefault();
        // alert("asdad");
        var qty = $(this).closest('.item_data').find('.input-qty').val();
        var item_code = $(this).val();
        var size = $(".btn-check:checked").val();

        if (size != null) {
            $.ajax({
                method: "POST",
                url: "includes/handle_cart.php",
                data: {
                    "item_code": item_code,
                    "item_qty": qty,
                    "item_size": size,
                    "scope": "buy"
                },
                success: function (response) {
                    const a = JSON.parse(response);
                    window.location.assign("ordersummarypage.php?email_add=" + a.email_add + "&item_code=" + a.item_code + "&checkout=true");
                },
                error: function (response) {
                    alert("Something went wrong");
                }
            });
        } else {
            alert("Please select size before adding to cart.");
        }

    });


    $(document).on('click', '.updateQty_btn', function (e) {
        var item_code = $(this).closest('.item_data').find('.itemCode').val();
        var item_size = $(this).closest('.item_data').find('.itemSize').val();
        var qty = $(this).closest('.item_data').find('.input-qty').val();

        $.ajax({
            method: "POST",
            url: "includes/handle_cart.php",
            data: {
                "item_code": item_code,
                "item_size": item_size,
                "item_qty": qty,
                "scope": "update"
            },
            success: function (response) {
                alert(response);
            },
            error: function (response) {
                alert(response);
            }
        });
    });

    $(document).on('change', '.input-qty', function (e) {
        var item_code = $(this).closest('.item_data').find('.itemCode').val();
        var item_size = $(this).closest('.item_data').find('.itemSize').val();
        var qty = $(this).val();

        $.ajax({
            method: "POST",
            url: "includes/handle_cart.php",
            data: {
                "item_code": item_code,
                "item_size": item_size,
                "item_qty": qty,
                "scope": "update"
            },
            success: function (response) {
                alert(response);
            },
            error: function (response) {
                alert(response);
            }
        });
    });

    $(document).on('click', '.updateCustQty_btn', function (e) {
        var item_code = $(this).closest('.item_data').find('.itemCode').val();
        var item_size = $(this).closest('.item_data').find('.itemSize').val();
        var qty = $(this).closest('.item_data').find('.input-custom-qty').val();

        $.ajax({
            method: "POST",
            url: "includes/handle_custom.php",
            data: {
                "item_code": item_code,
                "item_size": item_size,
                "item_qty": qty,
                "scope": "update"
            },
            success: function (response) {
                alert(response);
            },
            error: function (response) {
                alert(response);
            }
        });
    });

    $(document).on('change', '.input-custom-qty', function (e) {
        var item_code = $(this).closest('.item_data').find('.itemCode').val();
        var item_size = $(this).closest('.item_data').find('.itemSize').val();
        var qty = $(this).val();

        $.ajax({
            method: "POST",
            url: "includes/handle_custom.php",
            data: {
                "item_code": item_code,
                "item_size": item_size,
                "item_qty": qty,
                "scope": "update"
            },
            success: function (response) {
                alert(response);
            },
            error: function (response) {
                alert(response);
            }
        });
    });

    $(document).on('click', '.deleteItem_btn', function (e) {
        e.preventDefault();

        var item_code = $(this).val();
        var item_size = $(this).closest('.item_data').find('.itemSize').val();

        $.ajax({
            method: "POST",
            url: "includes/handle_cart.php",
            data: {
                "item_code": item_code,
                "item_size": item_size,
                "scope": "delete"
            },
            success: function (response) {
                alert(response);
                location.reload(true);
            },
            error: function (response) {
                alert(response);
            }
        });
    });

    $(document).on('click', '.deleteCust_btn', function (e) {
        e.preventDefault();

        var item_code = $(this).val();
        $.ajax({
            method: "POST",
            url: "includes/handle_custom.php",
            data: {
                "item_code": item_code,
                "scope": "delete"
            },
            success: function (response) {
                alert(response);
                location.reload(true);
            },
            error: function (response) {
                alert(response);
            }
        });
    });

    $(document).on('click', '.deleteAll_btn', function (e) {
        e.preventDefault();

        var id = [];
        $(':checkbox:checked').each(function (i) {
            id[i] = $(this).val();
        });

        if (id.length === 0) {
            alert("Please select atleast one item");
        } else {
            if (confirm("Are you sure you want to delete selected items?")) {
                $.ajax({
                    method: "POST",
                    url: "includes/handle_cart.php",
                    data: {
                        "id": id,
                    },
                    success: function (response) {
                        alert("Items successfully deleted from cart!");
                        $('#shopping_cart').load(location.href + " #shopping_cart");
                        resetForm();
                    },
                    error: function (response) {
                        alert("Something went wrong");
                    }
                });
            } else {
                return false;
            }
        }
    });

    //check all checkboxes button function
    $("#checkAll").click(function () {
        $('.item_checkbox').prop('checked', this.checked);
        $('.item_checkbox').change();
    });

    $("#customAll").click(function () {
        var items = $('.custom_checkbox');

        var stat = this.checked
        $.each(items, function (i) {
            var $this = $(this);
            if (!$this.prop('disabled')) {
                $this.prop('checked', stat);
            }
        });


        $('.custom_checkbox').change();
    });

    //disable place order button by default
    $('#checkout_btn').prop('disabled', true);
    $('#custom_checkout_btn').prop('disabled', true);

    var counter = 0;


    //for displaying total amount on click of pre made items
    // $("[name='item_checkbox[]']").click(function () {
    $('.item_checkbox').change(function () {
        var item_id = [];
        var get_ship_fee = document.querySelector("#display_shipping_fee").textContent;
        var ship_fee = get_ship_fee.slice(1, 3);
        var getEmail = $(".email").val();

        var items = $('.item_checkbox');

        $.each(items, function (i) {
            var $this = $(this);
            if ($this.is(":checked")) {
                item_id[i] = $(this).val();
            }
        });


        $.ajax({
            method: "POST",
            url: "includes/handle_cart.php",
            data: {
                "item_id": item_id,
            },
            success: function (response) {
                $("#display_subtotal").text("₱" + response + ".00");

                if (response == 0 || response == "") {
                    $("#display_subtotal").text("₱0.00");
                    $('#checkout_btn').prop('disabled', true);
                    //alert(item_id.toString());
                } else {
                    $('#checkout_btn').prop('disabled', false);
                    //alert(item_id.toString());
                }

                var len = item_id.length;
                if (len > 0) {
                    $("#num_items").text(len);
                } else {
                    $("#num_items").text("0");
                }

                var parsed_response = parseInt(response);
                var parsed_ship_fee = parseInt(ship_fee);

                // var a = jQuery.type(parsed_response);
                // var b = jQuery.type(parsed_ship_fee);

                var total_amount = parsed_response + parsed_ship_fee;
                // alert(parsed_response + " " + parsed_ship_fee);

                if (response == "" || total_amount == 0 || parsed_response == NaN) {
                    $("#display_total_amount").text("₱0.00");
                } else {
                    $("#display_total_amount").text("₱" + total_amount + ".00");
                }


            },
            error: function (response) {
                alert("Something went wrong");
            }
        });
        counter++;
        // alert(item_id.toString());
    });

    //for displaying total amount on click of custom shirts
    $(".custom_checkbox").change(function () {
        var item_id = [];
        var get_ship_fee = document.querySelector("#display_shipping_fee").textContent;
        var ship_fee = get_ship_fee.slice(1, 3);
        var getEmail = $(".email").val();

        var items = $(".custom_checkbox");
        $.each(items, function (i) {
            var $this = $(this);
            if ($this.is(":checked")) {
                item_id[i] = $(this).val();
            }
        });


        $.ajax({
            method: "POST",
            url: "includes/handle_custom.php",
            data: {
                "item_id": item_id,
            },
            success: function (response) {
                $("#custom_subtotal").text("₱" + response + ".00");

                if (response == 0 || response == "") {
                    $("#custom_subtotal").text("₱0.00");
                    $('#custom_checkout_btn').prop('disabled', true);
                    //alert(item_id.toString());
                } else {
                    $('#custom_checkout_btn').prop('disabled', false);
                    //alert(item_id.toString());
                }

                var len = item_id.length;
                if (len > 0) {
                    $("#num_items").text(len);
                } else {
                    $("#num_items").text("0");
                }

                var parsed_response = parseInt(response);
                var parsed_ship_fee = parseInt(ship_fee);

                // var a = jQuery.type(parsed_response);
                // var b = jQuery.type(parsed_ship_fee);

                var total_amount = parsed_response + parsed_ship_fee;
                // alert(parsed_response + " " + parsed_ship_fee);

                if (response == "" || total_amount == 0 || parsed_response == NaN) {
                    $("#custom_total_amount").text("₱0.00");
                } else {
                    $("#custom_total_amount").text("₱" + total_amount + ".00");
                }


            },
            error: function (response) {
                alert("Something went wrong");
            }
        });
        counter++;
        // alert(item_id.toString());
    });

    currLoc = $(location).attr('href');
    var result = currLoc.includes("order");
    if (result == true || result == "true") {
        var url = window.location.href;
        var obj = JSON.parse(arrStr);
        alert(JSON.parse(sessionStorage.getItem("jsArray")));
        //alert("HAHAHA");

    }


    $("#checkout_btn").click(function () {
        var check_id = [];
        var item_name = $(this).closest('.item_data').find('.itemName').val();
        var email = $(this).closest('.item_data').find('.email').val();
        var item_price = $(this).closest('.item_data').find('.itemPrice').val();
        var item_image = $(this).closest('.item_data').find('.itemImage').val();
        var item_code = $(this).closest('.item_data').find('.itemCode').val();
        var item_size = $(this).closest('.item_data').find('.itemSize').val();
        var qty = $(this).closest('.item_data').find('.input-qty').val();
        var getEmail = $(".email").val();

        $('.item_checkbox').each(function (i) {
            if($(this).is(":checked"))
                check_id[i] = $(this).val();
        });


        $.ajax({
            method: "POST",
            url: "includes/handle_cart.php",
            data: {
                "email": email,
                "item_code": item_code,
                "item_name": item_name,
                "item_price": item_price,
                "item_image": item_image,
                "item_size": item_size,
                "item_qty": qty,
                "check_id": check_id,
            },
            success: function (response) {
                window.location.href = "ordersummarypage.php?email_add=" + getEmail + "&item_code=" + check_id.filter(n => n);
            },
            error: function (response) {
                alert("Something went wrong");
            }
        });
    });

    $("#custom_checkout_btn").click(function () {
        var check_id = [];
        var item_name = $(this).closest('.item_data').find('.itemName').val();
        var email = $(this).closest('.item_data').find('.email').val();
        var item_price = $(this).closest('.item_data').find('.itemPrice').val();
        var item_image = $(this).closest('.item_data').find('.itemImage').val();
        var item_code = $(this).closest('.item_data').find('.itemCode').val();
        var item_size = $(this).closest('.item_data').find('.itemSize').val();
        var qty = $(this).closest('.item_data').find('.input-qty').val();
        var getEmail = $(".email").val();

        var items = $('.custom_checkbox');
        $.each(items, function (i) {
            var $this = $(this);
            if ($(this).is(":checked")) {
                check_id[i] = $(this).val();
            }
        });


        $.ajax({
            method: "POST",
            url: "includes/handle_custom.php",
            data: {
                "email": email,
                "item_code": item_code,
                "item_name": item_name,
                "item_price": item_price,
                "item_image": item_image,
                "item_size": item_size,
                "item_qty": qty,
                "check_id": check_id,
            },
            success: function (response) {
                window.location.href = "ordersummarypage.php?email_add=" + getEmail + "&item_code=" + check_id.filter(n => n) + "&custom=true";
            },
            error: function (response) {
                alert("Something went wrong");
            }
        });
    });


});