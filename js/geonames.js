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
                $('#res-ubicaciones').empty();

                $.each(res.geonames, function(index, ubicacion){
                    var nombre_lugar = ubicacion.name + ', ' + ubicacion.adminName1 + ', ' + ubicacion.countryCode;

                    if (lugares_unicos.indexOf(nombre_lugar) == -1)
                    {
                        lugares_unicos.push(nombre_lugar);
                        $('#res-ubicaciones').append("<li lat='" + ubicacion.lat + "' lng='" + ubicacion.lng + "'>" + nombre_lugar + "</li>");
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

var seleccionaUbicacion = function()
{
    $('#res-ubicaciones').on('click', 'li', function() {
        $('#Fotos_direccion').val($(this).html());
        $('#Fotos_latitud').val($(this).attr('lat'));
        $('#Fotos_longitud').val($(this).attr('lng'));

        map.flyTo([$(this).attr('lat'), $(this).attr('lng')], 12);
    });
};