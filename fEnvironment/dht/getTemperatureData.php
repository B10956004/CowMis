<?php
require("../../SQLServer.php");

// 執行SQL查詢
$sql = "SELECT temperature FROM dht ORDER BY time DESC LIMIT 1";
$result = mysqli_query($db_link,$sql);

// 獲取查詢結果
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $temperature = $row["temperature"];
} else {
    $temperature = 0;
}
// 返回數據
echo $temperature;
?>
