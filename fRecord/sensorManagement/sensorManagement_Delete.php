<?php
require_once("../../SQLServer.php");

if(isset($_POST['Del']))
{
    $postUuid=$_POST['postUuid'];
    $query = "DELETE FROM `sensor_management` WHERE uuid='$postUuid'";
    $result = mysqli_query($db_link,$query);

if($result)
{
    header("location:sensorManagement.php");

}
else
{
    echo 'Please Check Your Query';
}
}
else
{
    header("location:sensorManagement.php");
}
?>