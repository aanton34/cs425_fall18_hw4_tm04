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
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
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
                $result=mysqli_query($conn,"SELECT General.ID,General.Name,General.Operator,General.ComDate,general.Description,Efficiency.SystemPower,efficiency.AnnualProduction,
                efficiency.CO2,efficiency.Reimbursement,hardware.SolarPanelmod,hardware.Azimuth,hardware.Inclination,
                hardware.Communication,hardware.Communication,hardware.Inverter,hardware.Sensors,Location.Address,Location.X,Location.Y
                FROM General
                INNER JOIN  Location
                ON General.Loc_ID=Location.ID
                INNER JOIN Efficiency
                ON General.Eff_ID=Efficiency.ID
                INNER JOIN Hardware
                ON General.Hard_ID=Hardware.ID;");
                $row=mysqli_fetch_assoc($result);
                $i = 0;
                while($row!=null):
            ?>
            <script>
                var i=parseInt(<?php echo JSON_encode($i); ?>);
                var x=parseFloat(<?php echo JSON_encode($row['X']); ?>);
                var y=parseFloat(<?php echo JSON_encode($row['Y']); ?>);
                var id=<?php echo JSON_encode($row['ID']); ?>;
                var name=<?php echo JSON_encode($row['Name']); ?>;
                var operator=<?php echo JSON_encode($row['Operator']); ?>;
                var date=<?php echo JSON_encode($row['ComDate']); ?>;
                var addr=<?php echo JSON_encode($row['Address']); ?>;
                var power=<?php echo JSON_encode($row['SystemPower']); ?>;
                var production=<?php echo JSON_encode($row['AnnualProduction']); ?>;
                var co2=<?php echo JSON_encode($row['CO2']); ?>;
                var reim=<?php echo JSON_encode($row['Reimbursement']); ?>;
                var spmod=<?php echo JSON_encode($row['SolarPanelmod']); ?>;
                var reim=<?php echo JSON_encode($row['Reimbursement']); ?>;
                var spmod=<?php echo JSON_encode($row['SolarPanelmod']); ?>;
                var azimuth=<?php echo JSON_encode($row['Azimuth']); ?>;
                var inclination=<?php echo JSON_encode($row['Inclination']); ?>;
                var comm=<?php echo JSON_encode($row['Communication']); ?>;
                var inverter=<?php echo JSON_encode($row['Inverter']); ?>;
                var sensors=<?php echo JSON_encode($row['Sensors']); ?>;
                var description=<?php echo JSON_encode($row['Description']); ?>;
                var pvInfo = '<form id="showInfo-form">\
                    <table class="popup-table">\
                    <tr class="popup-table-row">\
                            <th class="popup-table-header">ID:</th>\
                            <td id="value-id" class="popup-table-data">'+id+'</td></tr>\
                        <tr class="popup-table-row">\
                            <th class="popup-table-header">Name:</th>\
                            <td id="value-name" class="popup-table-data">'+name+'</td></tr>\
                        <tr class="popup-table-row">\
                            <th class="popup-table-header">Operator:</th>\
                            <td id="value-operator" class="popup-table-data">'+operator+'</td></tr>\
                        <tr class="popup-table-row">\
                            <th class="popup-table-header">Commision Date:</th>\
                            <td id="value-date" class="popup-table-data">'+date+'</td></tr>\
                        <tr class="popup-table-row">\
                            <th class="popup-table-header">Address:</th>\
                            <td id="value-address" class="popup-table-data">'+addr+'</td></tr>\
                        <tr class="popup-table-row">\
                            <th class="popup-table-header">Latitude:</th>\
                            <td id="value-lat" class="popup-table-data">'+x+'</td></tr>\
                        <tr class="popup-table-row">\
                            <th class="popup-table-header">Longtitude:</th>\
                            <td id="value-lng" class="popup-table-data">'+y+'</td></tr>\
                        <tr class="popup-table-row">\
                            <th class="popup-table-header">System Power:</th>\
                            <td id="value-power" class="popup-table-data">'+power+'</td></tr>\
                        <tr class="popup-table-row">\
                            <th class="popup-table-header">Annual Production:</th>\
                            <td id="value-prod" class="popup-table-data">'+production+'</td></tr>\
                        <tr class="popup-table-row">\
                            <th class="popup-table-header">CO2 avoided:</th>\
                            <td id="value-co2" class="popup-table-data">'+co2+'</td></tr>\
                        <tr class="popup-table-row">\
                            <th class="popup-table-header">Reimbursement:</th>\
                            <td id="value-reimb" class="popup-table-data">'+reim+'</td></tr>\
                        <tr class="popup-table-row">\
                            <th class="popup-table-header">Solar Panel Modules:</th>\
                            <td id="value-spmod" class="popup-table-data">'+spmod+'</td></tr>\
                        <tr class="popup-table-row">\
                            <th class="popup-table-header">Azimuth Angle:</th>\
                            <td id="value-azimuth" class="popup-table-data">'+azimuth+'</td></tr>\
                        <tr class="popup-table-row">\
                            <th class="popup-table-header">Inclination Angle:</th>\
                            <td id="value-inclination" class="popup-table-data">'+inclination+'</td></tr>\
                        <tr class="popup-table-row">\
                            <th class="popup-table-header">Communication:</th>\
                            <td id="value-comm" class="popup-table-data">'+comm+'</td></tr>\
                        <tr class="popup-table-row">\
                            <th class="popup-table-header">Inverter:</th>\
                            <td id="value-inverter" class="popup-table-data">'+inverter+'</td></tr>\
                        <tr class="popup-table-row">\
                            <th class="popup-table-header">Sensors:</th>\
                            <td id="value-sensors" class="popup-table-data">'+sensors+'</td></tr>\
                        <tr class="popup-table-row">\
                            <th class="popup-table-header">Description:</th>\
                            <td id="value-description" class="popup-table-data">'+description+'</td></tr>\
                    </table>\
                    <input type="submit" id="update" name="update" value="Update">\
                    <button type="button" class="btn btn-info btn-lg" data-toggle="modal" onclick=getID('+id+'); data-target="#myModal">Update</button>\
                    <input type="submit" id="delete" name="delete" value="Delete">\
                    </form>';
                L.marker([x,y]).addTo(map)
                .bindPopup(pvInfo);
            </script>
            <?php
                $i++;
                $row=mysqli_fetch_assoc($result);
                endwhile;
            ?>
            <script>
                map.on('click', function(e){
             	    var coord = e.latlng.toString().split(',');
             		var lat = coord[0].split('(');
                    var x1 = parseFloat(lat[1]);
             		var lng = coord[1].split(')');
                    var y1 = parseFloat(lng[0]);

                    var create_new = '<form id="createNew-form">\
                        <label for="createNew">Create new PV system?</label>\
                        <br>\
                        <input type="submit" name="yes" value="Yes">\
                        <input type="submit" name="no" value="No">\
                        </form>';
             		L.marker([x1,y1]).addTo(map)
                    .bindPopup(create_new)
                    .openPopup();
             	});
            </script>

            <script>
                function getID(id){
                    //  document.getElementById("idGen").value = id;
                    // document.getElementById("hiddenID").value=id;

                      $.ajax({
                            cache: false,
                            type: 'POST',
                            url: 'fetchAll.php',
                            data: 'ID='+id,
                            success: function(data) 
                            {
                                $('#myModal').show();
                                $('#modalContent').show().html(data);
                            }
                        });
                }
            </script>

            <form action="" method="post">
                <input type="hidden" id="hiddenID" name="hiddenID"/> 
            </form>
            
            <?php 
                // $currentID=$_POST['hiddenID'];
                // if (isset($_POST['hiddenID'])){
                //     $currentID = $_POST['hiddenID'];
                //     $result=mysqli_query($conn,"SELECT General.ID,General.Name,General.Operator,General.ComDate,general.Description,Efficiency.SystemPower,efficiency.AnnualProduction,
                //     efficiency.CO2,efficiency.Reimbursement,hardware.SolarPanelmod,hardware.Azimuth,hardware.Inclination,
                //     hardware.Communication,hardware.Communication,hardware.Inverter,hardware.Sensors,Location.Address,Location.X,Location.Y
                //     FROM General
                //     INNER JOIN Location
                //     ON General.Loc_ID=Location.ID
                //     INNER JOIN Efficiency
                //     ON General.Eff_ID=Efficiency.ID
                //     INNER JOIN Hardware
                //     ON General.Hard_ID=Hardware.ID
                //     WHERE General.ID='$currentID';");
                //     $row=mysqli_fetch_assoc($result);
                //     }
            ?>

         <!-- Modal -->
    <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Modal Header</h4>
        </div>
        <div class="modal-body">
          <div id="modalContent">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" id="UpdateDataBase" data-dismiss="modal">Update</button>
        </div>
      </div>
    </div>
  </div>
  
        </div>
        <button id="addDataJson">Add Json<button>
    </body>
</html>