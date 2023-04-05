<?php
require_once("../../SQLServer.php");


if (isset($_POST['submit'])) {

    $id = $_POST['id'];
    $date = $_POST['date'];
    $birthParity = $_POST['birthParity'];
    $events = $_POST['events'];
    $details = $_POST['details'];

    $query = "INSERT INTO parturition_history (id, date, birthParity, events, details) VALUES('$id','$date', '$birthParity', '$events', '$details' )";
    $result = mysqli_query($db_link, $query);

    if ($result) {
        header("location:growthInformation.php");
    } else {
        echo 'Please check ur query';
    }
} else {
    header("location:growthInformation.php");
}
?>