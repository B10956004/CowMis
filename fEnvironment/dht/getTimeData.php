<?php
require("../../SQLServer.php");

// 執行SQL查詢
$sql = "SELECT time FROM dht ORDER BY time DESC LIMIT 1";
$result = mysqli_query($db_link,$sql);

// 獲取查詢結果
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $time = $row["time"];
} else {
    $time = '發生異常，請檢查裝置!';
}
// 返回數據
echo $time;
?>
