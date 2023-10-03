<?php
require("../../SQLServer.php");
$id=$_GET['id'];
// 執行 SQL 查詢
$result = mysqli_query($db_link,"SELECT * FROM pedometer WHERE id='$id' AND (date BETWEEN DATE_SUB(NOW(), INTERVAL 7 DAY) AND NOW() OR DATE(date) = CURDATE())");

// 將資料轉換為 JSON 格式
$data = [[]];
while ($row = $result->fetch_assoc()) {
    $data[0][] = [
        'date' => $row['date'],
        'value' => (int) $row['value']

    ];
}
$resultRolling=mysqli_query($db_link,"SELECT id,
rolling_avg as avg,
rolling_std_dev as std_dev,
Date(date) as date
FROM (
SELECT id,value,date,
 AVG(value) OVER (PARTITION BY id ORDER BY (Date(date) - CURDATE()) RANGE BETWEEN 1 PRECEDING AND CURRENT ROW) as rolling_avg,
 STDDEV_POP(value) OVER (PARTITION BY id ORDER BY (Date(date) - CURDATE()) RANGE BETWEEN 1 PRECEDING AND CURRENT ROW) as rolling_std_dev
FROM (SELECT DISTINCT id, date, value FROM pedometer WHERE date BETWEEN DATE_SUB(NOW(), INTERVAL 7 DAY) AND NOW()) AS pedometer
) AS sub_query
WHERE id='05Q119' GROUP by id,Date(date), rolling_avg, rolling_std_dev");
while($row=$resultRolling->fetch_assoc()){
    $data[1][]=[
        'avg'=>$row['avg'],
        'std_dev'=>$row['std_dev'],
        'day'=>$row['date']
    ];
}
$json_data = json_encode($data);
header('Content-Type: application/json');
echo $json_data;
?>