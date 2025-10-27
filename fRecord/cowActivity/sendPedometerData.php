<?php
require("../../SQLServer.php");

// 從 GET 取得參數
$device_id = $_GET['device_id'];
$uuid=$_GET['uuid'];
$x = $_GET['x'];
$y = $_GET['y'];
$z = $_GET['z'];
$step = $_GET['step'];
$label = $_GET['label'];
$timestamp = $_GET['timestamp'];  // 格式應為 ISO 字串，例如 2025-05-25T19:00:00

// 為避免 SQL 錯誤，確保數值格式正確（浮點數/整數）
$x = number_format((float)$x, 6, '.', '');
$y = number_format((float)$y, 6, '.', '');
$z = number_format((float)$z, 6, '.', '');
$step = intval($step);
$label = mysqli_real_escape_string($db_link, $label);
$device_id = mysqli_real_escape_string($db_link, $device_id);
$timestamp = mysqli_real_escape_string($db_link, $timestamp);

// 插入資料
$query = "INSERT INTO sensor_log (`timestamp`, `uuid`,`device_id`, `x`, `y`, `z`, `step`, `label`) 
          VALUES ('$timestamp','$uuid', '$device_id', $x, $y, $z, $step, '$label')";
$result = mysqli_query($db_link, $query);

// 回傳結果
header('Content-Type: text/plain');
if ($result) {
    echo 'Insert success';
} else {
    echo 'Insert fail: ' . mysqli_error($db_link);
}
?>
