<?php require('header.html');?>
<body>
    <?php require('nav.html');?>

    <div class="container">
        <div class="page-header">
            <h1>Hitta hit</h1>
        </div>

        <div class="col-sm-8">
            <p>Information + kartfunktioner om hur du på snabbaste sätt hittar till karnevalsområdet!</p>
        </div>

        <div class="page-header col-sm-8">
            <h2>Karta</h2>
            <h4>Ta dig från Lund C (Bangatan) till karnevalsområdet:</h4>

        <div id="map">
        <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB9Rjz13Brt8JAqcG9V0JqzzpdBcLzPOqk&callback=initMap"></script>
            
    </div>
    <?php require('footer.php');?>
</body>