(function(window, google, $) {

    //var for laravel
    var latField = $('input#lat'),
        lngField = $('input#lng');

    var $maperizer = $('#map-canvas').maperizer(Maperizer.MAP_OPTIONS_GEOLOCATION);

    $maperizer.maperizer('attachEventsToMap', [{
            name: 'click',
            callback: function(event){

                $maperizer.maperizer('removeMarkers', function(marker){
                    return marker.newMarker === true;
                });

                $maperizer.maperizer('addMarker', {
                    lat: event.latLng.lat(),
                    lng: event.latLng.lng(),
                    newMarker: true
                });

                latField.val( event.latLng.G);
                lngField.val(event.latLng.K);
            }
        }]
    );



}(window, google, jQuery));

