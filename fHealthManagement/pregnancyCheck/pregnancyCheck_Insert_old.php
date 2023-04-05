<?php
require_once("../../SQLServer.php");


if (isset($_POST['submit'])) {
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
    $query = "INSERT INTO disease_management (id,date, disease, drugs, vaccines) VALUES('$id','$date', '$disease', '$drugs', '$vaccines')";
    $result = mysqli_query($db_link, $query);
    if ($result) {

        header("location:pregnancyCheck.php");
    } else {
        echo 'Please check ur query';
    }
} else {
    header("location:pregnancyCheck.php");
}
