let baseUrl = "";
let currentUrl = "";
let web;
let bounds = new google.maps.LatLngBounds();

var markers = []; //MARKER UNTUK POSISI SAAT INI
var pos = "null"; //lat & lng POSISI SAAT INI
var centerLokasi; //lat & lng POSISI SAAT INI

var infowindow; //JENDELA INFO
var infoDua = []; //HIMPUNAN JENDELA INFO
var markersDua = []; //HIMPUNAN MARKER
var markersManual = []; //HIMPUNAN MARKER
let map;
let putCounter = 0;
let over = 1;
let urlAplikasi = "http://localhost:8080/";

function setBaseUrl(url) {
  baseUrl = url;
}

// $(".deleteStyle").click(function (e) {
//   e.preventDefault(); // Prevent the href from redirecting directly
//   var linkURL = $(this).attr("href");
//   warnBeforeRedirect(linkURL);
// });

$(document).on("click", "a.deleteStyle", function (e) {
  e.preventDefault();
  var linkURL = $(this).attr("href");

  Swal.fire({
    title: "Do you want to delete the row?",

    showCancelButton: true,
    confirmButtonText: "Delete",
    denyButtonText: `Don't delete`,
  }).then((result) => {
    /* Read more about isConfirmed, isDenied below */
    if (result.isConfirmed) {
      Swal.fire("Done!", "", "success");
      window.location.href = linkURL;
    } else if (result.isDenied) {
      Swal.fire("Changes are not saved", "", "info");
    }
  });
});

// -------------------------------------------------------------------------

var drawingManager;
var selectedShape;
var colors = ["#1E90FF", "#FF1493", "#32CD32", "#FF8C00", "#4B0082"];
var selectedColor;
var colorButtons = {};

String.prototype.replaceAll = function (str1, str2, ignore) {
  return this.replace(
    new RegExp(
      str1.replace(/([\/\,\!\\\^\$\{\}\[\]\(\)\.\*\+\?\|\<\>\-\&])/g, "\\$&"),
      ignore ? "gi" : "g"
    ),
    typeof str2 == "string" ? str2.replace(/\$/g, "$$$$") : str2
  );
};
let clickCount = 0;
let dinCount = 0;
let directionsRenderer1 = new Array();
let directionsRenderer2 = new Array();
let directionCount = 0;

let u = 0;
let directionDisplay;
let directionsService = new google.maps.DirectionsService();
let directionsServicePackage = new google.maps.DirectionsService();
let directionsRenderer = new google.maps.DirectionsRenderer({
  suppressMarkers: true,
});
let waypoints = new Array();
let waypointsMarker = new Array();
let packageMarker = new Array();

function dirrectionManual(x, y, des) {
  // Tambahkan panel informasi arah yang bisa diambil
  // directionDisplay = new google.maps.DirectionsRenderer();
  // directionDisplay.setMap(map);

  // [{location: first, stopover: false},
  //   {location: second, stopover: false}]

  var first = new google.maps.LatLng(parseFloat(y), parseFloat(x));
  waypoints.push({ location: first, stopover: true });
  waypointsMarker.push({ lat: y, lng: x, des: des });
  console.log(waypoints);
  // var second = new google.maps.LatLng(42.496401, -124.413126);

  // var request = {
  //     origin: first,
  //     destination: "San Diego, CA",
  //     waypoints: waypoints,
  //     optimizeWaypoints: true,
  //     travelMode: google.maps.DirectionsTravelMode.WALKING
  // };
  // directionsService.route(request, function (response, status) {
  //     if (status == google.maps.DirectionsStatus.OK) {
  //         directionDisplay.setDirections(response);
  //         var route = response.routes[0];
  //         var summaryPanel = document.getElementById("panelRenderX");
  //         summaryPanel.innerHTML = "";
  //         // For each route, display summary information.
  //         for (var i = 0; i < route.legs.length; i++) {
  //             var routeSegment = i + 1;
  //             summaryPanel.innerHTML += "<b>Route Segment: " + routeSegment + "</b><br />";
  //             summaryPanel.innerHTML += route.legs[i].start_address + " to ";
  //             summaryPanel.innerHTML += route.legs[i].end_address + "<br />";
  //             summaryPanel.innerHTML += route.legs[i].distance.text + "<br /><br />";
  //         }
  //     } else {
  //         alert("directions response " + status);
  //     }
  // });
}

function detail_booking(id_package) {
  window.location.href = urlAplikasi + "/package/booking_read/" + id_package;
}

