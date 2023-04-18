<?php
require_once("../../../SQLServer.php");
$now=date("Y-m-d");
$area=$_POST['PostArea'];
$id=$_POST['PostID'];
$sql="UPDATE `cows_information` SET `area`='$area' , `areatime`='$now'  WHERE id='$id'";
mysqli_query($db_link,$sql);
?>