$(document).ready(function (){

    $("#placeOrderBtn").click(function(){
        var orders_id = [];
        var payment_method;

        $('input[name="code_checkboxes"]').each(function(i){
            orders_id[i] = $(this).val();
        }); 

        payment_method = $('input[name="payment_chk"]:checked').val();

        if(payment_method === undefined || payment_method === '' || payment_method === null){
            alert("Select a payment method!");
        } else {
            $.ajax({
                method: "POST",
                url: "includes/checkout.inc.php",
                data: {
                    "orders_id": orders_id,
                    "payment_method": payment_method,
                },
                success: function(response){
                    window.location.href = "successful_checkout.php";
                    // alert("No error");
                },
                error: function(response) {
                    alert("Something went wrong");
                 }
            });
        }

       
    });


});