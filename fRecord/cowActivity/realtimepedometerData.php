<?php
require("../../SQLServer.php");

// 從 GET 取得 cid
$cid = $_GET['cid'];
$cid = mysqli_real_escape_string($db_link, $cid);

// 查找對應的 device_id (uuid)
$uuid_query = "SELECT uuid FROM sensor_management WHERE cid = '$cid' LIMIT 1";
$uuid_result = mysqli_query($db_link, $uuid_query);
$uuid_row = mysqli_fetch_assoc($uuid_result);

if ($uuid_row && isset($uuid_row['uuid'])) {
    $uuid = mysqli_real_escape_string($db_link, $uuid_row['uuid']);

    // 查詢最新的 step 與 label
    $query = "SELECT `device_id`,`timestamp`,`step`, `label` FROM sensor_log 
              WHERE uuid = '$uuid' 
              ORDER BY `timestamp` DESC LIMIT 60";
    $result = mysqli_query($db_link, $query);
    $data = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }

    // 時間由新到舊轉為舊到新
    $data = array_reverse($data);

    header('Content-Type: application/json');
    echo json_encode($data);
} else {
    echo json_encode(["error" => "No uuid found for cid: $cid"]);
}
?>
