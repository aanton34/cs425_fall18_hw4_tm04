
<?php
    include_once 'dbh.inc.php';
?>

<?php
    $aResult = array();
    $functionName = htmlspecialchars($_POST['functionname']);
        switch($functionName) {
            case "getAllPV":
                $sql="SELECT *
                FROM General
                INNER JOIN  Location
                ON General.Loc_ID=Location.ID
                INNER JOIN Efficiency
                ON General.Eff_ID=Efficiency.ID
                INNER JOIN Hardware
                ON General.Hard_ID=Hardware.ID;";
                $result=mysqli_query($conn,$sql);
                $row=mysqli_fetch_assoc($result);
                echo json_encode($aResult);
                break;
            case "getOnePV":
                $name = htmlspecialchars($_POST['arguments'][0]);
                $sql="SELECT *
                FROM General
                INNER JOIN  Location
                ON General.Loc_ID=Location.ID
                INNER JOIN Efficiency
                ON General.Eff_ID=Efficiency.ID
                INNER JOIN Hardware
                ON General.Hard_ID=Hardware.ID;";
                $result=mysqli_query($conn,$sql);
                $row=mysqli_fetch_assoc($result);
                echo json_encode($aResult);
                break;
            default:
                $aResult['error'] = 'Not found function '.$_POST['functionname'].'!';
        }
?>

