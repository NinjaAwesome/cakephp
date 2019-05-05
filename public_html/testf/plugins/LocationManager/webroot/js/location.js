function initMap(lat, lng, zoom) {
    geocoder = new google.maps.Geocoder();
    var latitude = document.getElementById('latitude');
    var longitude = document.getElementById('longitude');

    if (typeof (lat) == 'undefined') {
        lat = '53.9511369';
    } else {
        latitude.value = lat;
    }
    if (typeof (lng) == 'undefined') {
        lng = '-4.9567997';
    } else {
        longitude.value = lng;
    }
    if (typeof (zoom) == 'undefined') {
        zoom = 5;
    }
    var LatLng = new google.maps.LatLng(lat, lng);
    var mapOptions = {
        zoom: zoom,
        center: LatLng,
        scaleControl: true,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    }
    map = new google.maps.Map(document.getElementById('map'), mapOptions);


    marker = new google.maps.Marker({
        position: LatLng,
        map: map,
        title: 'Drag Me!',
        draggable: true
    });

    google.maps.event.addListener(map, 'click', function (event) {
        marker.setPosition(event.latLng);
        latitude.value = event.latLng.lat();
        longitude.value = event.latLng.lng();
        infowindow.close();
        geocodePosition(marker.getPosition());
    });

    google.maps.event.addListener(marker, 'dragend', function (event) {
        latitude.value = this.getPosition().lat();
        longitude.value = this.getPosition().lng();
        geocodePosition(marker.getPosition());
    });
}
function geocodePosition(pos) {
    geocoder.geocode({
        latLng: pos
    }, function (responses) {
        if ($("#formatted-address").length) {
            if (responses && responses.length > 0) {
                $("#formatted-address").html(responses[0].formatted_address);
            } else {
                $("#formatted-address").html('Cannot determine address at this location.');
            }
        }
    });
}


function setMapByAddress(address) {
    var z = 0;
    geocoder.geocode({'address': address}, function (results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
            var latitude = results[0].geometry.location.lat();
            var longitude = results[0].geometry.location.lng();
            var formatted_address = results[0].formatted_address;
            
                $('#latitude').val(latitude);
                $('#longitude').val(longitude);
                $('#formatted-address').html(formatted_address);
            zoom = 10;
            if (z == 3)
                zoom = 12
            else if (z >= 4)
                zoom = 18
            initMap(latitude, longitude, zoom);
        } else {
                	//alert('Invalid Address Please enter valid address to Locate Lat long.');
            		//$('#street-address').focus();
        }
    });
}