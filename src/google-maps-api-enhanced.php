<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Google Maps Api Enhanced</title>
    <link rel="stylesheet" href="../css/index.css">

    <!-- CDN for jquery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <!-- flatpickr -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

</head>
<body>
    
<div class="search-wrapper">

    <div class="search-box">

    <div class="location">
    
    <p class="label">Location</p>

        <div class="form-group">

            <input type="text" id="location" name="location" class="form-control" placeholder="Where are u going?" value="<?php if(isset($_GET["location"])){ echo $_GET["location"]; } ?>">
        
        </div>

    </div>

    <div class="lat">

        <p class="label">Latitude</p>

        <div class="form-group">

            <input type="text" name="lat" class="form-control" id="lat" class="lat" value="<?php if(isset($_GET["lat"])){ echo $_GET["lat"]; } ?>">

        </div>

    </div>

    <div class="lng">

        <p class="label">Longitude</p>

        <div class="form-group">

                <input type="text" name="lng" class="form-control" id="lng" class="lng" value="<?php if(isset($_GET["lng"])){ echo $_GET["lng"]; } ?>">

        </div>

    </div>


    <a class="search-icon" id="formsubmit" href="#"><img src="../assets/search2.svg" alt=""></a>

    </div>

</div>

<div class="map" id="map">



</div>

<script>
    
let autocomplete;
var enabled = "true";

function doNothing() {}

function downloadUrl(url, callback) {
  var request = window.ActiveXObject ?
    new ActiveXObject('Microsoft.XMLHTTP') :
    new XMLHttpRequest;

  request.onreadystatechange = function() {
    if (request.readyState == 4) {
      request.onreadystatechange = doNothing;
      callback(request, request.status);
    }
  };

  request.open('GET', url, true);
  request.send(null);
}

var customLabel = {
  restaurant: {
    label: 'Food',
    icon: './dish.svg'
  },
  bar: {
    label: 'Bar'
  },
  home:{
    label: 'Home',
    //icon: '../assets/location-picker.svg'
  },
  homestay:{
    label: 'Homestay',
    //icon: '../assets/location-picker.svg',
  },
  condominium:{
    label: 'Condo',
    //icon: '../assets/location-picker.svg',
  }
}; 

