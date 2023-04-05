<div class="col-12">
    <!-- 區域資訊 -->
    <div class="card" id="selectCowArea">
        <div class="card-body">
            <h5 class="card-title"><i class="fas fa-paw"></i>&nbsp;選擇區域</h5>
            <img src="../../image/牛舍區域.png" width="100%">
        </div>
    </div>
</div>
<div class="col-12">
    <!-- 牛隻資訊 -->
    <div class="card-body">
        <h5 class="card-title"><i class="fas fa-paw"></i>&nbsp;選擇牛隻</h5>
        <p class="card-text">牛隻編號:</p>
        <select id="selected_cow" onchange="informationLoad()" class="col-12">
            <?php
            require("../../../SQLServer.php");
            $GetSn = $_GET['GetSn'];
            echo $GetSn;
            $query = "SELECT * FROM cows_information WHERE isDel=0 ";
            $result = mysqli_query($db_link, $query);
            while ($row = mysqli_fetch_assoc($result)) {
                $sn = $row['sn']; //序列號
                $id = $row['id']; //牛隻編號
                if ($sn == $GetSn) {
                    echo "<option value=\"$sn\" selected>$id</option>";
                } else {
                    echo "<option value=\"$sn\">$id</option>";
                }
            }
            echo "</select>";
            ?>
    </div>
</div>