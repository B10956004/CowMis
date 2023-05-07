<?php
require("../../../SQLServer.php");
$id=$_GET['id'];
// 執行 SQL 查詢
$result = mysqli_query($db_link,"SELECT * FROM pedometer WHERE id='$id' AND (date BETWEEN DATE_SUB(NOW(), INTERVAL 7 DAY) AND NOW() OR DATE(date) = CURDATE())");

// 將資料轉換為 JSON 格式
$data = [];
while ($row = $result->fetch_assoc()) {
    $data[] = [
        'date' => $row['date'],
        'value' => (int) $row['value']
    ];
}
$json_data = json_encode($data);
header('Content-Type: application/json');
echo $json_data;
?>