function routeWayPoints() {
  console.log(waypointsMarker);
  directionDisplay = new google.maps.DirectionsRenderer();
  directionDisplay.setMap(map);
  directionsRenderer.setMap(map);

  let upMarker = waypointsMarker.length;
  let fd = 0;
  while (fd < upMarker) {
    var pgPos = {
      lat: parseFloat(waypointsMarker[fd].lat),
      lng: parseFloat(waypointsMarker[fd].lng),
    };

    packageMarker[fd] = new google.maps.Marker({
      position: pgPos,
      map,
      title: waypointsMarker[fd].des,
      animation: google.maps.Animation.DROP,
    });
    packageMarker[fd].setZIndex(fd);
    packageMarker[fd].setLabel((fd + 1).toString());
    // console.log(packageMarker);
    fd++;
  }

  wayLength = waypoints.length;
  wayLength = wayLength - 1;
  console.log(waypoints[0].location.lat());

  var origin = {
    lat: parseFloat(waypoints[0].location.lat()),
    lng: parseFloat(waypoints[0].location.lng()),
  };

  var destination = {
    lat: parseFloat(waypoints[wayLength].location.lat()),
    lng: parseFloat(waypoints[wayLength].location.lng()),
  };

  console.log({
    origin: origin,
    destination: destination,
    waypoints: waypoints,

    travelMode: google.maps.TravelMode.DRIVING,
  });

  directionsServicePackage
    .route({
      origin: origin,
      destination: destination,
      waypoints: waypoints,

      travelMode: google.maps.TravelMode.DRIVING,
    })
    .then((response) => {
      directionsRenderer.setDirections(response);

      // const route = response.routes[0];
      // const summaryPanel = document.getElementById("panelRenderX");

      // summaryPanel.innerHTML = "";

      // // For each route, display summary information.
      // for (let i = 0; i < route.legs.length; i++) {
      //   const routeSegment = i + 1;

      //   summaryPanel.innerHTML +=
      //     "<b>Route Segment: " + routeSegment + "</b><br>";
      //   summaryPanel.innerHTML += route.legs[i].start_address + " to ";
      //   summaryPanel.innerHTML += route.legs[i].end_address + "<br>";
      //   summaryPanel.innerHTML += route.legs[i].distance.text + "<br><br>";
      // }
    })
    .catch((e) => window.alert("Directions request failed due to " + status));
}

function dirrectionManualPackage(x, y, description) {
  // Tambahkan panel informasi arah yang bisa diambil
  // directionDisplay = new google.maps.DirectionsRenderer();
  // directionDisplay.setMap(map);

  // [{location: first, stopover: false},
  //   {location: second, stopover: false}]

  var first = new google.maps.LatLng(parseFloat(y), parseFloat(x));
  waypoints.push({ location: first, stopover: true });
  waypointsMarker.push({ lat: y, lng: x, des: description });
  // console.log(waypoints);
  // var second = new google.maps.LatLng(42.496401, -124.413126);

  // var request = {
  //     origin: first,
  //     destination: "San Diego, CA",
  //     waypoints: waypoints,
  //     optimizeWaypoints: true,
  //     travelMode: google.maps.DirectionsTravelMode.WALKING
  // };
  // directionsService.route(request, function (response, status) {
  //     if (status == google.maps.DirectionsStatus.OK) {
  //         directionDisplay.setDirections(response);
  //         var route = response.routes[0];
  //         var summaryPanel = document.getElementById("panelRenderX");
  //         summaryPanel.innerHTML = "";
  //         // For each route, display summary information.
  //         for (var i = 0; i < route.legs.length; i++) {
  //             var routeSegment = i + 1;
  //             summaryPanel.innerHTML += "<b>Route Segment: " + routeSegment + "</b><br />";
  //             summaryPanel.innerHTML += route.legs[i].start_address + " to ";
  //             summaryPanel.innerHTML += route.legs[i].end_address + "<br />";
  //             summaryPanel.innerHTML += route.legs[i].distance.text + "<br /><br />";
  //         }
  //     } else {
  //         alert("directions response " + status);
  //     }
  // });
}
function showDetailPackage(count) {
  $("#detailPackage_" + count).append(
    '<div class="row"><div class="col-sm-6"><br><b>Activity</b><input name="activity_' +
      count +
      "_" +
      dinCount +
      '" type="text" class="form form-control" placeholder="Activity"></div><div class="col-sm-6"><br><b>Description</b><input type="text" class="form form-control" name="DETAIL-description_' +
      count +
      "_" +
      dinCount +
      '" placeholder="Description"></div><div class="col-sm-6"><br><b>Object</b><select name="select_object_' +
      count +
      "_" +
      dinCount +
      '" id="dataDinamis_' +
      count +
      "_" +
      dinCount +
      '" class="form form-control"></select></div></div>'
  );
  fillObjectID(count, dinCount);
  dinCount++;
}
let arrayName = new Array();
let textData = "";

