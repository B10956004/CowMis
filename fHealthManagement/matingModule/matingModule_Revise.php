<!-- 連接資料庫 -->
<?php
require_once("../../SQLServer.php");
$GetSn = $_GET['GetSn'];
$query = "SELECT * FROM mating_module WHERE sn='$GetSn'";
$result = mysqli_query($db_link, $query);

while ($row = mysqli_fetch_assoc($result)) {
  $id = $row['id']; //編號
  $dueDate = $row['dueDate']; //預期分娩日
  $dateCompleted = $row['dateCompleted']; //實際分娩日
  $birthParity = $row['birthParity']; //胎次
  $birthEvent = $row['birthEvent']; //胎別
  $area = $row['area']; //區域
  $class = $row['class']; //類別
}
?>
<!DOCTYPE html>
<!-- 搜尋特定欄位的資訊並以彈出視窗顯示 -->
<form action="matingModule_Revise_action.php?GetSn=<?php echo $GetSn ?>" method="post">
  <input type="text" class="form-control mb-2" placeholder="編號" name="id" value="<?php echo $id ?>" readonly>
  <input type="date" class="form-control mb-2" placeholder="預定分娩日" name="dueDate" value="<?php echo $dueDate ?>" required>
  <input type="date" class="form-control mb-2" placeholder="實際分娩日" name="dateCompleted" value="<?php echo $dateCompleted ?>" required>
  <input type="text" class="form-control mb-2" placeholder="胎次" name="birthParity" value="<?php echo $birthParity ?>" required>
  <input type="text" class="form-control mb-2" placeholder="胎別" name="birthEvent" value="<?php echo $birthEvent ?>" required>
  <input type="text" class="form-control mb-2" placeholder="區域" name="area" value="<?php echo $area ?>" required>
  <input type="text" class="form-control mb-2" placeholder="類別" name="class" value="<?php echo $class ?>" required>
  <input type="submit" class="btn btn-info" name="update" value="修改">
</form>

</html>