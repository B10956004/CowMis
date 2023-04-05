<!-- 連接資料庫 -->
<?php
include("../../SQLServer.php");
$GetSn = $_GET['GetSn'];

$query = "SELECT * FROM cull_module WHERE sn='$GetSn'";
$result = mysqli_query($db_link, $query);

while ($row = mysqli_fetch_assoc($result)) {
  $id = $row['id']; //編號
  $standUp = $row['standUp']; //站起
  $crouch = $row['crouch']; //躺
  $ingestion = $row['ingestion']; //採食
  $mating = $row['mating']; //騎乘?
  $buttocksUp = $row['buttocksUp']; //臀部上翹
  $headOn = $row['headOn']; //頭靠上
}

?>
<!DOCTYPE html>
<!-- 搜尋特定欄位的資訊並以彈出視窗顯示 -->
<form action="cullModule_Revise_action.php?GetSn=<?php echo $GetSn ?>" method="post">
  <input type="text" class="form-control mb-2" placeholder="請輸入編號" name="id" value="<?php echo $id ?>" readonly>
  <input type="datetime-local" class="form-control mb-2" placeholder="請輸入站起時間" name="standUp" value="<?php echo $standUp ?>" required>
  <input type="datetime-local" class="form-control mb-2" placeholder="請輸入躺臥時間" name="crouch" value="<?php echo $crouch ?>" required>
  <input type="datetime-local" class="form-control mb-2" placeholder="請輸入採食時間" name="ingestion" value="<?php echo $ingestion ?>" required>
  <input type="datetime-local" class="form-control mb-2" placeholder="請輸入騎乘時間" name="mating" value="<?php echo $mating ?>" required>
  <input type="datetime-local" class="form-control mb-2" placeholder="請輸入臀部上翹時間" name="buttocksUp" value="<?php echo $buttocksUp ?>" required>
  <input type="datetime-local" class="form-control mb-2" placeholder="請輸入頭靠上時間" name="headOn" value="<?php echo $headOn ?>" required>
  <input type="submit" class="btn btn-info" name="update" value="更新">

</form>

</html>