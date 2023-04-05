<?php

require_once("../../SQLServer.php");
if (isset($_POST['update']))
{
    $GetSn=$_GET['GetSn'];
    $id = $_POST['id'];
    $standUp = $_POST['standUp'];
    $crouch = $_POST['crouch'];
    $ingestion = $_POST['ingestion'];
    $mating = $_POST['mating'];
    $buttocksUp = $_POST['buttocksUp'];
    $headOn = $_POST['headOn'];

$query = "UPDATE cull_module SET standUp='$standUp',crouch='$crouch',ingestion='$ingestion',mating='$mating',buttocksUp='$buttocksUp',headOn='$headOn' WHERE sn='$GetSn'";
$result = mysqli_query($db_link,$query);

if($result)
{
header("location:cullModule.php");

}
else
{
echo 'Please Check Your Query';
}
}
else
{
    header("location:cullModule.php");
}
?>

