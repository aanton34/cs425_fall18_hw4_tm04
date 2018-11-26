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
    <link rel="stylesheet" type="text/css" href="mystyle.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    </head>
    <body> 
    <div id="map">

      <script>
              var map = L.map('map').setView([46.770920, 23.589920], 5);

                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                }).addTo(map);
        </script>

                <?php 
                    $result=mysqli_query($conn,"SELECT *
                    FROM General
                    INNER JOIN  Location
                    ON General.Loc_ID=Location.ID
                    INNER JOIN Efficiency
                    ON General.Eff_ID=Efficiency.ID
                    INNER JOIN Hardware
                    ON General.Hard_ID=Hardware.ID;");
                    $row=mysqli_fetch_assoc($result);
                    while($row!=null):
                    ?>

            <script>
                var x=parseFloat(<?php echo JSON_encode($row['X']); ?>);
                var y=parseFloat(<?php echo JSON_encode($row['Y']); ?>);
               L.marker([x,y]).addTo(map)
                    .bindPopup(<?php echo JSON_encode($row['Name']); ?>)
                    .openPopup();

            </script>

            <?php
            $row=mysqli_fetch_assoc($result);
            endwhile;
            ?>
        </div>
        <button id="addDataJson">Add Json<button>
    </body>
</html>