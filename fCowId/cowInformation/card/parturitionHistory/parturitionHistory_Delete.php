<?php
require_once("../../../../SQLServer.php");
date_default_timezone_set('Asia/Taipei');
if(isset($_POST['Del']))
{
    $postSn=$_POST['postSn'];
    $today=date("Y-m-d H:i:s");
$query = "DELETE FROM `pregnancy_check` WHERE `sn` = '$postSn';";
$result = mysqli_query($db_link,$query);

if($result)
{
    header("location:../../cowInformation.php");

}
else
{
    echo 'Please Check Your Query';
}
}
else
{
    header("location:../../cowInformation.php");
}
