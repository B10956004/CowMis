<?php

require_once("../../SQLServer.php");
if (isset($_POST['update']))
{
    $GetSn=$_GET['GetSn'];
    $id = $_POST['id'];
    $dueDate = $_POST['dueDate']; //預期分娩日
    $dateCompleted = $_POST['dateCompleted']; //實際分娩日
    $birthParity = $_POST['birthParity']; //胎次
    $birthEvent = $_POST['birthEvent']; //胎別
    $area = $_POST['area']; //區域
    $class = $_POST['class']; //類別

$query = "UPDATE mating_module SET dueDate='$dueDate',dateCompleted='$dateCompleted',birthParity='$birthParity',birthEvent='$birthEvent',area='$area',class='$class' WHERE sn='$GetSn'";
$result = mysqli_query($db_link,$query);

if($result)
{
header("location:matingModule.php");
}
else
{
echo 'Please Check Your Query';
}
}
else
{
    header("location:matingModule.php");
}
?>

