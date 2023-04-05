<!-- 連接資料庫 -->
<?php
require_once("../../SQLServer.php");
$GetSn = $_GET['GetSn'];
$query = "SELECT * FROM rectal_examination WHERE sn='$GetSn'";
$result = mysqli_query($db_link, $query);

while ($row = mysqli_fetch_assoc($result)) {
  $id = $row['id'];
  $checkDate = $row['checkDate'];
  $pregnancyResult = $row['pregnancyResult'];
}
?>
<!DOCTYPE html>
<!-- 搜尋特定欄位的資訊並以彈出視窗顯示 -->
<form action="rectalExamination_Revise_action.php?GetSn=<?php echo $GetSn ?>" method="post">
  <input type="text" class="form-control mb-2" placeholder="編號" name="id" value="<?php echo $id ?>" readonly>
  <input type="date" class="form-control mb-2" placeholder="檢查日期" name="checkDate" value="<?php echo $checkDate ?>" required>
  <input type="text" class="form-control mb-2" placeholder="測孕結果" name="pregnancyResult" value="<?php echo $pregnancyResult ?>" required>
  <input type="submit" class="btn btn-info" name="update" value="修改">
</form>

</html>