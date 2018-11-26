<?php
    include_once 'dbh.inc.php';
?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.4/dist/leaflet.css"
        integrity="sha512-puBpdR0798OZvTTbP4A8Ix/l+A4dHDD0DGqYW6RQ+9jxkRFclaxxQb/SJAWZfWAkuyeQUytO7+7N4QKrDh+drA=="
        crossorigin=""/>
        <!-- Make sure you put this AFTER Leaflet's CSS -->
        <script src="https://unpkg.com/leaflet@1.3.4/dist/leaflet.js"
        integrity="sha512-nMMmRyTVoLYqjP9hrbed9S+FzjZHW5gY1TWCHA5ckwXZBadntCNs8kEqAWdrb9O7rxbCaA4lKTIWjDXZxflOcA=="
        crossorigin="">
        </script>
        <script src="index.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    </head>
    <body> 
        <div id="map">
            <script>
                var map = L.map('map').setView([46.770920, 23.589920], 5);

                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                }).addTo(map);

                L.marker([36.533140, 22.406140]).addTo(map)
                    .bindPopup('Iliodora PV System')
                    .openPopup();
                L.marker([50.886580, 4.262970]).addTo(map)
                    .bindPopup('Harte PV System')
                    .openPopup();
                L.marker([50.678600, 4.722720]).addTo(map)
                    .bindPopup('Corpo PV System')
                    .openPopup();
                L.marker([50.280870, 4.971220]).addTo(map)
                    .bindPopup('Rosier PV System')
                    .openPopup();
            </script>
        </div>
        <button id="addDataJson">Add Json<button>
    </body>
</html>