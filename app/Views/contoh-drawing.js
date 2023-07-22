// Code goes here

// var map = null;
var myMarker;
var myLatlng;
let over=1;


$(document).ready(function () {


  // lat=;
  // lng=;
  function initializeGMap() {
    myLatlng = new google.maps.LatLng(-0.343707, 100.374485);




    var myOptions = {
      zoom: 16,
      zoomControl: true,
      center: myLatlng,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    };

    map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);

    // console.log(html);

    myMarker = new google.maps.Marker({
      position: myLatlng
    });
    // myMarker.setMap(map);


    var drawingManager = new google.maps.drawing.DrawingManager({
      drawingMode: google.maps.drawing.OverlayType.POLYGON,
      drawingControl: true,
      drawingControlOptions: {
        position: google.maps.ControlPosition.TOP_CENTER,
        drawingModes: ['polygon']
      },
      markerOptions: {
        icon: 'https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png'
      },
      circleOptions: {
        fillColor: '#ffff00',
        fillOpacity: 1,
        strokeWeight: 5,
        clickable: false,
        editable: true,
        zIndex: 1
      }
    });

    drawingManager.setMap(map);

    google.maps.event.addListener(drawingManager, 'overlaycomplete', function (event) {
      var str_input ='POLYGON((';
      var str_backup='';

      if (event.type == google.maps.drawing.OverlayType.POLYGON) {

        console.log('polygon path array', event.overlay.getPath().getArray());
        $.each(event.overlay.getPath().getArray(), function(key, latlng){
          var lat = latlng.lat();
          var lon = latlng.lng();
          console.log(lat, lon);

          str_input += lon +' '+ lat +',';
          str_backup+= lon +' '+ lat +',';
          if(over==1)
          {
            // startView+=lat +' '+ lon ;
            over++;
          }
        });
      }

      console.log(str_backup);
      str_backup=str_backup.split(",");
      console.log(str_backup[0]);

      str_input = str_input.substr(0,str_input.length-1) +','+str_backup[0]+ '))';
      console.log(str_input);

      str_input = str_input.substr(0, str_input.length - 1) + ')';
      // console.log(str_input);
      var name = document.getElementById('coordinates').value = str_input;


      // Check Drawing Polygon


    });



  }

  // Re-init map before show modal
  $('#myModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    initializeGMap(button.data('lat'), button.data('lng'));
    $("#location-map").css("width", "100%");
    $("#map_canvas").css("width", "100%");
  });

  // Trigger map resize event after modal shown
  $('#myModal').on('shown.bs.modal', function () {
    google.maps.event.trigger(map, "resize");
    map.setCenter(myLatlng);

  });
});




function gps() {
  alert("If GPS not accurate use LatLon instead");
  // alert("test");
  // console.log(map);
  // Try HTML5 geolocation.
  var infoWindow;
  infoWindow = new google.maps.InfoWindow;
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function (position) {
      var pos = {
        lat: position.coords.latitude,
        lng: position.coords.longitude
      };

      infoWindow.setPosition(pos);
      infoWindow.setContent('Location found.');
      infoWindow.open(map);
      map.setCenter(pos);
    }, function () {
      handleLocationError(true, infoWindow, map.getCenter());
    });
  } else {
    // Browser doesn't support Geolocation
    handleLocationError(false, infoWindow, map.getCenter());
  }
}

function handleLocationError(browserHasGeolocation, infoWindow, pos) {
  infoWindow.setPosition(pos);
  infoWindow.setContent(browserHasGeolocation ?
    'Error: The Geolocation service failed.' :
    'Error: Your browser doesn\'t support geolocation.');
  infoWindow.open(map);
}


function latlon() {
  latitude = document.getElementById("latitude").value;
  longitude = document.getElementById("longitude").value;

  latitude = parseFloat(latitude);
  longitude = parseFloat(longitude);

  map.setCenter({ lat: latitude, lng: longitude });
}


function landSearch() {
  land_id = document.getElementById("land").value;
  if(land_id=="")
  {

  }
  else
  {
     // Getting Land Data
  $.ajax({
    url: "../../../controller/admin/buildings/land_search.php?land_id=" + land_id, success: function (result) {
     result=JSON.parse(result);
     latitude = parseFloat(result.features[0].properties.y);
     longitude = parseFloat(result.features[0].properties.x);
    //  console.log(result);
     map.data.addGeoJson(result);
     map.setCenter({ lat: latitude, lng: longitude });
    }
  });
  }

}