function getNameField() {
  $("#submitName").attr("disabled", false);
  arrayName = [];
  $("#dynamicForm input, #dynamicForm select, #dynamicForm textarea").each(
    function (index) {
      var input = $(this);
      console.log(
        "Type: " +
          input.attr("type") +
          "Name: " +
          input.attr("name") +
          "Value: " +
          input.val()
      );
      if (input.attr("name").includes("checkbox_service_package")) {
      } else {
        textData = textData + input.attr("name") + ",";
        arrayName.push(input.attr("name"));
      }
    }
  );

  $("#dynamicForm")
    .children("input:checked")
    .map(function () {
      console.log(this.name);
      textData = textData + this.name + ",";
      arrayName.push("REAL_" + this.name);
    });

  console.log(arrayName);

  data_final = JSON.stringify(arrayName);
  $("#nameHidden").val(textData);
}

let package_count = 1;

function showPackageDay() {
  $("#detail_day").append(
    '<div class="form-group"><label for="int">Package Day</label><input type="number" class="form-control" autocomplete="off" name="package_day_' +
      clickCount +
      '" id="price" placeholder="Package Day" value="' +
      package_count +
      '"></div><label for="description">Description </label><textarea class="form-control" rows="3" name="DAY-description_' +
      clickCount +
      '" id="description" placeholder="Description"></textarea><div id="detailPackage_' +
      clickCount +
      '"></div><div onclick="showDetailPackage(' +
      clickCount +
      ')" class="btn btn-info">Add detail</div>'
  );
  package_count++;
  clickCount++;
}

function fillObjectID(count, dinCount) {
  let i = 0;
  $.get(urlAplikasi + "package/get_object/", function (data) {
    data = JSON.parse(data);
    console.log(data);
    let tourism_object_data_length = data.tourism_object.features.length;
    let tourism_object_data = data.tourism_object.features;
    let culinary_data_length = data.culinary.features.length;
    let culinary_data = data.culinary.features;
    let event_data_length = data.event.features.length;
    let event_data = data.event.features;
    let homestay_data_length = data.homestay.features.length;
    let homestay_data = data.homestay.features;
    let worship_data_length = data.worship.features.length;
    let worship_data = data.worship.features;
    let souvenir_data_length = data.souvenir.features.length;
    let souvenir_data = data.souvenir.features;

    i = 0;
    while (i < tourism_object_data_length) {
      $("#dataDinamis_" + count + "_" + dinCount).append(
        '<option value="' +
          tourism_object_data[i].properties.id +
          '">[Tourism Object] ' +
          tourism_object_data[i].properties.name +
          "</option>"
      );

      i++;
    }

    i = 0;
    while (i < culinary_data_length) {
      $("#dataDinamis_" + count + "_" + dinCount).append(
        '<option value="' +
          culinary_data[i].properties.id +
          '">[Culinary] ' +
          culinary_data[i].properties.name +
          "</option>"
      );

      i++;
    }

    i = 0;
    while (i < homestay_data_length) {
      $("#dataDinamis_" + count + "_" + dinCount).append(
        '<option value="' +
          homestay_data[i].properties.id +
          '">[Homestay] ' +
          homestay_data[i].properties.name +
          "</option>"
      );

      i++;
    }

    i = 0;
    while (i < event_data_length) {
      $("#dataDinamis_" + count + "_" + dinCount).append(
        '<option value="' +
          event_data[i].properties.id +
          '">[Event] ' +
          event_data[i].properties.name +
          "</option>"
      );

      i++;
    }

    i = 0;
    while (i < worship_data_length) {
      $("#dataDinamis_" + count + "_" + dinCount).append(
        '<option value="' +
          worship_data[i].properties.id +
          '">[Worship] ' +
          worship_data[i].properties.name +
          "</option>"
      );

      i++;
    }

    i = 0;
    while (i < souvenir_data_length) {
      $("#dataDinamis_" + count + "_" + dinCount).append(
        '<option value="' +
          souvenir_data[i].properties.id +
          '">[Souvenir] ' +
          souvenir_data[i].properties.name +
          "</option>"
      );

      i++;
    }
  });
}

// Addfacil;ity Ambil ID culinary
// function saveCulinaryFacility(id_culinary) {
//   let id_facility = $("#culinary_facility_select").find(":selected").val();
//   $.get(
//     urlAplikasi + "culinary/add_facility/" + id_culinary + "/" + id_facility,
//     function () {
//       location.reload();
//     }
//   );
// }

function confirm_booking(booking_date, id_user, id_package) {
  // Confirm Booking

  console.log(booking_date + "/" + id_user + "/" + id_package);
  comment = $("#comment").val();
  if (comment == "") {
    comment = "NO COMMENT";
  }
  $.get(
    urlAplikasi +
      "booking/confirm_booking/" +
      id_user +
      "/" +
      booking_date +
      "/" +
      id_package +
      "/" +
      comment,
    function (data) {
      location.reload();
      console.log(data);
    }
  );
}

