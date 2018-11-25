
<?php
    include_once 'dbh.inc.php';
?>

<?php
    $aResult = array();
    $functionName = htmlspecialchars($_POST['functionname']);
        switch($functionName) {
            case "createLocation":
                $address = htmlspecialchars($_POST['arguments'][0]);
                $x = htmlspecialchars($_POST['arguments'][1]);
                $y = htmlspecialchars($_POST['arguments'][2]);
                $sql="INSERT INTO Location(Address,X,Y)
                    VALUES('$address','$x','$y');";
                mysqli_query($conn,$sql);
                echo json_encode($aResult);
                break;
            case "createHardWare":
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
            case "createGeneral":
                $name = htmlspecialchars($_POST['arguments'][0]);
                $photo = htmlspecialchars($_POST['arguments'][1]);
                $oper = htmlspecialchars($_POST['arguments'][2]);
                $conDate = htmlspecialchars($_POST['arguments'][3]);
                $Desc = htmlspecialchars($_POST['arguments'][4]);
                $X = htmlspecialchars($_POST['arguments'][5]);
                $Y = htmlspecialchars($_POST['arguments'][6]);
                $sql="INSERT INTO Hardware(Name,Photo,Operator,ComDate,Description,Loc_ID,Eff_ID,Hard_ID)
                VALUES('$name','$photo','$oper','$conDate','$Desc',
                (SELECT ID
                FROM Location
                WHERE X='$X' and Y='$Y'),
                (SELECT ID
                FROM Efficiency
                WHERE genName='$name'),
                (SELECT ID
                FROM Hardware
                WHERE genName='$name'));";
                mysqli_query($conn,$sql);
                echo json_encode($aResult);
                break;
            case "createEfficiency":
                $systenP = htmlspecialchars($_POST['arguments'][0]);
                $anualP = htmlspecialchars($_POST['arguments'][1]);
                $co2 = htmlspecialchars($_POST['arguments'][2]);
                $reim = htmlspecialchars($_POST['arguments'][3]);
                $name = htmlspecialchars($_POST['arguments'][4]);
                $sql="INSERT INTO Efficiency(SystemPower,AnnualProduction,CO2,Reimbursement,genName)
                    VALUES('$systenP','$anualP','$co2','$reim','$name');";
                mysqli_query($conn,$sql);
                echo json_encode($aResult);
                break;
            default:
                $aResult['error'] = 'Not found function '.$_POST['functionname'].'!';
        }
?>

