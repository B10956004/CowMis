<?php
require_once("../SQLServer.php"); //注入SQL檔
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
    <link rel="stylesheet" href="../css/indexcss.css">

    <script>
        //資料讀取
        function informationLoad() {
            $.ajax({
                url: "./card/cowInformation.php",
                method: "GET",
                data: {
                    GetSn: document.getElementById("selected_cow").value
                },
                success: function(data) {
                    $('#cowInformation').html(data);
                }
            });
            $.ajax({
                url: "./card/milkRecord.php",
                method: "GET",
                data: {
                    GetSn: document.getElementById("selected_cow").value
                },
                success: function(data) {
                    $('#milkInformation').html(data);
                }
            });
            $.get("./card/diseaseManagement.php", {
                GetSn: document.getElementById("selected_cow").value
            }, function(data) {
                $('#diseaseInformation').html(data);
            });
            $.get("./card/feedRecord.php", {
                GetSn: document.getElementById("selected_cow").value
            }, function(data) {
                $('#feedRecord').html(data);
            });
        }
    </script>
</head>

<body>
    <div id="content" style="width:100%; height:100% ;   padding:1.5rem  ;   ">
        <span class="col-6" style="font-weight:bold;font-size:25px;"><i class="fas fa-home"></i>&nbsp;基本資訊總覽</span>
        <div class="container">
            <div class="row">
                <div class="col-4">
                    <!-- 牛隻資訊 -->
                    <div class="card" id="cowInformation">
                        <div class="card-body">
                            <h5 class="card-title"><i class="fas fa-paw"></i>&nbsp;牛隻資訊</h5>
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
                                echo "<br><br>
                            <p class=\"card-text\">出生日期 </p>
                            <input type=\"text\" class=\"col-12\" disabled>
                            <br>
                            <div class=\"row\">
                                <div class=\"col-4\">
                                    <p class=\"card-text\">年齡 </p>
                                    <input type=\"text\" class=\"col-12\" disabled>
                                </div>
                                <div class=\"col-4\">
                                    <p class=\"card-text\">出生胎次 </p>
                                    <input type=\"text\" class=\"col-12\" disabled>
                                </div>
                                <div class=\"col-4\">
                                    <p class=\"card-text\">胎距 </p>
                                    <input type=\"text\" class=\"col-12\" disabled>
                                </div>
                            </div>
                            <br>
                            <div class=\"row\">
                                <div class=\"col-6\">
                                    <p class=\"card-text\">母親牛編號</p>
                                    <input type=\"text\" class=\"col-12\" disabled>
                                </div>
                                <div class=\"col-6\">
                                    <p class=\"card-text\">父親牛編號 </p>
                                    <input type=\"text\" class=\"col-12\" disabled>
                                </div>
                            </div>
                            <br>
                            <p class=\"card-text\">離開牛群</p>
                            <input type=\"text\" class=\"col-12\" disabled>
                            ";
                                ?>
                        </div>
                    </div>
                </div>
                <div class="col-8">
                    <div class="row">
                        <div class="col-12">
                            <!-- 乳質資訊 -->
                            <div class="card" id="milkInformation">
                                <div class="card-body">
                                    <h5 class="card-title"><i class="fas fa-tint"></i>&nbsp;乳質資訊&nbsp;&nbsp;<a href="#milkQuality" class="btn btn-info view_data">乳質檢測數據</a></h5>
                                    <div class="table-responsive">
                                        <div id="cow_table" style="text-align:center;">
                                            <table id="rule" class="table table-hover">
                                                <thead>
                                                    <tr class="table-active">
                                                        <th>日期</th>
                                                        <th>乳質</th>
                                                        <th>乳量</th>
                                                        <th>運輸紀錄</th>
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
                        <div class="col-12">
                            <!-- 疾病資訊 -->
                            <div class="card" id="diseaseInformation">
                                <div class="card-body">
                                    <h5 class="card-title"><i class="fas fa-heart"></i>&nbsp;疾病資訊</h5>
                                    <div class="table-responsive">
                                        <div id="cow_table" style="text-align:center;">
                                            <table id="rule" class="table table-hover">
                                                <thead>
                                                    <tr class="table-active">
                                                        <th>日期</th>
                                                        <th>疾病</th>
                                                        <th>藥品</th>
                                                        <th>疫苗</th>
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
                        <!-- <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Special title treatment</h5>
                                    <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                                    <a href="#" class="btn btn-primary">Go somewhere</a>
                                </div>
                            </div>
                        </div> -->
                    </div>
                </div>
                <div class="col-12">
                    <!-- 飼養管理紀錄 -->
                    <div class="card" id="feedRecord">
                        <div class="card-body">
                            <h5 class="card-title"><i class="fas fa-seedling"></i>&nbsp;飼養管理紀錄</h5>
                            <div class="table-responsive">
                                <div id="cow_table" style="text-align:center;">

                                    <table id="rule" class="table table-hover">
                                        <thead>
                                            <tr class="table-active">
                                                <th>進場日期</th>
                                                <th>系譜</th>
                                                <th>精料</th>
                                                <th>芻料</th>
                                                <th>懷孕</th>
                                                <th>泌乳</th>
                                                <th>飲水量</th>
                                                <th>餵養時間</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- ajax注入內容 -->
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
</body>

</html>