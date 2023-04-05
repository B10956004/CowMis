<?php

require_once("../../SQLServer.php");
if (isset($_POST['update']))
{
    $GetSn=$_GET['GetSn'];//序列號
    $id = $_POST['id']; //編號
    $dob = $_POST['dob']; //生日
    $birthParity = $_POST['birthParity']; //出生胎次
    $calvingInterval = $_POST['calvingInterval']; //胎距
    $mid = $_POST['mid']; //母親牛編號
    $fid = $_POST['fid']; //精液編號
    $area=$_POST['selectArea'];//區域
    $now=date("Y-m-d");
    $query="UPDATE cows_information SET dob='$dob',birthParity='$birthParity',calvingInterval='$calvingInterval',mid='$mid',fid='$fid',area='$area',areatime='$now' WHERE `sn`= '$GetSn'";
    $result = mysqli_query($db_link,$query);

if($result)
{
header("location:cowInformation.php?GetSn={$GetSn}");

}
else
{
echo 'Please Check Your Query';
}
}
else
{
    header("location:cowInformation.php?GetSn={$GetSn}");
}
echo $query;
?>

