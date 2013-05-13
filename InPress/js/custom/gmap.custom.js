jQuery(document).ready(function($){ 
    var map;
    var geocoder;
    initializeMap();

    function initializeMap() {
        geocoder = new google.maps.Geocoder();
        geocoder.geocode({
            "address": "'.$c_adress.'",
            "partialmatch": true}, geocodeResult);   
    }
    function geocodeResult(results, status) {
        if (status == "OK" && results.length > 0) {         
            var latlng = new google.maps.LatLng(results[0].geometry.location.b,results[0].geometry.location.c);
            var myOptions = {
                zoom: 15,
                center: results[0].geometry.location,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            }; 
            map = new google.maps.Map(document.getElementById("contact_fgmap"), myOptions);

            var marker = new google.maps.Marker({
                position: results[0].geometry.location,
                map: map,
                title: "'.$c_title.'"
            });
        } 
    }
});