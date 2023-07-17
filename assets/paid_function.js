$(document).ready(function (){

    $(document).on('click', '#paidBtn', function(e) {
        
        var item_code = $(this).val();

        // alert(item_code);
       
        $.ajax({
            method: "POST",
            url: "includes/paid_order.php",
            data: {  
                "item_code": item_code,
            },
            success: function(response){
               alert("Item has been paid!");  
                // window.location.href = "edit_product.php?item_code=" + it_code;        
                //  ed_modal.style.display = "block";
                
            },
            error: function(response) {
                alert(response);
                console.log(response);
             }
        });
    
    });














});