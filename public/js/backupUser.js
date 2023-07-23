let putCounter = 0;
let over = 1;
let urlAplikasi = "http://localhost:8080/";
let map;
let tempArray;
let countArray = 0;
var infoWindow, markerA, markerB, drag_pos;
let countDirection = 0;
let directionsRenderer1;
let directionsRenderer2;
let directionsService;
let markerRouteStart;
let GPSLocation = null;
let radiusCircle;
let radiusStart = 0;
let markerArrayTemp = new Array();
let centerCircle;
function setBaseUrl(url) {
  baseUrl = url;
}

function initialize() {
  map = new google.maps.Map(document.getElementById("googlemaps"), {
    zoom: 14,
    center: new google.maps.LatLng(-0.7911133716096994, 100.60009746739821),
    mapTypeId: google.maps.MapTypeId.ROADMAP,
    disableDefaultUI: true,
    zoomControl: true,
  });

  var polyOptions = {
    strokeWeight: 0,
    fillOpacity: 0.45,
    editable: true,
  };

  if (putCounter == 0) {
    // myTimeout = setTimeout(callAfterPut, 2000);

    callAfterPut();
  } else {
  }
}
google.maps.event.addDomListener(window, "load", initialize);

function mapView(id) {
  var pos = {
    lat: parseFloat("-0.7911133716096994"),
    lng: parseFloat("100.60009746739821"),
  };
  map.setCenter(pos);
  map.setZoom(14);

  setMapOnAll(null);
  if (countArray == 0) {
  } else {
    tempArray.setMap(null);
    countArray = 0;
  }
  if (countDirection == 0) {
  } else {
    markerA.setMap(null);
    markerB.setMap(null);
    directionsRenderer1.setMap(null);
    directionsRenderer2.setMap(null);

    countDirection = 0;
  }

  // setMapOnAll(map);
  // markers.push(marker);
  // Buat marker baru di sini
  console.log(markerArray);
  $.get(urlAplikasi + "web/select_id_tourism/" + id, function (data) {
    xyPoint = JSON.parse(data);
    console.log();
    let x = xyPoint.features[0].properties["x"];
    let y = xyPoint.features[0].properties["y"];
    let posData = {
      lat: parseFloat(y),
      lng: parseFloat(x),
    };
    contentStringX =
      '<table class="table">' +
      "<thead>" +
      "  <tr>" +
      '    <th class="tg-0lax">Item</th>' +
      '    <th class="tg-0lax">Info</th>' +
      "  </tr>" +
      "</thead>" +
      "<tbody>" +
      "  <tr>" +
      '    <td class="tg-0lax">Name</td>' +
      '    <td class="tg-0lax">' +
      xyPoint.features[0].properties["name"] +
      "</td>" +
      "  </tr>" +
      "  <tr>" +
      '    <td class="tg-0lax">kshdkajhsdkahdjks</td>' +
      '    <td class="tg-0lax">jkhadkahjdhjkdjkj</td>' +
      "  </tr>" +
      "  <tr>" +
      '    <td class="tg-0lax"></td>' +
      '    <td class="tg-0lax"></td>' +
      "  </tr>" +
      "  <tr>" +
      '    <td class="tg-0lax"></td>' +
      '    <td class="tg-0lax"></td>' +
      "  </tr>" +
      "</tbody>" +
      "</table>" +
      "<br/><button onclick='dirrectionPointX(" +
      x +
      "," +
      y +
      ")' class='btn btn-success'>Route</button>";
    tempArray = new google.maps.Marker({
      position: posData,
      map,
      title: "Hello World!",
      animation: google.maps.Animation.DROP,
      info: contentStringX,
    });

    infowindow = new google.maps.InfoWindow({
      content: contentStringX,
      ariaLabel: "Uluru",
    });
    google.maps.event.addListener(tempArray, "click", function () {
      infowindow.setContent(this.info);
      infowindow.open(map, this);
    });
  });

  countArray = countArray + 1;
}
function mapRoute(id) {
  Swal.fire({
    title: "Click on the map to add the position manually",
    allowOutsideClick: () => {
      const popup = Swal.getPopup();
      popup.classList.remove("swal2-show");
      setTimeout(() => {
        popup.classList.add("animate__animated", "animate__headShake");
      });
      setTimeout(() => {
        popup.classList.remove("animate__animated", "animate__headShake");
      }, 500);
      return false;
    },
  });

  //  Rute dimana user memilih sendiri lokasinya
  google.maps.event.addListener(map, "click", function (event) {
    $.get(urlAplikasi + "web/select_id_tourism/" + id, function (data) {
      xyPoint = JSON.parse(data);
      console.log();
      let x = xyPoint.features[0].properties["x"];
      let y = xyPoint.features[0].properties["y"];

      placeMarker(event.latLng, x, y);
    });
  });

  setMapOnAll(null);

  console.log("test");
}

