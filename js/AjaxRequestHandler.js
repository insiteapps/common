var AjaxRequestHandler = function () {
    return {
        init: function (url, data, successHandler, errorHandler, type, dataType) {
            $.ajax({
                url: url,
                type: type ? type : 'post',
                dataType: dataType ? dataType : 'json',
                data: data,
                success: successHandler,
                error: errorHandler
            });
        }
    }


    var successHandler = function (data) {

    };

    var errorHandler = function () {
        alert('Sorry there has been an error');
    };
}();
