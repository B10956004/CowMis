<!-- 連接資料庫 -->
<?php
require_once("../../../../SQLServer.php");
$GetSn = $_GET['GetSn'];
$query = "SELECT * FROM pregnancy_check WHERE sn='$GetSn'";
$result = mysqli_query($db_link, $query);

while ($row = mysqli_fetch_assoc($result)) {
  $id = $row['id'];
  $date = $row['pregnancydate'];
  $birthParity = $row['birthparity'];
  $events = $row['events'];
  $details = $row['details'];
}
?>
<!DOCTYPE html>
<!-- 搜尋特定欄位的資訊並以彈出視窗顯示 -->
<form action="card/parturitionHistory/parturitionHistory_Revise_action.php?GetSn=<?php echo $GetSn ?>" method="post">
  編號<input type="text" class="form-control mb-2" placeholder="編號" name="id" value="<?php echo $id ?>" readonly>
  分娩日期<input type="date" class="form-control mb-2" placeholder="日期" name="date" value="<?php echo $date ?>" required>
  <div class="row">
    <div class="col-4">
      胎次<input type="number" min="1" class="form-control mb-2" placeholder="胎次" name="birthParity" value="<?php echo $birthParity ?>" required>
    </div>
    <div class="col-4">
      事件<select class="form-select" name="selectEvent" id="selectEvent" onchange="eventsChange(this)" required>
        <?php echo"<option value='$events' selected>$events</option>";?>
        <option value="胎衣滯留" <?php if ($events == '胎衣滯留') {
                                echo "hidden";
                              } ?>>胎衣滯留</option>
        <option value="空胎" <?php if ($events == '空胎') {
                              echo "hidden";
                            } ?>>空胎</option>
        <option value="感冒" <?php if ($events == '感冒') {
                              echo "hidden";
                            } ?>>感冒</option>
        <option value="食滯" <?php if ($events == '食滯') {
                              echo "hidden";
                            } ?>>食滯</option>
        <option value="子宮外翻" <?php if ($events == '子宮外翻') {
                                echo "hidden";
                              } ?>>子宮外翻</option>
        <option value="其他">其他</option>
      </select>
    </div>
    <script>
          function eventsChange(ele){
              var other=document.getElementById('other');
              var textOther=document.getElementById('textOther');
            if(ele.value=='其他'){
              other.hidden=false;
              textOther.setAttribute("required","");
            }else{
              other.hidden=true;
              textOther.removeAttribute("required");
            }
            
          }
    </script>
    <div class="col-4">
      詳情<input type="text" class="form-control mb-2" placeholder="詳情" name="details" value="<?php echo $details ?>">
    </div>
    <div class="col-12" hidden id="other">其他事件<input type="text" class="form-control mb-2" placeholder="填寫其他事件" name="textOther" id="textOther"/></div>
  </div>
  <input type="submit" class="btn btn-success" name="update" value="確定">
  <?php
  // ajax Post to Delete
  echo "<a id=\"linkDelInformation\" href=\"#del\" class=\"btn btn-danger\">刪除歷史懷孕紀錄</a>";
  echo "
                    <script>
                      $(\"#linkDelInformation\").click(function(){
                        var yesDel = confirm(\"你確定要刪除這筆{$id}資料嗎？，刪除後不可復原。\");
                          if (yesDel) {
                            $.post(\"card/parturitionHistory/parturitionHistory_Delete.php\",{ Del: 1,postSn:$GetSn },function(result){
                                location.href=\"cowInformation.php?GetID={$id}\";
                              });
                          }
                        });
                    </script>";
  ?>
</form>

</html>