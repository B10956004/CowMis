<?php

require_once("../../SQLServer.php");
if (isset($_POST['update']))
{
    $GetSn=$_GET['GetSn'];
    $id = $_POST['id'];
    $date = $_POST['date'];
    $genealogy = $_POST['genealogy'];
    $concentrate = $_POST['concentrate'];
    $forage = $_POST['forage'];
    $isPregnancy = $_POST['isPregnancy'];
    $lactation = $_POST['lactation'];
    $waterIntake = $_POST['waterIntake'];
    $feedTime = $_POST['feedTime'];
    $recordTime = $_POST['recordTime'];

    $query = "UPDATE feed_record SET date='$date',genealogy='$genealogy',concentrate='$concentrate',forage='$forage',isPregnancy='$isPregnancy',lactation='$lactation',waterIntake='$waterIntake',feedTime='$feedTime',recordTime='$recordTime'WHERE sn='$GetSn'";
    $result = mysqli_query($db_link,$query);

if($result)
{
header("location:feedRecord.php");

}
else
{
echo 'Please Check Your Query';
}
}
else
{
    header("location:feedRecord.php");
}
?>

