<?php
header('Content-Type: application/json');
require("../../SQLServer.php");

$id = $_GET['id'];

// 取得 sensor_management 中對應 cid 的 uuid
$subquery = "SELECT uuid FROM sensor_management WHERE cid = '$id'";

// 查詢近 7 天 sensor_log 資料
$query = "
    SELECT * FROM sensor_log 
    WHERE uuid = ($subquery) 
    AND (
        timestamp BETWEEN DATE_SUB(NOW(), INTERVAL 7 DAY) AND NOW() 
        OR DATE(timestamp) = CURDATE()
    )
";
$result = mysqli_query($db_link, $query);

if (!$result) {
    die(json_encode(['error' => 'Data query failed: ' . mysqli_error($db_link)]));
}

// 將資料轉換為 JSON 格式
$data = [[]];
while ($row = $result->fetch_assoc()) {
    $data[0][] = [
        'date' => $row['timestamp'],
        'value' => (int) $row['step']
    ];
}

// // 用 uuid 查詢 sensor_log 資料並計算 rolling 平均與標準差
$rollingQuery = "
SELECT 
    '$id' AS cid,
    rolling_avg AS avg,
    rolling_std_dev AS std_dev,
    DATE(timestamp) AS date
FROM (
    SELECT 
        step AS value,
        timestamp,
        AVG(step) OVER (ORDER BY DATE(timestamp) ROWS BETWEEN 1 PRECEDING AND CURRENT ROW) AS rolling_avg,
        STDDEV_POP(step) OVER (ORDER BY DATE(timestamp) ROWS BETWEEN 1 PRECEDING AND CURRENT ROW) AS rolling_std_dev
    FROM sensor_log 
    WHERE uuid = ($subquery)
    AND timestamp BETWEEN DATE_SUB(NOW(), INTERVAL 7 DAY) AND NOW()
) AS sub_query
GROUP BY DATE(timestamp), rolling_avg, rolling_std_dev
";

$resultRolling = mysqli_query($db_link, $rollingQuery);

if (!$resultRolling) {
    die(json_encode(['error' => 'Rolling query failed: ' . mysqli_error($db_link)]));
}

while ($row = $resultRolling->fetch_assoc()) {
    $data[1][] = [
        'avg' => $row['avg'],
        'std_dev' => $row['std_dev'],
        'day' => $row['date']
    ];
}

// 輸出 JSON
echo json_encode($data);
?>
