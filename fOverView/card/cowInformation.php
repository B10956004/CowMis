<div class="card-body">
    <h5 class="card-title"><i class="fas fa-paw"></i></i>&nbsp;牛隻資訊</h5>
    <p class="card-text">牛隻編號:</p>
    <select id="selected_cow" onchange="informationLoad()" class="col-12">
        <?php
        require_once("../../SQLServer.php");

        if (isset($_GET['GetSn'])) { //判斷有無選擇
            $GetSn = $_GET['GetSn'];
        }
        $query = "SELECT * FROM cows_information WHERE isDel=0 ";
        $result = mysqli_query($db_link, $query);
        while ($row = mysqli_fetch_assoc($result)) {
            $sn = $row['sn']; //序列號
            $id = $row['id']; //牛隻編號
            if ($sn == $GetSn) {
                echo "<option value=\"$sn\" selected>$id</option>"; //設為已選擇
            } else {
                echo "<option value=\"$sn\">$id</option>";
            }
        }
        echo "</select>";
        if (isset($_GET['GetSn'])) { //選擇的牛隻
            $query = "SELECT * FROM cows_information WHERE isDel=0 AND sn=$GetSn";
            $result = mysqli_query($db_link, $query);
            while ($row = mysqli_fetch_assoc($result)) {
                $dob = $row['dob']; //生日
                $age = $row['age']; //年齡
                $birthParity = $row['birthParity']; //出生胎次
                $calvingInterval = $row['calvingInterval']; //胎距
                $mid = $row['mid']; //母親牛編號
                $fid = $row['fid']; //父親牛編號
                $leaveGroup = $row['leaveGroup']; //離開牛群
            }
        } else { //預設第一筆
            $query = "SELECT * FROM cows_information WHERE isDel=0 AND sn=1";
            $result = mysqli_query($db_link, $query);
            while ($row = mysqli_fetch_assoc($result)) {
                $dob = $row['dob']; //生日
                $age = $row['age']; //年齡
                $birthParity = $row['birthParity']; //出生胎次
                $calvingInterval = $row['calvingInterval']; //胎距
                $mid = $row['mid']; //母親牛編號
                $fid = $row['fid']; //父親牛編號
                $leaveGroup = $row['leaveGroup']; //離開牛群
            }
        }
        echo "<br><br>
                            <p class=\"card-text\">出生日期 </p>
                            <input type=\"text\" class=\"col-12\" value=\"$dob\" disabled>
                            <br>
                            <div class=\"row\">
                                <div class=\"col-4\">
                                    <p class=\"card-text\">年齡 </p>
                                    <input type=\"text\" class=\"col-12\" value=\"$age\" disabled>
                                </div>
                                <div class=\"col-4\">
                                    <p class=\"card-text\">出生胎次 </p>
                                    <input type=\"text\" class=\"col-12\" value=\"$birthParity\" disabled>
                                </div>
                                <div class=\"col-4\">
                                    <p class=\"card-text\">胎距 </p>
                                    <input type=\"text\" class=\"col-12\" value=\"$calvingInterval\" disabled>
                                </div>
                            </div>
                            <br>
                            <div class=\"row\">
                                <div class=\"col-6\">
                                    <p class=\"card-text\">母親牛編號</p>
                                    <input type=\"text\" class=\"col-12\" value=\"$mid\" disabled>
                                </div>
                                <div class=\"col-6\">
                                    <p class=\"card-text\">父親牛編號 </p>
                                    <input type=\"text\" class=\"col-12\" value=\"$fid\" disabled>
                                </div>
                            </div>
                            <br>
                            <p class=\"card-text\">離開牛群</p>
                            <input type=\"text\" class=\"col-12\" value=\"$leaveGroup\" disabled>
                            ";

        ?>
</div>