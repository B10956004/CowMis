<?php

require_once("../../SQLServer.php");
if (isset($_POST['update']))
{
    $GetSn=$_GET['GetSn'];
    $id = $_POST['id'];
    $date = $_POST['date'];
    if ($_POST['selectDisease'] != '其他疾病') {
        $disease = $_POST['selectDisease'];
    }else{
        $disease=$_POST['otherDisease'];
    }
    if ($_POST['selectDrug'] != '其他藥品') {
        $drugs = $_POST['selectDrug'];
    }else{
        $drugs=$_POST['otherDrug'];
    }
    if ($_POST['selectVaccine'] != '其他疾病') {
        $vaccines = $_POST['selectVaccine'];
    }else{
        $vaccines=$_POST['otherVaccine'];
    }
$query = "UPDATE disease_management SET date='$date',disease='$disease',drugs='$drugs',vaccines='$vaccines' WHERE sn='$GetSn' AND id='$id'";
$result = mysqli_query($db_link,$query);
echo $query;
if($result)
{
header("location:diseaseManagement.php");

}
else
{
echo 'Please Check Your Query';
}
}
else
{
    header("location:diseaseManagement.php");
}
