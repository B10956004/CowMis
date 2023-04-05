<!-- 連接資料庫 -->
<?php
require_once("../../SQLServer.php");
$GetID = $_GET['GetID'];
$query = "SELECT * FROM milk_Quality WHERE id='$GetID' AND isDel=0 ORDER BY `date` DESC LIMIT 0,3";
$result = mysqli_query($db_link, $query);
while ($row = mysqli_fetch_assoc($result)) {
    $date = $row['date'];
    $milkFatPrecentage = $row['milkFatPrecentage'];
    $milkProtein = $row['milkProtein'];
    $somaticCellCount = $row['somaticCellCount'];
    $acidity = $row['acidity'];
    $bloodyMilk = $row['bloodyMilk'];
    $milkSolidsNotFat = $row['milkSolidsNotFat'];
    $totalBacteria = $row['totalBacteria'];
}
?>
<!DOCTYPE html>
<div class="table-responsive">
    <div id="cow_table" style="text-align:center;">

        <table id="rule" class="table table-hover">
            <thead>
                <tr class="table-active">
                    <th>檢測日期</th>
                    <th>乳脂率</th>
                    <th>乳蛋白</th>
                    <th>體細胞數</th>
                    <th>酸度</th>
                    <th>血乳</th>
                    <th>無脂固形物</th>
                    <th>生菌數</th>
                </tr>
            </thead>
            <tbody>
                <?php if (mysqli_num_rows($result) >= 1) {
                    echo "
                    <td>$date</td>
                    <td>$milkFatPrecentage</td>
                    <td>$milkProtein</td>
                    <td>$somaticCellCount</td>
                    <td>$acidity</td>
                    <td>$bloodyMilk</td>
                    <td>$milkSolidsNotFat</td>
                    <td>$totalBacteria</td>
                    ";
                }
                ?>

                </tr>
            </tbody>
        </table>
    </div>
</div>

</html>