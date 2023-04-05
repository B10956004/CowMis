<?php
require_once("../../SQLServer.php");


if (isset($_POST['submit'])) {

    $id = $_POST['id'];
    $matingDate = $_POST['matingDate'];
    $frequency = $_POST['frequency'];
    $status = $_POST['status'];
    $matingMethod = $_POST['matingMethod'];
    $abortion = $_POST['abortion'];


    $query = "INSERT INTO mating_record (id, matingDate, frequency,status,matingMethod,abortion) VALUES('$id', '$matingDate', '$frequency','$status','$matingMethod','$abortion')";
    $result = mysqli_query($db_link, $query);
    if ($result) {
        header("location:matingRecord.php");
    } else {
        echo 'Please check ur query';
    }
} else {
    header("location:matingRecord.php");
}
