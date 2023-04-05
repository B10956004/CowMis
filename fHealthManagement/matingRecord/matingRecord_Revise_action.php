<?php

require_once("../../SQLServer.php");
if (isset($_POST['update']))
{
    $GetSn=$_GET['GetSn'];
    $id = $_POST['id'];
    $matingDate = $_POST['matingDate'];
    $frequency = $_POST['frequency'];
    $status = $_POST['status'];
    $matingMethod = $_POST['matingMethod'];
    $abortion = $_POST['abortion'];

    $query = "UPDATE mating_record SET id='$id',matingDate='$matingDate',frequency='$frequency',status='$status',matingMethod='$matingMethod',abortion='$abortion'WHERE sn='$GetSn'";

    $result = mysqli_query($db_link,$query);

if($result)
{
header("location:matingRecord.php");

}
else
{
echo 'Please Check Your Query';
}
}
else
{
    header("location:matingRecord.php");
}
?>