function initAutocomplete(lat, lng){

  //console.log(url);

  if(typeof lat == 'undefined'){

    if($('#lat').val() > 0 ){

      lat = parseFloat($('#lat').val());
      lng = parseFloat($('#lng').val());

    }else{

      lat = 5.319239;
      lng = 100.469696;

    }

  }

  const map = new google.maps.Map(document.getElementById("map"), {
    center: { lat: lat, lng: lng },
    zoom: 11,
    mapTypeId: "roadmap",
  });

  var infoWindow = new google.maps.InfoWindow;

  map.addListener('dragstart', () =>{

    if(enabled == 'true'){

    location: $('#location').val("Map Selected Area");

    }

  })

  map.addListener('idle', () =>{

    google.maps.Map.prototype.markers = new Array();

    google.maps.Map.prototype.addMarker = function(marker) {
        this.markers[this.markers.length] = marker;
    };

    google.maps.Map.prototype.getMarkers = function() {
        return this.markers
    };

    google.maps.Map.prototype.clearMarkers = function() {
        for(var i=0; i<this.markers.length; i++){
            this.markers[i].setMap(null);
        }
        this.markers = new Array();
    };

    if(enabled == 'true'){

        let markers = [];

        function setMapOnAll(map) {
        for (var i = 0; i < markers.length; i++) {
            markers[i].setMap(map);
        }
        }

        function clearMarkers() {
        setMapOnAll(null);
        }

        function deleteMarkers() {
        clearMarkers();
        markers = [];
        }

        deleteMarkers();

        var centerLat = map.getCenter().lat();
        var centerLng = map.getCenter().lng();

        lat: $('#lat').val(centerLat);
        lng: $('#lng').val(centerLng);

        map.setOptions({draggable: false});
        $('#map').css("pointer-events","none");

        maploading = `<div class="map-loader">`+`<img src="../assets/loading-dark.gif" height="30px" width="30px">`+`</div>`;

        $('#map').append(maploading);

        console.log(centerLat, centerLng);

        var start = 0;

        downloadUrl(`../inc/xml_querier.inc.php?lat=${centerLat}&lng=${centerLng}`, function(data) {

            console.log(data);

            var xml = data.responseXML;
            var markers = xml.documentElement.getElementsByTagName('marker');

            Array.prototype.forEach.call(markers, function(markerElem) {

            var id = markerElem.getAttribute('id');
            var name = markerElem.getAttribute('name');
            var address = markerElem.getAttribute('address');
            var type = markerElem.getAttribute('stayType');
            var point = new google.maps.LatLng(

                parseFloat(markerElem.getAttribute('lat')),
                parseFloat(markerElem.getAttribute('lng'))

            );

            var infowincontent = document.createElement('div');
            var strong = document.createElement('strong');
            strong.textContent = name
            infowincontent.appendChild(strong);
            infowincontent.appendChild(document.createElement('br'));

            var text = document.createElement('text');
            text.textContent = address
            infowincontent.appendChild(text);

            infowincontent = `<div class="infopopup">`+
                `<a href="#/">Go to details</a>`

            var icon = customLabel[type] || {};

            var marker = new google.maps.Marker({

                map: map,
                position: point,
                label: icon.id,
                //icon: '../../Image/icons/location-picker.svg',
                
            });

            marker.addListener('click', function() {

                infoWindow.setContent(infowincontent);
                infoWindow.open(map, marker);

            });

            });

            map.setOptions({draggable: true});
            $('#map').css("pointer-events","all");
            $('.map-loader').remove();

        });

    }

  });

  var centerLat = map.getCenter().lat();
  var centerLng = map.getCenter().lng();

  // Change this depending on the name of your PHP or XML file
  downloadUrl(`../inc/xml_querier.inc.php?lat=${centerLat}&lng=${centerLng}`, function(data) {

    console.log(data);

    var xml = data.responseXML;
    var markers = xml.documentElement.getElementsByTagName('marker');

    Array.prototype.forEach.call(markers, function(markerElem) {

      var id = markerElem.getAttribute('id');
      var name = markerElem.getAttribute('name');
      var address = markerElem.getAttribute('address');
      var type = markerElem.getAttribute('stayType');
      var point = new google.maps.LatLng(

        parseFloat(markerElem.getAttribute('lat')),
        parseFloat(markerElem.getAttribute('lng'))

      );

      var infowincontent = document.createElement('div');
      var strong = document.createElement('strong');
      strong.textContent = name
      infowincontent.appendChild(strong);
      infowincontent.appendChild(document.createElement('br'));

      var text = document.createElement('text');
      text.textContent = address
      infowincontent.appendChild(text);

      infowincontent = `<div class="infopopup">`+
        `<a href="#/">Go to details</a>`

      var icon = customLabel[type] || {};

      var marker = new google.maps.Marker({

        map: map,
        position: point,
        label: icon.id,
        icon: icon.icon
        
      });

      marker.addListener('click', function() {

        /* window.location.href = "http://www.w3schools.com"; */

        infoWindow.setContent(infowincontent);
        infoWindow.open(map, marker);

      });

    });

  });

    autocomplete = new google.maps.places.Autocomplete(

      document.getElementById('location'),
      {

          //restrict google services to only these 3 is provided, less payout
          fields: ['place_id','geometry','name']

      }

    );

    autocomplete.addListener('place_changed', onPlaceChanged);

    $(".pac-container").css("width","450px");

    searchonmove = `<div class="searchonmove">`+
    `<p>Search on map move</p>`+
    `<input type="checkbox" value="" id="toggle-slide" checked onchange="toggleSearchOnMove()">`+
    `</div>`

    $('#map').append(searchonmove);

/*     centerbutton = `<div class="center-button">`+

    `<a href="#/" onclick="centermap(${lat}, ${lng})" class="center-button"><img src="../../Image/icons/aim.svg" height="30px" width="30px"></a>`+

    `</div>`;

    $('#map').append(centerbutton); */

}

/*     function centermap(lat, lng){

      initAutocomplete(lat, lng);

    } */

    function toggleSearchOnMove(){

      if(enabled == "true"){

        enabled = "false";

      }else if(enabled == "false"){

        enabled = "true";

      }

    }

    function onPlaceChanged(){

        var place = autocomplete.getPlace();

        document.querySelector(".lat").value = place.geometry.location.lat();
        document.querySelector(".lng").value = place.geometry.location.lng();

        console.log(place.geometry.location.lat());
        console.log(place.geometry.location.lng());

        initAutocomplete(place.geometry.location.lat(), place.geometry.location.lng());

    }

</script>

<!-- Google Maps Api -->
<script async src="https://maps.googleapis.com/maps/api/js?key=APIKEY&callback=initAutocomplete&libraries=places&v=weekly"></script>

</body>
</html>