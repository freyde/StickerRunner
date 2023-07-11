$(document).ready(function (){
    
    
    $(document).on('click', '#receiveBtn', function(e) {
        
        var package_num = $(this).val();
    
        $.ajax({
            method: "POST",
            url: "includes/received_order.inc.php",
            data: {  
                "package_num": package_num,
            },
            success: function(response){
                alert(response);
                console.log(response);
                location.reload(true);
            },
            error: function(response) {
                alert(response);
             }
        });
    });
    
   


















});