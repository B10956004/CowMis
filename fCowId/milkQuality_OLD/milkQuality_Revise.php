<!-- 連接資料庫 -->
<?php
require_once("../../SQLServer.php");
$GetSn = $_GET['GetSn'];
$query = "SELECT * FROM milk_Quality WHERE sn='$GetSn'";
$result = mysqli_query($db_link, $query);

while ($row = mysqli_fetch_assoc($result)) {
  $id = $row['id'];
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
<!-- 搜尋特定欄位的資訊並以彈出視窗顯示 -->
<form action="milkQuality_Revise_action.php?GetSn=<?php echo $GetSn ?>" method="post">
  <input type="text" class="form-control mb-2" placeholder="編號" name="id" value="<?php echo $id ?>" readonly>
  <input type="date" class="form-control mb-2" placeholder="檢測日期" name="date" value="<?php echo $date ?>" required>
  <input type="text" class="form-control mb-2" placeholder="乳脂率" name="milkFatPrecentage" value="<?php echo $milkFatPrecentage ?>" required>
  <input type="text" class="form-control mb-2" placeholder="乳蛋白" name="milkProtein" value="<?php echo $milkProtein ?>" required>
  <input type="text" class="form-control mb-2" placeholder="體細胞數" name="somaticCellCount" value="<?php echo $somaticCellCount ?>" required>
  <input type="text" class="form-control mb-2" placeholder="酸度" name="acidity" value="<?php echo $acidity ?>" required>
  <input type="text" class="form-control mb-2" placeholder="血乳" name="bloodyMilk" value="<?php echo $bloodyMilk ?>" required>
  <input type="text" class="form-control mb-2" placeholder="無脂固形物" name="milkSolidsNotFat" value="<?php echo $milkSolidsNotFat ?>" required>
  <input type="text" class="form-control mb-2" placeholder="生菌數" name="totalBacteria" value="<?php echo $totalBacteria ?>" required>
  <input type="submit" class="btn btn-info" name="update" value="修改">
</form>

</html>