<!-- 連接資料庫 -->
<?php
include("../../SQLServer.php");
$GetSn = $_GET['GetSn'];
$query = "SELECT * FROM milk_Record WHERE sn='" . $GetSn . "'";
$result = mysqli_query($db_link, $query);

while ($row = mysqli_fetch_assoc($result)) {
  $date = $row['date']; //日期
  $quality = $row['quality']; //乳質
  $volume = $row['volume']; //乳量
  $milkSolidsNotFat = $row['milkSolidsNotFat']; //無脂固形物
  $milkFatPrecentage = $row['milkFatPrecentage']; //乳脂率
  $milkProtein = $row['milkProtein']; //乳蛋白
  $somaticCellCount = $row['somaticCellCount']; //體細胞數
}

?>
<!DOCTYPE html>
<!-- 搜尋特定欄位的資訊並以彈出視窗顯示 -->
<div class="card">
  <div class="card-body">
    <form action="milkRecord_Revise_action.php?GetSn=<?php echo $GetSn;?>" method="post">
      <div class="row">
        <div class="col-12">
          <p>擠乳日期</p>
          <input type="date" class="form-control card-text" placeholder="請輸入擠乳日期" name="date" value="<?php echo $date; ?>" required>
          <br>
        </div>
        <div class="col-6">
          <p>乳質品質</p>
          <select class="form-select" required name="quality">
            <option value="A"<?php if($quality=='A'){echo"selected";}?>>A級</option>
            <option value="B"<?php if($quality=='B'){echo"selected";}?>>B級</option>
            <option value="C"<?php if($quality=='C'){echo"selected";}?>>C級</option>
            <option value="D"<?php if($quality=='D'){echo"selected";}?>>D級</option>
          </select>
        </div>
        <div class="col-6">
          <p>乳量</p>
          <input type="range" name="volume" id="volume_range" value="<?php echo $volume; ?>" min="0" max="100" class="form-range" oninput="updateMilkVolumn(this.value);">
          <input type="text" name="volume" id="volume_text" class="form-control card-text" value="<?php echo $volume; ?>" placeholder="請輸入乳量" onchange="updateMilkVolumn(this.value);">
          <br>
        </div>
        <div class="col-3">
          <p>無脂固形物</p>
          <input type="text" class="form-control card-text" placeholder="請輸入無脂固形物" name="milkSolidsNotFat" value="<?php echo $milkSolidsNotFat; ?>" required>
        </div>
        <div class="col-3">
          <p>乳脂率</p>
          <input type="text" class="form-control card-text" placeholder="請輸入乳脂率" name="milkFatPrecentage" value="<?php echo $milkFatPrecentage; ?>" required>
        </div>
        <div class="col-3">
          <p>乳蛋白</p>
          <input type="text" class="form-control card-text" placeholder="請輸入乳蛋白" name="milkProtein" value="<?php echo $milkProtein; ?>" required>
        </div>
        <div class="col-3">
          <p>體細胞數</p>
          <input type="text" class="form-control card-text" placeholder="請輸入體細胞數" name="somaticCellCount" value="<?php echo $somaticCellCount; ?>" required>
        </div>
      </div>
      <br>
      <input type="hidden" value="update" name="update"/>
      <input type="submit" class="btn btn-success" value="確定" name="submit"></input>
  </div>
  </form>
</div>

</html>