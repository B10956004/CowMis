<?php
require_once("../../../SQLServer.php");
$GetID = $_GET['GetID']; //選擇的牛隻
$selectQuery = "SELECT * FROM `pregnancy_check` WHERE id='$GetID' AND (events!='空胎' AND events!='' AND events IS NOT NULL) ORDER BY parturitiondate DESC LIMIT 2"; //比對最新兩筆
$resultSelect = mysqli_query($db_link, $selectQuery);
$array = mysqli_fetch_all($resultSelect);
if (mysqli_num_rows($resultSelect) >= 2) { //確認有無兩筆以上紀錄
    $calvingInterval = (strtotime($array[0][8]) - strtotime($array[1][8])) / 86400 . '天'; //分娩日期
} else {
    $calvingInterval = 0 . '天';
}
$updateQuery = "UPDATE `cows_information` SET `calvingInterval`='$calvingInterval' WHERE `id`='$GetID'";
mysqli_query($db_link, $updateQuery);
?>
<div class="card-body">
    <?php
    $query = "SELECT * FROM cows_information WHERE id='$GetID'";
    $result = mysqli_query($db_link, $query);
    while ($row = mysqli_fetch_assoc($result)) {
        $dob = $row['dob']; //生日
        $id = $row['id']; //名稱
        // $age = $row['age']; //年齡
        $birthParity = $row['birthParity']; //胎次
        $calvingInterval = $row['calvingInterval']; //胎距
        $mid = $row['mid']; //母親牛編號
        $fid = $row['fid']; //父親牛編號
        $area = $row['area']; //所在區域
        $areatime = $row['areatime']; //駐留天數
        $today = date("Y-m-d");
        $stayDate = (strtotime($today) - strtotime($areatime)) / 86400; //60*60*24
        $stayDate = $stayDate . '天';
        // $leaveGroup = $row['leaveGroup']; //離開牛群
    }

    $selectQuery = "SELECT parturitiondate FROM pregnancy_check WHERE id='$GetID' AND events='正常' ORDER BY birthparity DESC LIMIT 1";
    if (mysqli_num_rows(mysqli_query($db_link, $selectQuery)) != 0) {
        $row = mysqli_fetch_array(mysqli_query($db_link, $selectQuery));
        $DIM = (strtotime($today) - strtotime($row['parturitiondate'])) / 86400 . '天'; //計算到今天過了幾天 泌乳天數days in milk
    } else {
        $DIM = '0天';
    }
    $selectQuery = "SELECT * FROM pregnancy_check WHERE id='$GetID' AND (events IS NULL OR events='')";
    if (mysqli_num_rows(mysqli_query($db_link, $selectQuery)) != 0) {
        $row = mysqli_fetch_array(mysqli_query($db_link, $selectQuery));
        $breedingStatus = '已配種';
        $estimateBirthParity = $row['birthparity'];
        $matingcount = $row['matingcount'];
        $pregnancyresult = $row['pregnancyresult'];
        if ($pregnancyresult == null) {
            $pregnancyresult = '未檢查';
        }
    } else {
        $breedingStatus = '待配種';
        $estimateBirthParity = '無';
        $matingcount = 0;
        $pregnancyresult = '未檢查';
    }
    if ($breedingStatus == '已配種' && $pregnancyresult != '未檢查') {
        $EDD = date("Y-m-d", strtotime("+9 month", strtotime($row['matingdate']))); //推估9個月產出estimated due date (EDD)
    } else {
        $EDD = '無';
    }
    $selectQuery = "SELECT * FROM sensor_management WHERE cid='{$id}'";
    $sensorResult = mysqli_query($db_link, $selectQuery);
    if (mysqli_num_rows($sensorResult) != 0) {
        $sensorRow = mysqli_fetch_array($sensorResult);
        $states = $sensorRow['states'];
    } else {
        $states = '未配戴';
    }

    echo "<h5 class=\"card-title\"><i class=\"fas fa-tint\"></i>&nbsp;牛隻資訊&nbsp;&nbsp;&nbsp;&nbsp;編號:$id &nbsp;&nbsp;<a href=\"#revise\" GetID='$GetID' class=\"btn btn-primary view_data\">編輯</a></h5>";
    echo "
    <div class=\"row\">
    <div class=\"col-12 col-sm-8\">
    <p class=\"card-text \">出生日期<br>
    <input type=\"text\" class=\"col-12\" value='$dob' disabled> </p>
</div>
<div class=\"col-12 col-sm-4\">";
    echo"<a href=\"../../fEnvironment/sensorManagement/sensorManagement.php\"><p class=\"card-text \">感測器狀態</a><br>";
    if ($states == '未連接') {
        echo "<i class=\"fas fa-circle\" style=\"color: gray;\"></i>";
      } elseif ($states == '正常') {
        echo "<i class=\"fas fa-circle\" style=\"color: green;\"></i>";
      } elseif ($states == '疑似發情' || $states == '發情') {
        echo "<i class=\"fas fa-circle\" style=\"color: red;\"></i>";
      } else {
        echo "<i class=\"fas fa-circle\" style=\"color: gold;\"></i>";
      }
    echo "<input type=\"text\" class=\"col-12 col-sm-10\" value='{$states}' disabled> </p>
