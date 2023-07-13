$(document).ready(function (){
    $(document).on('click', '#generateReportBtn', function(e) {
        $.ajax({
            method: "POST",
            url: "../includes/generate_report.php",
            data: {  
                "startDate": $("#startDate").val(),
                "endDate": $("#endDate").val(),
            },
            success: function(response){
                console.log(response);
            },
            error: function(response) {
                alert(response);
             }
        });
    });
})