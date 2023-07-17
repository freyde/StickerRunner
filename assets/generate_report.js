$(document).ready(function () {
    $(document).on('click', '#generateReportBtn', function (e) {
        $.ajax({
            method: "POST",
            url: "includes/generate_report.php",
            data: {
                "startDate": $("#startDate").val(),
                "endDate": $("#endDate").val(),
            },
            dataType: 'JSON',
            success: function (response) {
                var len = response.length;
                var totalSales = 0;
                $("#salesTable tbody").empty();
                for (var i = 0; i < len; i++) {
                    var orderDate = response[i].order_date;
                    var orderID = response[i].order_id;
                    var orderItemName = response[i].order_item_name;
                    var orderItemPrice = response[i].order_item_price;
                    var orderItemQuantity = response[i].order_item_quantity;
                    var paymentMethod = response[i].payment_method;
                    var orderTotalPrice = response[i].order_total_price;
                    totalSales += parseInt(orderTotalPrice);

                    var tr_str = "<tr>" +
                        "<td align='center'>" + orderDate + "</td>" +
                        "<td align='center'>" + orderID + "</td>" +
                        "<td align='center'>" + orderItemName + "</td>" +
                        "<td align='center'>" + orderItemPrice + "</td>" +
                        "<td align='center'>" + orderItemQuantity + "</td>" +
                        "<td align='center'>" + paymentMethod + "</td>" +
                        "<td align='center'>" + orderTotalPrice + "</td>" +
                        "</tr>";

                    $("#salesTable tbody").append(tr_str);
                }
                var tr_str = "<tr>" +
                    "<td align='center'></td>" +
                    "<td align='center'></td>" +
                    "<td align='center'></td>" +
                    "<td align='center'></td>" +
                    "<td align='center'></td>" +
                    "<td align='center'><b>Total Sales</b></td>" +
                    "<td align='center'><b>" + totalSales + "</b></td>" +
                    "</tr>";
                $("#salesTable tbody").append(tr_str);
            },
            error: function (response) {
                console.log(response);
            }
        });
    });

    $(document).on('click', '#printReportBtn', function (e) {
        var divToPrint = document.getElementById("salesTable");
        newWin = window.open("");
        newWin.document.write(divToPrint.outerHTML);
        newWin.print();
        newWin.close();
    });
})