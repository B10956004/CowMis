<!DOCTYPE html>
<html>

<head>
    <?php
    require_once("../SQLServer.php"); //注入SQL檔
    ?>
    <style>
        th,
        td {
            border: 1px solid black;
            border-radius: 10px;
            vertical-align: middle;
            text-align: center;
        }
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
</head>
<script>
    setInterval(function() {
        $.ajax({
            url: "refreshCowStates.php",
            method: "GET",
            data: {
                Refresh: true
            },
            success: function(data) {
                $('#cowStates').html(data);
            }
        });
    }, 1000); // 每 1 秒檢查刷新頁面
</script>

<body>
    <div id="cowStates">
        <?php
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
            if ($states == '未連接'||$states=='未配戴') {
                echo "<i class=\"fas fa-circle\" style=\"color: gray;\"></i>";
              } elseif ($states == '正常') {
                echo "<i class=\"fas fa-circle\" style=\"color: green;\"></i>";
              }elseif($states=='疑似發情'||$states=='發情'){
                echo "<i class=\"fas fa-circle\" style=\"color: red;\"></i>";
              }
               else {
                echo "<i class=\"fas fa-circle\" style=\"color: gold;\"></i>";
              }
            echo $states;
            echo "</td>";

            echo "<td><a href=\"../fCowId/cowInformation/cowInformation.php?GetID=$id\" target=\"frame\">$id</a></td>";
            echo "</tr>";
        }
        echo "</table>";
        ?>
    </div>
</body>

</html>