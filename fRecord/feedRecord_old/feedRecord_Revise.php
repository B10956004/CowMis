<!-- 連接資料庫 -->
<?php
require_once("../../SQLServer.php");
$GetSn = $_GET['GetSn'];
$query = "SELECT * FROM feed_record WHERE sn='$GetSn'";
$result = mysqli_query($db_link, $query);

while ($row = mysqli_fetch_assoc($result)) {
  $id = $row['id']; //編號
  $date = $row['date']; //進場時間
  $genealogy = $row['genealogy']; //系譜
  $concentrate = $row['concentrate']; //精料
  $forage = $row['forage']; //芻料
  $isPregnancy = $row['isPregnancy']; //懷孕
  $lactation = $row['lactation']; //泌乳
  $waterIntake = $row['waterIntake']; //飲水量
  $feedTime = $row['feedTime']; //餵養時間
  $recordTime = $row['recordTime']; //紀錄時間
}
?>
<!DOCTYPE html>
<!-- 搜尋特定欄位的資訊並以彈出視窗顯示 -->
<form action="feedRecord_Revise_action.php?GetSn=<?php echo $GetSn ?>" method="post">
  <input type="text" class="form-control " placeholder="請輸入個體識別" name="id" value="<?php echo $id ?>" readonly>
  <input type="date" class="form-control " placeholder="請輸入進場日期" name="date" value="<?php echo $date ?>" required>
  <input type="text" class="form-control " placeholder="請輸入系譜" name="genealogy" value="<?php echo $genealogy ?>" required>
  <input type="text" class="form-control " placeholder="請輸入精料" name="concentrate" value="<?php echo $concentrate ?>" required>
  <input type="text" class="form-control " placeholder="請輸入芻料" name="forage" value="<?php echo $forage ?>" required>
  <input type="text" class="form-control " placeholder="請輸入懷孕" name="isPregnancy" value="<?php echo $isPregnancy ?>" required>
  <input type="text" class="form-control " placeholder="請輸入泌乳" name="lactation" value="<?php echo $lactation ?>" required>
  <input type="text" class="form-control " placeholder="請輸入飲水量" name="waterIntake" value="<?php echo $waterIntake ?>" required>
  <input type="datetime-local" class="form-control " placeholder="請輸入餵養時間" name="feedTime" value="<?php echo $feedTime ?>" required>
  <input type="datetime-local" class="form-control " placeholder="請輸入紀錄時間" name="recordTime" value="<?php echo $recordTime ?>" required>
  <input type="submit" class="btn btn-info" name="update" value="修改">
</form>

</html>