<?php

require_once("../../SQLServer.php");
if (isset($_POST['update']))
{
    $GetSn=$_GET['GetSn'];
    $id = $_POST['id'];
    $date = $_POST['date'];
    if ($_POST['remark'] == '') {
        $remark = '無';
    } else {
        $remark = $_POST['remark'];
    }
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
$query = "UPDATE disease_management SET date='$date',disease='$disease',drugs='$drugs',remark='$remark' WHERE sn='$GetSn' AND id='$id'";
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
