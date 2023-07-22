let putCounter = 0;
let over = 1;
let urlAplikasi = "http://localhost:8080/";
let map;
let tempArray;
let radArray;
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
let markerCulinary = new Array();
let markerEvent = new Array();
let markerSouvenir = new Array();
let markerWorship = new Array();
let markerFacility = new Array();
let markerHomestay = new Array();
let markerFacilityTemp = new Array();
let manualmarker = new Array();
let lat;
let lng;

let centerCircle;
let manualAuto = 0;
let latDetail;
let lngDetail;
let markerCenterRadius;

let u = 0;
let directionDisplay;
let directionsServicePackage = new google.maps.DirectionsService();
let directionsRenderer = new google.maps.DirectionsRenderer({
  suppressMarkers: true,
});
let waypoints = new Array();
let waypointsMarker = new Array();
let packageMarker = new Array();
let fd = 0;
let package_count = 1;
let clickCount = 0;
let dinCount = 0;

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

function showDetailPackage(count) {
  $("#detailPackage_" + count).append(
    '<div class="row"><br><b>Object</b><select name="select_object_' +
      count +
      "_" +
      dinCount +
      '" id="dataDinamis_' +
      count +
      "_" +
      dinCount +
      '" class="form form-control"></select></div>'
  );
  fillObjectID(count, dinCount);
  dinCount++;
}

