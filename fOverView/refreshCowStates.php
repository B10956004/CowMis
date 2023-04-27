
<?php
require_once("../SQLServer.php"); //注入SQL檔
if($_GET['Refresh']==true){
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
            if($row['states']!=null){
                $states = $row['states'];
            } else {
                $states = '未配戴';
            }

            echo "<td>";
            if ($states == '未連接' || $states == '未配戴') {
                echo "<i class=\"fas fa-circle\" style=\"color: red;\"></i>";
            } elseif ($states == '正常') {
                echo "<i class=\"fas fa-circle\" style=\"color: green;\"></i>";
            } else {
                echo "<i class=\"fas fa-circle\" style=\"color: yellow;\"></i>";
            }
            echo $states;
            echo "</td>";

            echo "<td><a href=\"../fCowId/cowInformation/cowInformation.php?GetID=$id\" target=\"frame\">$id</a></td>";
            echo "</tr>";
        }
        echo "</table>";
    }
?>