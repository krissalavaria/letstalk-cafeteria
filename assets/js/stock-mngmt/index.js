
$(document).ready(function() {
    loadproduct();
});

var loadproduct = () => {
    $(document).gmLoadPage({
        url: baseUrl + 'stock-mngmt/get_product',
        load_on: '#loadproduct'
    });
}

$(document).on('click', '.deduct-stock', function(){

    var id = $(this).data('value');
    var qty = $('#qty-'+id).text();
    $('#qty-'+id).text(parseInt(qty)-1);

    $(document).gmPostHandler({
        url: 'stock-mngmt/service/stock-mngmt-service/deduct_stock',
        data: {
            stock_id : id
        },
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

$(document).on('click', '.add-stock', function(){
    var id = $(this).data('value');
    var qty = $('#qty-'+id).text();
    $('#qty-'+id).text(parseInt(qty)+1);

    $(document).gmPostHandler({
        url: 'stock-mngmt/service/stock-mngmt-service/add_stock',
        data: {
            stock_id : id
        },
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


// /** save new establishment */
// $(document).on('click', '#add_product', function() {
//     $.confirm({
//         containerFluid: true,
//         columnClass: 'col-md-5 offset-md-4',
//         title: '',
//         content: 'Please click OK or ENTER to save.',
//         theme: 'modern',
//         closeIcon: true,
//         animation: 'scale',
//         type: 'red',
//         alignMiddle: true,
//         buttons: {
//             okay: {
//                 btnClass: 'btn-blue',
//                 keys: [
//                     'enter'
//                 ],
//                 action: function() {
//                     $(document).gmPostHandler({
//                         url: 'product-mngmt/service/product-mngmt-service/save_product',
//                         selector: '.form-control',
//                         field: 'field',
//                         function_call: true,
//                         function: loadproduct,
//                         parameter: true,
//                         alert_on_error: false,
//                         errorsend: true,
//                         errorsend_function: [{
//                             function: error_connection,
//                             msg: "Please check your connection and try again."
//                         }],
//                         function_call_on_error: true,
//                         error_function: [{
//                             function: error,
//                             parameter: true,
//                         }]
//                     });
//                 }
//             },
//             cancel: {

//             }
//         },
//     });
// });
