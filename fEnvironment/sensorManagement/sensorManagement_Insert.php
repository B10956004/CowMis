<?php
require_once("../../SQLServer.php");


if (isset($_POST['submit'])) {
    $cid = $_POST['cid']; //牛編號
    $uuid = $_POST['uuid']; //感測器編號
    $model = $_POST['model']; //型號
    $query = "INSERT INTO `sensor_management`(`uuid`, `model`, `states`, `cid`) VALUES ('$uuid','$model','未連接','$cid')";
    $result = mysqli_query($db_link, $query);
    if ($result) {
        header("location:sensorManagement.php");
    } else {
        echo "<script>
        alert('感測器編號不可重複，請再確認一次!');
        setTimeout(function(){window.location.href='sensorManagement.php'},0);
        </script>";
    }
} else {
    header("location:sensorManagement.php");
}
