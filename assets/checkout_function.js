$(document).ready(function () {

    $("#placeOrderBtn").click(function () {
        var orders_id = [];
        var payment_method;

        $('input[name="code_checkboxes"]').each(function (i) {
            orders_id[i] = $(this).val();
        });

        payment_method = $('input[name="payment_chk"]:checked').val();
        gcashRef = $('#inputGcashRef').val();
        // alert(gcashRef +" "+ payment_method);

        if (payment_method === undefined || payment_method === '' || payment_method === null) {
            alert("Select a payment method!");
        } else {
            if (payment_method == 'GCash' && gcashRef === "") {
                alert("Please input Gcash Reference Number.!");
            } else {
                $.ajax({
                    method: "POST",
                    url: "includes/checkout.inc.php",
                    data: {
                        "orders_id": orders_id,
                        "payment_method": payment_method,
                        "gcashRef": gcashRef,
                    },
                    success: function (response) {
                        window.location.href = "successful_checkout.php";
                        // alert("No error");
                        // alert(response);
                    },
                    error: function (response) {
                        alert("Something went wrong");
                    }
                });
            }
        }


    });


});