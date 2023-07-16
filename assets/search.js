$(document).ready(function () {
    $(document).on('click', '#searchBtn', function (e) {
        var searchString = $('#searchText').val();
        $.ajax({
            method: "POST",
            url: "includes/search.php",
            data: {
                "searchString": searchString,
            },
            success: function (response) {
                // alert(response);
                $('#test').val() = response;
            },
            error: function (response) {
                console.log(response);
            }
        });
    });
});