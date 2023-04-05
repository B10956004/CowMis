<?php
header('Content-Type: application/json');
require_once("../SQLServer.php");
// $sql = "SELECT * FROM `test` WHERE `time` > (NOW() - INTERVAL 10 SECOND)";
// $sql = "SELECT * FROM (SELECT * FROM `test` ORDER BY `time` LIMIT 50) AS record ORDER BY `time` ASC"; //BT5.0巢狀查詢(找最新50筆，由舊到新顯示)
$sql = "SELECT * FROM (SELECT * FROM `test2` ORDER BY `time` LIMIT 50) AS record ORDER BY `time` ASC"; //BT2.0巢狀查詢(找最新50筆，由舊到新顯示)
$result = mysqli_query($db_link, $sql);
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = array(
        'Time' => $row['time'],
        'deviceName' => $row['deviceName'],
        // 'Battery' => $row['battery'],
        'hx' => $row['hx'],
        'hy' => $row['hy'],
        'hz' => $row['hz'],
        'temp' => $row['temp'],
        'q0' => $row['q0'],
        'q1' => $row['q1'],
        'q2' => $row['q2'],
        'q3' => $row['q3'],
        'ax' => $row['ax'],
        'ay' => $row['ay'],
        'az' => $row['az'],
        'wx' => $row['wx'],
        'wy' => $row['wy'],
        'wz' => $row['wz'],
        'X' => $row['x'],
        'Y' => $row['y'],
        'Z' => $row['z']
    );
}
$json_data = json_encode($data); // 將資料轉成 JSON 格式回傳
if (json_last_error() !== JSON_ERROR_NONE) {
    die('JSON 資料格式有誤：' . json_last_error_msg());
}
echo $json_data;
echo "\r\n";
flush(); //直接將緩衝送至client端 *無需等待buffer滿
ob_flush();//刷新輸出buffer並強制送至client端
sleep(1); // 延遲1秒，模擬即時輸出
// 關閉連接
mysqli_close($db_link);
