<?php
require("../../SQLServer.php");
$id=$_GET['id'];
// 執行 SQL 查詢
$result = mysqli_query($db_link,"SELECT * FROM pedometer WHERE id='$id'");

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