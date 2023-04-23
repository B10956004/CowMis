<!-- 連接資料庫 -->
<?php
require_once("../../../../SQLServer.php");
$GetID = $_GET['GetID'];
$GetBirthParity = $_GET['GetBirthParity'];
$query = "SELECT * FROM pregnancy_check WHERE id='$GetID' AND birthparity='$GetBirthParity'";
$result = mysqli_query($db_link, $query);

while ($row = mysqli_fetch_assoc($result)) {
  $sn=$row['sn'];
  $id = $row['id']; //編號
  $estrusdate = $row['estrusdate']; //發情日期
  $matingdate = $row['matingdate']; //配種日期
  $birthparity = $row['birthparity']; //胎次
  $intervaldays = $row['intervaldays']; //間隔天數
  $pregnancydate = $row['pregnancydate']; //直腸檢查日期
  $pregnancyresult = $row['pregnancyresult']; //測孕結果
  $parturitiondate = $row['parturitiondate']; //分娩日期
  $events = $row['events']; //事件
  $details = $row['details']; //詳情
  $matingcount = $row['matingcount']; //配種次數
}
?>
<!DOCTYPE html>
<!-- 搜尋特定欄位的資訊並以彈出視窗顯示 -->
<div class="card">
  <div class="card-body">
    <form action="card/pregnancyCheck/pregnancyCheck_Revise_action.php?GetSn=<?php echo $sn; ?>" method="post">
      <div class="row">
        <div class="col-10">
          <p>編號</p>
          <input type="text" class="form-control card-text" name="id" id="id" value='<?php echo $id; ?>' readonly>
        </div>
        <div class="col-2">
          <p>胎次(配種數)</p>
          <input type="text" class="form-control card-text" name="birthparity(matingcount)" value='<?php echo $birthparity."({$matingcount})"; ?>' readonly>
        <input type="hidden" name="birthparity" value="<?php echo $birthparity?>">
        </div>
        <div class="col-6">
          <p>發情日期</p>
          <input type="date" class="form-control card-text" onchange="countInterval()" placeholder="請輸入發情日期" name="estrusdate" id='estrusdate' value='<?php echo $estrusdate; ?>' required>
        </div>
        <div class="col-6">
          <p>配種日期</p>
          <input type="date" class="form-control card-text" onchange="countInterval()" placeholder="請輸入配種日期" name="matingdate" id='matingdate' value='<?php echo $matingdate; ?>' required>
        </div>
        <div class="col-3">
          <p>間隔天數</p>
          <input type="text" class="form-control card-text" placeholder="請輸入間隔天數" name="intervaldays" id="intervaldays" value='<?php echo $intervaldays; ?>' readonly>
        </div>
        <div class="col-6">
          <p>檢查日期</p>
          <input type="date" class="form-control card-text" placeholder="請輸入檢查日期" name="pregnancydate" value='<?php echo $pregnancydate; ?>' required>
        </div>
        <div class="col-3">
          <p>測孕結果</p>
          <select class="form-select" name="pregnancyresult" id="pregnancyresult" required>
          <?php if ($pregnancyresult != '') {
              echo "<option value='$pregnancyresult' selected>$pregnancyresult</option>";
            } else {
              echo "<option style='display:none'>請選擇</option>";
            }
            ?>
            <option value="有" <?php if ($pregnancyresult == '有') {
                                echo "hidden";
                              } ?>>有</option>
            <option value="無" <?php if ($pregnancyresult == '無') {
                                echo "hidden";
                              } ?>>無</option>
          </select>
        </div>
        <div class="col-6">
          <p>分娩日期</p>
          <input type="date" class="form-control card-text" placeholder="請輸入檢查日期" name="parturitiondate" value='<?php echo $parturitiondate; ?>'>
        </div>
        <div class="col-6">
          <p>事件</p>
          <select class="form-select" name="selectEvent" id="selectEvent" onchange="eventsChange(this)">
            <?php if ($events != '') {
              echo "<option value='$events' selected>$events</option>";
            } else {
              echo "<option style='display:none'>請選擇</option>";
            }
            ?>
            <option value="正常" <?php if ($events == '正常') {
                                    echo "hidden";
                                  } ?>>正常</option>
            <option value="胎衣滯留" <?php if ($events == '胎衣滯留') {
                                    echo "hidden";
                                  } ?>>胎衣滯留</option>
            <option value="空胎" <?php if ($events == '空胎') {
                                  echo "hidden";
                                } ?>>空胎</option>
            <option value="子宮外翻" <?php if ($events == '子宮外翻') {
                                    echo "hidden";
                                  } ?>>子宮外翻</option>
            <option value="其他">其他</option>
          </select>
        </div>
        <script>
          function eventsChange(ele) {
            var other = document.getElementById('other');
            var textOther = document.getElementById('textOther');
            if (ele.value == '其他') {
              other.hidden = false;
              textOther.setAttribute("required", "");
            } else {
              other.hidden = true;
              textOther.removeAttribute("required");
            }
          }
        </script>
        <script>
          function countInterval() {
            var estrusdate = document.getElementById('estrusdate');
            estrusdate = new Date(estrusdate.value);
            var matingdate = document.getElementById('matingdate');
            matingdate = new Date(matingdate.value);
            var intervaldays = document.getElementById('intervaldays');
            var count = (estrusdate - matingdate) / (1000 * 3600 * 24);
            if (count > 0) {
              intervaldays.value = count + '天';
            } else {
              intervaldays.value = null;
            }

          }
        </script>
        <div class="col-12" hidden id="other">其他事件<input type="text" class="form-control mb-2" placeholder="填寫其他事件" name="textOther" id="textOther" /></div>
        <div class="col-12">
          詳情<input type="text" class="form-control mb-2" placeholder="請輸入詳情" name="details" value="<?php echo $details ?>">
        </div>

      </div>
      <br>
      <input type="hidden" value="update" name="update">
      <input type="submit" class="btn btn-success" value="確定" name="submit"></input>
  </div>
  </form>
</div>

</html>