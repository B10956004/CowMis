<?php
require_once("../../../SQLServer.php");
$GetID = $_GET['GetID']; //選擇的牛隻


?>
<div class="card-body">
    <h5 class="card-title"><i class="fas fa-chart-area"></i>&nbsp;活動量圖<?php
        // if (mysqli_num_rows($result) != 0) {
        //     echo "&nbsp;&nbsp;&nbsp;&nbsp;編號:$GetID &nbsp;&nbsp;";
        // }
        echo "&nbsp;&nbsp;&nbsp;&nbsp;編號:$GetID &nbsp;&nbsp;";
        ?></h5>
    <!-- <div class="table-responsive">
    <div id="cow_table" style="text-align:center;">
        <table id="rule" class="table table-hover">
            <thead>
                <tr class="table-active">
                    <th>分娩日期</th>
                    <th>胎次</th>
                    <th>事件</th>
                    <th>詳情</th>
                    <th>編輯</th>
                </tr>
            </thead>
            <tbody>
                ajax注入
            </tbody>
        </table>
    </div>
</div> -->
    <img src="./card/cowActivity/發情.PNG" width="100%">
</div>