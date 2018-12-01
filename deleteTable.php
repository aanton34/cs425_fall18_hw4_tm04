<?php
    include_once 'dbh.inc.php';
?>
<?php
    $name = $_POST['Name'];
    $sql="delete from general 
        where Name='$name'
        limit 1;";
        mysqli_query($conn,$sql);
    $sql="delete from location 
        where genName='$name'
        limit 1;";
        mysqli_query($conn,$sql);
    $sql="delete from Efficiency 
        where genName='$name'
        limit 1;";
        mysqli_query($conn,$sql);
    $sql="delete from Hardware 
        where generalName='$name'
        limit 1;";
        mysqli_query($conn,$sql);
?>