function dirrectionManual_User(x, y, des) {
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

function buyPackage(id) {
  // Order package
  $("#userOrder").empty();
  $("#userOrder").append(
    "<div  style='margin: 15px;'><input type='text' style='display:none' id='id_package_order' value='" +
      id +
      "' class='form form-control'><b>Total member</b><br/><input type='number' min='1' id='total_member_manual' class='form form-control'><br/><b>Comment</b><br/><input type='text' id='comment_manual' class='form form-control'><br/><b>Booking Date</b><input type='date' id='date_manual' class='form form-control'> <br/><button onclick ='processOrder(" +
      '"' +
      id +
      '"' +
      ")' class='btn btn-info'>Order</button></div>"
  );
}

function print(print) {
  let target = document.getElementById("print");
  let htmlToPrint =
    '<style type="text/css">' +
    "table {" +
    "font-family: arial, sans-serif;" +
    "border-collapse: collapse;" +
    "width: 95%;" +
    "margin-left: 20px" +
    "}" +
    "th, td {" +
    "border:1px solid #000;" +
    "padding: 8px;" +
    "}" +
    "tr:nth-child(even) {" +
    "background-color: #dddddd;" +
    "}" +
    "</style>";
  htmlToPrint += divToPrint.outerHTML;
  let windowToPrint = window.open("");
  windowToPrint.document.write(htmlToPrint);
  windowToPrint.print();
  windowToPrint.close();
}

function processOrder(id) {
  let total_member = $("#total_member_manual").val();
  let comment = $("#comment_manual").val();

  let date = $("#date_manual").val();
  $.get(
    urlAplikasi +
      "web/buy_package/" +
      id +
      "/" +
      total_member +
      "/" +
      comment +
      "/" +
      date,
    function (data) {
      if (data == "NULL") {
        Swal.fire("Failed!", "Login Required!", "error");
      } else {
        Swal.fire("Success!", "You have booked a package!", "success");
      }
      console.log(data);
      // location.reload();
    }
  );
}

function detail_booking(id_package) {
  window.location.href = urlAplikasi + "/web/detail_booking_read/" + id_package;
}

function cancel_booking(id_user, booking_date, id_package) {
  $.get(
    urlAplikasi +
      "web/cancel_booking/" +
      id_user +
      "/" +
      booking_date +
      "/" +
      id_package,
    function (data) {
      location.reload();
      // console.log(id_user + "/" + booking_date + "/" + id_package);
      // console.log(data);
    }
  );
}
function customOrder() {
  // Save custom order

  alert("Custom Order");
}

function showPackageDay() {
  $("#detail_day").append(
    '<div class="form-group"><label for="int">Package Day</label><input type="number" class="form-control" autocomplete="off" name="package_day_' +
      clickCount +
      '" id="price" placeholder="Package Day" value="' +
      package_count +
      '"></div><div id="detailPackage_' +
      clickCount +
      '"></div><div onclick="showDetailPackage(' +
      clickCount +
      ')" class="btn btn-info">Add detail</div>'
  );
  package_count++;
  clickCount++;
}

function packageRoute(id_package) {
  $.get(urlAplikasi + "web/select_package_read/" + id_package, function (data) {
    for (let i = 0; i < packageMarker.length; i++) {
      packageMarker[i].setMap(null);
    }
    waypoints = [];
    waypointsMarker = [];

    fd = 0;

    console.log(fd);

    data = JSON.parse(data);
    console.log(data["finalArray"].bulk);

    let dataTotal = data["finalArray"].bulk.length;
    let i = 0;

    while (i < dataTotal) {
      var x = data["finalArray"].bulk[i].properties.x;
      var y = data["finalArray"].bulk[i].properties.y;
      var des = data["finalArray"].bulk[i].properties.description;
      dirrectionManualPackage(x, y, des);
      i++;
    }

    // dirrectionManualPackage(x, y, description);
    routeWayPoints();
  });
}

function routeWayPoints_User() {
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

function routeWayPoints() {
  console.log(waypointsMarker);
  directionDisplay = new google.maps.DirectionsRenderer();
  directionDisplay.setMap(map);
  directionsRenderer.setMap(map);

  let upMarker = waypointsMarker.length;

  while (fd < upMarker) {
    var pgPos = {
      lat: parseFloat(waypointsMarker[fd].lat),
      lng: parseFloat(waypointsMarker[fd].lng),
    };

    packageMarker[fd] = new google.maps.Marker({
      position: pgPos,
      map,
      title: waypointsMarker[fd].des,
    });
    packageMarker[fd].setZIndex(fd);
    packageMarker[fd].setLabel((fd + 1).toString());
    // console.log(packageMarker);
    fd++;
  }

  wayLength = waypoints.length;
  wayLength = wayLength - 1;
  // console.log(waypoints[0].location.lat());

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

function infoList(id, type) {
  window.location.href = urlAplikasi + "web/detail_type/" + id + "/" + type;
}

function packageView(id) {
  window.location.href = urlAplikasi + "web/list_package_read/" + id;
}
function radiusWorship() {
  alert("test");
}

function searchByName() {
  let name = $("#search-name").val();
  // alert(name);
  name = "NAME_" + name;
  window.location.href = urlAplikasi + "web/search_all/" + name;
}

function searchByFacility() {
  let id = $("#select-name").val();
  window.location.href = urlAplikasi + "web/search_all/" + id;
}

function searchByFacilityCheck() {
  let list_id = "";
  var n = $('input:checkbox[id^="secret_"]:checked').length;
  $('input:checkbox[id^="secret_"]:checked').each(function () {
    list_id = list_id + $(this).attr("value") + "|";
    // alert($(this).attr("value"));
  });
  console.log(list_id);
  list_id = "CHECK_" + list_id;
  window.location.href = urlAplikasi + "web/search_all/" + list_id;
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

let countRad = 0;

function facilityMap() {
  if (GPSLocation == null) {
    GPSLocation = {
      lat: parseFloat(0),
      lng: parseFloat(0),
    };
  }

  $("#makeTable tbody tr").remove();
  $("#makeWorship tbody tr").remove();
  $("#makeSouvenir tbody tr").remove();
  $("#makeEvent tbody tr").remove();
  $("#makeCulinary tbody tr").remove();
  $("#makeHomestay tbody tr").remove();

  for (let i = 0; i < markerFacilityTemp.length; i++) {
    markerFacilityTemp[i].setMap(null);
  }

  markerFacilityTemp[0] = new google.maps.Marker({
    position: GPSLocation,
    map,
    title: "Tourism Object",
    info: contentString,
  });
  markerFacilityTemp[0].setLabel("C");

  // alert("facility map");
  var arrayFacility = [];
  setResultMap(null);
  var checkboxes = document.querySelectorAll("input[type=checkbox]:checked");
  console.log(checkboxes);
  let text = "";

  for (var i = 0; i < checkboxes.length; i++) {
    //   arrayFacility.push(checkboxes[i].value)
    text = text + "|" + checkboxes[i].value;
  }
  console.log("HEHE");
  console.log(GPSLocation);
  gpsText = GPSLocation.lat + "A" + GPSLocation.lng;
  console.log(text);
  console.log("HEHE");

  let radiusValue = $("#radiusRange").val();
  radiusDetail();

  $.get(
    urlAplikasi +
      "web/select_facility/" +
      text +
      "/" +
      gpsText +
      "/" +
      radiusValue,
    function (data) {
      // setMapOnAll(null);
      // markerArray=[];
      // setResultMap(null);
      // markerCulinary=[];
      // markerEvent=[];
      // markerFacility=[];
      // markerWorship=[];

      console.log("TEST DATA");

      console.log(JSON.parse(data));
      // console.log(data);
      console.log("TEST DATA");

      // console.log(radArray.length);
      // console.log( urlAplikasi+"media/icon/culinary.png")

      if (data == "no") {
      } else {
        geom_data = JSON.parse(data);
        console.log(geom_data);

        let b = 0;
        let length_worship = geom_data.worship.features.length;

        // show worship
        while (b < length_worship) {
          let x = geom_data.worship.features[b].properties["x"];
          let y = geom_data.worship.features[b].properties["y"];
          let a = GPSLocation.lng;
          let c = GPSLocation.lat;
          let posData = {
            lat: parseFloat(y),
            lng: parseFloat(x),
          };
          contentString =
            '<table class="table">' +
            "<thead>" +
            "  <tr>" +
            '    <th class="tg-0lax" style="text-align: center;">' +
            geom_data.worship.features[b].properties["name"] +
            "</th>" +
            // '    <th class="tg-0lax">Info</th>' +
            "  </tr>" +
            "</thead>" +
            "<tbody>" +
            "  <tr>" +
            '    <td class="tg-0lax" style="text-align: center;"><i class="fa-solid fa-person-praying"></i>&nbsp Worship</td>' +
            "  </tr>" +
            // "  <tr>" +
            // '    <td class="tg-0lax">Name</td>' +
            // '    <td class="tg-0lax">' +
            // geom_data.worship.features[b].properties["name"] +
            // "</td>" +
            // "  </tr>" +
            // "  <tr>" +
            // '    <td class="tg-0lax">Address</td>' +
            // '    <td class="tg-0lax">' +
            // geom_data.worship.features[b].properties["address"] +
            // "</td>" +
            // "  </tr>" +
            // "  <tr>" +
            // '    <td class="tg-0lax"> <button class="btn btn-outline-primary" onclick="directionNonTourism()"><i class="fa-solid fa-route"></i></button></td>' +
            // '    <td class="tg-0lax"><button class="btn btn-outline-primary" onclick="infoList(' +
            // "'" +
            // geom_data.worship.features[b].properties["id"] +
            // "'" +
            // "," +
            // "'" +
            // "WORSHIP" +
            // "'" +
            // ')"><i class="fa fa-info-circle"></i></button></td>' +
            // "  </tr>" +
            "</tbody>" +
            "</table>" +
            "<div class='d-flex justify-content-center'><button style='margin:5px;' class='btn btn-outline-primary' onclick='directionNonTourism()'><i class='fa-solid fa-route'></i></button><button style='margin:5px;' class='btn btn-outline-primary' onclick='infoList(" +
            '"' +
            geom_data.worship.features[b].properties["id"] +
            '"' +
            "," +
            '"' +
            "WORSHIP" +
            '"' +
            ")'><i class='fa fa-info-circle'></i></button></div>";
          markerWorship[b] = new google.maps.Marker({
            position: posData,
            map,
            title: "Worship Place",
            info: contentString,
            icon: urlAplikasi + "media/icon/marker_wp.png",
          });

          $("#makeTable")
            .find("tbody")
            .append(
              $("<tr>")
                .append(
                  $("<td>").append(
                    $(
                      "<div>" +
                        geom_data.worship.features[b].properties["name"] +
                        "</div>"
                    )
                  )
                )
                .append(
                  $("<td width='60px'>").append(
                    $(
                      '<button onclick="dirrectionManual(' +
                        x +
                        "," +
                        y +
                        "," +
                        c +
                        "," +
                        a +
                        ')" class="btn btn-primary"><i class="fa-solid fa-route"></i></button>'
                    )
                  )
                )
            );

          infowindow = new google.maps.InfoWindow({
            content: contentString,
            ariaLabel: "Uluru",
          });

          google.maps.event.addListener(markerWorship[b], "click", function () {
            infowindow.setContent(this.info);
            infowindow.open(map, this);
            console.log(this.getPosition().lat());
            console.log(this.getPosition().lng());
            latDetail = this.getPosition().lat();
            lngDetail = this.getPosition().lng();

            let posData = {
              lat: parseFloat(latDetail),
              lng: parseFloat(lngDetail),
            };

            lat = parseFloat(latDetail);
            lng = parseFloat(lngDetail);

            // GPSLocation =  {
            //     lat: parseFloat(latDetail),
            //     lng: parseFloat(lngDetail)
            // };
            // deletemaerker

            // Tambahkan Rute otomatis jika marker di klik

            // setMapOnAll(null);
            // markerArray=[];

            $("#radiusRange").prop("disabled", false);
            $("#radiusRange").prop("disabled", false);
            $("#worship").prop("disabled", false);
            $("#culinary").prop("disabled", false);
            $("#event").prop("disabled", false);
            $("#souvenir").prop("disabled", false);
            $("#homestay").prop("disabled", false);

            // markerCulinary[0] = new google.maps.Marker({
            //     position: posData,
            //     map,
            //     title: "Hello World!",
            //     info: contentString
            // });
          });

          b++;
        }

        let i = 0;
        let length_culinary = geom_data.culinary.features.length;
        console.log(length_culinary);
        // show culinary
        while (i < length_culinary) {
          let x = geom_data.culinary.features[i].properties["x"];
          let y = geom_data.culinary.features[i].properties["y"];
          let a = GPSLocation.lng;
          let c = GPSLocation.lat;
          let posData = {
            lat: parseFloat(y),
            lng: parseFloat(x),
          };
          contentString =
            '<table class="table">' +
            "<thead>" +
            "  <tr>" +
            '    <th class="tg-0lax">' +
            geom_data.culinary.features[i].properties["name"] +
            "</th>" +
            // '    <th class="tg-0lax">Info</th>' +
            "  </tr>" +
            "</thead>" +
            "<tbody>" +
            "  <tr>" +
            '    <td class="tg-0lax" style="text-align: center;"><i class="fa fa-utensils"></i>&nbsp Culinary</td>' +
            // '    <td class="tg-0lax">' +
            // geom_data.culinary.features[i].properties["name"] +
            // "</td>" +
            "  </tr>" +
            // "  <tr>" +
            // '    <td class="tg-0lax">Name</td>' +
            // '    <td class="tg-0lax">' +
            // geom_data.culinary.features[i].properties["name"] +
            // "</td>" +
            // "  </tr>" +
            // "  <tr>" +
            // '    <td class="tg-0lax">Address</td>' +
            // '    <td class="tg-0lax">' +
            // geom_data.culinary.features[i].properties["address"] +
            // "</td>" +
            // "  </tr>" +
            // "  <tr>" +
            // '    <td class="tg-0lax">Open</td>' +
            // '    <td class="tg-0lax">' +
            // geom_data.culinary.features[i].properties["open"] +
            // "</td>" +
            // "  </tr>" +
            // "  <tr>" +
            // '    <td class="tg-0lax">Close</td>' +
            // '    <td class="tg-0lax">' +
            // geom_data.culinary.features[i].properties["close"] +
            // "</td>" +
            // "  </tr>" +
            "  <tr>" +
            // '    <td class="tg-0lax"> <button class="btn btn-outline-primary" onclick="directionNonTourism()"><i class="fa-solid fa-route"></i></button></td>' +
            // '    <td class="tg-0lax"><button class="btn btn-outline-primary" onclick="infoList(' +
            // "'" +
            // geom_data.culinary.features[i].properties["id"] +
            // "'" +
            // "," +
            // "'" +
            // "CULINARY" +
            // "'" +
            // ')"><i class="fa fa-info-circle"></i></button></td>' +
            // "  </tr>" +
            "</tbody>" +
            "</table>" +
            "<div class='d-flex justify-content-center'><button style='margin:5px;' class='btn btn-outline-primary' onclick='directionNonTourism()'><i class='fa-solid fa-route'></i></button><button style='margin:5px;' class='btn btn-outline-primary' onclick='infoList(" +
            '"' +
            geom_data.culinary.features[i].properties["id"] +
            '"' +
            "," +
            '"' +
            "CULINARY" +
            '"' +
            ")'><i class='fa fa-info-circle'></i></button></div>";
          markerCulinary[i] = new google.maps.Marker({
            position: posData,
            map,
            title: "Culinary Place",
            info: contentString,
            icon: urlAplikasi + "media/icon/marker_cp.png",
          });

          $("#makeCulinary")
            .find("tbody")
            .append(
              $("<tr>")
                .append(
                  $("<td>").append(
                    $(
                      "<div>" +
                        geom_data.culinary.features[i].properties["name"] +
                        "</div>"
                    )
                  )
                )
                .append(
                  $("<td width='60px'>").append(
                    $(
                      '<button onclick="dirrectionManual(' +
                        x +
                        "," +
                        y +
                        "," +
                        c +
                        "," +
                        a +
                        ')" class="btn btn-primary"><i class="fa-solid fa-route"></i></button>'
                    )
                  )
                )
            );

          infowindow = new google.maps.InfoWindow({
            content: contentString,
            ariaLabel: "Uluru",
          });

          google.maps.event.addListener(
            markerCulinary[i],
            "click",
            function () {
              infowindow.setContent(this.info);
              infowindow.open(map, this);
              console.log(this.getPosition().lat());
              console.log(this.getPosition().lng());
              latDetail = this.getPosition().lat();
              lngDetail = this.getPosition().lng();

              let posData = {
                lat: parseFloat(latDetail),
                lng: parseFloat(lngDetail),
              };

              lat = parseFloat(latDetail);
              lng = parseFloat(lngDetail);

              // GPSLocation =  {
              //     lat: parseFloat(latDetail),
              //     lng: parseFloat(lngDetail)
              // };
              // deletemaerker

              // Tambahkan Rute otomatis jika marker di klik
              // placeMarker(GPSLocation, lng, lat);
              // markerA.setMap(null);
              // markerB.setMap(null);
              // markerRouteStart .setMap(null);

              // setMapOnAll(null);
              // markerArray=[];

              $("#radiusRange").prop("disabled", false);
              $("#radiusRange").prop("disabled", false);
              $("#worship").prop("disabled", false);
              $("#culinary").prop("disabled", false);
              $("#event").prop("disabled", false);
              $("#souvenir").prop("disabled", false);
              $("#homestay").prop("disabled", false);

              // markerCulinary[0] = new google.maps.Marker({
              //     position: posData,
              //     map,
              //     title: "Hello World!",
              //     info: contentString
              // });
            }
          );
          i++;
        }

        i = 0;
        let length_homestay = geom_data.homestay.features.length;
        // console.log(length_culinary);
        // show culinary
        while (i < length_homestay) {
          let x = geom_data.homestay.features[i].properties["x"];
          let y = geom_data.homestay.features[i].properties["y"];
          let a = GPSLocation.lng;
          let c = GPSLocation.lat;
          let posData = {
            lat: parseFloat(y),
            lng: parseFloat(x),
          };
          contentString =
            '<table class="table">' +
            "<thead>" +
            "  <tr>" +
            '    <th class="tg-0lax">' +
            geom_data.homestay.features[i].properties["name"] +
            "</th>" +
            // '    <th class="tg-0lax">Info</th>' +
            "  </tr>" +
            "</thead>" +
            "<tbody>" +
            "  <tr>" +
            '    <td class="tg-0lax" style="text-align: center;"><i class="fa fa-home"></i>&nbsp Homestay</td>' +
            // '    <td class="tg-0lax">' +
            // geom_data.homestay.features[i].properties["name"] +
            // "</td>" +
            "  </tr>" +
            // "  <tr>" +
            // '    <td class="tg-0lax">Name</td>' +
            // '    <td class="tg-0lax">' +
            // geom_data.homestay.features[i].properties["name"] +
            // "</td>" +
            // "  </tr>" +
            // "  <tr>" +
            // '    <td class="tg-0lax">Address</td>' +
            // '    <td class="tg-0lax">' +
            // geom_data.homestay.features[i].properties["address"] +
            // "</td>" +
            // "  </tr>" +
            // "  <tr>" +
            // '    <td class="tg-0lax">Capacity</td>' +
            // '    <td class="tg-0lax">' +
            // geom_data.homestay.features[i].properties["capacity"] +
            // "</td>" +
            // "  </tr>" +
            // "  <tr>" +
            // '    <td class="tg-0lax"> <button class="btn btn-outline-primary" onclick="directionNonTourism()"><i class="fa-solid fa-route"></i></button></td>' +
            // '    <td class="tg-0lax"><button class="btn btn-outline-primary" onclick="infoList(' +
            // "'" +
            // geom_data.homestay.features[i].properties["id"] +
            // "'" +
            // "," +
            // "'" +
            // "HOMESTAY" +
            // "'" +
            // ')"><i class="fa fa-info-circle"></i></button></td>' +
            // "  </tr>" +
            "</tbody>" +
            "</table>" +
            "<div class='d-flex justify-content-center'><button style='margin:5px;' class='btn btn-outline-primary' onclick='directionNonTourism()'><i class='fa-solid fa-route'></i></button><button style='margin:5px;' class='btn btn-outline-primary' onclick='infoList(" +
            '"' +
            geom_data.homestay.features[i].properties["id"] +
            '"' +
            "," +
            '"' +
            "HOMESTAY" +
            '"' +
            ")'><i class='fa fa-info-circle'></i></button></div>";
          markerHomestay[i] = new google.maps.Marker({
            position: posData,
            map,
            title: "Homestay",
            info: contentString,
            icon: urlAplikasi + "media/icon/marker_hs.png",
          });
          $("#makeHomestay")
            .find("tbody")
            .append(
              $("<tr>")
                .append(
                  $("<td>").append(
                    $(
                      "<div>" +
                        geom_data.homestay.features[i].properties["name"] +
                        "</div>"
                    )
                  )
                )
                .append(
                  $("<td width='60px'>").append(
                    $(
                      '<button onclick="dirrectionManual(' +
                        x +
                        "," +
                        y +
                        "," +
                        c +
                        "," +
                        a +
                        ')" class="btn btn-primary"><i class="fa-solid fa-route"></i></button>'
                    )
                  )
                )
            );

          infowindow = new google.maps.InfoWindow({
            content: contentString,
            ariaLabel: "Uluru",
          });

          google.maps.event.addListener(
            markerHomestay[i],
            "click",
            function () {
              infowindow.setContent(this.info);
              infowindow.open(map, this);
              console.log(this.getPosition().lat());
              console.log(this.getPosition().lng());
              latDetail = this.getPosition().lat();
              lngDetail = this.getPosition().lng();

              let posData = {
                lat: parseFloat(latDetail),
                lng: parseFloat(lngDetail),
              };

              lat = parseFloat(latDetail);
              lng = parseFloat(lngDetail);

              // GPSLocation =  {
              //     lat: parseFloat(latDetail),
              //     lng: parseFloat(lngDetail)
              // };
              // deletemaerker

              // Tambahkan Rute otomatis jika marker di klik
              // placeMarker(GPSLocation, lng, lat);
              // markerA.setMap(null);
              // markerB.setMap(null);
              // markerRouteStart .setMap(null);

              // setMapOnAll(null);
              // markerArray=[];

              $("#radiusRange").prop("disabled", false);
              $("#radiusRange").prop("disabled", false);
              $("#worship").prop("disabled", false);
              $("#culinary").prop("disabled", false);
              $("#event").prop("disabled", false);
              $("#souvenir").prop("disabled", false);
              $("#homestay").prop("disabled", false);

              // markerCulinary[0] = new google.maps.Marker({
              //     position: posData,
              //     map,
              //     title: "Hello World!",
              //     info: contentString
              // });
            }
          );
          i++;
        }

        // End while

        i = 0;
        let length_event = geom_data.event.features.length;

        // show culinary
        while (i < length_event) {
          let x = geom_data.event.features[i].properties["x"];
          let y = geom_data.event.features[i].properties["y"];
          let a = GPSLocation.lng;
          let c = GPSLocation.lat;
          let posData = {
            lat: parseFloat(y),
            lng: parseFloat(x),
          };
          contentString =
            '<table class="table">' +
            "<thead>" +
            "  <tr>" +
            '    <th class="tg-0lax">' +
            geom_data.event.features[i].properties["name"] +
            "</th>" +
            // '    <th class="tg-0lax">Info</th>' +
            "  </tr>" +
            "</thead>" +
            "<tbody>" +
            "  <tr>" +
            '    <td class="tg-0lax" style="text-align: center;"><i class="fa fa-bullhorn"></i>&nbsp Event</td>' +
            // '    <td class="tg-0lax">' +
            // geom_data.event.features[i].properties["name"] +
            // "</td>" +
            // "  </tr>" +
            // "  <tr>" +
            // '    <td class="tg-0lax">Name</td>' +
            // '    <td class="tg-0lax">' +
            // geom_data.event.features[i].properties["name"] +
            // "</td>" +
            // "  </tr>" +
            // "  <tr>" +
            // '    <td class="tg-0lax">Date Start</td>' +
            // '    <td class="tg-0lax">' +
            // geom_data.event.features[i].properties["date_start"] +
            // "</td>" +
            // "  </tr>" +
            // "  <tr>" +
            // '    <td class="tg-0lax">Date End</td>' +
            // '    <td class="tg-0lax">' +
            // geom_data.event.features[i].properties["date_end"] +
            // "</td>" +
            // "  </tr>" +
            // "  <tr>" +
            // '    <td class="tg-0lax">Ticket Price</td>' +
            // '    <td class="tg-0lax">' +
            // geom_data.event.features[i].properties["ticket_price"] +
            // "</td>" +
            // "  </tr>" +
            // "  <tr>" +
            // '    <td class="tg-0lax"> <button class="btn btn-outline-primary" onclick="directionNonTourism()"><i class="fa-solid fa-route"></i></button></td>' +
            // '    <td class="tg-0lax"><button class="btn btn-outline-primary" onclick="infoList(' +
            // "'" +
            // geom_data.event.features[i].properties["id"] +
            // "'" +
            // "," +
            // "'" +
            // "EVENT" +
            // "'" +
            // ')"><i class="fa fa-info-circle"></i></button></td>' +
            // "  </tr>" +
            "</tbody>" +
            "</table>" +
            "<div class='d-flex justify-content-center'><button style='margin:5px;' class='btn btn-outline-primary' onclick='directionNonTourism()'><i class='fa-solid fa-route'></i></button><button style='margin:5px;' class='btn btn-outline-primary' onclick='infoList(" +
            '"' +
            geom_data.event.features[i].properties["id"] +
            '"' +
            "," +
            '"' +
            "EVENT" +
            '"' +
            ")'><i class='fa fa-info-circle'></i></button></div>";

          markerEvent[i] = new google.maps.Marker({
            position: posData,
            map,
            title: "Event",
            info: contentString,
            icon: urlAplikasi + "media/icon/marker_ev.png",
          });

          $("#makeEvent")
            .find("tbody")
            .append(
              $("<tr>")
                .append(
                  $("<td>").append(
                    $(
                      "<div>" +
                        geom_data.event.features[i].properties["name"] +
                        "</div>"
                    )
                  )
                )
                .append(
                  $("<td width='60px'>").append(
                    $(
                      '<button onclick="dirrectionManual(' +
                        x +
                        "," +
                        y +
                        "," +
                        c +
                        "," +
                        a +
                        ')" class="btn btn-primary"><i class="fa-solid fa-route"></i></button>'
                    )
                  )
                )
            );

          infowindow = new google.maps.InfoWindow({
            content: contentString,
            ariaLabel: "Uluru",
          });

          google.maps.event.addListener(markerEvent[i], "click", function () {
            infowindow.setContent(this.info);
            infowindow.open(map, this);

            latDetail = this.getPosition().lat();
            lngDetail = this.getPosition().lng();

            let posData = {
              lat: parseFloat(latDetail),
              lng: parseFloat(lngDetail),
            };

            lat = parseFloat(latDetail);
            lng = parseFloat(lngDetail);

            // GPSLocation =  {
            //     lat: parseFloat(latDetail),
            //     lng: parseFloat(lngDetail)
            // };
            // deletemaerker

            // Tambahkan Rute otomatis jika marker di klik
            //  placeMarker(GPSLocation, lng, lat);
            //  markerA.setMap(null);
            //  markerB.setMap(null);
            //  markerRouteStart .setMap(null);

            // setMapOnAll(null);
            // markerArray=[];

            $("#radiusRange").prop("disabled", false);
            $("#radiusRange").prop("disabled", false);
            $("#worship").prop("disabled", false);
            $("#culinary").prop("disabled", false);
            $("#event").prop("disabled", false);
            $("#souvenir").prop("disabled", false);
            $("#homestay").prop("disabled", false);

            // markerEvent[0] = new google.maps.Marker({
            //     position: posData,
            //     map,
            //     title: "Hello World!",
            //     info: contentString
            // });
          });
          i++;
        }

        // End while

        i = 0;
        let length_souvenir = geom_data.souvenir.features.length;

        // show culinary
        while (i < length_souvenir) {
          let x = geom_data.souvenir.features[i].properties["x"];
          let y = geom_data.souvenir.features[i].properties["y"];
          let a = GPSLocation.lng;
          let c = GPSLocation.lat;
          let posData = {
            lat: parseFloat(y),
            lng: parseFloat(x),
          };
          contentString =
            '<table class="table">' +
            "<thead>" +
            "  <tr>" +
            '    <th class="tg-0lax">' +
            geom_data.souvenir.features[i].properties["name"] +
            "</th>" +
            // '    <th class="tg-0lax">Info</th>' +
            "  </tr>" +
            "</thead>" +
            "<tbody>" +
            "  <tr>" +
            '    <td class="tg-0lax" style="text-align: center;"><i class="fa fa-gift"></i>&nbsp </td>' +
            // '    <td class="tg-0lax">' +
            // geom_data.souvenir.features[i].properties["name"] +
            // "</td>" +
            "  </tr>" +
            // "  <tr>" +
            // '    <td class="tg-0lax">Name</td>' +
            // '    <td class="tg-0lax">' +
            // geom_data.souvenir.features[i].properties["name"] +
            // "</td>" +
            // "  </tr>" +
            // "  <tr>" +
            // '    <td class="tg-0lax">Address</td>' +
            // '    <td class="tg-0lax">' +
            // geom_data.souvenir.features[i].properties["address"] +
            // "</td>" +
            // "  </tr>" +
            // "  <tr>" +
            // '    <td class="tg-0lax"> <button class="btn btn-outline-primary" class="btn btn-outline-primary" onclick="directionNonTourism()"><i class="fa-solid fa-route"></i></button></td>' +
            // '    <td class="tg-0lax"><button class="btn btn-outline-primary" onclick="infoList(' +
            // "'" +
            // geom_data.souvenir.features[i].properties["id"] +
            // "'" +
            // "," +
            // "'" +
            // "SOUVENIR" +
            // "'" +
            // ')"><i class="fa fa-info-circle"></i></button></td>' +
            // "  </tr>" +
            "</tbody>" +
            "</table>" +
            "<div class='d-flex justify-content-center'><button style='margin:5px;' class='btn btn-outline-primary' onclick='directionNonTourism()'><i class='fa-solid fa-route'></i></button><button style='margin:5px;' class='btn btn-outline-primary' onclick='infoList(" +
            '"' +
            geom_data.souvenir.features[i].properties["id"] +
            '"' +
            "," +
            '"' +
            "SOUVENIR" +
            '"' +
            ")'><i class='fa fa-info-circle'></i></button></div>";
          markerSouvenir[i] = new google.maps.Marker({
            position: posData,
            map,
            title: "Souvenir",
            info: contentString,
            icon: urlAplikasi + "media/icon/marker_sp.png",
          });

          $("#makeSouvenir")
            .find("tbody")
            .append(
              $("<tr>")
                .append(
                  $("<td>").append(
                    $(
                      "<div>" +
                        geom_data.souvenir.features[i].properties["name"] +
                        "</div>"
                    )
                  )
                )
                .append(
                  $("<td width='60px'>").append(
                    $(
                      '<button onclick="dirrectionManual(' +
                        x +
                        "," +
                        y +
                        "," +
                        c +
                        "," +
                        a +
                        ')" class="btn btn-primary"><i class="fa-solid fa-route"></i></button>'
                    )
                  )
                )
            );

          infowindow = new google.maps.InfoWindow({
            content: contentString,
            ariaLabel: "Uluru",
          });

          google.maps.event.addListener(
            markerSouvenir[i],
            "click",
            function () {
              infowindow.setContent(this.info);
              infowindow.open(map, this);

              latDetail = this.getPosition().lat();
              lngDetail = this.getPosition().lng();

              let posData = {
                lat: parseFloat(latDetail),
                lng: parseFloat(lngDetail),
              };

              lat = parseFloat(latDetail);
              lng = parseFloat(lngDetail);

              // GPSLocation =  {
              //     lat: parseFloat(latDetail),
              //     lng: parseFloat(lngDetail)
              // };
              // deletemaerker

              // Tambahkan Rute otomatis jika marker di klik
              // placeMarker(GPSLocation, lng, lat);
              // markerA.setMap(null);
              // markerB.setMap(null);
              // markerRouteStart .setMap(null);

              // setMapOnAll(null);
              // markerArray=[];

              $("#radiusRange").prop("disabled", false);
              $("#radiusRange").prop("disabled", false);
              $("#worship").prop("disabled", false);
              $("#culinary").prop("disabled", false);
              $("#event").prop("disabled", false);
              $("#souvenir").prop("disabled", false);
              $("#homestay").prop("disabled", false);

              // markerSouvenir[0] = new google.maps.Marker({
              //     position: posData,
              //     map,
              //     title: "Hello World!",
              //     info: contentString,
              //     icon: urlAplikasi+"media/icon/marker_sp.png" ,
              // });
            }
          );
          i++;
        }

        // End while

        i = 0;
        let length_facility = geom_data.facility.features.length;
        console.log(geom_data.facility);

        // show culinary
        while (i < length_facility) {
          let x = geom_data.facility.features[i].properties["x"];
          let y = geom_data.facility.features[i].properties["y"];
          let a = GPSLocation.lng;
          let c = GPSLocation.lat;
          let posData = {
            lat: parseFloat(y),
            lng: parseFloat(x),
          };
          contentString =
            '<table class="table">' +
            "<thead>" +
            "  <tr>" +
            '    <th class="tg-0lax">' +
            geom_data.facility.features[i].properties["name"] +
            "</th>" +
            // '    <th class="tg-0lax">Info</th>' +
            "  </tr>" +
            "</thead>" +
            "<tbody>" +
            "  <tr>" +
            '    <td class="tg-0lax" style="text-align: center;"><i class="fa fa-mountain-sun"></i>&nbsp Tourism Object</td>' +
            // '    <td class="tg-0lax">' +
            // geom_data.facility.features[i].properties["name"] +
            // "</td>" +
            "  </tr>" +
            // "  <tr>" +
            // '    <td class="tg-0lax">Name</td>' +
            // '    <td class="tg-0lax">' +
            // geom_data.facility.features[i].properties["name"] +
            // "</td>" +
            // "  </tr>" +
            // "  <tr>" +
            // '    <td class="tg-0lax">Open</td>' +
            // '    <td class="tg-0lax">' +
            // geom_data.facility.features[i].properties["open"] +
            // "</td>" +
            // "  </tr>" +
            // "  <tr>" +
            // '    <td class="tg-0lax">Close</td>' +
            // '    <td class="tg-0lax">' +
            // geom_data.facility.features[i].properties["close"] +
            // "</td>" +
            // "  </tr>" +
            // "  <tr>" +
            // '    <td class="tg-0lax">Ticket Price</td>' +
            // '    <td class="tg-0lax">' +
            // geom_data.facility.features[0].properties["ticket_price"] +
            // "</td>" +
            // "  </tr>" +
            "</tbody>" +
            "</table>" +
            "";
          markerFacility[i] = new google.maps.Marker({
            position: posData,
            map,
            title: "Tourism Object",
            info: contentString,
            icon: urlAplikasi + "media/icon/marker_to.png",
          });

          infowindow = new google.maps.InfoWindow({
            content: contentString,
            ariaLabel: "Uluru",
          });

          google.maps.event.addListener(
            markerFacility[i],
            "click",
            function () {
              infowindow.setContent(this.info);
              infowindow.open(map, this);
              for (let i = 0; i < markerFacilityTemp.length; i++) {
                markerFacilityTemp[i].setMap(null);
              }

              latDetail = this.getPosition().lat();
              lngDetail = this.getPosition().lng();

              let posData = {
                lat: parseFloat(latDetail),
                lng: parseFloat(lngDetail),
              };

              GPSLocation = {
                lat: parseFloat(latDetail),
                lng: parseFloat(lngDetail),
              };

              lat = parseFloat(latDetail);
              lng = parseFloat(lngDetail);
              // deletemaerker

              // setMapOnAll(null);
              // markerArray=[];

              $("#radiusRange").prop("disabled", false);
              $("#radiusRange").prop("disabled", false);
              $("#worship").prop("disabled", false);
              $("#culinary").prop("disabled", false);
              $("#event").prop("disabled", false);
              $("#souvenir").prop("disabled", false);
              $("#homestay").prop("disabled", false);

              // markerFacility[0] = new google.maps.Marker({
              //     position: posData,
              //     map,
              //     title: "Hello World!",
              //     info: contentString,
              //     icon: urlAplikasi+"media/icon/marker_to.png",
              // });
            }
          );
          i++;
        }

        // End while
      }
    }
  );
}

function directionNonTourism() {
  placeMarker(GPSLocation, lng, lat);
  markerA.setMap(null);
  markerB.setMap(null);
  markerRouteStart.setMap(null);
}

function facilityMapAll() {
  if (GPSLocation == null) {
    GPSLocation = {
      lat: parseFloat(0),
      lng: parseFloat(0),
    };
  }
  $("#makeTable tbody tr").remove();
  $("#makeWorship tbody tr").remove();
  $("#makeSouvenir tbody tr").remove();
  $("#makeEvent tbody tr").remove();
  $("#makeCulinary tbody tr").remove();
  $("#makeHomestay tbody tr").remove();

  for (let i = 0; i < markerFacilityTemp.length; i++) {
    markerFacilityTemp[i].setMap(null);
  }

  markerFacilityTemp[0] = new google.maps.Marker({
    position: GPSLocation,
    map,
    title: "Tourism Object",
    info: contentString,
  });
  markerFacilityTemp[0].setLabel("C");

  // alert("facility map");
  var arrayFacility = [];
  setResultMap(null);
  var checkboxes = document.querySelectorAll("input[type=checkbox]:checked");
  console.log(checkboxes);
  let text = "";

  for (var i = 0; i < checkboxes.length; i++) {
    //   arrayFacility.push(checkboxes[i].value)
    text = text + "|" + checkboxes[i].value;
  }
  console.log("HEHE");
  console.log(GPSLocation);
  gpsText = GPSLocation.lat + "A" + GPSLocation.lng;
  console.log(text);
  console.log("HEHE");

  let radiusValue = $("#radiusRange").val();
  radiusDetail();

  $.get(
    urlAplikasi +
      "web/select_facility_all/" +
      text +
      "/" +
      gpsText +
      "/" +
      radiusValue,
    function (data) {
      // setMapOnAll(null);
      // markerArray=[];
      // setResultMap(null);
      // markerCulinary=[];
      // markerEvent=[];
      // markerFacility=[];
      // markerWorship=[];

      console.log("TEST DATA");
      console.log(JSON.parse(data));
      // console.log(data);
      console.log("TEST DATA");

      // console.log(radArray.length);
      // console.log( urlAplikasi+"media/icon/culinary.png")

      if (data == "no") {
      } else {
        geom_data = JSON.parse(data);
        console.log(geom_data);

        let b = 0;
        let length_worship = geom_data.worship.features.length;

        // show worship
        while (b < length_worship) {
          let x = geom_data.worship.features[b].properties["x"];
          let y = geom_data.worship.features[b].properties["y"];
          let a = GPSLocation.lng;
          let c = GPSLocation.lat;
          let posData = {
            lat: parseFloat(y),
            lng: parseFloat(x),
          };
          contentString =
            '<table class="table">' +
            "<thead>" +
            "  <tr>" +
            '    <th class="tg-0lax" style="text-align: center;">' +
            geom_data.worship.features[b].properties["name"] +
            "</th>" +
            // '    <th class="tg-0lax">Info</th>' +
            "  </tr>" +
            "</thead>" +
            "<tbody>" +
            "  <tr>" +
            '    <td class="tg-0lax" style="text-align: center;"><i class="fa fa-person-praying"></i>&nbsp Worship Place</td>' +
            // '    <td class="tg-0lax">' +
            // geom_data.worship.features[b].properties["name"] +
            // "</td>" +
            "  </tr>" +
            // "  <tr>" +
            // '    <td class="tg-0lax">Name</td>' +
            // '    <td class="tg-0lax">' +
            // geom_data.worship.features[b].properties["name"] +
            // "</td>" +
            // "  </tr>" +
            // "  <tr>" +
            // '    <td class="tg-0lax">Address</td>' +
            // '    <td class="tg-0lax">' +
            // geom_data.worship.features[b].properties["address"] +
            // "</td>" +
            // "  </tr>" +
            // "  <tr>" +
            // '    <td class="tg-0lax"> <button class="btn btn-outline-primary" onclick="directionNonTourism()"><i class="fa-solid fa-route"></i></button></td>' +
            // '    <td class="tg-0lax"><button class="btn btn-outline-primary" onclick="infoList(' +
            // "'" +
            // geom_data.worship.features[b].properties["id"] +
            // "'" +
            // "," +
            // "'" +
            // "WORSHIP" +
            // "'" +
            // ')"><i class="fa fa-info-circle"></i></button></td>' +
            // "  </tr>" +
            "</tbody>" +
            "</table>" +
            "<div class='d-flex justify-content-center'><button style='margin:5px;' class='btn btn-outline-primary' onclick='directionNonTourism()'><i class='fa-solid fa-route'></i></button><button style='margin:5px;' class='btn btn-outline-primary' onclick='infoList(" +
            '"' +
            geom_data.worship.features[b].properties["id"] +
            '"' +
            "," +
            '"' +
            "WORSHIP" +
            '"' +
            ")'><i class='fa fa-info-circle'></i></button></div>";
          markerWorship[b] = new google.maps.Marker({
            position: posData,
            map,
            title: "Worship Place",
            info: contentString,
            icon: urlAplikasi + "media/icon/marker_wp.png",
          });

          $("#makeTable")
            .find("tbody")
            .append(
              $("<tr>")
                .append(
                  $("<td>").append(
                    $(
                      "<div>" +
                        geom_data.worship.features[b].properties["name"] +
                        "</div>"
                    )
                  )
                )
                .append(
                  $("<td width='60px'>").append(
                    $(
                      '<button onclick="dirrectionManual(' +
                        x +
                        "," +
                        y +
                        "," +
                        c +
                        "," +
                        a +
                        ')" class="btn btn-primary"><i class="fa-solid fa-route"></i></button>'
                    )
                  )
                )
            );

          infowindow = new google.maps.InfoWindow({
            content: contentString,
            ariaLabel: "Uluru",
          });

          google.maps.event.addListener(markerWorship[b], "click", function () {
            infowindow.setContent(this.info);
            infowindow.open(map, this);
            console.log(this.getPosition().lat());
            console.log(this.getPosition().lng());
            latDetail = this.getPosition().lat();
            lngDetail = this.getPosition().lng();

            let posData = {
              lat: parseFloat(latDetail),
              lng: parseFloat(lngDetail),
            };

            lat = parseFloat(latDetail);
            lng = parseFloat(lngDetail);

            // GPSLocation =  {
            //     lat: parseFloat(latDetail),
            //     lng: parseFloat(lngDetail)
            // };
            // deletemaerker

            // Tambahkan Rute otomatis jika marker di klik

            // setMapOnAll(null);
            // markerArray=[];

            $("#radiusRange").prop("disabled", false);
            $("#radiusRange").prop("disabled", false);
            $("#worship").prop("disabled", false);
            $("#culinary").prop("disabled", false);
            $("#event").prop("disabled", false);
            $("#souvenir").prop("disabled", false);
            $("#homestay").prop("disabled", false);

            // markerCulinary[0] = new google.maps.Marker({
            //     position: posData,
            //     map,
            //     title: "Hello World!",
            //     info: contentString
            // });
          });

          b++;
        }

        let i = 0;
        let length_culinary = geom_data.culinary.features.length;
        console.log(length_culinary);
        // show culinary
        while (i < length_culinary) {
          let x = geom_data.culinary.features[i].properties["x"];
          let y = geom_data.culinary.features[i].properties["y"];
          let a = GPSLocation.lng;
          let c = GPSLocation.lat;
          let posData = {
            lat: parseFloat(y),
            lng: parseFloat(x),
          };
          contentString =
            '<table class="table">' +
            "<thead>" +
            "  <tr>" +
            '    <th class="tg-0lax">' +
            geom_data.culinary.features[i].properties["name"] +
            "</th>" +
            // '    <th class="tg-0lax">Info</th>' +
            "  </tr>" +
            "</thead>" +
            "<tbody>" +
            "  <tr>" +
            '    <td class="tg-0lax" style="text-align: center;"><i class="fa fa-utensils"></i>&nbsp Culinary</td>' +
            // '    <td class="tg-0lax">' +
            // geom_data.culinary.features[i].properties["name"] +
            // "</td>" +
            "  </tr>" +
            // "  <tr>" +
            // '    <td class="tg-0lax"><i class="fa fa-info-utensils"></i>&nbsp Culinary</td>' +
            // '    <td class="tg-0lax">' +
            // geom_data.culinary.features[i].properties["name"] +
            // "</td>" +
            // "  </tr>" +
            // "  <tr>" +
            // '    <td class="tg-0lax">Address</td>' +
            // '    <td class="tg-0lax">' +
            // geom_data.culinary.features[i].properties["address"] +
            // "</td>" +
            // "  </tr>" +
            // "  <tr>" +
            // '    <td class="tg-0lax">Open</td>' +
            // '    <td class="tg-0lax">' +
            // geom_data.culinary.features[i].properties["open"] +
            // "</td>" +
            // "  </tr>" +
            // "  <tr>" +
            // '    <td class="tg-0lax">Close</td>' +
            // '    <td class="tg-0lax">' +
            // geom_data.culinary.features[i].properties["close"] +
            // "</td>" +
            // "  </tr>" +
            // "  <tr>" +
            // '    <td class="tg-0lax"> <button class="btn btn-outline-primary" onclick="directionNonTourism()"><i class="fa-solid fa-route"></i></button></td>' +
            // '    <td class="tg-0lax"><button class="btn btn-outline-primary" onclick="infoList(' +
            // "'" +
            // geom_data.culinary.features[i].properties["id"] +
            // "'" +
            // "," +
            // "'" +
            // "CULINARY" +
            // "'" +
            // ')"><i class="fa fa-info-circle"></i></button></td>' +
            // "  </tr>" +
            "</tbody>" +
            "</table>" +
            "<div class='d-flex justify-content-center'><button style='margin:5px;' class='btn btn-outline-primary' onclick='directionNonTourism()'><i class='fa-solid fa-route'></i></button><button style='margin:5px;' class='btn btn-outline-primary' onclick='infoList(" +
            '"' +
            geom_data.culinary.features[i].properties["id"] +
            '"' +
            "," +
            '"' +
            "CULINARY" +
            '"' +
            ")'><i class='fa fa-info-circle'></i></button></div>";
          markerCulinary[i] = new google.maps.Marker({
            position: posData,
            map,
            title: "Culinary Place",
            info: contentString,
            icon: urlAplikasi + "media/icon/marker_cp.png",
          });

          $("#makeCulinary")
            .find("tbody")
            .append(
              $("<tr>")
                .append(
                  $("<td>").append(
                    $(
                      "<div>" +
                        geom_data.culinary.features[i].properties["name"] +
                        "</div>"
                    )
                  )
                )
                .append(
                  $("<td width='60px'>").append(
                    $(
                      '<button onclick="dirrectionManual(' +
                        x +
                        "," +
                        y +
                        "," +
                        c +
                        "," +
                        a +
                        ')" class="btn btn-primary"><i class="fa-solid fa-route"></i></button>'
                    )
                  )
                )
            );

          infowindow = new google.maps.InfoWindow({
            content: contentString,
            ariaLabel: "Uluru",
          });

          google.maps.event.addListener(
            markerCulinary[i],
            "click",
            function () {
              infowindow.setContent(this.info);
              infowindow.open(map, this);
              console.log(this.getPosition().lat());
              console.log(this.getPosition().lng());
              latDetail = this.getPosition().lat();
              lngDetail = this.getPosition().lng();

              let posData = {
                lat: parseFloat(latDetail),
                lng: parseFloat(lngDetail),
              };

              lat = parseFloat(latDetail);
              lng = parseFloat(lngDetail);

              // GPSLocation =  {
              //     lat: parseFloat(latDetail),
              //     lng: parseFloat(lngDetail)
              // };
              // deletemaerker

              // Tambahkan Rute otomatis jika marker di klik
              // placeMarker(GPSLocation, lng, lat);
              // markerA.setMap(null);
              // markerB.setMap(null);
              // markerRouteStart .setMap(null);

              // setMapOnAll(null);
              // markerArray=[];

              $("#radiusRange").prop("disabled", false);
              $("#radiusRange").prop("disabled", false);
              $("#worship").prop("disabled", false);
              $("#culinary").prop("disabled", false);
              $("#event").prop("disabled", false);
              $("#souvenir").prop("disabled", false);
              $("#homestay").prop("disabled", false);

              // markerCulinary[0] = new google.maps.Marker({
              //     position: posData,
              //     map,
              //     title: "Hello World!",
              //     info: contentString
              // });
            }
          );
          i++;
        }

        i = 0;
        let length_homestay = geom_data.homestay.features.length;
        // console.log(length_culinary);
        // show culinary
        while (i < length_homestay) {
          let x = geom_data.homestay.features[i].properties["x"];
          let y = geom_data.homestay.features[i].properties["y"];
          let a = GPSLocation.lng;
          let c = GPSLocation.lat;
          let posData = {
            lat: parseFloat(y),
            lng: parseFloat(x),
          };
          contentString =
            '<table class="table">' +
            "<thead>" +
            "  <tr>" +
            '    <th class="tg-0lax">' +
            geom_data.homestay.features[i].properties["name"] +
            "</th>" +
            // '    <th class="tg-0lax">Info</th>' +
            "  </tr>" +
            "</thead>" +
            "<tbody>" +
            "  <tr>" +
            '    <td class="tg-0lax" style="text-align: center;"><i class="fa fa-home"></i>&nbsp Homestay</td>' +
            // '    <td class="tg-0lax">' +
            // geom_data.homestay.features[i].properties["name"] +
            // "</td>" +
            "  </tr>" +
            // "  <tr>" +
            // '    <td class="tg-0lax">Name</td>' +
            // '    <td class="tg-0lax">' +
            // geom_data.homestay.features[i].properties["name"] +
            // "</td>" +
            // "  </tr>" +
            // "  <tr>" +
            // '    <td class="tg-0lax">Address</td>' +
            // '    <td class="tg-0lax">' +
            // geom_data.homestay.features[i].properties["address"] +
            // "</td>" +
            // "  </tr>" +
            // "  <tr>" +
            // '    <td class="tg-0lax">Capacity</td>' +
            // '    <td class="tg-0lax">' +
            // geom_data.homestay.features[i].properties["capacity"] +
            // "</td>" +
            // "  </tr>" +
            // "  <tr>" +
            // '    <td class="tg-0lax"> <button class="btn btn-outline-primary" onclick="directionNonTourism()"><i class="fa-solid fa-route"></i></button></td>' +
            // '    <td class="tg-0lax"><button class="btn btn-outline-primary" onclick="infoList(' +
            // "'" +
            // geom_data.homestay.features[i].properties["id"] +
            // "'" +
            // "," +
            // "'" +
            // "HOMESTAY" +
            // "'" +
            // ')"><i class="fa fa-info-circle"></i></button></td>' +
            // "  </tr>" +
            "</tbody>" +
            "</table>" +
            "<div class='d-flex justify-content-center'><button style='margin:5px;' class='btn btn-outline-primary' onclick='directionNonTourism()'><i class='fa-solid fa-route'></i></button><button style='margin:5px;' class='btn btn-outline-primary' onclick='infoList(" +
            '"' +
            geom_data.homestay.features[i].properties["id"] +
            '"' +
            "," +
            '"' +
            "HOMESTAY" +
            '"' +
            ")'><i class='fa fa-info-circle'></i></button></div>";
          markerHomestay[i] = new google.maps.Marker({
            position: posData,
            map,
            title: "Homestay",
            info: contentString,
            icon: urlAplikasi + "media/icon/marker_hs.png",
          });
          $("#makeHomestay")
            .find("tbody")
            .append(
              $("<tr>")
                .append(
                  $("<td>").append(
                    $(
                      "<div>" +
                        geom_data.homestay.features[i].properties["name"] +
                        "</div>"
                    )
                  )
                )
                .append(
                  $("<td width='60px'>").append(
                    $(
                      '<button onclick="dirrectionManual(' +
                        x +
                        "," +
                        y +
                        "," +
                        c +
                        "," +
                        a +
                        ')" class="btn btn-primary"><i class="fa-solid fa-route"></i></button>'
                    )
                  )
                )
            );

          infowindow = new google.maps.InfoWindow({
            content: contentString,
            ariaLabel: "Uluru",
          });

          google.maps.event.addListener(
            markerHomestay[i],
            "click",
            function () {
              infowindow.setContent(this.info);
              infowindow.open(map, this);
              console.log(this.getPosition().lat());
              console.log(this.getPosition().lng());
              latDetail = this.getPosition().lat();
              lngDetail = this.getPosition().lng();

              let posData = {
                lat: parseFloat(latDetail),
                lng: parseFloat(lngDetail),
              };

              lat = parseFloat(latDetail);
              lng = parseFloat(lngDetail);

              // GPSLocation =  {
              //     lat: parseFloat(latDetail),
              //     lng: parseFloat(lngDetail)
              // };
              // deletemaerker

              // Tambahkan Rute otomatis jika marker di klik
              // placeMarker(GPSLocation, lng, lat);
              // markerA.setMap(null);
              // markerB.setMap(null);
              // markerRouteStart .setMap(null);

              // setMapOnAll(null);
              // markerArray=[];

              $("#radiusRange").prop("disabled", false);
              $("#radiusRange").prop("disabled", false);
              $("#worship").prop("disabled", false);
              $("#culinary").prop("disabled", false);
              $("#event").prop("disabled", false);
              $("#souvenir").prop("disabled", false);
              $("#homestay").prop("disabled", false);

              // markerCulinary[0] = new google.maps.Marker({
              //     position: posData,
              //     map,
              //     title: "Hello World!",
              //     info: contentString
              // });
            }
          );
          i++;
        }

        // End while

        i = 0;
        let length_event = geom_data.event.features.length;

        // show culinary
        while (i < length_event) {
          let x = geom_data.event.features[i].properties["x"];
          let y = geom_data.event.features[i].properties["y"];
          let a = GPSLocation.lng;
          let c = GPSLocation.lat;
          let posData = {
            lat: parseFloat(y),
            lng: parseFloat(x),
          };
          contentString =
            '<table class="table">' +
            "<thead>" +
            "  <tr>" +
            '    <th class="tg-0lax">' +
            geom_data.event.features[i].properties["name"] +
            "</th>" +
            // '    <th class="tg-0lax">Info</th>' +
            "  </tr>" +
            "</thead>" +
            "<tbody>" +
            "  <tr>" +
            '    <td class="tg-0lax" style="text-align: center;"><i class="fa fa-bullhorn"></i>&nbsp Event</td>' +
            // '    <td class="tg-0lax">' +
            // geom_data.event.features[i].properties["name"] +
            // "</td>" +
            "  </tr>" +
            // "  <tr>" +
            // '    <td class="tg-0lax">Name</td>' +
            // '    <td class="tg-0lax">' +
            // geom_data.event.features[i].properties["name"] +
            // "</td>" +
            // "  </tr>" +
            // "  <tr>" +
            // '    <td class="tg-0lax">Date Start</td>' +
            // '    <td class="tg-0lax">' +
            // geom_data.event.features[i].properties["date_start"] +
            // "</td>" +
            // "  </tr>" +
            // "  <tr>" +
            // '    <td class="tg-0lax">Date End</td>' +
            // '    <td class="tg-0lax">' +
            // geom_data.event.features[i].properties["date_end"] +
            // "</td>" +
            // "  </tr>" +
            // "  <tr>" +
            // '    <td class="tg-0lax">Ticket Price</td>' +
            // '    <td class="tg-0lax">' +
            // geom_data.event.features[i].properties["ticket_price"] +
            // "</td>" +
            // "  </tr>" +
            // "  <tr>" +
            // '    <td class="tg-0lax"> <button class="btn btn-outline-primary" onclick="directionNonTourism()"><i class="fa-solid fa-route"></i></button></td>' +
            // '    <td class="tg-0lax"><button class="btn btn-outline-primary" onclick="infoList(' +
            // "'" +
            // geom_data.event.features[i].properties["id"] +
            // "'" +
            // "," +
            // "'" +
            // "EVENT" +
            // "'" +
            // ')"><i class="fa fa-info-circle"></i></button></td>' +
            // "  </tr>" +
            "</tbody>" +
            "</table>" +
            "<div class='d-flex justify-content-center'><button style='margin:5px;' class='btn btn-outline-primary' onclick='directionNonTourism()'><i class='fa-solid fa-route'></i></button><button style='margin:5px;' class='btn btn-outline-primary' onclick='infoList(" +
            '"' +
            geom_data.event.features[i].properties["id"] +
            '"' +
            "," +
            '"' +
            "EVENT" +
            '"' +
            ")'><i class='fa fa-info-circle'></i></button></div>";

          markerEvent[i] = new google.maps.Marker({
            position: posData,
            map,
            title: "Event",
            info: contentString,
            icon: urlAplikasi + "media/icon/marker_ev.png",
          });

          $("#makeEvent")
            .find("tbody")
            .append(
              $("<tr>")
                .append(
                  $("<td>").append(
                    $(
                      "<div>" +
                        geom_data.event.features[i].properties["name"] +
                        "</div>"
                    )
                  )
                )
                .append(
                  $("<td width='60px'>").append(
                    $(
                      '<button onclick="dirrectionManual(' +
                        x +
                        "," +
                        y +
                        "," +
                        c +
                        "," +
                        a +
                        ')" class="btn btn-primary"><i class="fa-solid fa-route"></i></button>'
                    )
                  )
                )
            );

          infowindow = new google.maps.InfoWindow({
            content: contentString,
            ariaLabel: "Uluru",
          });

          google.maps.event.addListener(markerEvent[i], "click", function () {
            infowindow.setContent(this.info);
            infowindow.open(map, this);

            latDetail = this.getPosition().lat();
            lngDetail = this.getPosition().lng();

            let posData = {
              lat: parseFloat(latDetail),
              lng: parseFloat(lngDetail),
            };

            lat = parseFloat(latDetail);
            lng = parseFloat(lngDetail);

            // GPSLocation =  {
            //     lat: parseFloat(latDetail),
            //     lng: parseFloat(lngDetail)
            // };
            // deletemaerker

            // Tambahkan Rute otomatis jika marker di klik
            //  placeMarker(GPSLocation, lng, lat);
            //  markerA.setMap(null);
            //  markerB.setMap(null);
            //  markerRouteStart .setMap(null);

            // setMapOnAll(null);
            // markerArray=[];

            $("#radiusRange").prop("disabled", false);
            $("#radiusRange").prop("disabled", false);
            $("#worship").prop("disabled", false);
            $("#culinary").prop("disabled", false);
            $("#event").prop("disabled", false);
            $("#souvenir").prop("disabled", false);
            $("#homestay").prop("disabled", false);

            // markerEvent[0] = new google.maps.Marker({
            //     position: posData,
            //     map,
            //     title: "Hello World!",
            //     info: contentString
            // });
          });
          i++;
        }

        // End while

        i = 0;
        let length_souvenir = geom_data.souvenir.features.length;

        // show culinary
        while (i < length_souvenir) {
          let x = geom_data.souvenir.features[i].properties["x"];
          let y = geom_data.souvenir.features[i].properties["y"];
          let a = GPSLocation.lng;
          let c = GPSLocation.lat;
          let posData = {
            lat: parseFloat(y),
            lng: parseFloat(x),
          };
          contentString =
            '<table class="table">' +
            "<thead>" +
            "  <tr>" +
            '    <th class="tg-0lax">' +
            geom_data.souvenir.features[i].properties["name"] +
            "</th>" +
            // '    <th class="tg-0lax">Info</th>' +
            "  </tr>" +
            "</thead>" +
            "<tbody>" +
            "  <tr>" +
            '    <td class="tg-0lax" style="text-align: center;"><i class="fa fa-gift"></i>&nbsp Souvenir</td>' +
            // '    <td class="tg-0lax">' +
            // geom_data.souvenir.features[i].properties["name"] +
            // "</td>" +
            "  </tr>" +
            // "  <tr>" +
            // '    <td class="tg-0lax">Name</td>' +
            // '    <td class="tg-0lax">' +
            // geom_data.souvenir.features[i].properties["name"] +
            // "</td>" +
            // "  </tr>" +
            // "  <tr>" +
            // '    <td class="tg-0lax">Address</td>' +
            // '    <td class="tg-0lax">' +
            // geom_data.souvenir.features[i].properties["address"] +
            // "</td>" +
            // "  </tr>" +
            // "  <tr>" +
            // '    <td class="tg-0lax"> <button class="btn btn-outline-primary" onclick="directionNonTourism()"><i class="fa-solid fa-route"></i></button></td>' +
            // '    <td class="tg-0lax"><button class="btn btn-outline-primary" onclick="infoList(' +
            // "'" +
            // geom_data.souvenir.features[i].properties["id"] +
            // "'" +
            // "," +
            // "'" +
            // "SOUVENIR" +
            // "'" +
            // ')"><i class="fa fa-info-circle"></i></button></td>' +
            // "  </tr>" +
            "</tbody>" +
            "</table>" +
            "<div class='d-flex justify-content-center'><button style='margin:5px;' class='btn btn-outline-primary' onclick='directionNonTourism()'><i class='fa-solid fa-route'></i></button><button style='margin:5px;' class='btn btn-outline-primary' onclick='infoList(" +
            '"' +
            geom_data.souvenir.features[i].properties["id"] +
            '"' +
            "," +
            '"' +
            "SOUVENIR" +
            '"' +
            ")'><i class='fa fa-info-circle'></i></button></div>";
          markerSouvenir[i] = new google.maps.Marker({
            position: posData,
            map,
            title: "Souvenir",
            info: contentString,
            icon: urlAplikasi + "media/icon/marker_sp.png",
          });

          $("#makeSouvenir")
            .find("tbody")
            .append(
              $("<tr>")
                .append(
                  $("<td>").append(
                    $(
                      "<div>" +
                        geom_data.souvenir.features[i].properties["name"] +
                        "</div>"
                    )
                  )
                )
                .append(
                  $("<td width='60px'>").append(
                    $(
                      '<button onclick="dirrectionManual(' +
                        x +
                        "," +
                        y +
                        "," +
                        c +
                        "," +
                        a +
                        ')" class="btn btn-primary"><i class="fa-solid fa-route"></i></button>'
                    )
                  )
                )
            );

          infowindow = new google.maps.InfoWindow({
            content: contentString,
            ariaLabel: "Uluru",
          });

          google.maps.event.addListener(
            markerSouvenir[i],
            "click",
            function () {
              infowindow.setContent(this.info);
              infowindow.open(map, this);

              latDetail = this.getPosition().lat();
              lngDetail = this.getPosition().lng();

              let posData = {
                lat: parseFloat(latDetail),
                lng: parseFloat(lngDetail),
              };

              lat = parseFloat(latDetail);
              lng = parseFloat(lngDetail);

              // GPSLocation =  {
              //     lat: parseFloat(latDetail),
              //     lng: parseFloat(lngDetail)
              // };
              // deletemaerker

              // Tambahkan Rute otomatis jika marker di klik
              // placeMarker(GPSLocation, lng, lat);
              // markerA.setMap(null);
              // markerB.setMap(null);
              // markerRouteStart .setMap(null);

              // setMapOnAll(null);
              // markerArray=[];

              $("#radiusRange").prop("disabled", false);
              $("#radiusRange").prop("disabled", false);
              $("#worship").prop("disabled", false);
              $("#culinary").prop("disabled", false);
              $("#event").prop("disabled", false);
              $("#souvenir").prop("disabled", false);
              $("#homestay").prop("disabled", false);

              // markerSouvenir[0] = new google.maps.Marker({
              //     position: posData,
              //     map,
              //     title: "Hello World!",
              //     info: contentString,
              //     icon: urlAplikasi+"media/icon/marker_sp.png" ,
              // });
            }
          );
          i++;
        }

        // End while

        i = 0;
        let length_facility = geom_data.facility.features.length;
        console.log(geom_data.facility);

        // show culinary
        while (i < length_facility) {
          let x = geom_data.facility.features[i].properties["x"];
          let y = geom_data.facility.features[i].properties["y"];
          let a = GPSLocation.lng;
          let c = GPSLocation.lat;
          let posData = {
            lat: parseFloat(y),
            lng: parseFloat(x),
          };
          contentString =
            '<table class="table">' +
            "<thead>" +
            "  <tr>" +
            '    <th class="tg-0lax">' +
            geom_data.facility.features[i].properties["name"] +
            "</th>" +
            // '    <th class="tg-0lax">Info</th>' +
            "  </tr>" +
            "</thead>" +
            "<tbody>" +
            "  <tr>" +
            '    <td class="tg-0lax"><i class="fa fa-mountain-sun"></i>&nbsp Tourism Object</td>' +
            // '    <td class="tg-0lax">' +
            // geom_data.facility.features[i].properties["name"] +
            // "</td>" +
            "  </tr>" +
            // "  <tr>" +
            // '    <td class="tg-0lax">Name</td>' +
            // '    <td class="tg-0lax">' +
            // geom_data.facility.features[i].properties["name"] +
            // "</td>" +
            // "  </tr>" +
            // "  <tr>" +
            // '    <td class="tg-0lax">Open</td>' +
            // '    <td class="tg-0lax">' +
            // geom_data.facility.features[i].properties["open"] +
            // "</td>" +
            // "  </tr>" +
            // "  <tr>" +
            // '    <td class="tg-0lax">Close</td>' +
            // '    <td class="tg-0lax">' +
            // geom_data.facility.features[i].properties["close"] +
            // "</td>" +
            // "  </tr>" +
            // "  <tr>" +
            // '    <td class="tg-0lax">Ticket Price</td>' +
            // '    <td class="tg-0lax">' +
            // geom_data.facility.features[0].properties["ticket_price"] +
            // "</td>" +
            // "  </tr>" +
            "</tbody>" +
            "</table>" +
            "";
          markerFacility[i] = new google.maps.Marker({
            position: posData,
            map,
            title: "Tourism Object",
            info: contentString,
            icon: urlAplikasi + "media/icon/marker_to.png",
          });

          infowindow = new google.maps.InfoWindow({
            content: contentString,
            ariaLabel: "Uluru",
          });

          google.maps.event.addListener(
            markerFacility[i],
            "click",
            function () {
              infowindow.setContent(this.info);
              infowindow.open(map, this);
              for (let i = 0; i < markerFacilityTemp.length; i++) {
                markerFacilityTemp[i].setMap(null);
              }

              latDetail = this.getPosition().lat();
              lngDetail = this.getPosition().lng();

              let posData = {
                lat: parseFloat(latDetail),
                lng: parseFloat(lngDetail),
              };

              GPSLocation = {
                lat: parseFloat(latDetail),
                lng: parseFloat(lngDetail),
              };

              lat = parseFloat(latDetail);
              lng = parseFloat(lngDetail);
              // deletemaerker

              // setMapOnAll(null);
              // markerArray=[];

              $("#radiusRange").prop("disabled", false);
              $("#radiusRange").prop("disabled", false);
              $("#worship").prop("disabled", false);
              $("#culinary").prop("disabled", false);
              $("#event").prop("disabled", false);
              $("#souvenir").prop("disabled", false);
              $("#homestay").prop("disabled", false);

              // markerFacility[0] = new google.maps.Marker({
              //     position: posData,
              //     map,
              //     title: "Hello World!",
              //     info: contentString,
              //     icon: urlAplikasi+"media/icon/marker_to.png",
              // });
            }
          );
          i++;
        }

        // End while
      }
    }
  );
}

function facilityMapAgro() {
  if (GPSLocation == null) {
    GPSLocation = {
      lat: parseFloat(0),
      lng: parseFloat(0),
    };
  }

  $("#makeTable tbody tr").remove();
  $("#makeWorship tbody tr").remove();
  $("#makeSouvenir tbody tr").remove();
  $("#makeEvent tbody tr").remove();
  $("#makeCulinary tbody tr").remove();
  $("#makeHomestay tbody tr").remove();

  for (let i = 0; i < markerFacilityTemp.length; i++) {
    markerFacilityTemp[i].setMap(null);
  }

  markerFacilityTemp[0] = new google.maps.Marker({
    position: GPSLocation,
    map,
    title: "Tourism Object",
    info: contentString,
  });
  markerFacilityTemp[0].setLabel("C");

  // alert("facility map");
  var arrayFacility = [];
  setResultMap(null);
  var checkboxes = document.querySelectorAll("input[type=checkbox]:checked");
  console.log(checkboxes);
  let text = "";

  for (var i = 0; i < checkboxes.length; i++) {
    //   arrayFacility.push(checkboxes[i].value)
    text = text + "|" + checkboxes[i].value;
  }
  console.log("HEHE");
  console.log(GPSLocation);
  gpsText = GPSLocation.lat + "A" + GPSLocation.lng;
  console.log(text);
  console.log("HEHE");

  let radiusValue = $("#radiusRange").val();
  radiusDetail();

  $.get(
    urlAplikasi +
      "web/select_facility_agro/" +
      text +
      "/" +
      gpsText +
      "/" +
      radiusValue,
    function (data) {
      // setMapOnAll(null);
      // markerArray=[];
      // setResultMap(null);
      // markerCulinary=[];
      // markerEvent=[];
      // markerFacility=[];
      // markerWorship=[];

      console.log("TEST DATA");
      console.log(JSON.parse(data));
      // console.log(data);
      console.log("TEST DATA");

      // console.log(radArray.length);
      // console.log( urlAplikasi+"media/icon/culinary.png")

      if (data == "no") {
      } else {
        geom_data = JSON.parse(data);
        console.log(geom_data);

        let b = 0;
        let length_worship = geom_data.worship.features.length;

        // show worship
        while (b < length_worship) {
          let x = geom_data.worship.features[b].properties["x"];
          let y = geom_data.worship.features[b].properties["y"];
          let a = GPSLocation.lng;
          let c = GPSLocation.lat;
          let posData = {
            lat: parseFloat(y),
            lng: parseFloat(x),
          };
          contentString =
            '<table class="table">' +
            "<thead>" +
            "  <tr>" +
            '    <th class="tg-0lax" style="text-align: center;">' +
            geom_data.worship.features[b].properties["name"] +
            "</th>" +
            // '    <th class="tg-0lax">Info</th>' +
            "  </tr>" +
            "</thead>" +
            "<tbody>" +
            "  <tr>" +
            '    <td class="tg-0lax" style="text-align: center;"><i class="fa-solid fa-person-praying"></i>&nbsp Worship</td>' +
            "  </tr>" +
            // "  <tr>" +
            // '    <td class="tg-0lax">Name</td>' +
            // '    <td class="tg-0lax">' +
            // geom_data.worship.features[b].properties["name"] +
            // "</td>" +
            // "  </tr>" +
            // "  <tr>" +
            // '    <td class="tg-0lax">Address</td>' +
            // '    <td class="tg-0lax">' +
            // geom_data.worship.features[b].properties["address"] +
            // "</td>" +
            // "  </tr>" +
            // "  <tr>" +
            // '    <td class="tg-0lax"> <button class="btn btn-outline-primary" onclick="directionNonTourism()"><i class="fa-solid fa-route"></i></button></td>' +
            // '    <td class="tg-0lax"><button class="btn btn-outline-primary" onclick="infoList(' +
            // "'" +
            // geom_data.worship.features[b].properties["id"] +
            // "'" +
            // "," +
            // "'" +
            // "WORSHIP" +
            // "'" +
            // ')"><i class="fa fa-info-circle"></i></button></td>' +
            // "  </tr>" +
            "</tbody>" +
            "</table>" +
            "<div class='d-flex justify-content-center'><button style='margin:5px;' class='btn btn-outline-primary' onclick='directionNonTourism()'><i class='fa-solid fa-route'></i></button><button style='margin:5px;' class='btn btn-outline-primary' onclick='infoList(" +
            '"' +
            geom_data.worship.features[b].properties["id"] +
            '"' +
            "," +
            '"' +
            "WORSHIP" +
            '"' +
            ")'><i class='fa fa-info-circle'></i></button></div>";
          markerWorship[b] = new google.maps.Marker({
            position: posData,
            map,
            title: "Worship Place",
            info: contentString,
            icon: urlAplikasi + "media/icon/marker_wp.png",
          });

          $("#makeTable")
            .find("tbody")
            .append(
              $("<tr>")
                .append(
                  $("<td>").append(
                    $(
                      "<div>" +
                        geom_data.worship.features[b].properties["name"] +
                        "</div>"
                    )
                  )
                )
                .append(
                  $("<td width='60px'>").append(
                    $(
                      '<button onclick="dirrectionManual(' +
                        x +
                        "," +
                        y +
                        "," +
                        c +
                        "," +
                        a +
                        ')" class="btn btn-primary"><i class="fa-solid fa-route"></i></button>'
                    )
                  )
                )
            );

          infowindow = new google.maps.InfoWindow({
            content: contentString,
            ariaLabel: "Uluru",
          });

          google.maps.event.addListener(markerWorship[b], "click", function () {
            infowindow.setContent(this.info);
            infowindow.open(map, this);
            console.log(this.getPosition().lat());
            console.log(this.getPosition().lng());
            latDetail = this.getPosition().lat();
            lngDetail = this.getPosition().lng();

            let posData = {
              lat: parseFloat(latDetail),
              lng: parseFloat(lngDetail),
            };

            lat = parseFloat(latDetail);
            lng = parseFloat(lngDetail);

            // GPSLocation =  {
            //     lat: parseFloat(latDetail),
            //     lng: parseFloat(lngDetail)
            // };
            // deletemaerker

            // Tambahkan Rute otomatis jika marker di klik

            // setMapOnAll(null);
            // markerArray=[];

            $("#radiusRange").prop("disabled", false);
            $("#radiusRange").prop("disabled", false);
            $("#worship").prop("disabled", false);
            $("#culinary").prop("disabled", false);
            $("#event").prop("disabled", false);
            $("#souvenir").prop("disabled", false);
            $("#homestay").prop("disabled", false);

            // markerCulinary[0] = new google.maps.Marker({
            //     position: posData,
            //     map,
            //     title: "Hello World!",
            //     info: contentString
            // });
          });

          b++;
        }

        let i = 0;
        let length_culinary = geom_data.culinary.features.length;
        console.log(length_culinary);
        // show culinary
        while (i < length_culinary) {
          let x = geom_data.culinary.features[i].properties["x"];
          let y = geom_data.culinary.features[i].properties["y"];
          let a = GPSLocation.lng;
          let c = GPSLocation.lat;
          let posData = {
            lat: parseFloat(y),
            lng: parseFloat(x),
          };
          contentString =
            '<table class="table">' +
            "<thead>" +
            "  <tr>" +
            '    <th class="tg-0lax">' +
            geom_data.culinary.features[i].properties["name"] +
            "</th>" +
            // '    <th class="tg-0lax">Info</th>' +
            "  </tr>" +
            "</thead>" +
            "<tbody>" +
            "  <tr>" +
            '    <td class="tg-0lax" style="text-align: center;"><i class="fa fa-utensils"></i>&nbsp Culinary</td>' +
            // '    <td class="tg-0lax">' +
            // geom_data.culinary.features[i].properties["name"] +
            // "</td>" +
            "  </tr>" +
            // "  <tr>" +
            // '    <td class="tg-0lax"><i class="fa fa-info-utensils"></i>&nbsp Culinary</td>' +
            // '    <td class="tg-0lax">' +
            // geom_data.culinary.features[i].properties["name"] +
            // "</td>" +
            // "  </tr>" +
            // "  <tr>" +
            // '    <td class="tg-0lax">Address</td>' +
            // '    <td class="tg-0lax">' +
            // geom_data.culinary.features[i].properties["address"] +
            // "</td>" +
            // "  </tr>" +
            // "  <tr>" +
            // '    <td class="tg-0lax">Open</td>' +
            // '    <td class="tg-0lax">' +
            // geom_data.culinary.features[i].properties["open"] +
            // "</td>" +
            // "  </tr>" +
            // "  <tr>" +
            // '    <td class="tg-0lax">Close</td>' +
            // '    <td class="tg-0lax">' +
            // geom_data.culinary.features[i].properties["close"] +
            // "</td>" +
            // "  </tr>" +
            // "  <tr>" +
            // '    <td class="tg-0lax"> <button class="btn btn-outline-primary" onclick="directionNonTourism()"><i class="fa-solid fa-route"></i></button></td>' +
            // '    <td class="tg-0lax"><button class="btn btn-outline-primary" onclick="infoList(' +
            // "'" +
            // geom_data.culinary.features[i].properties["id"] +
            // "'" +
            // "," +
            // "'" +
            // "CULINARY" +
            // "'" +
            // ')"><i class="fa fa-info-circle"></i></button></td>' +
            // "  </tr>" +
            "</tbody>" +
            "</table>" +
            "<div class='d-flex justify-content-center'><button style='margin:5px;' class='btn btn-outline-primary' onclick='directionNonTourism()'><i class='fa-solid fa-route'></i></button><button style='margin:5px;' class='btn btn-outline-primary' onclick='infoList(" +
            '"' +
            geom_data.culinary.features[i].properties["id"] +
            '"' +
            "," +
            '"' +
            "CULINARY" +
            '"' +
            ")'><i class='fa fa-info-circle'></i></button></div>";
          markerCulinary[i] = new google.maps.Marker({
            position: posData,
            map,
            title: "Culinary Place",
            info: contentString,
            icon: urlAplikasi + "media/icon/marker_cp.png",
          });

          $("#makeCulinary")
            .find("tbody")
            .append(
              $("<tr>")
                .append(
                  $("<td>").append(
                    $(
                      "<div>" +
                        geom_data.culinary.features[i].properties["name"] +
                        "</div>"
                    )
                  )
                )
                .append(
                  $("<td width='60px'>").append(
                    $(
                      '<button onclick="dirrectionManual(' +
                        x +
                        "," +
                        y +
                        "," +
                        c +
                        "," +
                        a +
                        ')" class="btn btn-primary"><i class="fa-solid fa-route"></i></button>'
                    )
                  )
                )
            );

          infowindow = new google.maps.InfoWindow({
            content: contentString,
            ariaLabel: "Uluru",
          });

          google.maps.event.addListener(
            markerCulinary[i],
            "click",
            function () {
              infowindow.setContent(this.info);
              infowindow.open(map, this);
              console.log(this.getPosition().lat());
              console.log(this.getPosition().lng());
              latDetail = this.getPosition().lat();
              lngDetail = this.getPosition().lng();

              let posData = {
                lat: parseFloat(latDetail),
                lng: parseFloat(lngDetail),
              };

              lat = parseFloat(latDetail);
              lng = parseFloat(lngDetail);

              // GPSLocation =  {
              //     lat: parseFloat(latDetail),
              //     lng: parseFloat(lngDetail)
              // };
              // deletemaerker

              // Tambahkan Rute otomatis jika marker di klik
              // placeMarker(GPSLocation, lng, lat);
              // markerA.setMap(null);
              // markerB.setMap(null);
              // markerRouteStart .setMap(null);

              // setMapOnAll(null);
              // markerArray=[];

              $("#radiusRange").prop("disabled", false);
              $("#radiusRange").prop("disabled", false);
              $("#worship").prop("disabled", false);
              $("#culinary").prop("disabled", false);
              $("#event").prop("disabled", false);
              $("#souvenir").prop("disabled", false);
              $("#homestay").prop("disabled", false);

              // markerCulinary[0] = new google.maps.Marker({
              //     position: posData,
              //     map,
              //     title: "Hello World!",
              //     info: contentString
              // });
            }
          );
          i++;
        }

        i = 0;
        let length_homestay = geom_data.homestay.features.length;
        // console.log(length_culinary);
        // show culinary
        while (i < length_homestay) {
          let x = geom_data.homestay.features[i].properties["x"];
          let y = geom_data.homestay.features[i].properties["y"];
          let a = GPSLocation.lng;
          let c = GPSLocation.lat;
          let posData = {
            lat: parseFloat(y),
            lng: parseFloat(x),
          };
          contentString =
            '<table class="table">' +
            "<thead>" +
            "  <tr>" +
            '    <th class="tg-0lax">' +
            geom_data.homestay.features[i].properties["name"] +
            "</th>" +
            // '    <th class="tg-0lax">Info</th>' +
            "  </tr>" +
            "</thead>" +
            "<tbody>" +
            "  <tr>" +
            '    <td class="tg-0lax" style="text-align: center;"><i class="fa fa-home"></i>&nbsp Homestay</td>' +
            // '    <td class="tg-0lax">' +
            // geom_data.homestay.features[i].properties["name"] +
            // "</td>" +
            "  </tr>" +
            // "  <tr>" +
            // '    <td class="tg-0lax">Name</td>' +
            // '    <td class="tg-0lax">' +
            // geom_data.homestay.features[i].properties["name"] +
            // "</td>" +
            // "  </tr>" +
            // "  <tr>" +
            // '    <td class="tg-0lax">Address</td>' +
            // '    <td class="tg-0lax">' +
            // geom_data.homestay.features[i].properties["address"] +
            // "</td>" +
            // "  </tr>" +
            // "  <tr>" +
            // '    <td class="tg-0lax">Capacity</td>' +
            // '    <td class="tg-0lax">' +
            // geom_data.homestay.features[i].properties["capacity"] +
            // "</td>" +
            // "  </tr>" +
            // "  <tr>" +
            // '    <td class="tg-0lax"> <button class="btn btn-outline-primary" onclick="directionNonTourism()"><i class="fa-solid fa-route"></i></button></td>' +
            // '    <td class="tg-0lax"><button class="btn btn-outline-primary" onclick="infoList(' +
            // "'" +
            // geom_data.homestay.features[i].properties["id"] +
            // "'" +
            // "," +
            // "'" +
            // "HOMESTAY" +
            // "'" +
            // ')"><i class="fa fa-info-circle"></i></button></td>' +
            // "  </tr>" +
            "</tbody>" +
            "</table>" +
            "<div class='d-flex justify-content-center'><button style='margin:5px;' class='btn btn-outline-primary' onclick='directionNonTourism()'><i class='fa-solid fa-route'></i></button><button style='margin:5px;' class='btn btn-outline-primary' onclick='infoList(" +
            '"' +
            geom_data.homestay.features[i].properties["id"] +
            '"' +
            "," +
            '"' +
            "HOMESTAY" +
            '"' +
            ")'><i class='fa fa-info-circle'></i></button></div>";
          markerHomestay[i] = new google.maps.Marker({
            position: posData,
            map,
            title: "Homestay",
            info: contentString,
            icon: urlAplikasi + "media/icon/marker_hs.png",
          });
          $("#makeHomestay")
            .find("tbody")
            .append(
              $("<tr>")
                .append(
                  $("<td>").append(
                    $(
                      "<div>" +
                        geom_data.homestay.features[i].properties["name"] +
                        "</div>"
                    )
                  )
                )
                .append(
                  $("<td width='60px'>").append(
                    $(
                      '<button onclick="dirrectionManual(' +
                        x +
                        "," +
                        y +
                        "," +
                        c +
                        "," +
                        a +
                        ')" class="btn btn-primary"><i class="fa-solid fa-route"></i></button>'
                    )
                  )
                )
            );

          infowindow = new google.maps.InfoWindow({
            content: contentString,
            ariaLabel: "Uluru",
          });

          google.maps.event.addListener(
            markerHomestay[i],
            "click",
            function () {
              infowindow.setContent(this.info);
              infowindow.open(map, this);
              console.log(this.getPosition().lat());
              console.log(this.getPosition().lng());
              latDetail = this.getPosition().lat();
              lngDetail = this.getPosition().lng();

              let posData = {
                lat: parseFloat(latDetail),
                lng: parseFloat(lngDetail),
              };

              lat = parseFloat(latDetail);
              lng = parseFloat(lngDetail);

              // GPSLocation =  {
              //     lat: parseFloat(latDetail),
              //     lng: parseFloat(lngDetail)
              // };
              // deletemaerker

              // Tambahkan Rute otomatis jika marker di klik
              // placeMarker(GPSLocation, lng, lat);
              // markerA.setMap(null);
              // markerB.setMap(null);
              // markerRouteStart .setMap(null);

              // setMapOnAll(null);
              // markerArray=[];

              $("#radiusRange").prop("disabled", false);
              $("#radiusRange").prop("disabled", false);
              $("#worship").prop("disabled", false);
              $("#culinary").prop("disabled", false);
              $("#event").prop("disabled", false);
              $("#souvenir").prop("disabled", false);
              $("#homestay").prop("disabled", false);

              // markerCulinary[0] = new google.maps.Marker({
              //     position: posData,
              //     map,
              //     title: "Hello World!",
              //     info: contentString
              // });
            }
          );
          i++;
        }

        // End while

        i = 0;
        let length_event = geom_data.event.features.length;

        // show culinary
        while (i < length_event) {
          let x = geom_data.event.features[i].properties["x"];
          let y = geom_data.event.features[i].properties["y"];
          let a = GPSLocation.lng;
          let c = GPSLocation.lat;
          let posData = {
            lat: parseFloat(y),
            lng: parseFloat(x),
          };
          contentString =
            '<table class="table">' +
            "<thead>" +
            "  <tr>" +
            '    <th class="tg-0lax">' +
            geom_data.event.features[i].properties["name"] +
            "</th>" +
            // '    <th class="tg-0lax">Info</th>' +
            "  </tr>" +
            "</thead>" +
            "<tbody>" +
            "  <tr>" +
            '    <td class="tg-0lax" style="text-align: center;"><i class="fa fa-bullhorn"></i>&nbsp Event</td>' +
            // '    <td class="tg-0lax">' +
            // geom_data.event.features[i].properties["name"] +
            // "</td>" +
            "  </tr>" +
            // "  <tr>" +
            // '    <td class="tg-0lax">Name</td>' +
            // '    <td class="tg-0lax">' +
            // geom_data.event.features[i].properties["name"] +
            // "</td>" +
            // "  </tr>" +
            // "  <tr>" +
            // '    <td class="tg-0lax">Date Start</td>' +
            // '    <td class="tg-0lax">' +
            // geom_data.event.features[i].properties["date_start"] +
            // "</td>" +
            // "  </tr>" +
            // "  <tr>" +
            // '    <td class="tg-0lax">Date End</td>' +
            // '    <td class="tg-0lax">' +
            // geom_data.event.features[i].properties["date_end"] +
            // "</td>" +
            // "  </tr>" +
            // "  <tr>" +
            // '    <td class="tg-0lax">Ticket Price</td>' +
            // '    <td class="tg-0lax">' +
            // geom_data.event.features[i].properties["ticket_price"] +
            // "</td>" +
            // "  </tr>" +
            // "  <tr>" +
            // '    <td class="tg-0lax"> <button class="btn btn-outline-primary" onclick="directionNonTourism()"><i class="fa-solid fa-route"></i></button></td>' +
            // '    <td class="tg-0lax"><button class="btn btn-outline-primary" onclick="infoList(' +
            // "'" +
            // geom_data.event.features[i].properties["id"] +
            // "'" +
            // "," +
            // "'" +
            // "EVENT" +
            // "'" +
            // ')"><i class="fa fa-info-circle"></i></button></td>' +
            // "  </tr>" +
            "</tbody>" +
            "</table>" +
            "<div class='d-flex justify-content-center'><button style='margin:5px;' class='btn btn-outline-primary' onclick='directionNonTourism()'><i class='fa-solid fa-route'></i></button><button style='margin:5px;' class='btn btn-outline-primary' onclick='infoList(" +
            '"' +
            geom_data.event.features[i].properties["id"] +
            '"' +
            "," +
            '"' +
            "EVENT" +
            '"' +
            ")'><i class='fa fa-info-circle'></i></button></div>";

          markerEvent[i] = new google.maps.Marker({
            position: posData,
            map,
            title: "Event",
            info: contentString,
            icon: urlAplikasi + "media/icon/marker_ev.png",
          });

          $("#makeEvent")
            .find("tbody")
            .append(
              $("<tr>")
                .append(
                  $("<td>").append(
                    $(
                      "<div>" +
                        geom_data.event.features[i].properties["name"] +
                        "</div>"
                    )
                  )
                )
                .append(
                  $("<td width='60px'>").append(
                    $(
                      '<button onclick="dirrectionManual(' +
                        x +
                        "," +
                        y +
                        "," +
                        c +
                        "," +
                        a +
                        ')" class="btn btn-primary"><i class="fa-solid fa-route"></i></button>'
                    )
                  )
                )
            );

          infowindow = new google.maps.InfoWindow({
            content: contentString,
            ariaLabel: "Uluru",
          });

          google.maps.event.addListener(markerEvent[i], "click", function () {
            infowindow.setContent(this.info);
            infowindow.open(map, this);

            latDetail = this.getPosition().lat();
            lngDetail = this.getPosition().lng();

            let posData = {
              lat: parseFloat(latDetail),
              lng: parseFloat(lngDetail),
            };

            lat = parseFloat(latDetail);
            lng = parseFloat(lngDetail);

            // GPSLocation =  {
            //     lat: parseFloat(latDetail),
            //     lng: parseFloat(lngDetail)
            // };
            // deletemaerker

            // Tambahkan Rute otomatis jika marker di klik
            //  placeMarker(GPSLocation, lng, lat);
            //  markerA.setMap(null);
            //  markerB.setMap(null);
            //  markerRouteStart .setMap(null);

            // setMapOnAll(null);
            // markerArray=[];

            $("#radiusRange").prop("disabled", false);
            $("#radiusRange").prop("disabled", false);
            $("#worship").prop("disabled", false);
            $("#culinary").prop("disabled", false);
            $("#event").prop("disabled", false);
            $("#souvenir").prop("disabled", false);
            $("#homestay").prop("disabled", false);

            // markerEvent[0] = new google.maps.Marker({
            //     position: posData,
            //     map,
            //     title: "Hello World!",
            //     info: contentString
            // });
          });
          i++;
        }

        // End while

        i = 0;
        let length_souvenir = geom_data.souvenir.features.length;

        // show culinary
        while (i < length_souvenir) {
          let x = geom_data.souvenir.features[i].properties["x"];
          let y = geom_data.souvenir.features[i].properties["y"];
          let a = GPSLocation.lng;
          let c = GPSLocation.lat;
          let posData = {
            lat: parseFloat(y),
            lng: parseFloat(x),
          };
          contentString =
            '<table class="table">' +
            "<thead>" +
            "  <tr>" +
            '    <th class="tg-0lax">' +
            geom_data.souvenir.features[i].properties["name"] +
            "</th>" +
            // '    <th class="tg-0lax">Info</th>' +
            "  </tr>" +
            "</thead>" +
            "<tbody>" +
            "  <tr>" +
            '    <td class="tg-0lax" style="text-align: center;"><i class="fa fa-gift"></i>&nbsp Souvenir</td>' +
            // '    <td class="tg-0lax">' +
            // geom_data.souvenir.features[i].properties["name"] +
            // "</td>" +
            "  </tr>" +
            // "  <tr>" +
            // '    <td class="tg-0lax">Name</td>' +
            // '    <td class="tg-0lax">' +
            // geom_data.souvenir.features[i].properties["name"] +
            // "</td>" +
            // "  </tr>" +
            // "  <tr>" +
            // '    <td class="tg-0lax">Address</td>' +
            // '    <td class="tg-0lax">' +
            // geom_data.souvenir.features[i].properties["address"] +
            // "</td>" +
            // "  </tr>" +
            // "  <tr>" +
            // '    <td class="tg-0lax"> <button class="btn btn-outline-primary" onclick="directionNonTourism()"><i class="fa-solid fa-route"></i></button></td>' +
            // '    <td class="tg-0lax"><button class="btn btn-outline-primary" onclick="infoList(' +
            // "'" +
            // geom_data.souvenir.features[i].properties["id"] +
            // "'" +
            // "," +
            // "'" +
            // "SOUVENIR" +
            // "'" +
            // ')"><i class="fa fa-info-circle"></i></button></td>' +
            // "  </tr>" +
            "</tbody>" +
            "</table>" +
            "<div class='d-flex justify-content-center'><button style='margin:5px;' class='btn btn-outline-primary' onclick='directionNonTourism()'><i class='fa-solid fa-route'></i></button><button style='margin:5px;' class='btn btn-outline-primary' onclick='infoList(" +
            '"' +
            geom_data.souvenir.features[i].properties["id"] +
            '"' +
            "," +
            '"' +
            "SOUVENIR" +
            '"' +
            ")'><i class='fa fa-info-circle'></i></button></div>";
          markerSouvenir[i] = new google.maps.Marker({
            position: posData,
            map,
            title: "Souvenir",
            info: contentString,
            icon: urlAplikasi + "media/icon/marker_sp.png",
          });

          $("#makeSouvenir")
            .find("tbody")
            .append(
              $("<tr>")
                .append(
                  $("<td>").append(
                    $(
                      "<div>" +
                        geom_data.souvenir.features[i].properties["name"] +
                        "</div>"
                    )
                  )
                )
                .append(
                  $("<td width='60px'>").append(
                    $(
                      '<button onclick="dirrectionManual(' +
                        x +
                        "," +
                        y +
                        "," +
                        c +
                        "," +
                        a +
                        ')" class="btn btn-primary"><i class="fa-solid fa-route"></i></button>'
                    )
                  )
                )
            );

          infowindow = new google.maps.InfoWindow({
            content: contentString,
            ariaLabel: "Uluru",
          });

          google.maps.event.addListener(
            markerSouvenir[i],
            "click",
            function () {
              infowindow.setContent(this.info);
              infowindow.open(map, this);

              latDetail = this.getPosition().lat();
              lngDetail = this.getPosition().lng();

              let posData = {
                lat: parseFloat(latDetail),
                lng: parseFloat(lngDetail),
              };

              lat = parseFloat(latDetail);
              lng = parseFloat(lngDetail);

              // GPSLocation =  {
              //     lat: parseFloat(latDetail),
              //     lng: parseFloat(lngDetail)
              // };
              // deletemaerker

              // Tambahkan Rute otomatis jika marker di klik
              // placeMarker(GPSLocation, lng, lat);
              // markerA.setMap(null);
              // markerB.setMap(null);
              // markerRouteStart .setMap(null);

              // setMapOnAll(null);
              // markerArray=[];

              $("#radiusRange").prop("disabled", false);
              $("#radiusRange").prop("disabled", false);
              $("#worship").prop("disabled", false);
              $("#culinary").prop("disabled", false);
              $("#event").prop("disabled", false);
              $("#souvenir").prop("disabled", false);
              $("#homestay").prop("disabled", false);

              // markerSouvenir[0] = new google.maps.Marker({
              //     position: posData,
              //     map,
              //     title: "Hello World!",
              //     info: contentString,
              //     icon: urlAplikasi+"media/icon/marker_sp.png" ,
              // });
            }
          );
          i++;
        }

        // End while

        i = 0;
        let length_facility = geom_data.facility.features.length;
        console.log(geom_data.facility);

        // show culinary
        while (i < length_facility) {
          let x = geom_data.facility.features[i].properties["x"];
          let y = geom_data.facility.features[i].properties["y"];
          let a = GPSLocation.lng;
          let c = GPSLocation.lat;
          let posData = {
            lat: parseFloat(y),
            lng: parseFloat(x),
          };
          contentString =
            '<table class="table">' +
            "<thead>" +
            "  <tr>" +
            '    <th class="tg-0lax">' +
            geom_data.facility.features[i].properties["name"] +
            "</th>" +
            // '    <th class="tg-0lax">Info</th>' +
            "  </tr>" +
            "</thead>" +
            "<tbody>" +
            "  <tr>" +
            '    <td class="tg-0lax" style="text-align: center;"><i class="fa fa-mountain-sun"></i>&nbsp Tourism Object</td>' +
            // '    <td class="tg-0lax">' +
            // geom_data.facility.features[i].properties["name"] +
            // "</td>" +
            "  </tr>" +
            // "  <tr>" +
            // '    <td class="tg-0lax">Name</td>' +
            // '    <td class="tg-0lax">' +
            // geom_data.facility.features[i].properties["name"] +
            // "</td>" +
            // "  </tr>" +
            // "  <tr>" +
            // '    <td class="tg-0lax">Open</td>' +
            // '    <td class="tg-0lax">' +
            // geom_data.facility.features[i].properties["open"] +
            // "</td>" +
            // "  </tr>" +
            // "  <tr>" +
            // '    <td class="tg-0lax">Close</td>' +
            // '    <td class="tg-0lax">' +
            // geom_data.facility.features[i].properties["close"] +
            // "</td>" +
            // "  </tr>" +
            // "  <tr>" +
            // '    <td class="tg-0lax">Ticket Price</td>' +
            // '    <td class="tg-0lax">' +
            // geom_data.facility.features[0].properties["ticket_price"] +
            // "</td>" +
            // "  </tr>" +
            "</tbody>" +
            "</table>" +
            "";
          markerFacility[i] = new google.maps.Marker({
            position: posData,
            map,
            title: "Tourism Object",
            info: contentString,
            icon: urlAplikasi + "media/icon/marker_to.png",
          });

          infowindow = new google.maps.InfoWindow({
            content: contentString,
            ariaLabel: "Uluru",
          });

          google.maps.event.addListener(
            markerFacility[i],
            "click",
            function () {
              infowindow.setContent(this.info);
              infowindow.open(map, this);
              for (let i = 0; i < markerFacilityTemp.length; i++) {
                markerFacilityTemp[i].setMap(null);
              }

              latDetail = this.getPosition().lat();
              lngDetail = this.getPosition().lng();

              let posData = {
                lat: parseFloat(latDetail),
                lng: parseFloat(lngDetail),
              };

              GPSLocation = {
                lat: parseFloat(latDetail),
                lng: parseFloat(lngDetail),
              };

              lat = parseFloat(latDetail);
              lng = parseFloat(lngDetail);
              // deletemaerker

              // setMapOnAll(null);
              // markerArray=[];

              $("#radiusRange").prop("disabled", false);
              $("#radiusRange").prop("disabled", false);
              $("#worship").prop("disabled", false);
              $("#culinary").prop("disabled", false);
              $("#event").prop("disabled", false);
              $("#souvenir").prop("disabled", false);
              $("#homestay").prop("disabled", false);

              // markerFacility[0] = new google.maps.Marker({
              //     position: posData,
              //     map,
              //     title: "Hello World!",
              //     info: contentString,
              //     icon: urlAplikasi+"media/icon/marker_to.png",
              // });
            }
          );
          i++;
        }

        // End while
      }
    }
  );
}

function radiusDetail() {
  // alert("test");
  if (countDirection > 0) {
    markerB.setMap(null);
    directionsRenderer1.setMap(null);
    directionsRenderer2.setMap(null);
    countDirection = 0;
  } else {
  }
  console.log("sini masuk 1");
  // Ubah ukuran circle
  if (radiusStart == 0) {
  } else {
    radiusCircle.setMap(null);
  }

  let radiusValue = $("#radiusRange").val();
  // alert(radiusValue);
  // $("#valueMeter").text(radiusValue + " Meter");
  // $("#typeRadius").val(radiusValue);

  // Panggil pakai AJAX ke database pakai fungsi spasial

  // Ubah GPSLocation menjadi string
  console.log("sini masuk 2");
  console.log(GPSLocation);

  // markerCentered = new google.maps.Marker({
  //     position: GPSLocation,
  //     map,
  //     title: "Hello World!",
  //     info: contentString
  // });

  gpsText = GPSLocation.lat + "A" + GPSLocation.lng;
  // console.log(gpsText);

  radiusCircle = new google.maps.Circle({
    strokeColor: "#FF0000",
    strokeOpacity: 0.8,
    strokeWeight: 2,
    fillColor: "#FF0000",
    fillOpacity: 0.35,
    map,
    center: GPSLocation,
    radius: parseInt(radiusValue),
    clickable: false,
  });

  radiusStart++;
}

function setBaseUrl(url) {
  baseUrl = url;
}

function infoDetail(id) {
  window.location.href = urlAplikasi + "web/detail/" + id;
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

    zoomControl: true,
    mapTypeControl: true,
    scaleControl: true,
    streetViewControl: true,
    rotateControl: true,
    fullscreenControl: true,
  });
  //Tampilkan Legend

  map.setOptions({ styles: styles["hide"] });
  const iconBase = urlAplikasi + "media/icon/";
  const icons = {
    culinary: {
      name: "Culinary",
      icon: iconBase + "marker_cp.png",
    },
    souvenir: {
      name: "Souvenir",
      icon: iconBase + "marker_sp.png",
    },
    homestay: {
      name: "Homestay",
      icon: iconBase + "marker_hs.png",
    },
    worship: {
      name: "Worship",
      icon: iconBase + "marker_wp.png",
    },
    event: {
      name: "Event",
      icon: iconBase + "marker_ev.png",
    },
    tourism: {
      name: "Tourism Object",
      icon: iconBase + "marker_to.png",
    },
  };

  const legend = document.getElementById("legend");

  for (const key in icons) {
    const type = icons[key];
    const name = type.name;
    const icon = type.icon;
    const div = document.createElement("div");

    div.innerHTML = '<img src="' + icon + '"> ' + name;
    legend.appendChild(div);
  }

  map.controls[google.maps.ControlPosition.RIGHT_BOTTOM].push(legend);

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
  // //console.log(markerArray);
  $.get(urlAplikasi + "web/select_id_tourism/" + id, function (data) {
    xyPoint = JSON.parse(data);
    // //console.log();
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
      '    <th class="tg-0lax">' +
      xyPoint.features[0].properties["name"] +
      "</th>" +
      "  </tr>" +
      "</thead>" +
      "<tbody>" +
      "  <tr>" +
      '    <td class="tg-0lax" style="text-align: center;"><i class="fa fa-mountain-sun"></i>&nbsp Tourism Object</td>' +
      "  </tr>" +
      "</table>" +
      "<br/><div class='d-flex justify-content-center'><button style='margin:5px;' onclick='infoDetail(" +
      '"' +
      xyPoint.features[0].properties["id"] +
      '"' +
      ")' class='btn btn-outline-primary'><i class='fa-solid fa-info-circle'></i></button>&nbsp<button style='margin:5px;' onclick='dirrectionPointX(" +
      x +
      "," +
      y +
      ")' class='btn btn-outline-primary'><i class='fa-solid fa-route'></i></button></div>";
    tempArray = new google.maps.Marker({
      position: posData,
      map,
      title: "Tourism Object",
      info: contentStringX,
      icon: urlAplikasi + "media/icon/marker_to.png",
    });

    infowindow = new google.maps.InfoWindow({
      content: contentStringX,
      ariaLabel: "Uluru",
    });

    google.maps.event.addListener(tempArray, "click", function () {
      infowindow.setContent(this.info);
      infowindow.open(map, this);
      // console.log(this.getPosition());
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
    // alert("KLIK");
    $.get(urlAplikasi + "web/select_id_tourism/" + id, function (data) {
      xyPoint = JSON.parse(data);
      // //console.log();
      let x = xyPoint.features[0].properties["x"];
      let y = xyPoint.features[0].properties["y"];

      placeMarker(event.latLng, x, y);
    });
  });

  setMapOnAll(null);

  //console.log("test");
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
      icon: urlAplikasi + "media/icon/marker_rs.png",
      animation: google.maps.Animation.DROP,
    });
  } else {
    markerRouteStart.setPosition(location);
  }
  //console.log("MANUAL");
  let lat_y = markerRouteStart.getPosition().lat();
  let lng_x = markerRouteStart.getPosition().lng();
  //console.log(lat_y)
  //console.log(lng_x)
  //console.log(x)
  //console.log(y)

  dirrectionManual(x, y, lat_y, lng_x);

  // countArray = countArray + 1;
}

function setMapOnAll(map) {
  for (let i = 0; i < markerArray.length; i++) {
    markerArray[i].setMap(map);
  }
}

function setResultMap(map) {
  for (let i = 0; i < markerArray.length; i++) {
    markerArray[i].setMap(map);
  }
  for (let i = 0; i < markerCulinary.length; i++) {
    markerCulinary[i].setMap(map);
  }
  for (let i = 0; i < markerEvent.length; i++) {
    markerEvent[i].setMap(map);
  }
  for (let i = 0; i < markerSouvenir.length; i++) {
    markerSouvenir[i].setMap(map);
  }
  for (let i = 0; i < markerWorship.length; i++) {
    markerWorship[i].setMap(map);
  }
  for (let i = 0; i < markerHomestay.length; i++) {
    markerHomestay[i].setMap(map);
  }
  for (let i = 0; i < markerFacility.length; i++) {
    markerFacility[i].setMap(map);
  }
  for (let i = 0; i < manualmarker.length; i++) {
    manualmarker[i].setMap(map);
  }
}
function hideElement() {
  var x = document.getElementById("legend");
  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
}

function hideSearchAll() {
  allHide_UserJS();
  var x = document.getElementById("search_object");
  var y = document.getElementById("search-object");
  if (x.style.display === "none") {
    x.style.display = "block";
    y.style.display = "none";
  } else {
    x.style.display = "none";
    y.style.display = "block";
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
    icon: urlAplikasi + "media/icon/marker_rs.png",
  });

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
  // directionsRenderer1.setPanel(document.getElementById("panelRender"));
  // FIX_THIS

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
        markerA.setVisible(false);
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

        markerA.setVisible(true);
        markerB.setVisible(true);
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
        des_lat = posData.lat;
        des_lng = posData.lng;

        or_lat = pos.lat;
        or_lng = pos.lng;

        let string_coordinat =
          "destination=" +
          des_lat +
          "," +
          des_lng +
          "&origin=" +
          or_lat +
          "," +
          or_lng;
        //         $.getJSON('https://maps.googleapis.com/maps/api/directions/json?'+string_coordinat+'&key=AIzaSyB8B04MTIk7abJDVESr6SUF6f3Hgt1DPAY&language=id', function(data) {
        // console.log(data);
        //     });

        // $.ajax({
        //     type: "GET",
        //     url: 'https://maps.googleapis.com/maps/api/directions/json?'+string_coordinat+'&key=AIzaSyB8B04MTIk7abJDVESr6SUF6f3Hgt1DPAY&language=id',
        //     async:true,
        //     dataType : 'jsonp',   //you may use jsonp for cross origin request
        //     crossDomain:true,
        //     success: function(data) {

        //       console.log(data);
        //     }
        //   });

        directionsService.route(
          {
            origin: pos,
            destination: posData,
            travelMode: "DRIVING",
            provideRouteAlternatives: true,
          },
          function (response, status) {
            $("#dinamisDistance").show();
            let put = 0;
            let length = response.routes[0].legs[0].steps.length;
            $("#panelRenderX > tbody").html("");
            while (put < length) {
              inst = response.routes[0].legs[0].steps[put].instructions;
              dis = response.routes[0].legs[0].steps[put].distance.text;
              inst = inst.toString();

              // console.log(response.routes[0].legs[0].steps[put].instructions);
              $("#panelRenderX > tbody").append(
                "<tr><td>" + dis + "</td><td>" + inst + "</td></tr>"
              );
              // $( "#panelRender" ).append( response.routes[0].legs[0].steps[put].instructions );
              put++;
            }
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
              //console.log(response);
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

let countClick = 0;

function dirrectionPointTemp(x, y) {
  if (countClick > 0) {
    markerA.setMap(null);
    markerB.setMap(null);
    directionsRenderer1.setMap(null);
    directionsRenderer2.setMap(null);
  }
  $("#panelRender").empty();
  $("#dinamisDistance").show();

  markerA = new google.maps.Marker({
    map: map,
    icon: urlAplikasi + "media/icon/marker_rs.png",
  });

  markerB = new google.maps.Marker({
    map: map,
    icon: urlAplikasi + "media/icon/marker_to.png",
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
  //   directionsRenderer1.setPanel(document.getElementById("panelRender"));
  // FIX_THIS

  // Try HTML5 geolocation.
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(
      function (position) {
        var pos = {
          lat: position.coords.latitude,
          lng: position.coords.longitude,
        };

        console.log(pos);
        var posB = {
          lat: parseFloat(y),
          lng: parseFloat(x),
        };

        map.setCenter(pos);
        map.setZoom(20);
        //Put markers on the place
        infoWindow.setContent("Your Location");
        markerA.setPosition(pos);
        markerB.setPosition(posB);
        markerA.setVisible(false);
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
        markerA.setVisible(true);
        markerB.setVisible(true);
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

        des_lat = posData.lat;
        des_lng = posData.lng;

        or_lat = pos.lat;
        or_lng = pos.lng;

        let string_coordinat =
          "destination=" +
          des_lat +
          "," +
          des_lng +
          "&origin=" +
          or_lat +
          "," +
          or_lng;

        directionsService.route(
          {
            origin: pos,
            destination: posData,
            travelMode: "DRIVING",
            provideRouteAlternatives: true,
          },
          function (response, status) {
            console.log(response);
            console.log(response.routes[0].legs[0].steps);
            let put = 0;
            let length = response.routes[0].legs[0].steps.length;
            $("#panelRenderX > tbody").html("");
            while (put < length) {
              inst = response.routes[0].legs[0].steps[put].instructions;
              dis = response.routes[0].legs[0].steps[put].distance.text;
              inst = inst.toString();

              // console.log(response.routes[0].legs[0].steps[put].instructions);
              $("#panelRenderX > tbody").append(
                "<tr><td>" + dis + "</td><td>" + inst + "</td></tr>"
              );
              // $( "#panelRender" ).append( response.routes[0].legs[0].steps[put].instructions );
              put++;
            }

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
              countClick++;
              //console.log(response);
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
  if (countDirection != 0) {
    markerA.setMap(null);
    directionsRenderer1.setMap(null);
    directionsRenderer2.setMap(null);
    countDirection = 0;
  }
  $("#panelRender").empty();
  $("#dinamisDistance").show();

  markerA = new google.maps.Marker({
    map: map,
    // icon: urlAplikasi + "media/icon/marker_to.png",
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
  // directionsRenderer1.setPanel(document.getElementById("panelRender"));
  // FIX_THIS

  var pos = {
    lat: parseFloat(lat_y),
    lng: parseFloat(lng_x),
  };

  map.setCenter(pos);
  map.setZoom(15);
  // FIX[1]
  //Put markers on the place
  infoWindow.setContent("Your Location");
  markerA.setPosition(pos);
  markerA.setVisible(true);
  // markerA.setLabel('A');
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

  des_lat = posData.lat;
  des_lng = posData.lng;

  or_lat = pos.lat;
  or_lng = pos.lng;

  let string_coordinat =
    "destination=" +
    des_lat +
    "," +
    des_lng +
    "&origin=" +
    or_lat +
    "," +
    or_lng;
  //     $.getJSON('https://maps.googleapis.com/maps/api/directions/json?'+string_coordinat+'&key=AIzaSyB8B04MTIk7abJDVESr6SUF6f3Hgt1DPAY&language=id', function(data) {
  // console.log(data);
  // });
  // $.ajax({
  //     type: "GET",
  //     url: 'https://maps.googleapis.com/maps/api/directions/json?'+string_coordinat+'&key=AIzaSyB8B04MTIk7abJDVESr6SUF6f3Hgt1DPAY&language=id',
  //     async:true,
  //     dataType : 'jsonp',   //you may use jsonp for cross origin request
  //     crossDomain:true,
  //     success: function(data) {

  //       console.log(data);
  //     }
  //   });
  directionsService.route(
    {
      origin: pos,
      destination: posData,
      travelMode: "DRIVING",
      provideRouteAlternatives: true,
    },
    function (response, status) {
      $("#dinamisDistance").show();
      let put = 0;
      let length = response.routes[0].legs[0].steps.length;
      $("#panelRenderX > tbody").html("");
      while (put < length) {
        inst = response.routes[0].legs[0].steps[put].instructions;
        dis = response.routes[0].legs[0].steps[put].distance.text;
        inst = inst.toString();

        // console.log(response.routes[0].legs[0].steps[put].instructions);
        $("#panelRenderX > tbody").append(
          "<tr><td>" + dis + "</td><td>" + inst + "</td></tr>"
        );
        // $( "#panelRender" ).append( response.routes[0].legs[0].steps[put].instructions );
        put++;
      }
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
        //console.log(response);
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
  setResultMap(null);

  infoWindow = new google.maps.InfoWindow();

  // Try HTML5 geolocation.
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(
      (position) => {
        GPSLocation = {
          lat: position.coords.latitude,
          lng: position.coords.longitude,
        };

        console.log(GPSLocation);
        markerposition = new google.maps.Marker({
          position: GPSLocation,
          map: map,
        });
        map.setCenter(GPSLocation);
        // infoWindow.setPosition(GPSLocation);

        infoWindow.setContent("Your Location");
        // infoWindow.open(map);

        markerposition.addListener("click", function () {
          infoWindow.open(map, markerposition);
        });
      },
      () => {
        handleLocationError(true, infoWindow, map.getCenter());
      }
    );
  } else {
    // Browser doesn't support Geolocation
    handleLocationError(false, infoWindow, map.getCenter());
  }
}

function radiusManual() {
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

  google.maps.event.addListener(map, "click", function (event) {
    setResultMap(null);

    manualmarker[0] = new google.maps.Marker({
      position: event.latLng,
      map: map,
    });
    let lat = event.latLng.lat();
    let lng = event.latLng.lng();

    GPSLocation = {
      lat: parseFloat(lat),
      lng: parseFloat(lng),
    };

    manualAuto++;
  });
}

function radiusChangeTourism() {
  if (countDirection > 0) {
    markerB.setMap(null);
    directionsRenderer1.setMap(null);
    directionsRenderer2.setMap(null);
    countDirection = 0;
  } else {
  }
  console.log("sini masuk 1");
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
    console.log("sini masuk 2");

    gpsText = GPSLocation.lat + "A" + GPSLocation.lng;
    $("#makeTable tbody tr").remove();
    // console.log(gpsText);

    $.get(
      urlAplikasi + "web/radius_data_tourism/" + radiusValue + "/" + gpsText,
      function (data) {
        //console.log(urlAplikasi + "web/radius_data/" + radiusValue + "/" + gpsText)
        // console.log(data);
        // Hapus semua marker lebih dahulu
        // setMapOnAll(null);
        hideMarkers();
        // //console.log(data.length);
        setMapOnAllTemp(null);

        if (data.length > 42) {
          // Marker Array Temporary

          let dataData = JSON.parse(data);
          console.log(dataData);
          let i = 0;
          let length = dataData.features.length;

          while (i < length) {
            //console.log("GPSLocation");
            //console.log(GPSLocation);
            //console.log("GPSLocation");

            let x = dataData.features[i].properties["x"];
            let y = dataData.features[i].properties["y"];
            let a = GPSLocation.lng;
            let b = GPSLocation.lat;
            let posData = {
              lat: parseFloat(y),
              lng: parseFloat(x),
            };

            if (manualAuto > 0) {
              //         contentString =
              //         '<table class="table">' +
              //         '<thead>' +
              //         '  <tr>' +
              //         '    <th class="tg-0lax">Item</th>' +
              //         '    <th class="tg-0lax">Info</th>' +
              //         '  </tr>' +
              //         '</thead>' +
              //         '<tbody>' +
              //         '  <tr>' +
              // '    <td class="tg-0lax">Name</td>' +
              // '    <td class="tg-0lax">' + dataData.features[i].properties['name'] + '</td>' +
              // '  </tr>' +
              // '  <tr>' +
              // '    <td class="tg-0lax">Address</td>' +
              // '    <td class="tg-0lax">' + dataData.features[i].properties['address'] + '</td>' +
              // '  </tr>' +
              // '  <tr>' +
              // '    <td class="tg-0lax">Open</td>' +
              // '    <td class="tg-0lax">' + dataData.features[i].properties['open'] + '</td>' +
              // '  </tr>' +
              // '  <tr>' +
              // '    <td class="tg-0lax">Close</td>' +
              // '    <td class="tg-0lax">' + dataData.features[i].properties['close'] + '</td>' +
              // '  </tr>' +
              // '  <tr>' +
              // '    <td class="tg-0lax">Ticket Price</td>' +
              // '    <td class="tg-0lax">' + dataData.features[i].properties['ticket_price'] + '</td>' +
              // '  </tr>' +
              // '</tbody>' +
              // '</table>' + "<br/><div class='d-flex justify-content-center'><button style='margin:5px;' onclick='infoDetail(" + '"' + dataData.features[i].properties['id'] + '"' +")' class='btn btn-outline-primary'><i class='fa-solid fa-info-circle'></i></button>&nbsp<button style='margin:5px;' onclick='dirrectionManual(" + x + "," + y +","+ b+","+a+")' class='btn btn-outline-primary'><i class='fa-solid fa-route'></i></button></div>";
              contentString =
                '<table class="table">' +
                "<thead>" +
                "  <tr>" +
                '    <th class="tg-0lax">' +
                dataData.features[i].properties["name"] +
                "</th>" +
                "  </tr>" +
                "</thead>" +
                "<tbody>" +
                "  <tr>" +
                '    <td class="tg-0lax" style="text-align: center;"><i class="fa fa-mountain-sun"></i>&nbsp Tourism Object</td>' +
                "</td>" +
                "  </tr>" +
                // "  <tr>" +
                // '    <td class="tg-0lax"  style="text-align: center;">Rp' +
                // dataData.features[i].properties["ticket_price"] +
                // "</td>" +
                // "  </tr>" +
                "</table>" +
                "<br/><div class='d-flex justify-content-center'><button style='margin:5px;' onclick='infoDetail(" +
                '"' +
                dataData.features[i].properties["id"] +
                '"' +
                ")' class='btn btn-outline-primary'><i class='fa-solid fa-info-circle'></i></button>&nbsp<button style='margin:5px;' onclick='dirrectionManual(" +
                x +
                "," +
                y +
                "," +
                b +
                "," +
                a +
                ")' class='btn btn-outline-primary'><i class='fa-solid fa-route'></i></button></div>";
            } else {
              contentString =
                '<table class="table">' +
                "<thead>" +
                "  <tr>" +
                '    <th class="tg-0lax">' +
                dataData.features[i].properties["name"] +
                "</th>" +
                // '    <th class="tg-0lax">Info</th>' +
                "  </tr>" +
                "</thead>" +
                "<tbody>" +
                "  <tr>" +
                // '    <td class="tg-0lax">Name</td>' +
                // '    <td class="tg-0lax">' +
                // dataData.features[i].properties["name"] +
                // "</td>" +
                '    <td class="tg-0lax" style="text-align: center;"><i class="fa fa-mountain-sun"></i>&nbsp Tourism Object</td>' +
                "</td>" +
                "  </tr>" +
                "  </tr>" +
                // "  <tr>" +
                // '    <td class="tg-0lax">Address</td>' +
                // '    <td class="tg-0lax">' +
                // dataData.features[i].properties["address"] +
                // "</td>" +
                // "  </tr>" +
                // "  <tr>" +
                // '    <td class="tg-0lax">Open</td>' +
                // '    <td class="tg-0lax">' +
                // dataData.features[i].properties["open"] +
                // "</td>" +
                // "  </tr>" +
                // "  <tr>" +
                // '    <td class="tg-0lax">Close</td>' +
                // '    <td class="tg-0lax">' +
                // dataData.features[i].properties["close"] +
                // "</td>" +
                // "  </tr>" +
                // "  <tr>" +
                // '    <td class="tg-0lax">Ticket Price</td>' +
                // '    <td class="tg-0lax">' +
                // dataData.features[i].properties["ticket_price"] +
                "</td>" +
                "  </tr>" +
                "</tbody>" +
                "</table>" +
                "<br/><div class='d-flex justify-content-center'><button style='margin:5px;' onclick='infoDetail(" +
                '"' +
                dataData.features[i].properties["id"] +
                '"' +
                ")' class='btn btn-outline-primary'><i class='fa-solid fa-info-circle'></i></button>&nbsp<button style='margin:5px;' onclick='dirrectionPointTemp(" +
                x +
                "," +
                y +
                ")' class='btn btn-outline-primary'><i class='fa-solid fa-route'></i></button></div>";
            }

            // Tambahkan tabel ke bagian samping
            $("#makeTable")
              .find("tbody")
              .append(
                $("<tr>")
                  .append(
                    $("<td>").append(
                      $(
                        "<div>" +
                          dataData.features[i].properties["name"] +
                          "</div>"
                      )
                    )
                  )
                  .append(
                    $("<td width='60px'>").append(
                      $(
                        '<button onclick="dirrectionManual(' +
                          x +
                          "," +
                          y +
                          "," +
                          b +
                          "," +
                          a +
                          ')" id="show_mark" class="btn btn-primary"><i class="fa-solid fa-eye"></i></button>'
                      )
                    )
                  )
                //     .append($('<td>')
                //     .append($(' <td><button onclick="mapView('+"'"+dataData.features[0].properties['id']+"'"+')" style="margin-left:5px;" class="btn btn-outline-primary"><i class="fa-solid fa-eye"></i></button></td>' )

                //     )
                // )
              );

            markerArrayTemp[i] = new google.maps.Marker({
              position: posData,
              map,
              title: "Tourism Object",
              info: contentString,
              icon: urlAplikasi + "media/icon/marker_to.png",
            });

            infowindow = new google.maps.InfoWindow({
              content: contentString,
              ariaLabel: "Uluru",
            });

            google.maps.event.addListener(show_mark, "click", function () {
              infowindow.setContent(this.info);
              infowindow.open(map, this);
            });
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
      clickable: false,
    });

    radiusStart++;
  }
  //console.log("GPS LOCATION");
  //console.log(GPSLocation);
  // alert(radiusValue);
}

function radiusChange() {
  if (countDirection > 0) {
    markerB.setMap(null);
    directionsRenderer1.setMap(null);
    directionsRenderer2.setMap(null);
    countDirection = 0;
  } else {
  }
  console.log("sini masuk 1");
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
    console.log("sini masuk 2");

    gpsText = GPSLocation.lat + "A" + GPSLocation.lng;
    $("#makeTable tbody tr").remove();
    // console.log(gpsText);

    $.get(
      urlAplikasi + "web/radius_data/" + radiusValue + "/" + gpsText,
      function (data) {
        //console.log(urlAplikasi + "web/radius_data/" + radiusValue + "/" + gpsText)
        // console.log(data);
        // Hapus semua marker lebih dahulu
        // setMapOnAll(null);
        hideMarkers();
        // //console.log(data.length);
        setMapOnAllTemp(null);

        if (data.length > 42) {
          // Marker Array Temporary

          let dataData = JSON.parse(data);
          console.log(dataData);
          let i = 0;
          let length = dataData.features.length;

          while (i < length) {
            //console.log("GPSLocation");
            //console.log(GPSLocation);
            //console.log("GPSLocation");

            let x = dataData.features[i].properties["x"];
            let y = dataData.features[i].properties["y"];
            let a = GPSLocation.lng;
            let b = GPSLocation.lat;
            let posData = {
              lat: parseFloat(y),
              lng: parseFloat(x),
            };

            if (manualAuto > 0) {
              contentString =
                '<table class="table">' +
                "<thead>" +
                "  <tr>" +
                '    <th class="tg-0lax">' +
                dataData.features[i].properties["name"] +
                "</th>" +
                '    <th class="tg-0lax">Info</th>' +
                "  </tr>" +
                "</thead>" +
                "<tbody>" +
                "  <tr>" +
                // '    <td class="tg-0lax">Name</td>' +
                // '    <td class="tg-0lax">';
                '    <td class="tg-0lax" style="text-align: center;"><i class="fa fa-mountain-sun"></i>&nbsp Tourism Object</td>' +
                "</td>" +
                "  </tr>" +
                // "  <tr>" +
                // '    <td class="tg-0lax">Address</td>' +
                // '    <td class="tg-0lax">' +
                // dataData.features[i].properties["address"] +
                // "</td>" +
                // "  </tr>" +
                // "  <tr>" +
                // '    <td class="tg-0lax">Open</td>' +
                // '    <td class="tg-0lax">' +
                // dataData.features[i].properties["open"] +
                // "</td>" +
                // "  </tr>" +
                // "  <tr>" +
                // '    <td class="tg-0lax">Close</td>' +
                // '    <td class="tg-0lax">' +
                // dataData.features[i].properties["close"] +
                // "</td>" +
                // "  </tr>" +
                // "  <tr>" +
                // '    <td class="tg-0lax">Ticket Price</td>' +
                // '    <td class="tg-0lax">' +
                // dataData.features[i].properties["ticket_price"] +
                // "</td>" +
                // "  </tr>" +
                "</tbody>" +
                "</table>" +
                "<br/><div class='d-flex justify-content-center'><button style='margin:5px;' onclick='infoDetail(" +
                '"' +
                dataData.features[i].properties["id"] +
                '"' +
                ")' class='btn btn-outline-primary'><i class='fa-solid fa-info-circle'></i></button>&nbsp<button style='margin:5px;' onclick='dirrectionManual(" +
                x +
                "," +
                y +
                "," +
                b +
                "," +
                a +
                ")' class='btn btn-outline-primary'><i class='fa-solid fa-route'></i></button></div>";
            } else {
              contentString =
                '<table class="table">' +
                "<thead>" +
                "  <tr>" +
                '    <th class="tg-0lax">' +
                dataData.features[i].properties["name"] +
                "</th>" +
                '    <th class="tg-0lax">Info</th>' +
                "  </tr>" +
                "</thead>" +
                "<tbody>" +
                "  <tr>" +
                // '    <td class="tg-0lax">Name</td>' +
                // '    <td class="tg-0lax">';
                '    <td class="tg-0lax" style="text-align: center;"><i class="fa fa-mountain-sun"></i>&nbsp Tourism Object</td>' +
                "</td>" +
                "  </tr>" +
                // "  <tr>" +
                // '    <td class="tg-0lax">Address</td>' +
                // '    <td class="tg-0lax">' +
                // dataData.features[0].properties["address"] +
                // "</td>" +
                // "  </tr>" +
                // "  <tr>" +
                // '    <td class="tg-0lax">Open</td>' +
                // '    <td class="tg-0lax">' +
                // dataData.features[0].properties["open"] +
                // "</td>" +
                // "  </tr>" +
                // "  <tr>" +
                // '    <td class="tg-0lax">Close</td>' +
                // '    <td class="tg-0lax">' +
                // dataData.features[0].properties["close"] +
                // "</td>" +
                // "  </tr>" +
                // "  <tr>" +
                // '    <td class="tg-0lax">Ticket Price</td>' +
                // '    <td class="tg-0lax">' +
                // dataData.features[0].properties["ticket_price"] +
                // "</td>" +
                // "  </tr>" +
                "</tbody>" +
                "</table>" +
                "<br/><div class='d-flex justify-content-center'><button style='margin:5px;' onclick='infoDetail(" +
                '"' +
                dataData.features[0].properties["id"] +
                '"' +
                ")' class='btn btn-outline-primary'><i class='fa-solid fa-info-circle'></i></button>&nbsp<button style='margin:5px;' onclick='dirrectionPointTemp(" +
                x +
                "," +
                y +
                ")' class='btn btn-outline-primary'><i class='fa-solid fa-route'></i></button></div>";
            }

            // Tambahkan tabel ke bagian samping
            $("#makeTable")
              .find("tbody")
              .append(
                $("<tr>")
                  .append(
                    $("<td>").append(
                      $(
                        "<div>" +
                          dataData.features[i].properties["name"] +
                          "</div>"
                      )
                    )
                  )
                  .append(
                    $("<td width='60px'>").append(
                      $(
                        '<button onclick="dirrectionManual(' +
                          x +
                          "," +
                          y +
                          "," +
                          b +
                          "," +
                          a +
                          ')" class="btn btn-primary"><i class="fa-solid fa-route"></i></button>'
                      )
                    )
                  )
                //     .append($('<td>')
                //     .append($(' <td><button onclick="mapView('+"'"+dataData.features[0].properties['id']+"'"+')" style="margin-left:5px;" class="btn btn-outline-primary"><i class="fa-solid fa-eye"></i></button></td>' )

                //     )
                // )
              );

            markerArrayTemp[i] = new google.maps.Marker({
              position: posData,
              map,
              title: "Tourism Object",
              info: contentString,
              icon: urlAplikasi + "media/icon/marker_to.png",
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
      clickable: false,
    });

    radiusStart++;
  }
  //console.log("GPS LOCATION");
  //console.log(GPSLocation);
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

    gpsText = GPSLocation.lat + "A" + GPSLocation.lng;

    $.get(
      urlAplikasi + "web/radius_data/" + radiusValue + "/" + gpsText,
      function (data) {
        //console.log(urlAplikasi + "web/radius_data/" + radiusValue + "/" + gpsText)
        // //console.log(data);
        // Hapus semua marker lebih dahulu
        // setMapOnAll(null);
        hideMarkers();
        // //console.log(data.length);
        setMapOnAllTemp(null);

        if (data.length > 42) {
          // Marker Array Temporary

          let dataData = JSON.parse(data);
          //console.log(dataData);
          let i = 0;
          let length = dataData.features.length;

          while (i < length) {
            //console.log("GPSLocation");
            //console.log(GPSLocation);
            //console.log("GPSLocation");

            let x = dataData.features[i].properties["x"];
            let y = dataData.features[i].properties["y"];
            let a = GPSLocation.lng;
            let b = GPSLocation.lat;
            let posData = {
              lat: parseFloat(y),
              lng: parseFloat(x),
            };

            contentString =
              '<table class="table">' +
              "<thead>" +
              "  <tr>" +
              '    <th class="tg-0lax">' +
              dataData.features[0].properties["name"] +
              "</th>" +
              '    <th class="tg-0lax">Info</th>' +
              "  </tr>" +
              "</thead>" +
              "<tbody>" +
              "  <tr>" +
              // // '    <td class="tg-0lax">Name</td>' +
              // '    <td class="tg-0lax">';
              '    <td class="tg-0lax" style="text-align: center;"><i class="fa fa-mountain-sun"></i>&nbsp Tourism Object</td>' +
              "</td>" +
              "  </tr>" +
              // "  <tr>" +
              // '    <td class="tg-0lax">Open</td>' +
              // '    <td class="tg-0lax">' +
              // dataData.features[0].properties["open"] +
              // "</td>" +
              // "  </tr>" +
              // "  <tr>" +
              // '    <td class="tg-0lax">Close</td>' +
              // '    <td class="tg-0lax">' +
              // dataData.features[0].properties["close"] +
              // "</td>" +
              // "  </tr>" +
              // "  <tr>" +
              // '    <td class="tg-0lax">Ticket Price</td>' +
              // '    <td class="tg-0lax">' +
              // dataData.features[0].properties["ticket_price"] +
              // "</td>" +
              // "  </tr>" +
              "</tbody>" +
              "</table>" +
              "<br/><div class='d-flex justify-content-center'><button style='margin:5px;' onclick='infoDetail(" +
              '"' +
              dataData.features[0].properties["id"] +
              '"' +
              ")' class='btn btn-outline-primary'><i class='fa-solid fa-info-circle'></i></button>&nbsp<button style='margin:5px;' onclick='dirrectionPointTemp(" +
              x +
              "," +
              y +
              ")' class='btn btn-outline-primary'><i class='fa-solid fa-route'></i></button></div>";
            markerArrayTemp[i] = new google.maps.Marker({
              position: posData,
              map,
              title: "Tourism Obect",
              info: contentString,
              icon: urlAplikasi + "media/icon/marker_to.png",
            });

            // Tambahkan tabel ke bagian samping
            $("#makeTable")
              .find("tbody")
              .append(
                $("<tr>")
                  .append(
                    $("<td>").append(
                      $(
                        "<div>" +
                          dataData.features[i].properties["name"] +
                          "</div>"
                      )
                    )
                  )
                  .append(
                    $("<td width='60px'>").append(
                      $(
                        '<button onclick="dirrectionManual(' +
                          x +
                          "," +
                          y +
                          "," +
                          b +
                          "," +
                          a +
                          ')" class="btn btn-primary"><i class="fa-solid fa-route"></i></button>'
                      )
                    )
                  )
                //     .append($('<td>')
                //     .append($(' <td><button onclick="mapView('+"'"+dataData.features[0].properties['id']+"'"+')" style="margin-left:5px;" class="btn btn-outline-primary"><i class="fa-solid fa-eye"></i></button></td>' )

                //     )
                // )
              );

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
      clickable: false,
    });

    radiusStart++;
  }
  // //console.log(GPSLocation);
  // alert(radiusValue);
}

function radiusChangeTypeTourism() {
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

    gpsText = GPSLocation.lat + "A" + GPSLocation.lng;

    $.get(
      urlAplikasi + "web/radius_data_tourism/" + radiusValue + "/" + gpsText,
      function (data) {
        //console.log(urlAplikasi + "web/radius_data/" + radiusValue + "/" + gpsText)
        // //console.log(data);
        // Hapus semua marker lebih dahulu
        // setMapOnAll(null);
        hideMarkers();
        // //console.log(data.length);
        setMapOnAllTemp(null);

        if (data.length > 42) {
          // Marker Array Temporary

          let dataData = JSON.parse(data);
          //console.log(dataData);
          let i = 0;
          let length = dataData.features.length;

          while (i < length) {
            //console.log("GPSLocation");
            //console.log(GPSLocation);
            //console.log("GPSLocation");

            let x = dataData.features[i].properties["x"];
            let y = dataData.features[i].properties["y"];
            let a = GPSLocation.lng;
            let b = GPSLocation.lat;
            let posData = {
              lat: parseFloat(y),
              lng: parseFloat(x),
            };

            contentString =
              '<table class="table">' +
              "<thead>" +
              "  <tr>" +
              '    <th class="tg-0lax">' +
              dataData.features[i].properties["name"] +
              "</th>" +
              '    <th class="tg-0lax">Info</th>' +
              "  </tr>" +
              "</thead>" +
              "<tbody>" +
              "  <tr>" +
              // '    <td class="tg-0lax">Name</td>' +
              // '    <td class="tg-0lax">';
              '    <td class="tg-0lax" style="text-align: center;"><i class="fa fa-mountain-sun"></i>&nbsp Tourism Object</td>' +
              "</td>" +
              "  </tr>" +
              // "  <tr>" +
              // '    <td class="tg-0lax">Open</td>' +
              // '    <td class="tg-0lax">' +
              // dataData.features[i].properties["open"] +
              // "</td>" +
              // "  </tr>" +
              // "  <tr>" +
              // '    <td class="tg-0lax">Close</td>' +
              // '    <td class="tg-0lax">' +
              // dataData.features[i].properties["close"] +
              // "</td>" +
              // "  </tr>" +
              // "  <tr>" +
              // '    <td class="tg-0lax">Ticket Price</td>' +
              // '    <td class="tg-0lax">' +
              // dataData.features[i].properties["ticket_price"] +
              // "</td>" +
              // "  </tr>" +
              "</tbody>" +
              "</table>" +
              "<br/><div class='d-flex justify-content-center'><button style='margin:5px;' onclick='infoDetail(" +
              '"' +
              dataData.features[i].properties["id"] +
              '"' +
              ")' class='btn btn-outline-primary'><i class='fa-solid fa-info-circle'></i></button>&nbsp<button style='margin:5px;' onclick='dirrectionPointTemp(" +
              x +
              "," +
              y +
              ")' class='btn btn-outline-primary'><i class='fa-solid fa-route'></i></button></div>";
            markerArrayTemp[i] = new google.maps.Marker({
              position: posData,
              map,
              title: "Tourism Object",
              info: contentString,
              icon: urlAplikasi + "media/icon/marker_to.png",
            });

            infowindow = new google.maps.InfoWindow({
              content: contentString,
              ariaLabel: "Uluru",
            });

            // Tambahkan tabel ke bagian samping
            $("#makeTable")
              .find("tbody")
              .append(
                $("<tr>")
                  .append(
                    $("<td>").append(
                      $(
                        "<div>" +
                          dataData.features[i].properties["name"] +
                          "</div>"
                      )
                    )
                  )
                  .append(
                    $("<td width='60px'>").append(
                      $(
                        '<button onclick="dirrectionManual(' +
                          x +
                          "," +
                          y +
                          "," +
                          b +
                          "," +
                          a +
                          ')" class="btn btn-primary"><i class="fa-solid fa-route"></i></button>'
                      )
                    )
                  )
                //     .append($('<td>')
                //     .append($(' <td><button onclick="mapView('+"'"+dataData.features[0].properties['id']+"'"+')" style="margin-left:5px;" class="btn btn-outline-primary"><i class="fa-solid fa-eye"></i></button></td>' )

                //     )
                // )
              );

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
      clickable: false,
    });

    radiusStart++;
  }
  // //console.log(GPSLocation);
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
