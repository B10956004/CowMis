<?php
require_once("../../SQLServer.php");


if (isset($_POST['submit'])) {

    $id = $_POST['id'];
    $date = $_POST['date'];
    $genealogy = $_POST['genealogy'];
    $concentrate = $_POST['concentrate'];
    $forage = $_POST['forage'];
    $isPregnancy = $_POST['isPregnancy'];
    $lactation = $_POST['lactation'];
    $waterIntake = $_POST['waterIntake'];
    $feedTime = $_POST['feedTime'];
    $recordTime = $_POST['recordTime'];

    $query = "INSERT INTO feed_record (id, date, genealogy,concentrate,forage,isPregnancy,lactation,waterIntake,feedTime,recordTime) VALUES('$id',  '$date', '$genealogy', '$concentrate' ,'$forage', '$isPregnancy','$lactation' ,'$waterIntake', '$feedTime', '$recordTime')";
    $result = mysqli_query($db_link, $query);

    if ($result) {

        header("location:feedRecord.php");
    } else {
        echo 'Please check ur query';
    }
} else {
    header("location:feedRecord.php");
}