function decline_booking(booking_date, id_user, id_package) {
  // Decline Booking
  comment = $("#comment").val();
  if (comment == "") {
    comment = "NO COMMENT";
  }
  $.get(
    urlAplikasi +
      "booking/decline_booking/" +
      id_user +
      "/" +
      booking_date +
      "/" +
      id_package +
      "/" +
      comment,
    function () {
      location.reload();
    }
  );
}

function saveHomestayFacility(id_culinary) {
  let id_facility = $("#culinary_facility_select").find(":selected").val();
  $.get(
    urlAplikasi + "homestay/add_facility/" + id_culinary + "/" + id_facility,
    function () {
      location.reload();
    }
  );
}

function saveSouvenirFacility(id_culinary) {
  let id_facility = $("#souvenir_facility_select").find(":selected").val();

  $.get(
    urlAplikasi +
      "souvenir_place/add_facility/" +
      id_culinary +
      "/" +
      id_facility,
    function () {
      location.reload();
    }
  );
}

function saveTourismFacility(id_culinary) {
  let id_facility = $("#tourism_facility_select").find(":selected").val();

  $.get(
    urlAplikasi +
      "tourism_object/add_facility/" +
      id_culinary +
      "/" +
      id_facility,
    function () {
      location.reload();
    }
  );
}

function saveWorshipFacility(id_culinary) {
  let id_facility = $("#worship_facility_select").find(":selected").val();

  $.get(
    urlAplikasi +
      "worship_place/add_facility/" +
      id_culinary +
      "/" +
      id_facility,
    function () {
      location.reload();
    }
  );
}

// Fungsi menghapus start
function deleteImageCulinary(id) {
  $.get(urlAplikasi + "culinary/delete_image/" + id, function () {
    location.reload();
  });
}

function deleteImageHomestay(id) {
  $.get(urlAplikasi + "homestay/delete_image/" + id, function () {
    location.reload();
  });
}
// fungsi menghapus end

function deleteImageEvent(id) {
  $.get(urlAplikasi + "event/delete_image/" + id, function () {
    location.reload();
  });
}

function deleteImageTourism(id) {
  $.get(urlAplikasi + "tourism_object/delete_image/" + id, function () {
    location.reload();
  });
}

function deleteVideoTourism(id) {
  $.get(urlAplikasi + "tourism_object/delete_video/" + id, function () {
    location.reload();
  });
}

function deleteVideoEvent(id) {
  $.get(urlAplikasi + "event/delete_video/" + id, function () {
    location.reload();
  });
}
//

// function deleteCulinaryFacility(id, id_facility) {
//   // $.get(urlAplikasi+"culinary/delete_facility/"+id, function(){
//   //   location.reload();
//   // });

//   $.get(
//     urlAplikasi + "culinary/delete_facility/" + id + "/" + id_facility,
//     function () {
//       location.reload();
//     }
//   );
//   console.log(id);
// }

function deleteHomestayFacility(id, id_facility) {
  // $.get(urlAplikasi+"culinary/delete_facility/"+id, function(){
  //   location.reload();
  // });

  $.get(
    urlAplikasi + "homestay/delete_facility/" + id + "/" + id_facility,
    function () {
      location.reload();
    }
  );
  console.log(id);
}

function deleteSouvenirFacility(id, id_facility) {
  // $.get(urlAplikasi+"culinary/delete_facility/"+id, function(){
  //   location.reload();
  // });

  $.get(
    urlAplikasi + "souvenir_place/delete_facility/" + id + "/" + id_facility,
    function () {
      location.reload();
    }
  );
  console.log(id);
}

function deleteTourismFacility(id, id_facility) {
  // $.get(urlAplikasi+"culinary/delete_facility/"+id, function(){
  //   location.reload();
  // });

  $.get(
    urlAplikasi + "tourism_object/delete_facility/" + id + "/" + id_facility,
    function () {
      location.reload();
    }
  );
  console.log(id);
}

function deleteWorshipFacility(id, id_facility) {
  // $.get(urlAplikasi+"culinary/delete_facility/"+id, function(){
  //   location.reload();
  // });

  $.get(
    urlAplikasi + "worship_place/delete_facility/" + id + "/" + id_facility,
    function () {
      location.reload();
    }
  );
  console.log(id);
}

function deleteImageSouvenir(id) {
  $.get(urlAplikasi + "souvenir_place/delete_image/" + id, function () {
    location.reload();
  });
}

function deleteImageWorship(id) {
  $.get(urlAplikasi + "worship_place/delete_image/" + id, function () {
    location.reload();
  });
}

function clearSelection() {
  if (selectedShape) {
    selectedShape.setEditable(false);
    selectedShape = null;
  }
}

function setSelection(shape) {
  clearSelection();
  selectedShape = shape;
  shape.setEditable(true);
  selectColor(shape.get("fillColor") || shape.get("strokeColor"));
}

function deleteSelectedShape() {
  if (selectedShape) {
    selectedShape.setMap(null);
  }
}

