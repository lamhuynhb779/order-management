$(document).ready(function(){
    // Reset default
    $('select option[value="order_number"]').attr("selected",true);
    $("#search-value").css('display', 'block');
    $("#search-date").css('display', 'none');

    $("#search-options").change(function () {
        let optionSelected = $(this).find("option:selected");
        let valueSelected = optionSelected.val();

        if (valueSelected === 'shipping_date') {
            $("#search-value").css('display', 'none');
            $("#search-date").css('display', 'block');
        } else {
            $("#search-value").css('display', 'block');
            $("#search-date").css('display', 'none');
        }
    });

    $(".button-search").click(function(){

        let searchOption = $('#search-options').find(":selected").val();
        let queryString = '';
        let searchValue = $('#search-value').val();
        let searchDate = $('#search-date').val();

        if (searchOption === 'order_number') {
            queryString = '?search[0][field]=code&search[0][value]=' + searchValue;
        } else if (searchOption === 'customer_name') {
            queryString = '?search[0][field]=name&search[0][value]=' + searchValue;
        } else if (searchOption === 'shipping_date') {
            queryString = '?filter[shipping_date]=' + searchDate;
        }

        if (searchValue !== '' || searchDate !== '') {
            $.ajax({
                url:"/orders/search" + queryString,
                method:'GET',
                success: function(res){
                    let orders;
                    if (res.status === 1) {
                        orders = res.data.data;
                        $('#order-list').empty();
                        $.each(orders, function (i, order) {
                            data = '<tr>';
                            data += '<td><input type="checkbox" class="checkbox" /></td>';
                            data += '<td><h3><a href="/orders/view/' + order.id + '">'+ order.code +'</a></h3></td>';
                            data += '<td>' + order.name + '</td>';
                            data += '<td>' + order.shipping_date + '</td>';
                            data += '<td>' + order.expected_delivery_date + '</td>';
                            data += '<td>'+ convertStateName(order.state_id) +'</td>';
                            data += '</tr>';
                            $('#order-list').append(data);
                        });
                    }
                },
                error: function(err){
                    console.log(err);
                }
            });
        }
    });
});
