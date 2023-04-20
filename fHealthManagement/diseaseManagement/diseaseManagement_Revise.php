<!-- 連接資料庫 -->
<?php
require_once("../../SQLServer.php");
$GetSn = $_GET['GetSn'];
$query = "SELECT * FROM disease_management WHERE sn='$GetSn'";
$result = mysqli_query($db_link, $query);

while ($row = mysqli_fetch_assoc($result)) {
  $id = $row['id']; //編號
  $date = $row['date']; //日期
  $disease = $row['disease']; //疾病種類
  $drugs = $row['drugs']; //藥品紀錄
  $vaccines = $row['vaccines']; //疫苗紀錄
}
?>
<!DOCTYPE html>
<!-- 搜尋特定欄位的資訊並以彈出視窗顯示 -->
<div class="card">
  <div class="card-body">
    <form action="diseaseManagement_Revise_action.php?GetSn=<?php echo $GetSn; ?>" method="post">
      <div class="row">
        <div class="col-6">
          <p>編號</p>
          <input type="text" class="form-control card-text" name="id" id="id" value='<?php echo $id; ?>' readonly>
        </div>
        <div class="col-6">
          <p>檢查日期</p>
          <input type="date" class="form-control card-text" placeholder="請輸入日期" name="date" value='<?php echo $date; ?>' required>
        </div>
        <div class="col-4">
          <p>疾病種類</p>
          <select class="form-select" name="selectDisease" id="selectDisease" onchange="eventsChange(this)" required>
            <?php echo "<option value=\"$disease\" selected>$disease</option>"; ?>
            <option value="無" <?php if ($disease == '無') {
                                echo "hidden";
                              } ?>>無</option>
            <option value="乳房炎" <?php if ($disease == '乳房炎') {
                                  echo "hidden";
                                } ?>>乳房炎</option>
            <option value="蹄病" <?php if ($disease == '蹄病') {
                                  echo "hidden";
                                } ?>>蹄病</option>
            <option value="感冒" <?php if ($disease == '感冒') {
                                  echo "hidden";
                                } ?>>感冒</option>
            <option value="食滯" <?php if ($disease == '食滯') {
                                  echo "hidden";
                                } ?>>食滯</option>
            <option value="其他疾病">其他</option>
          </select>
        </div>
        <div class="col-4">
          <p>藥品紀錄</p>
          <select class="form-select" name="selectDrug" id="selectDrug" onchange="eventsChange(this)" required>
            <?php echo "<option value=\"$drugs\" selected>$drugs</option>"; ?>
            <option value="無" <?php if ($drugs == '無') {
                                echo "hidden";
                              } ?>>無</option>
            <option value="乳房炎藥" <?php if ($drugs == '乳房炎藥') {
                                    echo "hidden";
                                  } ?>>乳房炎藥</option>
            <option value="蹄病藥" <?php if ($drugs == '蹄病藥') {
                                  echo "hidden";
                                } ?>>蹄病藥</option>
            <option value="其他藥品">其他</option>
          </select>
        </div>
        <div class="col-4">
          <p>疫苗紀錄</p>
          <select class="form-select" name="selectVaccine" id="selectVaccine" onchange="eventsChange(this)" required>
            <?php echo "<option value=\"$vaccines\" selected>$vaccines</option>"; ?>
            <option value="無" <?php if ($vaccines == '無') {
                                echo "hidden";
                              } ?>>無</option>
            <option value="乳房炎疫苗" <?php if ($vaccines == '乳房炎疫苗') {
                                    echo "hidden";
                                  } ?>>乳房炎疫苗</option>
            <option value="蹄病藥疫苗" <?php if ($vaccines == '蹄病藥疫苗') {
                                    echo "hidden";
                                  } ?>>蹄病藥疫苗</option>
            <option value="其他疫苗">其他</option>
          </select>
        </div>
        <div class="col-4" hidden id="otherDisease">
          <p>其他疾病</p>
          <input type="text" class="form-control card-text" placeholder="請輸入其他疾病" name="otherDisease" id="textDisease">
        </div>
        <div class="col-4" hidden id="otherDrug">
          <p>其他藥品</p>
          <input type="text" class="form-control card-text" placeholder="請輸入其他藥品" name="otherDrug" id="textDrug">
        </div>
        <div class="col-4" hidden id="otherVaccine">
          <p>其他疫苗</p>
          <input type="text" class="form-control card-text" placeholder="請輸入其他疫苗" name="otherVaccine" id="textVaccine">
        </div>
      </div>
      <br>
      <input type="hidden" value="update" name="update">
      <input type="submit" class="btn btn-success" value="確定" name="submit"></input>
  </div>
  </form>
</div>
<script>
  function eventsChange(ele) {
    if (ele.value == '其他疾病') {
      var other = document.getElementById('otherDisease');
      var textOther = document.getElementById('textDisease');
      other.hidden = false;
      textOther.setAttribute("required", "");
    } else if (ele.value == '其他藥品') {
      var other = document.getElementById('otherDrug');
      var textOther = document.getElementById('textDrug');
      other.hidden = false;
      textOther.setAttribute("required", "");
    } else if (ele.value == '其他疫苗') {
      var other = document.getElementById('otherVaccine');
      var textOther = document.getElementById('textVaccine');
      other.hidden = false;
      textOther.setAttribute("required", "");
    } else {
      if (ele.id == 'selectDisease') {
        var other = document.getElementById('otherDisease');
        var textOther = document.getElementById('textDisease');
        other.hidden = true;
        textOther.removeAttribute("required");
      } else if (ele.id == 'selectDrug') {
        var other = document.getElementById('otherDrug');
        var textOther = document.getElementById('textDrug');
        other.hidden = true;
        textOther.removeAttribute("required");
      } else if (ele.id == 'selectVaccine') {
        var other = document.getElementById('otherVaccine');
        var textOther = document.getElementById('textVaccine');
        other.hidden = true;
        textOther.removeAttribute("required");
      }
    }
  }
</script>

</html>