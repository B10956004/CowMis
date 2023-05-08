
<?php
require_once("../SQLServer.php"); //注入SQL檔
if ($_GET['Refresh'] == true) {
    //計算資料庫裡標準化值大於5和小於-5的id各有多少
    $pedoQuery = "SELECT pedometer.id, 
    IFNULL(SUM(CASE WHEN (pedometer.value - sub.avg_value) / sub.std_dev > 5 THEN 1 ELSE 0 END), 0) AS count_above_5,
    IFNULL(SUM(CASE WHEN (pedometer.value - sub.avg_value) / sub.std_dev < -5 THEN 1 ELSE 0 END), 0) AS count_below_neg_5
    FROM pedometer
    LEFT JOIN (
        SELECT id, AVG(value) AS avg_value, STDDEV(value) AS std_dev
        FROM pedometer
        WHERE date BETWEEN DATE_SUB(NOW(), INTERVAL 7 DAY) AND NOW() OR DATE(date) = CURDATE()
        GROUP BY id
        ) AS sub ON pedometer.id = sub.id
    WHERE (
    pedometer.date BETWEEN DATE_SUB(NOW(), INTERVAL 7 DAY) AND NOW() 
    OR DATE(pedometer.date) = CURDATE()
    )
    GROUP BY pedometer.id;";
    $pedoResult = mysqli_query($db_link, $pedoQuery);
    while ($pedoRows = mysqli_fetch_array($pedoResult)) {
        $cid = $pedoRows['id'];
        $count_above_5 = $pedoRows['count_above_5'];
        $count_below_neg_5 = $pedoRows['count_below_neg_5'];
        if ($count_above_5 > $count_below_neg_5) {
            mysqli_query($db_link, "UPDATE `sensor_management` SET `states`='疑似發情',`recordTime`=CURRENT_TIMESTAMP WHERE cid='$cid'");
        } else {
            if ($count_above_5 < $count_below_neg_5) {
                mysqli_query($db_link, "UPDATE `sensor_management` SET `states`='活動量低',`recordTime`=CURRENT_TIMESTAMP WHERE cid='$cid'");
            } else {
                mysqli_query($db_link, "UPDATE `sensor_management` SET `states`='正常',`recordTime`=CURRENT_TIMESTAMP WHERE cid='$cid'");
            }
        }
    }


    $query = "SELECT cows_information.*, sensor_management.*
        FROM cows_information
        LEFT JOIN sensor_management
        ON cows_information.id = sensor_management.cid
            AND sensor_management.recordTime = (
                SELECT MAX(recordTime)
                FROM sensor_management
                WHERE sensor_management.cid = cows_information.id
            )
        ORDER BY sensor_management.recordTime DESC, cows_information.id ASC;
        ";
    $result = mysqli_query($db_link, $query);
    echo "<table style=\"width:100%\">
<tr>
  <th>狀態</th>
  <th>編號</th> 
</tr>";
    while ($row = mysqli_fetch_array($result)) {
        echo "<tr>";
        $sn = $row['sn'];
        $id = $row['id'];
        if ($row['states'] != null) {
            $states = $row['states'];
        } else {
            $states = '未配戴';
        }

        echo "<td>";
        if ($states == '未連接' || $states == '未配戴') {
            echo "<i class=\"fas fa-circle\" style=\"color: gray;\"></i>";
        } elseif ($states == '正常') {
            echo "<i class=\"fas fa-circle\" style=\"color: green;\"></i>";
        } elseif ($states == '疑似發情' || $states == '發情') {
            echo "<i class=\"fas fa-circle\" style=\"color: red;\"></i>";
        } else {
            echo "<i class=\"fas fa-circle\" style=\"color: gold;\"></i>";
        }
        echo $states;
        echo "</td>";

        echo "<td><a href=\"../fCowId/cowInformation/cowInformation.php?GetID=$id\" target=\"frame\">$id</a></td>";
        echo "</tr>";
    }
    echo "</table>";
}
?>