function selectColor(color) {
  selectedColor = color;
  for (var i = 0; i < colors.length; ++i) {
    var currColor = colors[i];
    colorButtons[currColor].style.border =
      currColor == color ? "2px solid #789" : "2px solid #fff";
  }

  // Retrieves the current options from the drawing manager and replaces the
  // stroke or fill color as appropriate.
  var polylineOptions = drawingManager.get("polylineOptions");
  polylineOptions.strokeColor = color;
  drawingManager.set("polylineOptions", polylineOptions);

  var rectangleOptions = drawingManager.get("rectangleOptions");
  rectangleOptions.fillColor = color;
  drawingManager.set("rectangleOptions", rectangleOptions);

  var circleOptions = drawingManager.get("circleOptions");
  circleOptions.fillColor = color;
  drawingManager.set("circleOptions", circleOptions);

  var polygonOptions = drawingManager.get("polygonOptions");
  polygonOptions.fillColor = color;
  drawingManager.set("polygonOptions", polygonOptions);
}

function setSelectedShapeColor(color) {
  if (selectedShape) {
    if (selectedShape.type == google.maps.drawing.OverlayType.POLYLINE) {
      selectedShape.set("strokeColor", color);
    } else {
      selectedShape.set("fillColor", color);
    }
  }
}

function makeColorButton(color) {
  var button = document.createElement("span");
  button.className = "color-button";
  button.style.backgroundColor = color;
  google.maps.event.addDomListener(button, "click", function () {
    selectColor(color);
    setSelectedShapeColor(color);
  });

  return button;
}

function buildColorPalette() {
  var colorPalette = document.getElementById("color-palette");
  for (var i = 0; i < colors.length; ++i) {
    var currColor = colors[i];
    var colorButton = makeColorButton(currColor);
    colorPalette.appendChild(colorButton);
    colorButtons[currColor] = colorButton;
  }
  selectColor(colors[0]);
}

const styles = {
  default: [],
  hide: [
    {
      featureType: "poi.business",
      stylers: [{ visibility: "off" }],
    },
    {
      featureType: "transit",
      elementType: "labels.icon",
      stylers: [{ visibility: "off" }],
    },
  ],
};

function initialize() {
  map = new google.maps.Map(document.getElementById("googlemaps"), {
    zoom: 14,
    center: new google.maps.LatLng(-0.7911133716096994, 100.60009746739821),
    mapTypeId: google.maps.MapTypeId.ROADMAP,
    disableDefaultUI: true,
    zoomControl: true,
    mapTypeId: "satellite",
    disableDefaultUI: true,
    zoomControl: true,
    mapTypeControl: true,
    scaleControl: true,
    streetViewControl: true,
    rotateControl: true,
    fullscreenControl: true,
  });
  map.setOptions({ styles: styles["hide"] });
  var polyOptions = {
    strokeWeight: 0,
    fillOpacity: 0.45,
    editable: true,
  };
  // Creates a drawing manager attached to the map that allows the user to draw
  // markers, lines, and shapes.
  drawingManager = new google.maps.drawing.DrawingManager({
    drawingMode: google.maps.drawing.OverlayType.POLYGON,
    drawingControl: true,
    drawingControlOptions: {
      position: google.maps.ControlPosition.TOP_CENTER,
      drawingModes: ["polygon", "marker"],
    },
    markerOptions: {
      draggable: true,
    },
    polylineOptions: {
      editable: true,
    },
    rectangleOptions: polyOptions,
    circleOptions: polyOptions,
    polygonOptions: polyOptions,
    map: map,
  });

  google.maps.event.addListener(
    drawingManager,
    "overlaycomplete",
    function (e) {
      if (e.type != google.maps.drawing.OverlayType.MARKER) {
        // Switch back to non-drawing mode after drawing a shape.
        drawingManager.setDrawingMode(null);

        // Add an event listener that selects the newly-drawn shape when the user
        // mouses down on it.
        var newShape = e.overlay;
        newShape.type = e.type;
        google.maps.event.addListener(newShape, "click", function () {
          setSelection(newShape);
        });
        setSelection(newShape);
      }

      let str_input = "";
      let str_backup = "";

      if (e.type == google.maps.drawing.OverlayType.POLYGON) {
        str_input = "POLYGON((";
        console.log("polygon path array", e.overlay.getPath().getArray());
        $.each(e.overlay.getPath().getArray(), function (key, latlng) {
          var lat = latlng.lat();
          var lon = latlng.lng();
          console.log(lat, lon);

          str_input += lon + " " + lat + ",";
          str_backup += lon + " " + lat + ",";
          if (over == 1) {
            // startView+=lat +' '+ lon ;
            over++;
          }
        });

        // console.log(str_backup);
        str_backup = str_backup.split(",");
        // console.log(str_backup[0]);

        str_input =
          str_input.substr(0, str_input.length - 1) +
          "," +
          str_backup[0] +
          "))";
        console.log(str_input);

        str_input = str_input.substr(0, str_input.length - 1) + ")";
        // console.log(str_input);
        // var name = document.getElementById('coordinates').value = str_input;
        console.log(str_input);
        // $('geom').val(str_input);
        // Menambahkan geom ke kolom geom
        $("input[name=geom]").val(str_input);

        // Check Drawing Polygon
      } else if (e.type == google.maps.drawing.OverlayType.MARKER) {
        let markerValue = e.overlay.position.toString();
        str_input = markerValue;
        str_input = str_input.split(",");
        //  Gabungkan koordinat
        let coord1 = str_input[1];
        let coord2 = str_input[0];
        str_input = coord1 + coord2;
        str_input = str_input.replaceAll(" ", "");
        str_input = str_input.replaceAll(")(", " ");
        str_input = "POINT(" + str_input + ")";
        $("input[name=geom]").val(str_input);
      }
    }
  );

  // Clear the current selection when the drawing mode is changed, or when the
  // map is clicked.
  google.maps.event.addListener(
    drawingManager,
    "drawingmode_changed",
    clearSelection
  );
  google.maps.event.addListener(map, "click", clearSelection);
  google.maps.event.addDomListener(
    document.getElementById("delete-button"),
    "click",
    deleteSelectedShape
  );

  if (putCounter == 0) {
    // myTimeout = setTimeout(callAfterPut, 2000);

    callAfterPut();
    buildColorPalette();
  } else {
  }
}

