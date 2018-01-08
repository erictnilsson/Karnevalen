<?php require('header.html');?>
<body>
    <?php require('nav.html');?>

    <div class="container">
            <div class="page-header">
                <h1>Hitta hit</h1>
            </div>
            <div class="container">
                <p>Information + kartfunktion om hur man hittar till karnevalsområdet</p>
        </div>


        <div class="page-header container">
            <h2>Karta</h2>
        </div>

        <div id="map" class="container"></div>

        <script>
        function initMap() {
            var location = {lat: 55.704785, lng: 13.193841};
            var map = new google.maps.Map(document.getElementById("map"),{
                zoom: 16, 
                center: location
            });
            var marker = new google.maps.Marker({
                position: location, 
                map: map
            }); 
        }
        </script>
    
        <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB9Rjz13Brt8JAqcG9V0JqzzpdBcLzPOqk&callback=initMap">
        </script>

    <?php require('footer.php');?>
</body>