function placeMarker(location, x, y) {
  if (countArray == 0) {
  } else {
    markerB.setMap(null);
    countArray = 0;
  }
  if (countDirection == 0) {
  } else {
    markerA.setMap(null);
    markerB.setMap(null);
    directionsRenderer1.setMap(null);
    directionsRenderer2.setMap(null);

    countDirection = 0;
  }

  if (markerRouteStart == null) {
    markerRouteStart = new google.maps.Marker({
      position: location,
      map: map,
    });
  } else {
    markerRouteStart.setPosition(location);
  }
  console.log("MANUAL");
  let lat_y = markerRouteStart.getPosition().lat();
  let lng_x = markerRouteStart.getPosition().lng();
  console.log(lat_y);
  console.log(lng_x);
  console.log(x);
  console.log(y);

  dirrectionManual(x, y, lat_y, lng_x);
}

function setMapOnAll(map) {
  for (let i = 0; i < markerArray.length; i++) {
    markerArray[i].setMap(map);
  }
}
function setMapOnAllTemp(map) {
  for (let i = 0; i < markerArrayTemp.length; i++) {
    markerArrayTemp[i].setMap(map);
  }
}
function hideMarkers() {
  setMapOnAll(null);
}

function showMarkers() {
  setMapOnAll(map);
}

function dirrectionPointX(x, y) {
  $("#panelRender").empty();
  markerA = new google.maps.Marker({
    map: map,
  });
  if (tempArray == undefined) {
    centerCircle = new google.maps.Marker({
      position: GPSLocation,
      title: "Your Location!",
    });

    tempArray = centerCircle;
  }
  markerB = tempArray;
  infoWindow = new google.maps.InfoWindow();
  directionsService = new google.maps.DirectionsService();
  directionsRenderer1 = new google.maps.DirectionsRenderer({
    map: map,
    suppressMarkers: true,
  });
  directionsRenderer2 = new google.maps.DirectionsRenderer({
    map: map,
    suppressMarkers: true,
    polylineOptions: {
      strokeColor: "gray",
    },
  });
  directionsRenderer1.setPanel(document.getElementById("panelRender"));

  // Try HTML5 geolocation.
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(
      function (position) {
        var pos = {
          lat: position.coords.latitude,
          lng: position.coords.longitude,
        };

        map.setCenter(pos);
        map.setZoom(15);
        //Put markers on the place
        infoWindow.setContent("Your Location");
        markerA.setPosition(pos);
        markerA.setVisible(true);
        markerA.setLabel("A");
        markerA.addListener("click", function () {
          infoWindow.open(map, markerA);
        });

        //Get new lat long to put marker B 500m above Marker A
        var earth = 6378.137, //radius of the earth in kilometer
          pi = Math.PI,
          m = 1 / (((2 * pi) / 360) * earth) / 1000; //1 meter in degree

        // var new_latitude = pos.lat + (500 * m);
        // var new_pos = {
        //     lat: new_latitude,
        //     lng: position.coords.longitude
        // };

        // markerB.setPosition(new_pos, );
        markerB.setVisible(true);
        markerB.setLabel("B");
        // markerB.setDraggable(true);

        //Everytime MarkerB is drag Directions Service is use to get all the route
        // google.maps.event.addListener(markerB, 'dragend', function(evt) {
        // var drag_pos1 = {
        //     lat: evt.latLng.lat(),
        //     lng: evt.latLng.lng()
        // };
        // Koordinat tujuan
        let posData = {
          lat: parseFloat(y),
          lng: parseFloat(x),
        };

        directionsService.route(
          {
            origin: pos,
            destination: posData,
            travelMode: "DRIVING",
            provideRouteAlternatives: true,
          },
          function (response, status) {
            if (status === "OK") {
              for (var i = 0, len = response.routes.length; i < len; i++) {
                if (i === 0) {
                  directionsRenderer1.setDirections(response);
                  directionsRenderer1.setRouteIndex(i);
                } else {
                  directionsRenderer2.setDirections(response);
                  directionsRenderer2.setRouteIndex(i);
                }
              }
              console.log(response);
            } else {
              window.alert("Directions request failed due to " + status);
            }
          }
        );
        directionsService
          .route({
            origin: pos,
            destination: posData,
            travelMode: google.maps.TravelMode.DRIVING,
          })
          .then((response) => {
            directionsRenderer1.setDirections(response);
          })
          .catch((e) =>
            window.alert("Directions request failed due to " + status)
          );
        // });
        countDirection = countDirection + 1;
      },
      function () {
        handleLocationError(true, infoWindow, map.getCenter());
      }
    );
  } else {
    // Browser doesn't support Geolocation
    handleLocationError(false, infoWindow, map.getCenter());
  }
}

