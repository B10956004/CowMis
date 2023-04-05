<!-- 連接資料庫 -->
<?php
require_once("../../SQLServer.php");
$GetSn = $_GET['GetSn'];
$query = "SELECT * FROM estrus_record WHERE sn='$GetSn'";
$result = mysqli_query($db_link, $query);

while ($row = mysqli_fetch_assoc($result)) {
  $id = $row['id'];
  $estrusDate = $row['estrusDate'];
  $intervalDays = $row['intervalDays'];
  $isMating = $row['isMating'];
  $semenNumber = $row['semenNumber'];
}
?>


<!DOCTYPE html>
<!-- 搜尋特定欄位的資訊並以彈出視窗顯示 -->
<form action="estrusRecord_Revise_action.php?GetSn=<?php echo $GetSn ?>" method="post">
  <input type="text" class="form-control mb-2" placeholder="編號" name="id" value="<?php echo $id ?> " readonly>
  <input type="date" class="form-control mb-2" placeholder="發情日期" name="estrusDate" value="<?php echo $estrusDate ?>" required>
  <input type="text" class="form-control mb-2" placeholder="間隔天數" name="intervalDays" value="<?php echo $intervalDays ?>" required>
  <input type="text" class="form-control mb-2" placeholder="是否配種" name="isMating" value="<?php echo $isMating ?>" required>
  <input type="text" class="form-control mb-2" placeholder="精液號碼" name="semenNumber" value="<?php echo $semenNumber ?>" required>
  <input type="submit" class="btn btn-info" name="update" value="修改">
</form>

</html>