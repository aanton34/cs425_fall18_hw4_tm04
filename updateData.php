
<?php
    include_once 'dbh.inc.php';
?>

<?php
    $aResult = array();
    $functionName = htmlspecialchars($_POST['functionname']);
        switch($functionName) {
            case "updateLocation":
                $address = htmlspecialchars($_POST['arguments'][0]);
                $x = htmlspecialchars($_POST['arguments'][1]);
                $y = htmlspecialchars($_POST['arguments'][2]);
                $name = htmlspecialchars($_POST['arguments'][3]);
                $sql="UPDATE Location
                    SET Address='$address',X='$x',Y='$y'
                    WHERE Location.genName='$name';";
                mysqli_query($conn,$sql);
                echo $sql;
                echo json_encode($aResult);
                break;
            case "updateHardware":
                $solarPanel = htmlspecialchars($_POST['arguments'][0]);
                $azim = htmlspecialchars($_POST['arguments'][1]);
                $inclin = htmlspecialchars($_POST['arguments'][2]);
                $comm = htmlspecialchars($_POST['arguments'][3]);
                $inv = htmlspecialchars($_POST['arguments'][4]);
                $sen = htmlspecialchars($_POST['arguments'][5]);
                $name = htmlspecialchars($_POST['arguments'][6]);
                 $sql="UPDATE Hardware
                 SET SolarPanelmod='$solarPanel',Azimuth='$azim',Inclination='$inclin',Communication='$comm',Inverter='$inv',Sensors='$sen'
                 WHERE Hardware.generalName='$name';";
                mysqli_query($conn,$sql);
                echo $sql;
                echo json_encode($aResult);
                break;
            case "updateGeneral":
                $name = htmlspecialchars($_POST['arguments'][0]);
                $oper = htmlspecialchars($_POST['arguments'][1]);
                $comDate = htmlspecialchars($_POST['arguments'][2]);
                $Desc = htmlspecialchars($_POST['arguments'][3]);
                $idCurrent= htmlspecialchars($_POST['arguments'][4]);
                $sql="UPDATE General
                SET Name='$name',Operator='$oper',ComDate='$comDate',Description='$Desc'
                WHERE ID='$idCurrent';";
                mysqli_query($conn,$sql);
                echo $sql;
                echo json_encode($aResult);
                break;
            case "updateEfficiency":
                $systemP = htmlspecialchars($_POST['arguments'][0]);
                $anualP = htmlspecialchars($_POST['arguments'][1]);
                $co2 = htmlspecialchars($_POST['arguments'][2]);
                $reim = htmlspecialchars($_POST['arguments'][3]);
                $name = htmlspecialchars($_POST['arguments'][4]);
                $sql="UPDATE Efficiency
                SET SystemPower='$systemP',AnnualProduction='$anualP',CO2='$co2',Reimbursement='$reim'
                WHERE Efficiency.genName='$name';";
                mysqli_query($conn,$sql);
                echo $sql;
                echo json_encode($aResult);
                break;
            default:
            break;
        }
?>