google.maps.event.addDomListener(window, "load", initialize);

// -------------------------------------------------------------------------

// Initialize and add the map
// function initMap(lat = -0.7911133716096994, lng = 100.60009746739821) {

// // tampil map baru
// myLatlng = new google.maps.LatLng(-0.7911133716096994, 100.60009746739821);
// var myOptions = {
//     zoom: 12,
//     zoomControl: true,
//     center: myLatlng,
//     mapTypeId: google.maps.MapTypeId.ROADMAP
//   };

//   map = new google.maps.Map(document.getElementById("googlemaps"), myOptions);
//   myMarker = new google.maps.Marker({
//     position: myLatlng
//   });

//   var drawingManager = new google.maps.drawing.DrawingManager({
//     drawingMode: google.maps.drawing.OverlayType.POLYGON,
//     drawingControl: true,
//     drawingControlOptions: {
//       position: google.maps.ControlPosition.TOP_CENTER,
//       drawingModes: ['polygon','marker','circle','polyline','rectangle']
//     },
//     markerOptions: {
//       icon: 'https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png'
//     },
//     circleOptions: {
//       fillColor: '#ffff00',
//       fillOpacity: 1,
//       strokeWeight: 5,
//       clickable: false,
//       editable: true,
//       zIndex: 1
//     }
//   });
//   drawingManager.setMap(map);
//   google.maps.event.addListener(drawingManager, 'overlaycomplete', function (event) {
//     var str_input ='POLYGON((';
//     var str_backup='';

//     // Ini untuk mengambil data khusus poligon saja
//     // Tambah IF Untuk jenis data lain

//     if (event.type == google.maps.drawing.OverlayType.POLYGON) {

//       console.log('polygon path array', event.overlay.getPath().getArray());
//       $.each(event.overlay.getPath().getArray(), function(key, latlng){
//         var lat = latlng.lat();
//         var lon = latlng.lng();
//         console.log(lat, lon);

//         str_input += lon +' '+ lat +',';
//         str_backup+= lon +' '+ lat +',';
//         if(over==1)
//         {
//           // startView+=lat +' '+ lon ;
//           over++;
//         }
//       });
//     }

//     console.log(str_backup);
//     str_backup=str_backup.split(",");
//     console.log(str_backup[0]);

//     str_input = str_input.substr(0,str_input.length-1) +','+str_backup[0]+ '))';
//     console.log(str_input);

//     str_input = str_input.substr(0, str_input.length - 1) + ')';
//     // console.log(str_input);
//     // var name = document.getElementById('coordinates').value = str_input;

//     // Check Drawing Polygon

//   });

//     // add an event listener untuk menghapus semuanya

//     // const center = new google.maps.LatLng(lat, lng);
//     // map = new google.maps.Map(document.getElementById("googlemaps"), {
//     //     zoom: 13,
//     //     center: center,
//     //     mapTypeId: 'roadmap',
//     // });

//     var rendererOptions = {
//         map: map
//     }
//     // map.set('styles', customStyled);
//     directionsRenderer = new google.maps.DirectionsRenderer(rendererOptions);
//     digitVillage();

