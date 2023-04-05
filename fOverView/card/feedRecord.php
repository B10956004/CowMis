<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<?php
require_once("../../SQLServer.php");
$GetSn = $_GET['GetSn'];
$query = "SELECT * FROM cows_information WHERE isDel = 0 AND sn=$GetSn";
$result = mysqli_query($db_link, $query);
while ($row = mysqli_fetch_array($result)) {
    $GetID = $row['id']; //尋找ID
}
?>
<div class="card-body">
    <h5 class="card-title"><i class="fas fa-seedling"></i>&nbsp;飼養管理紀錄</h5>
    <div class="table-responsive">
        <div id="cow_table" style="text-align:center;">

            <table id="rule" class="table table-hover">
                <thead>
                    <tr class="table-active">
                        <th>進場日期</th>
                        <th>系譜</th>
                        <th>精料</th>
                        <th>芻料</th>
                        <th>懷孕</th>
                        <th>泌乳</th>
                        <th>飲水量</th>
                        <th>餵養時間</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = "SELECT * FROM feed_record WHERE isDel=0 AND id='$GetID'  ORDER BY `feedTime` DESC LIMIT 0,2";
                    $result = mysqli_query($db_link, $query);
                    while ($row = mysqli_fetch_assoc($result)) {
                        $date = $row['date']; //進場時間
                        $genealogy = $row['genealogy']; //系譜
                        $concentrate = $row['concentrate']; //精料
                        $forage = $row['forage']; //芻料
                        $isPregnancy = $row['isPregnancy']; //懷孕
                        $lactation = $row['lactation']; //泌乳
                        $waterIntake = $row['waterIntake']; //飲水量
                        $feedTime = $row['feedTime']; //餵養時間
                    ?>
                        <tr>
                            <td><?php echo $date ?></td>
                            <td><?php echo $genealogy ?></td>
                            <td><?php echo $concentrate ?></td>
                            <td><?php echo $forage ?></td>
                            <td><?php echo $isPregnancy ?></td>
                            <td><?php echo $lactation ?></td>
                            <td><?php echo $waterIntake ?></td>
                            <td><?php echo $feedTime ?></td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>