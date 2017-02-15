$(document).ready(function () {

    /*Start Show Model*/
    $('#myModal').on('shown.bs.modal', function () {
        $('#myInput').focus();
    });
    /*END Show Model*/

    /*start data upload*/
    var getCiudades = function () {
        $.post('/user/ajax/getCiudades', 'pais=' + $('#pais').val(), function (datas) {
            $('#ciudad').html('<option value=""> Select Ciudad </option>');

            for (var i = 0; i < datas.length; i++) {
                $('#ciudad').append('<option value = "' + datas[i].id + '">' + datas[i].ciudad + '</option>');
            }
        }, 'json');
    };

    $('#pais').change(function () {
        if (!$('#pais').val()) {
            $('#ciudad').html('');
        } else {
            getCiudades();
        }
    });

    $('#btn_insert').click(function () {
        $.post('/user/ajax/insertCiudad', 'pais=' + $('#pais').val() + '&ciudad=' + $('#ins_ciudad').val());

        $('#ins_ciudad').val('');
        getCiudades();
    });
    /*end data upload*/
});