// }
// Display tourism village digitizing
function digitVillage() {
  const village = new google.maps.Data();
  $.ajax({
    url: baseUrl + "/api/village",
    type: "POST",
    data: {
      village: "VIL01",
    },
    dataType: "json",
    success: function (response) {
      const data = response.data;
      village.addGeoJson(data);
      village.setStyle({
        fillColor: "#00b300",
        strokeWeight: 0.5,
        strokeColor: "#ffffff",
        fillOpacity: 0.1,
        clickable: false,
      });
      village.setMap(map);
    },
  });
}

function posisisekarang() {
  google.maps.event.clearListeners(map, "click");
  navigator.geolocation.getCurrentPosition(function (position) {
    pos = {
      lat: position.coords.latitude,
      lng: position.coords.longitude,
    };
    koordinat = {
      lat: position.coords.latitude,
      lng: position.coords.longitude,
    };

    centerBaru = new google.maps.LatLng(koordinat.lat, koordinat.lng);
    centerLokasi = centerBaru;
    map.setCenter(centerBaru);
    map.setZoom(13);

    var marker = new google.maps.Marker({
      position: koordinat,
      animation: google.maps.Animation.DROP,
      map: map,
    });

    marker.info = new google.maps.InfoWindow({
      content:
        "<center><a style='color:black;'>You Are Here ! <br> lat : " +
        koordinat.lat +
        " <br> long : " +
        koordinat.lng +
        "</a></center>",
      pixelOffset: new google.maps.Size(0, -1),
    });
    marker.info.open(map, marker);

    pos_lat = koordinat.lat;
    pos_lng = koordinat.lng;
    document.getElementById("myLatLocation").value = koordinat.lat;
    document.getElementById("myLngLocation").value = koordinat.lng;
    console.log(pos_lat);
    console.log(pos_lng);
  });
}

// Remove user location
function clearUser() {
  userLat = 0;
  userLng = 0;
  userMarker.setMap(null);
}

function lokasimanual() {
  alert("Click on Map");
  map.addListener("click", function (event) {
    addMarker_Manual(event.latLng);
  });
}
function addMarker_Manual(location) {
  for (var i = 0; i < markersManual.length; i++) {
    markersManual[i].setMap(null);
  }

  marker = new google.maps.Marker({
    //icon: "assets/img/biru1.ico",
    position: location,
    map: map,
    animation: google.maps.Animation.DROP,
  });

  koordinat = {
    lat: location.lat(),
    lng: location.lng(),
  };

  centerLokasi = new google.maps.LatLng(koordinat.lat, koordinat.lng);

  marker.info = new google.maps.InfoWindow({
    content:
      "<center><a style='color:black;'>You Are Here ! <br> lat : " +
      koordinat.lat +
      " <br> long : " +
      koordinat.lng +
      "</a></center>",
    pixelOffset: new google.maps.Size(0, -1),
  });
  marker.info.open(map, marker);
  map.setCenter(koordinat);
  map.setZoom(13);
  markersManual.push(marker);
  document.getElementById("myLatLocation").value = koordinat.lat;
  document.getElementById("myLngLocation").value = koordinat.lng;

  pos_lat = koordinat.lat;
  pos_lng = koordinat.lng;
  console.log(pos_lat);
  console.log(pos_lng);
}
function set_center(lat, lon, nama) {
  //Hapus Info Sebelumnya
  hapusInfo();

  //POSISI MAP
  var centerBaru = new google.maps.LatLng(lat, lon);
  map.setCenter(centerBaru);

  //JENDELA INFO
  var infowindow = new google.maps.InfoWindow({
    position: centerBaru,
    content: "<bold style='color:black'>" + nama + "</bold>",
  });
  infoDua.push(infowindow);
  infowindow.open(map);
}

function add_marker(lat, lng, name, tipe) {
  var pos = new google.maps.LatLng(lat, lng);
  marker = new google.maps.Marker({
    //icon: "assets/img/biru1.ico",
    position: pos,
    map: map,
    animation: google.maps.Animation.DROP,
  });
  if (name != "") {
    marker.info = new google.maps.InfoWindow({
      content: "<center><a style='color:black;'>" + name + "</a></center>",
      pixelOffset: new google.maps.Size(0, -1),
    });
    marker.info.open(map, marker);
  }
  markersDua.push(marker);
  klikInfoWindow(id, marker);
}

// Update radiusValue on search by radius
function updateRadius(postfix) {
  document.getElementById("radiusValue" + postfix).innerHTML =
    document.getElementById("inputRadius" + postfix).value * 100 + " m";
}

// display steps of direction to selected route
function showSteps() {
  $("#direction-row").show();
  $("#table-direction").empty();
  for (let i = 0; i < 2; i++) {
    let row =
      "<tr>" + "<td>400</td>" + "<td>Instruksi ditulis disini</td>" + "</tr>";
    $("#table-direction").append(row);
  }
}

