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
</head>

<body>
    <?php
    $query = "SELECT * FROM cows_information ";
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
        echo "<td>狀態</td>";
        echo "<td>$id</td>";
        echo "</tr>";
    }
    echo "</table>";
    ?>
</body>

</html>