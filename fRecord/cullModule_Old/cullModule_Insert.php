<?php
require_once("../../SQLServer.php");


if (isset($_POST['submit'])) {

    $id = $_POST['id'];
    $standUp = $_POST['standUp'];
    $crouch = $_POST['crouch'];
    $ingestion = $_POST['ingestion'];
    $mating = $_POST['mating'];
    $buttocksUp = $_POST['buttocksUp'];
    $headOn = $_POST['headOn'];

    $query = "INSERT INTO cull_module (id, standUp, crouch,ingestion,mating,buttocksUp,headOn) VALUES('$id', '$standUp', '$crouch',  '$ingestion' , '$mating', '$buttocksUp', '$headOn')";
    $result = mysqli_query($db_link, $query);

    if ($result) {

        header("location:cullModule.php");
    } else {
        echo 'Please check ur query';
    }
} else {
    header("location:cullModule.php");
}
