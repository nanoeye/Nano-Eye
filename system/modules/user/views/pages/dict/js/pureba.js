$(document).on('ready', function () {

    $('.page').click(function (){
        pagination($(this).attr('page'));
    });

    var pagination = function (page) {
        var page = 'page=' + page;
        var number = '&number=' + $('#number').val();
        var pais = '&pais=' + $('#pais').val();
        var ciudad = '&ciudad=' + $('#ciudad').val();
        var reg = '&reg=' + $('#reg').val();


        $.post(_root_ + 'user/dict/purebaAjax', page + number + pais + ciudad + reg, function (data) {
            $('#list').html('');
            $('#list').html(data);
        });
    }

    $('#pais').change(function() {
        $.post(_root_ + '/user/ajax/getCiudades', 'pais=' + $('#pais').val(), function(datas) {
            $('#ciudad').html('<option value=""> Select Ciudad </option>');

            for (var i = 0; i < datas.length; i++) {
                $('#ciudad').append('<option value = "' + datas[i].id + '">' + datas[i].ciudad + '</option>');
            }
        }, 'json');

        $('#ciudad').val('');

        pagination();
    });

    $('#btnSearch').click(function () {
        pagination();
    });

    $('#btnSearch').change(function() {
        if($('#pais').val()) {
            pagination();
        };
    });

    $('#reg').change(function() {
        if($('#reg').val()) {
            pagination();
        }
    });
});


