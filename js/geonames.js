var porNombre = function (q) {
    var url = "http://api.geonames.org/searchJSON";

    $.ajax({
        method: "GET",
        url: url,
        dataType: 'json',
        data: { q: q, username: 'calonsot', lang: 'es', maxRows: 10, country: 'mx' }
    })
        .done(function( res ) {
            if (typeof res.totalResultsCount !== 'undefined' && res.totalResultsCount > 0)
            {
                var lugares_unicos = [];
                $.each(res.geonames, function(index, ubicacion){
                    var nombre_lugar = ubicacion.name + ', ' + ubicacion.adminName1 + ', ' + ubicacion.countryCode;

                    if (lugares_unicos.indexOf(nombre_lugar) == -1)
                    {
                        lugares_unicos.push(nombre_lugar);
                        console.log(nombre_lugar);
                        $('#res-ubicaciones').append("<li>" + nombre_lugar + "</li>");
                    }
                });
            }
        });
};

var porCoordenadas = function (lat, lng) {
    var url = "http://api.geonames.org/findNearbyPostalCodesJSON";

    $.ajax({
        method: "GET",
        url: url,
        dataType: 'json',
        data: { lat: lat, lng: lng, username: 'calonsot', lang: 'es', country: 'mx' }
    })
        .done(function( ubicaciones ) {
            if (typeof ubicaciones.postalCodes !== 'undefined' && ubicaciones.postalCodes.length > 0) {
                var nombre_lugar = ubicaciones.postalCodes[0].placeName + ', ' + ubicaciones.postalCodes[0].adminName1 + ', ' + ubicaciones.postalCodes[0].countryCode;
                $('#Fotos_direccion').val(nombre_lugar);
                $('#Fotos_latitud').val(lat);
                $('#Fotos_longitud').val(lng);
            }
        });
};

$('#fotos-form').ready(function(){
    $('#fotos-form').on('click', '#boton-ubicaciones', function(){
        console.log('con clic');
        return false;
    });
});