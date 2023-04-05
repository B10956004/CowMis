<?php
require_once("../../../SQLServer.php");
$GetSn = $_GET['GetSn']; //選擇的牛隻
?>
<div class="card-body">
    <?php
    $query = "SELECT * FROM cows_information WHERE sn=$GetSn";
    $result = mysqli_query($db_link, $query);
    while ($row = mysqli_fetch_assoc($result)) {
        $dob = $row['dob']; //生日
        $id=$row['id'];//名稱
        // $age = $row['age']; //年齡
        $birthParity = $row['birthParity']; //出生胎次
        $calvingInterval = $row['calvingInterval']; //胎距
        $mid = $row['mid']; //母親牛編號
        $fid = $row['fid']; //父親牛編號
        $area=$row['area'];//所在區域
        $areatime=$row['areatime'];//駐留天數
        $today=date("Y-m-d");
        $stayDate=(strtotime($today)-strtotime($areatime))/86400;//60*60*24
        $stayDate=$stayDate.'天';
        // $leaveGroup = $row['leaveGroup']; //離開牛群
    }
    echo "<h5 class=\"card-title\"><i class=\"fas fa-tint\"></i>&nbsp;牛隻資訊&nbsp;&nbsp;&nbsp;&nbsp;編號:$id &nbsp;&nbsp;<a href=\"#revise\" GetSn='$GetSn' class=\"btn btn-primary view_data\">編輯</a></h5>";
    echo "
    <div class=\"row\">
    <div class=\"col-12\">
    <p class=\"card-text \">出生日期<br>
    <input type=\"text\" class=\"col-12\" value='$dob' disabled> </p>
</div>
<div class=\"col-6\">
    <p class=\"card-text\">目前區域<br>
    <input type=\"text\" class=\"col-12\" value='$area' disabled> </p>
</div>
<div class=\"col-6\">
    <p class=\"card-text\">駐留天數<br>
    <input type=\"text\" class=\"col-12\" value='$stayDate' disabled> </p>
</div>
                                    </div>
                                    <div class=\"row\">
                                        <!--<div class=\"col-4\">
                                            <p class=\"card-text\">年齡 <br>
                                            <input type=\"text\" class=\"col-12\" disabled> </p>
                                        </div>-->
                                        <div class=\"col-6\">
                                            <p class=\"card-text\">出生胎次 <br>
                                            <input type=\"text\" class=\"col-12\" value=$birthParity disabled> </p>
                                        </div>
                                        <div class=\"col-6\">
                                            <p class=\"card-text\">胎距 <br>
                                            <input type=\"text\" class=\"col-12\" value=$calvingInterval disabled> </p>
                                        </div>
                                    </div>
                                    <div class=\"row\">
                                        <div class=\"col-6\">
                                            <p class=\"card-text\">母親牛編號<br>
                                            <input type=\"text\" class=\"col-12\" value=$mid disabled> </p>
                                        </div>
                                        <div class=\"col-6\">
                                            <p class=\"card-text\">精液編號 <br>
                                            <input type=\"text\" class=\"col-12\" value=$fid disabled> </p>
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
        var GetSn = $(this).attr("GetSn");

        $.ajax({
            url: "cowInformation_Revise.php",
            method: "GET",
            data: {
                GetSn: GetSn
            },
            success: function(data) {
                // 將Revise頁面傳入浮動視窗
                $('#cow_detail').html(data);
                $('#dataModal').modal('show');
            }
        });

    });
</script>