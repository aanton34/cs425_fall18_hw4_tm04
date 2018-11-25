
<?php
    include_once 'dbh.inc.php';
?>

<?php
    $aResult = array();
    $functionName = htmlspecialchars($_POST['functionname']);
        switch($functionName) {
            case "deleteAllPV":
                $sql="DELETE FROM Hardware;";
                mysqli_query($conn,$sql);
                $sql="DELETE FROM Location;";
                mysqli_query($conn,$sql);
                $sql="DELETE FROM General;";
                mysqli_query($conn,$sql);
                $sql="DELETE FROM Effi;";
                mysqli_query($conn,$sql);
                echo json_encode($aResult);
                break;
            case "deleteOnePV":
                $solarPanel = htmlspecialchars($_POST['arguments'][0]);
                $azim = htmlspecialchars($_POST['arguments'][1]);
                $inclin = htmlspecialchars($_POST['arguments'][2]);
                $comm = htmlspecialchars($_POST['arguments'][3]);
                $inv = htmlspecialchars($_POST['arguments'][4]);
                $sen = htmlspecialchars($_POST['arguments'][5]);
                $Name = htmlspecialchars($_POST['arguments'][6]);
                $sql="INSERT INTO Hardware(SolarPanelmod,Azimuth,Inclination,Communication,Inverter,Sensors,generalName)
                    VALUES('$solarPanel','$azim','$inclin','$comm','$inv','$sen','$Name');";
                mysqli_query($conn,$sql);
                echo json_encode($aResult);
                break;
            default:
                $aResult['error'] = 'Not found function '.$_POST['functionname'].'!';
        }
?>

