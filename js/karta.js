function initMap() {
    var lundagård = {lat: 55.704785, lng: 13.193841};
    var bangatan = {lat: 55.705866, lng: 13.187604};

    var map = new google.maps.Map(document.getElementById("map"),{
        zoom: 16, 
        center: lundagård
    });
    

    var directionsDisplay = new google.maps.DirectionsRenderer({
        map: map
      });

    // Set destination, origin and travel mode.
    var request = {
        destination: bangatan,
        origin: lundagård,
        travelMode: 'DRIVING'
      };

      // Pass the directions request to the directions service.
      var directionsService = new google.maps.DirectionsService();
      directionsService.route(request, function(response, status) {
        if (status == 'OK') {
          // Display the route on the map.
          directionsDisplay.setDirections(response);
        }
      });

}