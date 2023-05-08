<?php

require_once("../../SQLServer.php");
if (isset($_POST['update'])) {
    $cid = $_POST['cid']; //牛編號
    $uuid = $_POST['uuid']; //感測器編號
    $model = $_POST['model']; //型號
    $query = "UPDATE `sensor_management` SET `model`='$model',`cid`='$cid',`recordTime`=(SELECT CURRENT_TIMESTAMP) WHERE `uuid`='$uuid'";
    $result = mysqli_query($db_link, $query);

    if ($result) {
        header("location:sensorManagement.php");
    } else {
        echo 'Please Check Your Query';
    }
} else {
    header("location:sensorManagement.php");
}