function dirrectionManual(x, y, lat_y, lng_x) {
  // Tambahkan panel informasi arah yang bisa diambil
  $("#panelRender").empty();

  markerA = new google.maps.Marker({
    map: map,
  });
  markerB = new google.maps.Marker({
    map: map,
  });
  infoWindow = new google.maps.InfoWindow();
  directionsService = new google.maps.DirectionsService();
  directionsRenderer1 = new google.maps.DirectionsRenderer({
    map: map,
    suppressMarkers: true,
  });
  directionsRenderer2 = new google.maps.DirectionsRenderer({
    map: map,
    suppressMarkers: true,
    polylineOptions: {
      strokeColor: "gray",
    },
  });
  directionsRenderer1.setPanel(document.getElementById("panelRender"));

  var pos = {
    lat: parseFloat(lat_y),
    lng: parseFloat(lng_x),
  };

  map.setCenter(pos);
  map.setZoom(15);
  //Put markers on the place
  infoWindow.setContent("Your Location");
  markerA.setPosition(pos);
  markerA.setVisible(true);
  markerA.setLabel("A");
  markerA.addListener("click", function () {
    infoWindow.open(map, markerA);
  });

  //Get new lat long to put marker B 500m above Marker A
  var earth = 6378.137, //radius of the earth in kilometer
    pi = Math.PI,
    m = 1 / (((2 * pi) / 360) * earth) / 1000; //1 meter in degree

  // var new_latitude = pos.lat + (500 * m);
  // var new_pos = {
  //     lat: new_latitude,
  //     lng: position.coords.longitude
  // };

  // markerB.setPosition(new_pos, );
  let posData = {
    lat: parseFloat(y),
    lng: parseFloat(x),
  };
  markerA.setPosition(posData);
  markerB.setVisible(true);
  markerB.setLabel("B");
  // markerB.setDraggable(true);

  //Everytime MarkerB is drag Directions Service is use to get all the route
  // google.maps.event.addListener(markerB, 'dragend', function(evt) {
  // var drag_pos1 = {
  //     lat: evt.latLng.lat(),
  //     lng: evt.latLng.lng()
  // };
  // Koordinat tujuan

  directionsService.route(
    {
      origin: pos,
      destination: posData,
      travelMode: "DRIVING",
      provideRouteAlternatives: true,
    },
    function (response, status) {
      if (status === "OK") {
        for (var i = 0, len = response.routes.length; i < len; i++) {
          if (i === 0) {
            directionsRenderer1.setDirections(response);
            directionsRenderer1.setRouteIndex(i);
          } else {
            directionsRenderer2.setDirections(response);
            directionsRenderer2.setRouteIndex(i);
          }
        }
        console.log(response);
      } else {
        window.alert("Directions request failed due to " + status);
      }
    }
  );

  directionsService
    .route({
      origin: pos,
      destination: posData,
      travelMode: google.maps.TravelMode.DRIVING,
    })
    .then((response) => {
      directionsRenderer1.setDirections(response);
    })
    .catch((e) => window.alert("Directions request failed due to " + status));
  // });
  countDirection = countDirection + 1;
}

function radiusGPS() {
  infoWindow = new google.maps.InfoWindow();

  const locationButton = document.createElement("button");

  locationButton.textContent = "Pan to Current Location";
  locationButton.classList.add("custom-map-control-button");
  locationButton.classList.add("btn");
  locationButton.classList.add("btn-danger");

  map.controls[google.maps.ControlPosition.TOP_CENTER].push(locationButton);
  locationButton.addEventListener("click", () => {
    // Try HTML5 geolocation.
    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(
        (position) => {
          GPSLocation = {
            lat: position.coords.latitude,
            lng: position.coords.longitude,
          };

          infoWindow.setPosition(GPSLocation);
          infoWindow.setContent("Location found.");
          infoWindow.open(map);
          map.setCenter(GPSLocation);
        },
        () => {
          handleLocationError(true, infoWindow, map.getCenter());
        }
      );
    } else {
      // Browser doesn't support Geolocation
      handleLocationError(false, infoWindow, map.getCenter());
    }
  });
}

function radiusManual() {}

