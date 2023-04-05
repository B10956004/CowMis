<?php
require_once("../../SQLServer.php");


if (isset($_POST['submit'])) {

    $id = $_POST['id'];
    $estrusDate = $_POST['estrusDate'];
    $intervalDays = $_POST['intervalDays'];
    $isMating = $_POST['isMating'];
    $semenNumber = $_POST['semenNumber'];

    $query = "INSERT INTO estrus_record (id, estrusDate, intervalDays, isMating, semenNumber) VALUES('$id', '$estrusDate', '$intervalDays','$isMating','$semenNumber')";
    $result = mysqli_query($db_link, $query);

    if ($result) {
        header("location:estrusRecord.php");
    } else {
        echo 'Please check ur query';
    }
} else {
    header("location:estrusRecord.php");
}
