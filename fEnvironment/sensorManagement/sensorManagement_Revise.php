<!-- 連接資料庫 -->
<?php
include("../../SQLServer.php");
$GetUuid = $_GET['GetUuid'];
$query = "SELECT * FROM sensor_management WHERE uuid='" . $GetUuid . "'";
$result = mysqli_query($db_link, $query);

while ($row = mysqli_fetch_assoc($result)) {
  $cid = $row['cid']; //牛編號
  $uuid = $row['uuid']; //感測器編號
  $model = $row['model']; //型號
  $states = $row['states']; //狀態
}
$selectQuery = "SELECT area FROM cows_information WHERE id='$cid' ";
$area = mysqli_fetch_array(mysqli_query($db_link, $selectQuery))['area'];
?>
<!DOCTYPE html>
<!-- 搜尋特定欄位的資訊並以彈出視窗顯示 -->
<div class="card">
  <div class="card-body">
    <form action="sensorManagement_Revise_action.php?GetUuid=<?php echo $GetUuid; ?>" method="post">
      <div class="row">
      <div class="col-12">
          <p>感測器編號</p>
          <input type="text" name="uuid" id="uuid" class="form-control card-text" value="<?php echo $uuid ?>" readonly>
        </div>
        <div class="col-4">
          <p>區域</p>
          <select class="form-select" name="area" id="area" onchange="selectArea(this)" required>
            <?php echo "<option selected value='$area'>$area</option>" ?>
            <option value="高乳" <?php if ($area == '高乳') {
                                  echo 'hidden';
                                } ?>>高乳</option>
            <option value="低乳" <?php if ($area == '低乳') {
                                  echo 'hidden';
                                } ?>>低乳</option>
            <option value="乾乳" <?php if ($area == '乾乳') {
                                  echo 'hidden';
                                } ?>>乾乳</option>
            <option value="已受孕" <?php if ($area == '已受孕') {
                                  echo 'hidden';
                                } ?>>已受孕</option>
            <option value="未受孕" <?php if ($area == '未受孕') {
                                  echo 'hidden';
                                } ?>>未受孕</option>
            <option value="小牛" <?php if ($area == '小牛') {
                                  echo 'hidden';
                                } ?>>小牛</option>
          </select>
        </div>
        <div class="col-4">
          <p>乳牛編號</p>
          <select class="form-select" name="cid" id="cid" required>
            <?php echo "<option selected value={$cid}>$cid</option>";
            $cowsQuery = "SELECT id FROM cows_information WHERE id!='$cid' AND area='$area'";
            $cowsResult = mysqli_query($db_link, $cowsQuery);
            while ($row = mysqli_fetch_array($cowsResult)) {
              $id = $row['id']; //牛編號
              echo "<option value='$id'>$id</option>";
            }
            ?>
          </select>
        </div>
        <div class="col-4">
          <p>感測器型號</p>
          <select class="form-select" required name="model">
            <?php echo "<option selected value={$model}>$model</option>" ?>
            <option value="nRF52840" <?php if ($model == 'nRF52840') {
                                            echo 'hidden';
                                          } ?>>XIAO nRF52840</option>
            <option value="BWT901CL" <?php if ($model == 'BWT901CL') {
                                        echo 'hidden';
                                      } ?>>BWT901CL</option>
            <option value="WT901BLECL5.0" <?php if ($model == 'WT901BLECL5.0') {
                                            echo 'hidden';
                                          } ?>>WT901BLECL5.0</option>
          </select>
        </div>
      </div>
      <br>
      <input type="hidden" value="update" name="update" />
      <input type="submit" class="btn btn-success" value="確定" name="submit"></input>
  </div>
  </form>
</div>
<!-- 場域選擇 -->
<script>
  function selectArea(area) {
    if (area.value) {
      $.ajax({
        url: 'get_cows.php',
        type: 'POST',
        data: {
          area: area.value
        },
        dataType: 'json',
        success: function(data) {
          $('#cid').empty();
          $.each(data, function(key, value) {
            $('#cid').append('<option value="' + value.id + '">' + value.id + '</option>');
          });
        }
      });
    } else {
      $('#cid').empty();
    }
  };
</script>

</html>