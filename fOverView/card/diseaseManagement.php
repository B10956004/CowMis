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
    <h5 class="card-title"><i class="fas fa-heart"></i>&nbsp;疾病資訊</h5>
    <div class="table-responsive">
        <div id="cow_table" style="text-align:center;">
            <table id="rule" class="table table-hover">
                <thead>
                    <tr class="table-active">
                        <th>日期</th>
                        <th>疾病</th>
                        <th>藥品</th>
                        <th>疫苗</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- 控制每頁的欄數 -->
                <?php
                $query = "SELECT * FROM disease_management WHERE isDel=0 AND id='$GetID'  ORDER BY `date` DESC LIMIT 0,2";
                $result = mysqli_query($db_link, $query);
                while ($row = mysqli_fetch_assoc($result)) {
                  $date=$row['date'];//日期
                  $disease = $row['disease'];//疾病種類
                  $drugs = $row['drugs'];//藥品紀錄
                  $vaccines = $row['vaccines'];//疫苗紀錄
                ?>
                  <tr>
                    <td><?php echo $date ?></td>
                    <td><?php echo $disease ?></td>
                    <td><?php echo $drugs ?></td>
                    <td><?php echo $vaccines ?></td>
                <?php   
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>