</div>
<div class=\"col-12 col-sm-6\">
    <p class=\"card-text\">目前區域<br>
    <input type=\"text\" class=\"col-12\" value='$area' disabled> </p>
</div>
<div class=\"col-12 col-sm-6\">
    <p class=\"card-text\">駐留天數<br>
    <input type=\"text\" class=\"col-12\" value='$stayDate' disabled> </p>
</div>
                                    </div>
                                    <div class=\"row\">
                                        <!--<div class=\"col-4\">
                                            <p class=\"card-text\">年齡 <br>
                                            <input type=\"text\" class=\"col-12\" disabled> </p>
                                        </div>-->
                                        <div class=\"col-12 col-sm-3\">
                                            <p class=\"card-text\">泌乳天數 <br>
                                            <input type=\"text\" class=\"col-12\" value=$DIM disabled> </p>
                                        </div>
                                        <div class=\"col-12 col-sm-3\">
                                            <p class=\"card-text\">胎次 <br>
                                            <input type=\"text\" class=\"col-12\" value=$birthParity disabled> </p>
                                        </div>
                                        <div class=\"col-12 col-sm-6\">
                                            <p class=\"card-text\">胎距 <br>
                                            <input type=\"text\" class=\"col-12\" value=$calvingInterval disabled> </p>
                                        </div>
                                    </div>
                                    <div class=\"row\">
                                        <div class=\"col-12 col-sm-6\">
                                            <p class=\"card-text\">母親牛編號<br>
                                            <input type=\"text\" class=\"col-12\" value=$mid disabled> </p>
                                        </div>
                                        <div class=\"col-12 col-sm-6\">
                                            <p class=\"card-text\">精液編號 <br>
                                            <input type=\"text\" class=\"col-12\" value=$fid disabled> </p>
                                        </div>
                                    </div>
                                    <div class=\"row\">
                                        <div class=\"col-12 col-sm-3\">";
    if ($breedingStatus == '已配種') {
        echo "<a href=\"#revisePregnancy\" GetID='$GetID' GetBirthParity='$estimateBirthParity' class=\"view_pregnancy_data\"><p class=\"card-text\">預期胎次(配種數) <br></a>";
    } else {
        echo "<a href=\"../../fHealthManagement/pregnancyCheck/pregnancyCheck.php\"><p class=\"card-text\">預期胎次(配種數) <br></a>";
    }
    echo "<input type=\"text\" class=\"col-12\" value=$estimateBirthParity($matingcount) disabled> </p>
                                        </div>
                                        <div class=\"col-12 col-sm-3\">
                                            <p class=\"card-text\">繁殖狀況<br>
                                            <input type=\"text\" class=\"col-12\" value=$breedingStatus disabled> </p>
                                        </div>
                                        <div class=\"col-12 col-sm-3\">
                                            <p class=\"card-text\">測孕結果 <br>
                                            <input type=\"text\" class=\"col-12\" value=$pregnancyresult disabled> </p>
                                        </div>
                                        <div class=\"col-12 col-sm-3\">
                                            <p class=\"card-text\">預產日 <br>
                                            <input type=\"text\" class=\"col-12\" value=$EDD disabled> </p>
                                        </div>
                                    </div>
                                    <!--
                                    <p class=\"card-text\">離開牛群<br>
                                    <input type=\"text\" class=\"col-12\" disabled> </p>
                                    -->
                                    ";
    ?>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>
<!-- 修改功能 浮動視窗 -->
<div id="dataModal" class="modal fade bd-example-modal-lg">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title font-weight-bold">修改牛隻基本資料</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body" id="cow_detail">
                <!-- <input type="text" name="cow_ID" id="cow_ID" claass="form-control" readonly /> -->
                <br />
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">關閉</button>
            </div>
        </div>
    </div>
</div>
<!-- ajax Revise DataModal -->
<script>
    $(document).on('click', '.view_data', function() {
        var GetID = $(this).attr("GetID");

        $.ajax({
            url: "cowInformation_Revise.php",
            method: "GET",
            data: {
                GetID: GetID
            },
            success: function(data) {
                // 將Revise頁面傳入浮動視窗
                $('#cow_detail').html(data);
                $('#dataModal').modal('show');
            }
        });

    });
</script>
<div id="dataModalPregnancyCheck" class="modal fade bd-example-modal-lg">
    <div class="modal-dialog  modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title font-weight-bold">修改妊娠資料</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body" id="cow_pregnancy_detail">
                <br />
                <!-- ajax注入 -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">關閉</button>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).on('click', '.view_pregnancy_data', function() {
        var GetID = $(this).attr("GetID");
        var GetBirthParity = $(this).attr("GetBirthParity");

        $.ajax({
            url: "card/pregnancyCheck/pregnancyCheck_Revise.php",
            method: "GET",
            data: {
                GetID: GetID,
                GetBirthParity: GetBirthParity
            },


            success: function(data) {
                $('#cow_pregnancy_detail').html(data);
                $('#dataModalPregnancyCheck').modal('show');
            }
        });

    });
</script>