function radiusChange() {
  // Ubah ukuran circle
  if (radiusStart == 0) {
  } else {
    radiusCircle.setMap(null);
  }

  let radiusValue = $("#customRadius").val();
  $("#valueMeter").text(radiusValue + " Meter");
  $("#typeRadius").val(radiusValue);
  if (GPSLocation == null) {
    alert("Select Geolocation or Add Coordinate Manually First");
    radiusValue = $("#customRadius").val("0");
    $("#typeRadius").val(0);
    $("#valueMeter").text("0 M");
  } else {
    // Panggil pakai AJAX ke database pakai fungsi spasial

    // Ubah GPSLocation menjadi string

    gpsText = GPSLocation.lat + "A" + GPSLocation.lng;

    $.get(
      urlAplikasi + "web/radius_data/" + radiusValue + "/" + gpsText,
      function (data) {
        console.log(
          urlAplikasi + "web/radius_data/" + radiusValue + "/" + gpsText
        );
        // console.log(data);
        // Hapus semua marker lebih dahulu
        // setMapOnAll(null);
        hideMarkers();
        // console.log(data.length);
        setMapOnAllTemp(null);

        if (data.length > 42) {
          // Marker Array Temporary

          let dataData = JSON.parse(data);
          console.log(dataData);
          let i = 0;
          let length = dataData.features.length;

          while (i < length) {
            console.log("GPSLocation");
            console.log(GPSLocation);
            console.log("GPSLocation");

            let x = dataData.features[i].properties["x"];
            let y = dataData.features[i].properties["y"];
            let posData = {
              lat: parseFloat(y),
              lng: parseFloat(x),
            };

            contentString =
              '<table class="table">' +
              "<thead>" +
              "  <tr>" +
              '    <th class="tg-0lax">Item</th>' +
              '    <th class="tg-0lax">Info</th>' +
              "  </tr>" +
              "</thead>" +
              "<tbody>" +
              "  <tr>" +
              '    <td class="tg-0lax">Name</td>' +
              '    <td class="tg-0lax">' +
              dataData.features[0].properties["name"] +
              "</td>" +
              "  </tr>" +
              "  <tr>" +
              '    <td class="tg-0lax">kshdkajhsdkahdjks</td>' +
              '    <td class="tg-0lax">jkhadkahjdhjkdjkj</td>' +
              "  </tr>" +
              "  <tr>" +
              '    <td class="tg-0lax"></td>' +
              '    <td class="tg-0lax"></td>' +
              "  </tr>" +
              "  <tr>" +
              '    <td class="tg-0lax"></td>' +
              '    <td class="tg-0lax"></td>' +
              "  </tr>" +
              "</tbody>" +
              "</table>" +
              "<br/><button onclick='dirrectionPointX(" +
              x +
              "," +
              y +
              ")' class='btn btn-success'>Route</button>";
            markerArrayTemp[i] = new google.maps.Marker({
              position: posData,
              map,
              title: "Hello World!",
              info: contentString,
            });

            infowindow = new google.maps.InfoWindow({
              content: contentString,
              ariaLabel: "Uluru",
            });

            google.maps.event.addListener(
              markerArrayTemp[i],
              "click",
              function () {
                infowindow.setContent(this.info);
                infowindow.open(map, this);
              }
            );
            i++;
          }
        } else {
          // Jangan lakukan apa-apa
        }
      }
    );

    radiusCircle = new google.maps.Circle({
      strokeColor: "#FF0000",
      strokeOpacity: 0.8,
      strokeWeight: 2,
      fillColor: "#FF0000",
      fillOpacity: 0.35,
      map,
      center: GPSLocation,
      radius: parseInt(radiusValue),
    });

    radiusStart++;
  }
  console.log("GPS LOCATION");
  console.log(GPSLocation);
  // alert(radiusValue);
}

function radiusChangeType() {
  // Ubah ukuran circle
  if (radiusStart == 0) {
  } else {
    radiusCircle.setMap(null);
  }

  let radiusValue = $("#typeRadius").val();
  $("#valueMeter").text(radiusValue + " Meter");
  $("#customRadius").val(radiusValue);
  if (GPSLocation == null) {
    alert("Select Geolocation or Add Coordinate Manually First");
    radiusValue = $("#typeRadius").val(0);
    $("#customRadius").val(0);
    $("#valueMeter").text("0 M");
  } else {
    // Panggil pakai AJAX ke database pakai fungsi spasial
    radiusCircle = new google.maps.Circle({
      strokeColor: "#FF0000",
      strokeOpacity: 0.8,
      strokeWeight: 2,
      fillColor: "#FF0000",
      fillOpacity: 0.35,
      map,
      center: GPSLocation,
      radius: parseInt(radiusValue),
    });

    radiusStart++;
  }
  console.log(GPSLocation);
  // alert(radiusValue);
}

function handleLocationError(browserHasGeolocation, infoWindow, pos) {
  infoWindow.setPosition(pos);
  infoWindow.setContent(
    browserHasGeolocation
      ? "Error: The Geolocation service failed."
      : "Error: Your browser doesn't support geolocation."
  );
  infoWindow.open(map);
}
