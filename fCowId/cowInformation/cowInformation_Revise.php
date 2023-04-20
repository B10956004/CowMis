<!-- 連接資料庫 -->
<?php
include("../../SQLServer.php");
$GetID = $_GET['GetID']; //序列號

$query = "SELECT * FROM cows_information WHERE id='" . $GetID . "'";
$result = mysqli_query($db_link, $query);

while ($row = mysqli_fetch_assoc($result)) {
  $sn = $row['sn']; //編號
  $dob = $row['dob']; //生日
  // $age = $row['age']; //年齡
  $birthParity = $row['birthParity']; //出生胎次
  $calvingInterval = $row['calvingInterval']; //胎距
  $mid = $row['mid']; //母親牛編號
  $fid = $row['fid']; //父親牛編號
  $area = $row['area']; //目前區域
  // $leaveGroup = $row['leaveGroup']; //離開牛群
}

?>
<!DOCTYPE html>
<!-- 搜尋特定欄位的資訊並以彈出視窗顯示 -->
<form action="cowInformation_Revise_action.php?GetID=<?php echo $GetID ?>" method="post">
  編號:<input type="text" class="form-control mb-2" placeholder="編號" name="id" value="<?php echo $GetID ?> " readonly>
  生日:<input type="date" class="form-control mb-2" placeholder="生日" name="dob" value="<?php echo $dob ?>" required>
  <div class="row">
    <div class="col-4">區域:<select class="form-select" name="selectArea" required>
        <option value="低乳"<?php if($area=='低乳'){echo"selected";}?>>低乳</option>
        <option value="高乳"<?php if($area=='高乳'){echo"selected";}?>>高乳</option>
        <option value="乾乳"<?php if($area=='乾乳'){echo"selected";}?>>乾乳</option>
        <option value="已受孕"<?php if($area=='已受孕'){echo"selected";}?>>已受孕</option>
        <option value="未受孕"<?php if($area=='未受孕'){echo"selected";}?>>未受孕</option>
        <option value="小牛"<?php if($area=='小牛'){echo"selected";}?>>小牛</option>
      </select></div>
    <div class="col-4">胎次:<input type="number" min="1" class="form-control mb-2" placeholder="胎次" name="birthParity" value="<?php echo $birthParity ?>" required></div>
    <div class="col-4">胎距:<input type="text" class="form-control mb-2" placeholder="胎距" name="calvingInterval" value="<?php echo $calvingInterval ?>" required readonly></div>
  </div>
  <div class="row">
    <div class="col-6">母親牛編號:<input type="text" class="form-control mb-2" placeholder="母親牛編號" name="mid" value="<?php echo $mid ?>" required></div>
    <div class="col-6">精液編號:<input type="text" class="form-control mb-2" placeholder="父親牛編號" name="fid" value="<?php echo $fid ?>" required></div>
  </div>
  <!-- 離開牛群:<input type="text" class="form-control mb-2" placeholder="離開牛群" name="leaveGroup" value="<?php echo $leaveGroup ?>" required> -->
  <input type="submit" class="btn btn-success" name="update" value="確定">
  <?php
  // ajax Post to Delete
  echo "<a id=\"linkDelInformation\" href=\"#del\" class=\"btn btn-danger\">刪除牛隻資料</a>";
  echo "
                    <script>
                      $(\"#linkDelInformation\").click(function(){
                        var yesDel = confirm(\"你確定要刪除這筆{$GetID}資料嗎？，刪除後不可復原。\");
                          if (yesDel) {
                            $.post(\"./cowInformation_Delete.php\",{ Del: 1,postSn:$sn },function(result){
                                location.href=\"cowInformation.php\";
                              });
                          }
                        });
                    </script>";
  ?>
</form>

</html>