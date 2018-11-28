
<?php
    include_once 'dbh.inc.php';
?>
<?php
 $id = $_POST["ID"];
 $result=mysqli_query($conn,"SELECT General.ID,General.Name,General.Operator,General.ComDate,general.Description,Efficiency.SystemPower,efficiency.AnnualProduction,
                    efficiency.CO2,efficiency.Reimbursement,hardware.SolarPanelmod,hardware.Azimuth,hardware.Inclination,
                    hardware.Communication,hardware.Communication,hardware.Inverter,hardware.Sensors,Location.Address,Location.X,Location.Y
                    FROM General
                    INNER JOIN Location
                    ON General.Loc_ID=Location.ID
                    INNER JOIN Efficiency
                    ON General.Eff_ID=Efficiency.ID
                    INNER JOIN Hardware
                    ON General.Hard_ID=Hardware.ID
                    WHERE General.ID='$id';");
                    $row=mysqli_fetch_assoc($result);

                    echo "<div class=\"form-style\">
                            <form action=\"\">
                            <label for=\"idGen\" >ID:</label>
                            <input type=\"text\" id=\"idGen\" name=\"idGen\" value=\"".$row['ID']."\" disabled >
                            <br>
                            <label for=\"nameGen\">Name:</label>
                            <input type=\"text\" id=\"NameGen\" name=\"NameGen\" value=\"".$row['Name']."\" disabled >
                            <br>
                            <label for=\"operation\">Operation:</label>
                            <input type=\"text\" id=\"operationGen\" name=\"operationGen\" value=\"".$row['Operator']."\">
                            <br>
                            <label for=\"comDateGen\">Commision Date:</label>
                            <input type=\"text\" id=\"comDateGen\" name=\"comDateGen\" value=\"".$row['ComDate']."\">
                            <br>
                            <label for=\"AddressLoc\">Address:</label>
                            <input type=\"text\" id=\"AddressLoc\" name=\"AddressLoc\" value=\"".$row['Address']."\">
                            <br>
                            <label for=\"latitudeLoc\">Latitude:</label>
                            <input type=\"text\" id=\"LatitudeLoc\" name=\"LatitudeLoc\" value=\"".$row['X']."\">
                            <br>
                            <label for=\"longtitude\">Longtitude:</label>
                            <input type=\"text\" id=\"LongtitudeLoc\" name=\"LongtitudeLoc\" value=\"".$row['Y']."\">
                            <br>
                            <label for=\"systemPowerEff\">System Power:</label>
                            <input type=\"text\" id=\"systemPowerEff\" name=\"systemPowerEff\" value=\"".$row['SystemPower']."\">
                            <br>
                            <label for=\"annualProductionEff\">Annual Production:</label>
                            <input type=\"text\" id=\"annualProductionEff\" name=\"annualProductionEff\" value=\"".$row['AnnualProduction']."\">
                            <br>
                            <label for=\"co2AvoidedEff\">CO2 Avoided:</label>
                            <input type=\"text\" id=\"co2AvoidedEff\" name=\"co2AvoidedEff\" value=\"".$row['CO2']."\">
                            <br>
                            <label for=\"reimbursementEff\">Reimbursement:</label>
                            <input type=\"text\" id=\"reimbursementEff\" name=\"reimbursementEff\" value=\"".$row['Reimbursement']."\">
                            <br>
                            <label for=\"solarPanelHW\">Solar Panel Modules:</label>
                            <input type=\"text\" id=\"solarPanelHW\" name=\"solarPanelHW\" value=\"".$row['SolarPanelmod']."\">
                            <br>
                            <label for=\"azimuthHW\">Azimuth Angle:</label>
                            <input type=\"text\" id=\"azimuthHW\" name=\"azimuthHW\" value=\"".$row['Azimuth']."\">
                            <br>
                            <label for=\"inclinationHW\">Inclination Angle:</label>
                            <input type=\"text\" id=\"inclinationHW\" name=\"inclinationHW\" value=\"".$row['Inclination']."\">
                            <br>
                            <label for=\"communicationHW\">Communication:</label>
                            <input type=\"text\" id=\"communicationHW\" name=\"communicationHW\" value=\"".$row['Communication']."\">
                            <br>
                            <label for=\"inverterHW\">Inverter:</label>
                            <input type=\"text\" id=\"inverterHW\" name=\"inverterHW\" value=\"".$row['Inverter']."\">
                            <br>
                            <label for=\"sensorsHW\">Sensors:</label>
                            <input type=\"text\" id=\"sensorsHW\" name=\"sensorsHW\" value=\"".$row['Sensors']."\">
                            <br>
                            <label for=\"descriptionHW\">Description:</label>
                            <input type=\"text\" id=\"descriptionHW\" name=\"descriptionHW\" value=\"".$row['Description']."\">
                            <br>
                          </div>";