<?php
require_once("../../SQLServer.php");


if (isset($_POST['submit'])) {

    $id = $_POST['id'];
    $checkDate = $_POST['checkDate'];
    $pregnancyResult = $_POST['pregnancyResult'];

    $query = "INSERT INTO rectal_examination (id, checkDate, pregnancyResult) VALUES('$id', '$checkDate', '$pregnancyResult')";
    $result = mysqli_query($db_link, $query);

    if ($result) {

        header("location:rectalExamination.php");
    } else {
        echo 'Please check ur query';
    }
} else {
    header("location:rectalExamination.php");
}
