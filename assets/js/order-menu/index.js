
$(document).ready(function() {
    loadproduct();
});

var loadproduct = (data) => {
    var html = '';
    $(data).each(function(index, value){
        html+= '<button class="btn btn-success item" data-value="'+value.ID+'" data-price="'+value.price+'" data-label="'+value.product_name+'">'+value.product_name+'</button>';
    });
    $('#display_item').html(html);
}

$(document).on('click', '.category-menu', function(){

    var id = $(this).data('value');
    $(document).gmPostHandler({
        url: 'order-menu/service/order-menu-service/by_category',
        data: {
            category_id : id
        },
        function_call: true,
        function: loadproduct,
        parameter: true,
        alert_on_error: false,
        errorsend: true,
        errorsend_function: [{
            function: error_connection,
            msg: "Please check your connection and try again."
        }],
        function_call_on_error: true,
        error_function: [{
            function: error,
            parameter: true,
        }]
    });
})


$(document).on('click', '.item', function(){

    var id = $(this).data('value');
    var price = $(this).data('price');
    var label = $(this).data('label');
    var html = '';

    if(!($('#product_row_'+id+'').length)){
        html+=
        '<tr class="product_rows" id="product_row_'+id+'">'+
            '<td>'+label+'</td>'+
            '<td><span id="qty_'+id+'">1</span></td>'+
            '<td><span id="realprice_'+id+'">'+price+'</span></td>'+
            '<td><span class="prices" id="price_'+id+'" data-value="'+price+'">'+price+'</span></td>'+
        '</tr>';
    }else{
        var qty = $('#qty_'+id+'').text() ;
        var price = $('#price_'+id+'').data('value');
        var new_qty = parseInt(qty)+1;
        var new_price = parseInt(new_qty) * parseFloat(price);
        $('#price_'+id+'').text(new_price);
        $('#qty_'+id+'').text(new_qty);
    }

    loadtotal();
    $('#loadproduct').append(html);

})


function loadtotal() {
    setInterval(function(){ 
        var total = 0;
        $('.prices').each(function(){
            var pricelist = $(this).text();
            total+=parseInt(pricelist);
            $('#total').text(total);
            $('#display_total_number').text(total);
        }); 
    }, 100);
}

// $('.pay').on('click', function(){
//     alert();
// })

$('.emply-no').on('keyup', function(){
    var emply_no = $(this).val();
    $(document).gmPostHandler({
        url: 'order-menu/service/order-menu-service/employee',
        data: {
            employee_no : emply_no
        },
        function_call: true,
        function: loademployee,
        parameter: true,
        alert_on_error: false,
        errorsend: true,
        errorsend_function: [{
            function: error_connection,
            msg: "Please check your connection and try again."
        }],
        function_call_on_error: true,
        error_function: [{
            function: error,
            parameter: true,
        }]
    });
})


var loademployee = (data) => {
    var html = '';
    $(data).each(function(index, value){
        html+= 
        '<tr>'+
            '<td><span style="color:black; font-weight:bold;">'+value.employee_no+'</span></td>'+
            '<td>'+value.first_name+' '+value.middle_name+' '+value.last_name+'</td>'+
        '</tr>';
    });

    $('#loademployee').html(html);
}

$('.proceed-order').on('click', function(){
    var orderlist = [];
    var ids = [];
    var qty = [];
    var emply_no = $('.emply-no').val();

    $('.product_rows').each(function(index, value){
        var id = ($(this).attr('id')).replace( /^\D+/g, '');
        var varqty = $('#qty_'+id).text();
        ids.push(id);
        qty.push(varqty);
    })

    orderlist = [
        ids,
        qty
    ]

    // orderlist['ids'] = ids;
    // orderlist['qty'] = qty;
    

    $(document).gmPostHandler({
        url: 'order-menu/service/order-menu-service/orderlist',
        data: {
            orderlist : (JSON.stringify((orderlist))),
            employee_no : emply_no
        },
        function_call: false,
        parameter: true,
        alert_on_error: false,
        errorsend: true,
        errorsend_function: [{
            function: error_connection,
            msg: "Please check your connection and try again."
        }],
        function_call_on_error: true,
        error_function: [{
            function: error,
            parameter: true,
        }]
    });
})




