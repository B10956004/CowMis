<?php
require("../../SQLServer.php");

// 執行SQL查詢
$sql = "SELECT thi FROM dht ORDER BY time DESC LIMIT 1";
$result = mysqli_query($db_link,$sql);

// 獲取查詢結果
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $thi = $row["thi"];
} else {
    $thi = 0;
}
// 返回數據
echo $thi;
?>
