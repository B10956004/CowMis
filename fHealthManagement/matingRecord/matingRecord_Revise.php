<!-- 連接資料庫 -->
<?php
require_once("../../SQLServer.php");
$GetSn = $_GET['GetSn'];
$query = "SELECT * FROM mating_record WHERE sn='$GetSn'";
$result = mysqli_query($db_link, $query);

while ($row = mysqli_fetch_assoc($result)) {
  $id = $row['id'];
  $matingDate = $row['matingDate'];
  $frequency = $row['frequency'];
  $status = $row['status'];
  $matingMethod = $row['matingMethod'];
  $abortion = $row['abortion'];
}
?>
<!DOCTYPE html>
<!-- 搜尋特定欄位的資訊並以彈出視窗顯示 -->
<form action="matingRecord_Revise_action.php?GetSn=<?php echo $GetSn ?>" method="post">
  <input type="text" class="form-control mb-2" placeholder="編號" name="id" value="<?php echo $id ?>" readonly>
  <input type="date" class="form-control mb-2" placeholder="配種日期" name="matingDate" value="<?php echo $matingDate ?>" required>
  <input type="text" class="form-control mb-2" placeholder="次數" name="frequency" value="<?php echo $frequency ?>" required>
  <input type="text" class="form-control mb-2" placeholder="狀態" name="status" value="<?php echo $status ?>" required>
  <input type="text" class="form-control mb-2" placeholder="配種方式" name="matingMethod" value="<?php echo $matingMethod ?>" required>
  <input type="text" class="form-control mb-2" placeholder="流產" name="abortion" value="<?php echo $abortion ?>" required>
  <input type="submit" class="btn btn-info" name="update" value="修改">
</form>

</html>