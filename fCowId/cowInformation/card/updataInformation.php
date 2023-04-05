<?php
require_once("../../../SQLServer.php");
$now=date("Y-m-d");
$area=$_POST['PostArea'];
$sn=$_POST['PostSn'];
$sql="UPDATE `cows_information` SET `area`='$area' , `areatime`='$now'  WHERE sn='$sn'";
mysqli_query($db_link,$sql);
?>