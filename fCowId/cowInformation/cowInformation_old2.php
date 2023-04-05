<?php
require_once("../../SQLServer.php"); //注入SQL檔
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <meta charset="utf-8">
    <!--<meta http-equiv="refresh" content="60;url='http://140.127.22.165//豬隻V2.1/index.php'"/>-->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js"></script>
    <link rel="stylesheet" href="../../css/indexcss.css">

    <script>
        //資料讀取
        function informationLoad() {
            $.ajax({
                url: "./card/selectCowInformation.php",
                method: "GET",
                data: {
                    GetSn: document.getElementById("selected_cow").value
                },
                success: function(data) {
                    $('#leftArea').html(data);
                    // $('#selectCowInformation').html(data);
                }
            });
            $.ajax({
                url: "./card/cowInformationDetail.php",
                method: "GET",
                data: {
                    GetSn: document.getElementById("selected_cow").value
                },
                success: function(data) {
                    $('#cowInformation').html(data);
                }
            });
            $.get("./card/parturitionHistory.php", {
                GetSn: document.getElementById("selected_cow").value
            }, function(data) {
                $('#parturitionHistory').html(data);
            });
        }
    </script>
    <?php
    if (isset($_GET['GetSn'])) {
        $GetSn = $_GET['GetSn'];
        echo "<script>
        function informationLoad_Sn() {
            $.ajax({
                url: \"./card/selectCowInformation.php\",
                method: \"GET\",
                data: {
                    GetSn: $GetSn
                },
                success: function(data) {
                    $('#leftArea').html(data);
                    // $('#selectCowInformation').html(data);
                }
            });
            $.ajax({
                url: \"./card/cowInformationDetail.php\",
                method: \"GET\",
                data: {
                    GetSn: $GetSn
                },
                success: function(data) {
                    $('#cowInformation').html(data);
                }
            });
            $.get(\"./card/parturitionHistory.php\", {
                GetSn: $GetSn
            }, function(data) {
                $('#parturitionHistory').html(data);
            });
        }
        informationLoad_Sn();
            </script>";
    }
    ?>
</head>

<body>
    <div id="content" style="width:100%; height:100% ;   padding:1.5rem  ;   ">
        <div class="tab-content">
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <a href="#cowsList" class="nav-link active" data-toggle="tab">牛隻資料</a>
                </li>
                <li class="nav-item">
                    <a href="#addCows" class="nav-link" data-toggle="tab">新增牛隻</a>
                </li>
            </ul>
            <div class="tab-pane active bg-white shadow-sm p-4" id="cowsList">
                <div class="container">
                    <div class="row">
                        <div class="col-4">
                            <div class="row" id="leftArea">
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
                                    <div class="card" id="selectCowInformation">
                                        <div class="card-body">
                                            <h5 class="card-title"><i class="fas fa-paw"></i>&nbsp;選擇牛隻</h5>
                                            <p class="card-text">牛隻編號:</p>
                                            <select id="selected_cow" onchange="informationLoad()" class="col-12">
                                                <option value="" selected>請選擇</option>
                                                <?php
                                                $query = "SELECT * FROM cows_information WHERE isDel=0 ";
                                                $result = mysqli_query($db_link, $query);
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    $sn = $row['sn']; //序列號
                                                    $id = $row['id']; //牛隻編號
                                                    echo "<option value=\"$sn\">$id</option>";
                                                }
                                                echo "</select>";
                                                ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-8">
                            <div class="row">
                                <div class="col-12">
                                    <!-- 牛隻資訊 -->
                                    <div class="card" id="cowInformation">
                                        <div class="card-body">
                                            <h5 class="card-title"><i class="fas fa-tint"></i>&nbsp;牛隻資訊&nbsp;&nbsp;</h5>
                                            <?php
                                            echo "
                                    <p class=\"card-text\">出生日期<br>
                                    <input type=\"text\" class=\"col-12\" disabled> </p>
                                    <div class=\"row\">
                                        <div class=\"col-4\">
                                            <p class=\"card-text\">年齡 <br>
                                            <input type=\"text\" class=\"col-12\" disabled> </p>
                                        </div>
                                        <div class=\"col-4\">
                                            <p class=\"card-text\">出生胎次 <br>
                                            <input type=\"text\" class=\"col-12\" disabled> </p>
                                        </div>
                                        <div class=\"col-4\">
                                            <p class=\"card-text\">胎距 <br>
                                            <input type=\"text\" class=\"col-12\" disabled> </p>
                                        </div>
                                    </div>
                                    <div class=\"row\">
                                        <div class=\"col-6\">
                                            <p class=\"card-text\">母親牛編號<br>
                                            <input type=\"text\" class=\"col-12\" disabled> </p>
                                        </div>
                                        <div class=\"col-6\">
                                            <p class=\"card-text\">父親牛編號 <br>
                                            <input type=\"text\" class=\"col-12\" disabled> </p>
                                        </div>
                                    </div>
                                    <!--
                                    <p class=\"card-text\">離開牛群<br>
                                    <input type=\"text\" class=\"col-12\" disabled> </p>
                                    -->
                                    ";
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <!-- 歷史懷孕紀錄 -->
                                    <div class="card" id="parturitionHistory">
                                        <div class="card-body">
                                            <h5 class="card-title"><i class="fas fa-heart"></i>&nbsp;歷史懷孕紀錄</h5>
                                            <div class="table-responsive">
                                                <div id="cow_table" style="text-align:center;">
                                                    <table id="rule" class="table table-hover">
                                                        <thead>
                                                            <tr class="table-active">
                                                                <th>日期</th>
                                                                <th>胎次</th>
                                                                <th>事件</th>
                                                                <th>詳情</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <!--ajax注入-->
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade bg-white shadow-sm p-4" id="addCows" style="border-radius:5px;">
                <div class="card">
                    <div class="card-body">
                        <form action="cowInformation_Insert.php" method="post">
                            <div class="row">
                                <div class="col-6">
                                    <p>編號</p>
                                    <input type="text" class="form-control card-text" placeholder="請輸入編號" name="id" required>
                                </div>
                                <div class="col-6">
                                    <p>出生日期</p>
                                    <input type="date" class="form-control card-text" placeholder="請輸入出生日期" name="dob" required>
                                </div>

                                <div class="col-4">
                                    <p>年齡</p>
                                    <input type="text" class="form-control card-text" placeholder="請輸入年齡" name="age" required>
                                </div>
                                <div class="col-4">
                                    <p>出生胎次</p>
                                    <input type="text" class="form-control card-text" placeholder="請輸入出生胎次" name="birthParity" required>
                                </div>
                                <div class="col-4">
                                    <p>胎距</p>
                                    <input type="text" class="form-control card-text" placeholder="胎距" name="calvingInterval" required>
                                </div>

                                <div class="col-6">
                                    <p>父親牛編號</p>
                                    <input type="text" class="form-control card-text" placeholder="請輸入父親牛編號" name="fid" required>
                                </div>
                                <div class="col-6">
                                    <p>母親牛編號</p>
                                    <input type="text" class="form-control card-text" placeholder="請輸入母親牛編號" name="mid" required>
                                </div>
                            </div>
                            <div class="col-12">
                                <p>離開牛群</p>
                                <input type="text" class="form-control card-text" placeholder="請輸入離開牛群" name="leaveGroup" required>
                            </div>
                            <br>
                            <input type="submit" class="btn btn-info" value="新增" name="submit"></input>
                    </div>
                    </form>
                </div>
            </div>

        </div>

    </div>
    </div>
    </div>
</body>

</html>