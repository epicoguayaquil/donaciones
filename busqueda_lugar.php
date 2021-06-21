<!DOCTYPE html>
<html>
  <head>
    <title>Places Search Box</title>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    
    <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAHa67r_2hPqR_URtU8zsibmJx9Ahq7yGQ&callback=initAutocomplete&libraries=places&v=weekly"
      defer
    ></script>
    
    
    <!-- NUEVO TOKEN DEL API GOOGLE MAPS
    https://maps.googleapis.com/maps/api/js?key=AIzaSyCgZ2MSpo9q8CAnl8BqjGwY6y2JzeGJGDM&callback=initAutocomplete&libraries=places&v=weekly
    -->
    <!-- jsFiddle will insert css and js -->
    <style>
        #map {
        height: 100%;
        }
        html,
body {
  height: 100%;
  margin: 0;
  padding: 0;
}

#description {
  font-family: Roboto;
  font-size: 15px;
  font-weight: 300;
}

#infowindow-content .title {
  font-weight: bold;
}

#infowindow-content {
  display: none;
}

#map #infowindow-content {
  display: inline;
}

.pac-card {
  margin: 10px 10px 0 0;
  border-radius: 2px 0 0 2px;
  box-sizing: border-box;
  -moz-box-sizing: border-box;
  outline: none;
  box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
  background-color: #fff;
  font-family: Roboto;
}

#pac-container {
  padding-bottom: 12px;
  margin-right: 12px;
}

.pac-controls {
  display: inline-block;
  padding: 5px 11px;
}

.pac-controls label {
  font-family: Roboto;
  font-size: 13px;
  font-weight: 300;
}

#pac-input {
  background-color: #fff;
  font-family: Roboto;
  font-size: 15px;
  font-weight: 300;
  margin-left: 12px;
  padding: 0 11px 0 13px;
  text-overflow: ellipsis;
  width: 400px;
}

#pac-input:focus {
  border-color: #4d90fe;
}

#title {
  color: #fff;
  background-color: #4d90fe;
  font-size: 25px;
  font-weight: 500;
  padding: 6px 12px;
}

#target {
  width: 345px;
}
    </style>
  </head>
  <body>
    <input
      id="pacInput"
      class="controls"
      type="text"
      placeholder="Search Box"
    />
    <div id="map"></div>
    <input type="hidden" value="" name="txt_latitud_frm" id="txt_latitud_frm">
    <input type="hidden" value="" name="txt_longitud_frm" id="txt_longitud_frm"> 
    <div style="z-index: 9999999999999999999999999999;position: absolute;position: absolute;top: 50%;left: 50%;">
        <!-- <img src="images/banderas.png"> -->
    </div>
    <script>
    function initAutocomplete() {
  const map = new google.maps.Map(document.getElementById("map"), {
    center: {
      lat: -2.1318855334422167,
      lng: -79.89283561706544,
    },
    zoom: 13,
    mapTypeId: "roadmap",
  }); // Create the search box and link it to the UI element.

  const input = document.getElementById("pacInput");
  const searchBox = new google.maps.places.SearchBox(input);
  map.controls[google.maps.ControlPosition.TOP_LEFT].push(input); // Bias the SearchBox results towards current map's viewport.

  map.addListener("bounds_changed", () => {
    searchBox.setBounds(map.getBounds());
     //alert(map.getCenter().lat());
     //console.log(map.getCenter().lat());
     //console.log(map.getCenter().lng());
    $('#txt_latitud_frm').val(map.getCenter().lat());
    $('#txt_longitud_frm').val(map.getCenter().lng());
  });
  let markers = []; // Listen for the event fired when the user selects a prediction and retrieve
  // more details for that place.

  searchBox.addListener("places_changed", () => {
    const places = searchBox.getPlaces();
    //console.log(searchBox);
   
    if (places.length == 0) {
      return;
    } // Clear out the old markers.

    markers.forEach((marker) => {
      marker.setMap(null);
    });
    markers = []; // For each place, get the icon, name and location.

    const bounds = new google.maps.LatLngBounds();
    places.forEach((place) => {
      if (!place.geometry) {
        console.log("Returned place contains no geometry");
        return;
      }

      const icon = {
        url: place.icon,
        size: new google.maps.Size(71, 71),
        origin: new google.maps.Point(0, 0),
        anchor: new google.maps.Point(17, 34),
        scaledSize: new google.maps.Size(25, 25),
      }; // Create a marker for each place.

      markers.push(
        new google.maps.Marker({
          map,
          icon: "images/bandera.png",
          title: place.name,
          position: place.geometry.location,
        })
      );
    
    ////////////////////////////
    
   
    
    
   
      if (place.geometry.viewport) {
        // Only geocodes have viewport.
        bounds.union(place.geometry.viewport);
      } else {
        bounds.extend(place.geometry.location);
      }
    });
    
    map.fitBounds(bounds);
  });
  //marker.bindTo('position', map, 'center');
}
    </script>
    <script src="js/jquery.min.js"></script> 
  </body>
</html>