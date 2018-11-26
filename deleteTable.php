
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
                $sql="DELETE FROM Efficiency;";
                mysqli_query($conn,$sql);
                echo json_encode($aResult);
                break;
            case "deleteOnePV":
                $name = htmlspecialchars($_POST['arguments'][0]);
                $x = htmlspecialchars($_POST['arguments'][1]);
                $y = htmlspecialchars($_POST['arguments'][2]);
                $sql="delete from general 
                     where Name='$name'
                    limit 1;";
                mysqli_query($conn,$sql);
                $sql="delete from location 
                     where Name='$name'
                    limit 1;";
                mysqli_query($conn,$sql);
                $sql="delete from Efficiency 
                     where Name='$name'
                    limit 1;";
                mysqli_query($conn,$sql);
                $sql="delete from Hardware 
                     where X='$x' and Y='$y'
                    limit 1;";
                mysqli_query($conn,$sql);
                echo json_encode($aResult);
                break;
            default:
                $aResult['error'] = 'Not found function '.$_POST['functionname'].'!';
        }
?>

