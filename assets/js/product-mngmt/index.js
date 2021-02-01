
$(document).ready(function() {
    loadproduct();
});

var loadproduct = () => {
    $(document).gmLoadPage({
        url: baseUrl + 'product-mngmt/get_product',
        load_on: '#loadproduct'
    });
}

/** save new establishment */
$(document).on('click', '#add_product', function() {
    $.confirm({
        containerFluid: true,
        columnClass: 'col-md-5 offset-md-4',
        title: '',
        content: 'Please click OK or ENTER to save.',
        theme: 'modern',
        closeIcon: true,
        animation: 'scale',
        type: 'red',
        alignMiddle: true,
        buttons: {
            okay: {
                btnClass: 'btn-blue',
                keys: [
                    'enter'
                ],
                action: function() {
                    $(document).gmPostHandler({
                        url: 'product-mngmt/service/product-mngmt-service/save_product',
                        selector: '.form-control',
                        field: 'field',
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
                }
            },
            cancel: {

            }
        },
    });
});

/** save new establishment */
$(document).on('click', '#update_product', function() {
    $.confirm({
        containerFluid: true,
        columnClass: 'col-md-5 offset-md-4',
        title: '',
        content: 'Please click OK or ENTER to save.',
        theme: 'modern',
        closeIcon: true,
        animation: 'scale',
        type: 'red',
        alignMiddle: true,
        buttons: {
            okay: {
                btnClass: 'btn-blue',
                keys: [
                    'enter'
                ],
                action: function() {
                    $(document).gmPostHandler({
                        url: 'product-mngmt/service/product-mngmt-service/update_product',
                        selector: '.form-control',
                        field: 'field',
                        function_call: true,
                        parameter: true,
                        function: success,
                        add_functions: [
                            {
                                function: loadproduct
                            }
                        ],
                        
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
                }
            },
            cancel: {

            }
        },
    });
});