// close nearby search section
function closeNearby() {
  $("#direction-row").hide();
  $("#check-nearby-col").hide();
  $("#result-nearby-col").hide();
  $("#list-rg-col").show();
  $("#list-ev-col").show();
}

// open nearby search section
function openNearby() {
  $("#list-rg-col").hide();
  $("#list-ev-col").hide();
  $("#list-rec-col").hide();
  $("#check-nearby-col").show();
}

// Search Result Object Around
function checkNearby() {
  $("#table-cp").empty();
  $("#table-wp").empty();
  $("#table-sp").empty();
  $("#table-cp").hide();
  $("#table-wp").hide();
  $("#table-sp").hide();

  const checkCP = document.getElementById("check-cp").checked;
  const checkWP = document.getElementById("check-wp").checked;
  const checkSP = document.getElementById("check-sp").checked;

  if (!checkCP && !checkWP && !checkSP) {
    document.getElementById("radiusValueNearby").innerHTML = "0 m";
    document.getElementById("inputRadiusNearby").value = 0;
    return Swal.fire("Please choose one object");
  }

  if (checkCP) {
    let table =
      "<thead><tr>" +
      "<th>Culinary Name</th>" +
      "<th>Action</th>" +
      "</tr></thead>" +
      '<tbody id="data-cp">' +
      "</tbody>";
    $("#table-cp").append(table);
    $("#table-cp").show();
  }
  if (checkWP) {
    let table =
      "<thead><tr>" +
      "<th>Worship Name</th>" +
      "<th>Action</th>" +
      "</tr></thead>" +
      '<tbody id="data-wp">' +
      "</tbody>";
    $("#table-wp").append(table);
    $("#table-wp").show();
  }
  if (checkSP) {
    let table =
      "<thead><tr>" +
      "<th>Souvenir Name</th>" +
      "<th>Action</th>" +
      "</tr></thead>" +
      '<tbody id="data-sp">' +
      "</tbody>";
    $("#table-sp").append(table);
    $("#table-sp").show();
  }
  $("#result-nearby-col").show();
}

// Set star by user input
function setStar(star) {
  switch (star) {
    case "star-1":
      $("#star-1").addClass("star-checked");
      $("#star-2,#star-3,#star-4,#star-5").removeClass("star-checked");
      document.getElementById("star-rating").value = "1";
      break;
    case "star-2":
      $("#star-1,#star-2").addClass("star-checked");
      $("#star-3,#star-4,#star-5").removeClass("star-checked");
      document.getElementById("star-rating").value = "2";
      break;
    case "star-3":
      $("#star-1,#star-2,#star-3").addClass("star-checked");
      $("#star-4,#star-5").removeClass("star-checked");
      document.getElementById("star-rating").value = "3";
      break;
    case "star-4":
      $("#star-1,#star-2,#star-3,#star-4").addClass("star-checked");
      $("#star-5").removeClass("star-checked");
      document.getElementById("star-rating").value = "4";
      break;
    case "star-5":
      $("#star-1,#star-2,#star-3,#star-4,#star-5").addClass("star-checked");
      document.getElementById("star-rating").value = "5";
      break;
  }
  console.log(document.getElementById("star-rating").value);
}

// Create legend
function getLegend() {
  const icons = {
    rg: {
      name: "Rumah Gadang",
      icon: baseUrl + "/media/icon/marker_rg.png",
    },
    ev: {
      name: "Event",
      icon: baseUrl + "/media/icon/marker_ev.png",
    },
    cp: {
      name: "Culinary Place",
      icon: baseUrl + "/media/icon/marker_cp.png",
    },
    wp: {
      name: "Worship Place",
      icon: baseUrl + "/media/icon/marker_wp.png",
    },
    sp: {
      name: "Souvenir Place",
      icon: baseUrl + "/media/icon/marker_sp.png",
    },
  };

  const title = '<p class="fw-bold fs-6">Legend</p>';
  $("#legend").append(title);

  for (key in icons) {
    const type = icons[key];
    const name = type.name;
    const icon = type.icon;
    const div = '<div><img src="' + icon + '"> ' + name + "</div>";

    $("#legend").append(div);
  }
  map.controls[google.maps.ControlPosition.RIGHT_BOTTOM].push(legend);
}

// toggle legend element
function viewLegend() {
  if ($("#legend").is(":hidden")) {
    $("#legend").show();
  } else {
    $("#legend").hide();
  }
}

// Validate if star rating picked yet
function checkStar(event) {
  const star = document.getElementById("star-rating").value;
  if (star == "0") {
    event.preventDefault();
    Swal.fire("Please put rating star");
  }
}

// Update preview of uploaded photo profile
function showPreview(input) {
  if (input.files && input.files[0]) {
    const reader = new FileReader();
    reader.onload = function (e) {
      $("#avatar-preview").attr("src", e.target.result).width(300).height(300);
    };
    reader.readAsDataURL(input.files[0]);
  }
}

// Delete Marker
