<?php

require_once("../../SQLServer.php");
if (isset($_POST['update']))
{
    $GetSn=$_GET['GetSn'];
    $id = $_POST['id'];
    $estrusDate = $_POST['estrusDate'];
    $intervalDays = $_POST['intervalDays'];
    $isMating = $_POST['isMating'];
    $semenNumber = $_POST['semenNumber'];


    $query = "UPDATE estrus_record SET estrusDate='$estrusDate',intervalDays='$intervalDays',isMating='$isMating',semenNumber='$semenNumber' WHERE sn='$GetSn'";
    $result = mysqli_query($db_link,$query);

if($result)
{
header("location:estrusRecord.php");

}
else
{
echo 'Please Check Your Query';
}
}
else
{
    header("location:estrusRecord.php");
}
?>

