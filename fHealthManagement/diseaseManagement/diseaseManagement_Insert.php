<?php
require_once("../../SQLServer.php");


if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $date = $_POST['date'];
    if ($_POST['remark'] == '') {
        $remark = '無';
    } else {
        $remark = $_POST['remark'];
    }
    if ($_POST['selectDisease'] != '其他疾病') {
        $disease = $_POST['selectDisease'];
    } else {
        $disease = $_POST['otherDisease'];
    }
    if ($_POST['selectDrug'] != '其他藥品') {
        $drugs = $_POST['selectDrug'];
    } else {
        $drugs = $_POST['otherDrug'];
    }
    $query = "INSERT INTO disease_management (id,date, disease, drugs, remark) VALUES('$id','$date', '$disease', '$drugs', '$remark')";
    $result = mysqli_query($db_link, $query);
    if ($result) {

        header("location:diseaseManagement.php");
    } else {
        echo 'Please check ur query';
    }
} else {
    header("location:diseaseManagement.php");
}
