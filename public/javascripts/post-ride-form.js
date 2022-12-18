
window.initGoogleMap = initGoogleMapLoader;
// $(document).ready(function(){
// Set Google place API for from and to inputs

function initGoogleMapLoader (){
  new google.maps.event.addDomListener(window, "load", function(){
    console.log("Google load google map...")
    googleMapLoad()
  });


}

function googleMapLoad(){

  var GOOGLE_MARKER = {
    // 'blue': {
    //   url: 'http://maps.google.com/mapfiles/kml/paddle/blu-blank.png',
    //   // scaledSize: new google.maps.Size(42,42),
    //   // origin: new google.maps.Point(0,0), // origin
    //   // anchor: new google.maps.Point(0, 0) // anchor
    // },
    // 'red': {
    //   url: 'http://maps.google.com/mapfiles/kml/paddle/red-blank.png',
    //   // scaledSize: new google.maps.Size(42,42),
    //   // origin: new google.maps.Point(0,0), // origin
    //   // anchor: new google.maps.Point(0, 0) // anchor
    // }
  }
  if(typeof google !== "undefined"){







    var googleMapElements = $(".post-ride-google-map");

    // Ride Form place auto complete
    var rideGoogleMaps=[]
    var rideDepartureElement = document.getElementById("ride-departure");
    var rideDestinationElement = document.getElementById("ride-destination");
    var rideDepartureAutoComplete = new google.maps.places.Autocomplete(rideDepartureElement);
    var rideDestinationAutoComplete = new google.maps.places.Autocomplete(rideDestinationElement);

    var postRideElementObject = {
      "ride-departure": {
        autoComplete: rideDepartureAutoComplete,
        latElement: "#ride-departure-lat",
        lngElement: "#ride-departure-lng",
        mapElement: ".post-ride-google-map"
      },
      "ride-destination": {
        autoComplete: rideDestinationAutoComplete,
        latElement: "#ride-destination-lat",
        lngElement: "#ride-destination-lng",
        mapElement: ".post-ride-google-map"
      }
    };

    Object.keys(postRideElementObject).forEach((function(key, index){
      updateAndModifyPlaceDropdown(key, postRideElementObject[key]);
    }))



    function callRouteDisplay(rideGoogleMap, rideGoogleMarker, rideGoogleDestinationMarker, item){
      if(rideGoogleMarker.position && rideGoogleDestinationMarker && rideGoogleDestinationMarker.position){
        if(!rideGoogleDestinationMarker || !rideGoogleMarker){
          return
        }
        var startPosition = rideGoogleMarker.position;
        var endPosition = rideGoogleDestinationMarker.position;
        var routeObject = {
          origin: startPosition,
          destination: endPosition,
          travelMode: "DRIVING"
        };

        item['rideDirectionService'].route(routeObject, function(response, status){
          console.log(response)
          console.log("Response data,.,,")
          if(status === google.maps.DirectionsStatus.OK){
            item["rideDirectionRenderer"].setDirections(response)
            item['rideDirectionRenderer'].setMap(rideGoogleMap);
          }
          try{
            var bound = response.routes[0].bounds;
            console.log(bound);
            var leg = response.routes[0].legs[0];
            $("#ride-distance").val(leg.distance.text)
            $("#ride-time").val(leg.duration.text)

            if(item.infoWindow){
              try{
                if(item.infoWindow.getContent()){
                  item.infoWindow.close();
                }
              }catch (e) {

              }
            }

            var infoWindowContent = "<div class='info__wrapper__content'>" +
              "<div class='media media-time'>" +
              "<div class='media-left'><span class='fa fa-car'></span></div>" +
              "<div class='media-body'><h5 class='media-title'>"+(leg.duration.text)+"</h5></div>"+
              "</div>" +
              "<div class='media media-distance'>" +
              "<div class='media-body'><h5 class='media-title'>"+(leg.distance.text)+"</h5></div>"+
              "</div>"+
              "</div>"
            // var infoWindow = new google.maps.InfoWindow({
            //   content:infoWindowContent,
            //   position: bound.getCenter()
            // });

            var overviewPaths = response.routes[0].overview_path;
            var centerOverViewPathIndex = Math.round(overviewPaths.length/2)
            var centerOverviewPath = overviewPaths[centerOverViewPathIndex];
            var infoWindow = item.infoWindow;
            infoWindow.setOptions({
              content: infoWindowContent,
              position: centerOverviewPath
            });
            infoWindow.open(rideGoogleMap);

          }catch (e) {
            console.log(e)
            console.log("Inside call route display")
          }
        });
      }

      // console.log("Distance between 2 point")
      //
      // console.log(google.maps.geometry.spherical.computeDistanceBetween(startPosition, endPosition))
      // console.log("<<< Distance between 2 point...")

    }

    function reStructureBasedOnMarkerPoints(rideGoogleMap, rideGoogleMarker, rideGoogleDestinationMarker, item){
      // debugger
      if(!rideGoogleMarker && !rideGoogleDestinationMarker){
        return  false
      }
      // if(rideGoogleMarker && !rideGoogleDestinationMarker){
      //   // Set Map position to show rideGoogleMarker
      // }
      // if(!rideGoogleMarker && rideGoogleDestinationMarker){
      //   // Set Map position to show rideGoogleDestinationMarker
      // }

      var latLngBound = new google.maps.LatLngBounds();
      if(rideGoogleMarker){
        latLngBound.extend(rideGoogleMarker.position)
      }
      if(rideGoogleDestinationMarker){
        latLngBound.extend(rideGoogleDestinationMarker.position);
      }

      rideGoogleMap.setCenter(latLngBound.getCenter())
      rideGoogleMap.fitBounds(latLngBound);
      // Once set call for Routes
      callRouteDisplay(rideGoogleMap, rideGoogleMarker, rideGoogleDestinationMarker, item);

    }

    googleMapElements.each(function(index, element){
      // var rideGoogleMapElement = document.getElementById("ride-google-map");
      var rideGoogleMapElement = element;
      var defaultRideCenter = {
        lat: 51.4934,
        lng: 0.0098
      };




      var rideGoogleMapObject = {};
      var rideDirectionService = new google.maps.DirectionsService;
      var rideDirectionRenderer = new google.maps.DirectionsRenderer;
      var infoWindow = new google.maps.InfoWindow({
        borderRadius: 0,
        shadowStyle: 0
      });
      rideGoogleMapObject["rideDirectionService"] = rideDirectionService;
      rideGoogleMapObject["rideDirectionRenderer"] = rideDirectionRenderer;
      rideGoogleMapObject["infoWindow"] = infoWindow;

      rideGoogleMapObject["rideGoogleMap"] = new google.maps.Map(rideGoogleMapElement, {
        center: defaultRideCenter,
        zoom: 1,

      });

      rideGoogleMapObject["rideDirectionRenderer"].setMap(rideGoogleMapObject["rideGoogleMap"]);
      // rideGoogleMapObject["rideGoogleMarker"] = new google.maps.Marker({
      //   position: defaultRideCenter,
      //   map: rideGoogleMapObject["rideGoogleMap"],
      //   // label: 'S',
      //   // icon: GOOGLE_MARKER.blue
      // });

      rideGoogleMapObject["rideGoogleDestinationMarker"]="";


      rideGoogleMaps.push(rideGoogleMapObject);
      // End Ride form place auto complete


    });

    rideDepartureElement.addEventListener('change', function(e){
      var value = e.target.value;
      console.log('Clean ride departure ...')
      if(value.trim() === ""){
        // Reset current marker and remove info and distance..
        rideGoogleMaps = rideGoogleMaps.map(function(item) {
          // Reset marker
          var rideGoogleMarker = item['rideGoogleMarker'];
          var rideDirectionRender = item['rideDirectionRenderer'];
          rideGoogleMarker.setMap(null);
          if(rideDirectionRender){
            rideDirectionRender.setMap(null);
          }
          delete item['rideGoogleMarker'];
          if(item['infoWindow']){
            item.infoWindow.close();
          }
          return item;
        })
      }
    })
    rideDepartureAutoComplete.addListener("place_changed", function(){
      console.log(rideDepartureAutoComplete.getPlace())
      console.log("Departure position change...")
      var place = rideDepartureAutoComplete.getPlace();
      var rideGoogleMarker,rideGoogleMap, rideGoogleDestinationMarker;
      rideGoogleMaps = rideGoogleMaps.map(function(item, index){
        rideGoogleMap = item["rideGoogleMap"];
        rideGoogleMarker = item["rideGoogleMarker"];
        item['rideGoogleMarker'] = rideGoogleMarker;
        rideGoogleDestinationMarker = item["rideGoogleDestinationMarker"];
        if(rideGoogleMarker){
          rideGoogleMarker.setVisible(false);
          rideGoogleMarker.setMap(null)
        }
        // Remove existing infoWindow
        if(item["infoWindow"]){
          if(typeof item.infoWindow.getPosition !== "undefined" && item.infoWindow.getPosition()){
            item.infoWindow.close();
          }
        }
        // debugger
        if(place.geometry){
          // view port

          if(place.geometry.viewport){
            rideGoogleMap.fitBounds(place.geometry.viewport)
          }else{
            rideGoogleMap.setCenter(place.geometry.location);
          }

          if(!rideGoogleMarker){
            rideGoogleMarker = new google.maps.Marker({
              position: place.geometry.location,
              map: rideGoogleMap,
              // icon: GOOGLE_MARKER.blue,
              // label: 'S'
            })
          }else{
            rideGoogleMarker.setPosition(place.geometry.location);
            rideGoogleMarker.setMap(rideGoogleMap);
          }
          var location = place.geometry.location;
            
            var address = place.address_components;
            var city='';
			$.each(address, function (index, address_componet) {
				var long_name = address_componet.long_name,
				    short_name = address_componet.short_name,
				    types = address_componet.types;

                console.log(long_name, types);
                if (types.indexOf("neighborhood") > -1) {
                    //alert(long_name);
					//$("#departure_place").val(long_name);
				}
                if (types.indexOf("route") > -1) {
					$("#departure_route").val(long_name);
				}
				if (types.indexOf("postal_code") > -1) {
					$("#departure_zipcode").val(long_name);
				}
				if (types.indexOf("country") > -1) {
					$("#departure_country").val(long_name);
				}
                if (types.indexOf("locality") > -1) {
                    city=long_name;
					$("#departure_city").val(long_name);
				}
				if (types.indexOf("administrative_area_level_1") > -1) {
					$("#departure_state").val(long_name);
                    if($("#departure_state_short").length>0)
                    $("#departure_state_short").val(short_name);
				}
				if (types.indexOf("administrative_area_level_2") > -1) {
                    if(city=='')
					$("#departure_city").val(long_name);
				}
                if (types.indexOf("sublocality_level_1") > -1) {
					$("#departure_place").val(long_name);
				}
			});
            
          $("#ride-departure-lat").val(location.lat())
          $("#ride-departure-lng").val(location.lng())
          rideGoogleMarker.setVisible(true);
          item['rideGoogleMarker'] = rideGoogleMarker;
          if(rideGoogleDestinationMarker){
            console.log("I want to reset position....")
            reStructureBasedOnMarkerPoints(rideGoogleMap, rideGoogleMarker, rideGoogleDestinationMarker, item);
          }
        }
        return item;
      })

    });

    rideDestinationElement.addEventListener('change', function(e){
      var place = e.target.value;
      if(place.trim() === ""){
        rideGoogleMaps = rideGoogleMaps.map(function(item){
          var rideGoogleDestinationMarker = item['rideGoogleDestinationMarker'];
          var rideDirectionRender = item['rideDirectionRenderer'];
          rideGoogleDestinationMarker.setMap(null);

          if(rideDirectionRender){
            rideDirectionRender.setMap(null);
          }

          delete item.rideGoogleDestinationMarker
          if(item['infoWindow']){
            item.infoWindow.close();
          }
          return item;
        })
      }
    })

    rideDestinationAutoComplete.addListener("place_changed", function(){

      var destinationPlace = rideDestinationAutoComplete.getPlace();
      var rideGoogleDestinationMarker,rideGoogleMap,rideGoogleMarker;

      rideGoogleMaps = rideGoogleMaps.map(function(item, index){
        // debugger
        rideGoogleMap = item["rideGoogleMap"];
        rideGoogleDestinationMarker = item["rideGoogleDestinationMarker"];
        rideGoogleMarker = item["rideGoogleMarker"];
        if(rideGoogleDestinationMarker){
          rideGoogleDestinationMarker.setVisible(false);
          rideGoogleDestinationMarker.setMap(null)
        }

        if(item["infoWindow"]){
          if(typeof item.infoWindow.getPosition !== "undefined" && item.infoWindow.getPosition()){
            item.infoWindow.close();
          }
        }

        if(destinationPlace.geometry.location){
          if(item.rideGoogleDestinationMarker){
            rideGoogleDestinationMarker.setPosition(destinationPlace.geometry.location);
            rideGoogleDestinationMarker.setVisible(true)
            rideGoogleDestinationMarker.setMap(rideGoogleMap);
          }else{
            rideGoogleDestinationMarker = new google.maps.Marker({
              position: destinationPlace.geometry.location,
              map: rideGoogleMap,
              // icon: GOOGLE_MARKER.red,
              // label: 'E'
            });
          }
          item["rideGoogleDestinationMarker"] = rideGoogleDestinationMarker;
        }
        if(destinationPlace.geometry){
          if(destinationPlace.geometry.viewport){

          }else{

          }
          // rideGoogleDestinationMarker.setPosition(destinationPlace.geometry.location);
          var location = destinationPlace.geometry.location;
            
            var address2 = destinationPlace.address_components;
            var city='';
			$.each(address2, function (index, address_componet) {
				var long_name = address_componet.long_name,
				    short_name = address_componet.short_name,
				    types = address_componet.types;

                console.log(long_name, types);
                if (types.indexOf("neighborhood") > -1) {
                    //alert(long_name);
					//$("#departure_place").val(long_name);
				}
                if (types.indexOf("route") > -1) {
					$("#destination_route").val(long_name);
				}
				if (types.indexOf("postal_code") > -1) {
					$("#destination_zipcode").val(long_name);
				}
				if (types.indexOf("country") > -1) {
					$("#destination_country").val(long_name);
				}
                if (types.indexOf("locality") > -1) {
                    city=long_name;
					$("#destination_city").val(long_name);
				}
				if (types.indexOf("administrative_area_level_1") > -1) {
					$("#destination_state").val(long_name);
                    if($("#destination_state_short").length>0)
                    $("#destination_state_short").val(short_name);
				}
				if (types.indexOf("administrative_area_level_2") > -1) {
                    if(city=='')
					$("#destination_city").val(long_name);
				}
                if (types.indexOf("sublocality_level_1") > -1) {
					$("#destination_place").val(long_name);
				}
			});
            
          $("#ride-destination-lat").val(location.lat());
          $("#ride-destination-lng").val(location.lng());
          /* Add Info Window here */
          /* end Info Window here */
          rideGoogleDestinationMarker.setVisible(true)
        }
        reStructureBasedOnMarkerPoints(rideGoogleMap, rideGoogleMarker, rideGoogleDestinationMarker, item);
        return item;
      })
    });


    /**
     * @description Lat and Lng of the departure and destination
     */
      try{
        var rideDepartureLatField = $("#ride-departure-lat");
        var rideDepartureLngField = $("#ride-departure-lng");
        var rideDestinationLatField = $("#ride-destination-lat");
        var rideDestinationLngField = $("#ride-destination-lng");

        var rideDestinationLat = parseFloat(rideDestinationLatField.val()),
          rideDestinationLng = parseFloat(rideDestinationLngField.val()),
          rideDepartureLat = parseFloat(rideDepartureLatField.val()),
          rideDepartureLng =  parseFloat(rideDepartureLngField.val());
        var rideDestination = {
          lat: rideDestinationLat,
          lng: rideDestinationLng
        };
        var rideDeparture = {
          lat: rideDepartureLat,
          lng: rideDepartureLng
        }

        if(!rideDestinationLat && !rideDestinationLng){
          return
        }

        if(!rideDepartureLat && !rideDepartureLng){
          return
        }


        // Iterate through Google maps
        rideGoogleMaps =rideGoogleMaps.map(function(map){
          // Create marker if not exists using lat and lng
          /* Set or update departure marker */
          if(!map['rideGoogleMarker']){
            map['rideGoogleMarker'] = new google.maps.Marker({
              position: rideDeparture,
              map: map["rideGoogleMap"]
            })
          }else{
            map["rideGoogleMarker"].setPosition(rideDeparture)
          }

          /* Set or update destination marker */
          if(!map["rideGoogleDestinationMarker"]){
            map['rideGoogleDestinationMarker'] = new google.maps.Marker({
              position: rideDestination,
              map: map["rideGoogleMap"]
            })
          }else{
            map["rideGoogleDestinationMarker"].setPosition(rideDestination)
          }

          var latLngBound = new google.maps.LatLngBounds();
          if(map.rideGoogleMarker){
            latLngBound.extend(map.rideGoogleMarker.position)
          }
          if(map.rideGoogleDestinationMarker){
            latLngBound.extend(map.rideGoogleDestinationMarker.position);
          }

          map.rideGoogleMap.setCenter(latLngBound.getCenter())
          map.rideGoogleMap.fitBounds(latLngBound);
          callRouteDisplay(map.rideGoogleMap, map.rideGoogleMarker, map.rideGoogleDestinationMarker, map)
          return map;
        });
      }catch (e) {

      }
  }
}






// initGoogleMap();




// Get distance between From and To points
// });