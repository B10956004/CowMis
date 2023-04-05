<?php
require_once("../../SQLServer.php");


if (isset($_POST['submit'])) {

    $id = $_POST['id']; //編號
    $dueDate = $_POST['dueDate']; //預期分娩日
    $dateCompleted = $_POST['dateCompleted']; //實際分娩日
    $birthParity = $_POST['birthParity']; //胎次
    $birthEvent = $_POST['birthEvent']; //胎別
    $area = $_POST['area']; //區域
    $class = $_POST['class']; //類別

    $query = "INSERT INTO mating_module (id, dueDate, dateCompleted, birthParity, birthEvent, area, class )VALUES('$id','$dueDate', '$dateCompleted', '$birthParity', '$birthEvent','$area','$class' )";
    $result = mysqli_query($db_link, $query);
    if ($result) {
        header("location:matingModule.php");
    } else {
        echo 'Please check ur query';
    }
} else {
    header("location:matingModule.php");
}
?>