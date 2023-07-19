$(document).ready(function () {

    $(document).on('click', '#editBtn', function (e) {

        var it_code = $(this).val();
        var ed_modal = document.getElementById("editModal");

        // alert(it_code);

        $.ajax({
            method: "POST",
            url: "../includes/show_edit_modal.php",
            data: {
                "it_code": it_code,
            },
            success: function (response) {

                window.location.href = "edit_product.php?item_code=" + it_code;
                ed_modal.style.display = "block";

            },
            error: function (response) {
                alert(response);
                console.log(response);
            }
        });




    });

    $(document).on('click', '#delBtn', function (e) {

        var it_code = $(this).val();

        // alert(it_code);

        $.ajax({
            method: "POST",
            url: "includes/delete_item.php",
            data: {
                "it_code": it_code,
            },
            success: function (response) {
                window.location.href = "main_dashboard.php?products";
            },
            error: function (response) {
                alert(response);
                console.log(response);
            }
        });




    });














});