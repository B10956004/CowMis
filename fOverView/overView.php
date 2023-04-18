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
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js"></script>
    <link rel="stylesheet" href="../css/indexcss.css">
    <script src="../Gauge.js"></script>
</head>

<body>
    <div id="content" style="width:100%; height:100% ;   padding:1.5rem  ;   ">
        <span class="col-6" style="font-weight:bold;font-size:25px;"><i class="fas fa-home"></i>&nbsp;牛舍資訊總覽</span>
        <div class="container">
            <div class="row bg-light shadow p-3 mt-2">
                <div class="col-4">
                    <h5 style="text-align: center;">溫度°C
                        <canvas id="temperatureChart" width="auto" height="125"></canvas>
                    </h5>
                    <script>
                        var ctx = document.getElementById("temperatureChart");
                        new Chart(ctx, {
                            type: "tsgauge",
                            data: {
                                datasets: [{
                                    backgroundColor: ["#2894FF", "#0fdc63", "#FFD306", "#EA0000"],
                                    borderWidth: 0,
                                    gaugeData: {
                                        value: 30,
                                        valueColor: "#0fdc63"
                                    },
                                    gaugeLimits: [0, 15, 30, 40, 50]
                                }]
                            },
                            options: {
                                events: [],
                                showMarkers: true
                            }
                        });
                    </script>
                </div>
                <div class="col-4">
                    <h5 style="text-align: center;">相對濕度%
                        <canvas id="humidityChart" width="auto" height="125"></canvas>
                    </h5>
                    <script>
                        var ctx = document.getElementById("humidityChart");
                        new Chart(ctx, {
                            type: "tsgauge",
                            data: {
                                datasets: [{
                                    backgroundColor: ["#00E3E3", "#0080FF", "#0066CC", "#000093"],
                                    borderWidth: 0,
                                    gaugeData: {
                                        value: 35,
                                        valueColor: "#00E3E3"
                                    },
                                    gaugeLimits: [20, 40, 60, 80, 100]
                                }]
                            },
                            options: {
                                events: [],
                                showMarkers: true,
                            }
                        });
                    </script>
                </div>
                <div class="col-4">
                    <h5 style="text-align: center;">熱緊迫指數THI
                        <canvas id="THIChart" width="auto" height="125"></canvas>
                    </h5>
                    <script>
                        var ctx = document.getElementById("THIChart");
                        new Chart(ctx, {
                            type: "tsgauge",
                            data: {
                                datasets: [{
                                    backgroundColor: ["#9D9D9D", "#FFD306", "#FF8000", "#EA0000", "#750075"],
                                    borderWidth: 0,
                                    gaugeData: {
                                        value: 41,
                                        valueColor: "#9D9D9D"
                                    },
                                    gaugeLimits: [50, 68, 72, 78, 89, 99]
                                }]
                            },
                            options: {
                                events: [],
                                showMarkers: true,
                            }
                        });
                    </script>
                </div>
                <div class="col-12">
                    <h5 style="text-align: center;">發情判斷</h5>
                    <div class="collapse show" data-parent="#estrusRecord" id="cow_basic">
                        <div class="card-body" id="estrusRecord">
                            <table id="rule" class="table table-hover" width="50%" align="center" style="display: table-cell;vertical-align: middle;">
                                <thead>
                                    <tr>
                                        <th>編號</th>
                                        <th>發情判斷</th>
                                        <th>狀態填寫</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $query = "SELECT * FROM cows_information ";
                                    $result = mysqli_query($db_link, $query);
                                    $num = mysqli_num_rows($result);
                                    $per = 1; //每頁顯示項目數量
                                    $pages = ceil($num / $per);
                                    if ($pages == 0) {
                                        $pages = 1;
                                    }
                                    if (!isset($_GET["page"])) {
                                        $page = 1;
                                    } else {
                                        $page = intval($_GET["page"]);
                                    }
                                    $start = ($page - 1) * $per;

                                    $query .= "ORDER BY `id` DESC LIMIT $start,$per";

                                    $result = mysqli_query($db_link, $query);
                                    $i = 1;
                                    while ($row = mysqli_fetch_array($result)) {
                                        echo "<tr>";
                                        $sn = $row['sn'];
                                        $id = $row['id'];
                                        echo "<td>$id</td>";
                                        echo "<td><center><img src=\"./發情.PNG\" width=\"60%\"></center></td>";
                                        echo "<td><input type=\"button\" class=\"addEstrusDate btn-primary btn\" value=\"發情日期\" GetSn=\"$sn\" GetID=\"$id\"> <br><br> <input type=\"button\" class=\"addMatingDate btn-primary btn\" value=\"受精日期\" GetSn=\"$sn\" GetID=\"$id\"></td>";
                                        echo "</tr>";
                                        $i += 1;
                                    }
                                    ?>
                                </tbody>
                            </table>
                            <?php
                            echo "
                                    <center><div class='row text-center'>
                                        <div class='col-12 justify-content-center' style='display:flex;'>
                                                <nav aria-label='Page navigation example'>
                                                    <ul class='pagination'>
                                                        <li class='page-item'>
                                                            <a class='page-link' href='?page=1' aria-label='Previous'>
                                                                <span aria-hidden='true'>&laquo;</span>
                                                            </a>
                                                        </li> ";

                            for ($i = 1; $i <= $pages; $i++) {
                                if ($page - 1 < $i && $i < $page + 1) {
                                    if ($page == $i) {
                                        echo "<li class='page-item active'><a class='page-link' href=?page=" . $i . " >" . $i . "</a></li> ";
                                    }
                                } else {
                                    echo "<li class='page-item'><a class='page-link' href=?page=" . $i . " >" . $i . "</a></li> ";
                                }
                            }
                            echo "<li class='page-item'><a class='page-link' aria-label='Next' href=?page=" . $pages . " ><span aria-hidden='true'>&raquo;</span></a></li></ul>
                                    </nav></div>";
                            //echo "<div class=\"col-12\">第" . $page . "/" . $pages . "頁-共" . $num . "筆</div></center>";
                            echo "</center>";
                            ?>
                        </div>
                    </div>
                    <div id="addEstrusDateModal" class="modal fade bd-example-modal-lg">
                        <div class="modal-dialog  modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title font-weight-bold">新增發情日期</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                <div class="modal-body" id="addEstrusDate">
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
                        $(document).on('click', '.addEstrusDate', function() {
                            var GetSn = $(this).attr("GetSn");
                            var GetID = $(this).attr("GetID");
                            $.ajax({
                                url: "../fHealthManagement/pregnancyCheck/addEstrusDate.php",
                                method: "GET",
                                data: {
                                    GetSn: GetSn,
                                    GetID: GetID
                                },


                                success: function(data) {
                                    $('#addEstrusDate').html(data);
                                    $('#addEstrusDateModal').modal('show');
                                }
                            });

                        });
                    </script>
                    <div id="addMatingDateModal" class="modal fade bd-example-modal-lg">
                        <div class="modal-dialog  modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title font-weight-bold">新增配種日期</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                <div class="modal-body" id="addMatingDate">
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
                        $(document).on('click', '.addMatingDate', function() {
                            var GetSn = $(this).attr("GetSn");
                            var GetID = $(this).attr("GetID");
                            $.ajax({
                                url: "../fHealthManagement/pregnancyCheck/addMatingDate.php",
                                method: "GET",
                                data: {
                                    GetSn: GetSn,
                                    GetID: GetID
                                },


                                success: function(data) {
                                    $('#addMatingDate').html(data);
                                    $('#addMatingDateModal').modal('show');
                                }
                            });

                        });
                    </script>
                </div>
                <div class="col-6">
                    <h5 style="text-align: center;">準備轉至乾乳牛隻</h5>
                    <div class="table-responsive" style="overflow: hidden;">
                        <div id="cow_table" style="text-align:center;">
                            <table id="rule" class="table table-hover">
                                <thead>
                                    <tr class="table-active">
                                        <th>編號</th>
                                        <th>發情日期</th>
                                        <th>配種日期</th>
                                        <th>胎次</th>
                                        <th>間隔天數</th>
                                        <th>懷孕日期</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- 更新間隔天數 -->
                                    <?php
                                    $query = "SELECT * FROM pregnancy_check WHERE `details` IS NULL OR `details`= '' ORDER BY `id` , `matingdate` ";
                                    $result = mysqli_query($db_link, $query);
                                    $i = 0;
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $sn = $row['sn']; //序列號
                                        $id = $row['id']; //編號
                                        if ($i == 0) {
                                            $temp = $id;
                                            $i += 1;
                                        } else {
                                            if ($id == $temp) {
                                                $i += 1;
                                            } else {
                                                $temp = $id;
                                                $i = 1;
                                            }
                                        }
                                        $estrusdate = $row['estrusdate']; //發情日期
                                        $matingdate = $row['matingdate']; //配種日期
                                        if ($matingdate != "0000-00-00" && $estrusdate != "0000-00-00") {
                                            $intervaldays = (strtotime($estrusdate) - strtotime($matingdate)) / (60 * 60 * 24); //間隔天數
                                            if ($intervaldays < 0) {
                                                $intervaldays = "";
                                            } else {
                                                $intervaldays = $intervaldays . '天';
                                            }
                                        } else {
                                            $intervaldays = "";
                                        }
                                        $birthparity = $i;
                                        $updateQuery = "UPDATE `pregnancy_check` SET `intervaldays`='$intervaldays',`birthparity`='$birthparity' WHERE `sn`='$sn' AND `id`='$id' ";
                                        mysqli_query($db_link, $updateQuery);
                                    }
                                    ?>
                                    <!-- 控制每頁的欄數 分娩前45~60天 -->
                                    <?php
                                    $query = "SELECT * FROM `pregnancy_check` WHERE (DATEDIFF(now(),`pregnancydate`)/30)>7 AND `pregnancyresult`='有' ";
                                    $result = mysqli_query($db_link, $query);
                                    // $num = mysqli_num_rows($result);
                                    // $per = 2; //每頁顯示項目數量
                                    // $pages = ceil($num / $per);
                                    // if ($pages == 0) {
                                    //     $pages = 1;
                                    // }
                                    // if (!isset($_GET["page"])) {
                                    //     $page = 1;
                                    // } else {
                                    //     $page = intval($_GET["page"]);
                                    // }
                                    // $start = ($page - 1) * $per;
                                    // $query .= "ORDER BY `parturitiondate` ASC LIMIT $start,$per";
                                    $query .= "ORDER BY `parturitiondate` ASC";

                                    $result = mysqli_query($db_link, $query);
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $sn = $row['sn']; //序列號
                                        $id = $row['id']; //編號
                                        $estrusdate = $row['estrusdate']; //發情日期
                                        $matingdate = $row['matingdate']; //配種日期
                                        $intervaldays = $row['intervaldays']; //間隔天數
                                        $pregnancydate = $row['pregnancydate']; //直腸檢查日期
                                        $birthparity = $row['birthparity']; //胎次
                                    ?>
                                        <tr>
                                            <td><?php echo $id ?></td>
                                            <td><?php echo $estrusdate ?></td>
                                            <td><?php echo $matingdate ?></td>
                                            <td><?php echo $birthparity ?></td>
                                            <td><?php echo $intervaldays ?></td>
                                            <td><?php echo $pregnancydate ?></td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                            <?php
                            // 暫時遺棄
                            // echo "
                            //         <center><div class='row text-center'>
                            //             <div class='col-12 justify-content-center' style='display:flex;'>
                            //                     <nav aria-label='Page navigation example'>
                            //                         <ul class='pagination'>
                            //                             <li class='page-item'>
                            //                                 <a class='page-link' href='?page=1' aria-label='Previous'>
                            //                                     <span aria-hidden='true'>&laquo;</span>
                            //                                 </a>
                            //                             </li> ";

                            // for ($i = 1; $i <= $pages; $i++) {
                            //     if ($page - 2 < $i && $i < $page + 4) {
                            //         if ($page == $i) {
                            //             echo "<li class='page-item active'><a class='page-link' href=?page=" . $i . " >" . $i . "</a></li> ";
                            //         }
                            //     } else {
                            //         echo "<li class='page-item'><a class='page-link' href=?page=" . $i . " >" . $i . "</a></li> ";
                            //     }
                            // }
                            // echo "<li class='page-item'><a class='page-link' aria-label='Next' href=?page=" . $pages . " ><span aria-hidden='true'>&raquo;</span></a></li></ul>
                            //         </nav></div>";
                            // //echo "<div class=\"col-12\">第" . $page . "/" . $pages . "頁-共" . $num . "筆</div></center>";
                            // echo "</center>";
                            ?>
                        </div>

                        </table>
                        </center>
                    </div>
                </div>
                <div class="col-6">
                    <h5 style="text-align: center;">即將分娩牛隻</h5>
                    <div class="collapse show" data-parent="#birth_data" id="cow_basic">
                        <div class="card-body" id="birth_data">
                            <center>
                                <table id="rule" class="table table-hover">
                                    <thead>
                                        <tr class="table-active">
                                            <th>編號</th>
                                            <th>胎次</th>
                                            <th>懷孕日期</th>
                                            <th>分娩日期</th>
                                            <th>編輯</th>
                                            <th>刪除</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- 控制每頁的欄數 -->
                                        <?php
                                        $query = "SELECT * FROM pregnancy_check WHERE `events` IS NULL OR `events`= '' AND `pregnancyresult`='有' ";
                                        $result = mysqli_query($db_link, $query);
                                        // $num = mysqli_num_rows($result);
                                        // $per = 5; //每頁顯示項目數量
                                        // $pages = ceil($num / $per);
                                        // if ($pages == 0) {
                                        //     $pages = 1;
                                        // }
                                        // if (!isset($_GET["page"])) {
                                        //     $page = 1;
                                        // } else {
                                        //     $page = intval($_GET["page"]);
                                        // }
                                        // $start = ($page - 1) * $per;

                                        // $query .= "ORDER BY `intervaldays` DESC LIMIT $start,$per";
                                        $query .= "ORDER BY `intervaldays` DESC";
                                        $result = mysqli_query($db_link, $query);
                                        $i = 1;
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            $sn = $row['sn']; //序列號
                                            $id = $row['id']; //編號
                                            $pregnancydate = $row['pregnancydate']; //直腸檢查日期
                                            $parturitiondate = $row['parturitiondate']; //分娩日期
                                            if ($parturitiondate == '0000-00-00') {
                                                $parturitiondate = '';
                                            }
                                            $birthparity = $row['birthparity']; //胎次
                                            $events = $row['events']; //事件
                                            $details = $row['details']; //詳情
                                        ?>
                                            <tr>
                                                <td><?php echo $id ?></td>
                                                <td><?php echo $birthparity ?></td>
                                                <td><?php echo $pregnancydate ?></td>
                                                <td><?php echo $parturitiondate ?></td>
                                                <td><button class="view_data btn btn-primary" GetSn="<?php echo $sn; ?>">編輯</button></td>
                                                <?php
                                                echo "<td><button id=\"linkDel_$i\" onclick=\"#del\" class='btn btn-danger'>刪除</button></td>";
                                                echo "
                    <script>
                      $(\"#linkDel_$i\").click(function(){
                        var yesDel = confirm(\"你確定要刪除\"+'$id'+\"這筆資料嗎？，刪除後不可復原。\");
                          if (yesDel) {
                            $.post(\"./pregnancyCheck_Delete.php\",{ Del: 1,postSn:$sn },function(result){
                              location.reload();
                              });
                          }
                        });
                    </script>";
                                                ?>
                                            </tr>
                                        <?php
                                            $i += 1;
                                        }
                                        ?>
                                    </tbody>
                                </table>
                                <?php
                                // 暫時遺棄
                                // echo "
                                //     <center><div class='row text-center'>
                                //         <div class='col-12 justify-content-center' style='display:flex;'>
                                //                 <nav aria-label='Page navigation example'>
                                //                     <ul class='pagination'>
                                //                         <li class='page-item'>
                                //                             <a class='page-link' href='?page=1' aria-label='Previous'>
                                //                                 <span aria-hidden='true'>&laquo;</span>
                                //                             </a>
                                //                         </li> ";

                                // for ($i = 1; $i <= $pages; $i++) {
                                //     if ($page - 5 < $i && $i < $page + 4) {
                                //         if ($page == $i) {
                                //             echo "<li class='page-item active'><a class='page-link' href=?page=" . $i . " >" . $i . "</a></li> ";
                                //         } else {
                                //             echo "<li class='page-item'><a class='page-link' href=?page=" . $i . " >" . $i . "</a></li> ";
                                //         }
                                //     }
                                // }
                                // echo "<li class='page-item'><a class='page-link' aria-label='Next' href=?page=" . $pages . " ><span aria-hidden='true'>&raquo;</span></a></li></ul>
                                //     </nav></div>";
                                // //echo "<div class=\"col-12\">第" . $page . "/" . $pages . "頁-共" . $num . "筆</div>";
                                // echo "</center>";
                                ?>
                        </div>
                    </div>

                </div>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
                <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>
                <div id="pregnancyDataModal" class="modal fade bd-example-modal-lg">
                    <div class="modal-dialog  modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title font-weight-bold">修改妊娠資料</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body" id="cow_pregnancyDetail">
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
                    $(document).on('click', '.view_data', function() {
                        var GetSn = $(this).attr("GetSn");

                        $.ajax({
                            url: "../fHealthManagement/pregnancyCheck/pregnancyCheck_Revise.php",
                            method: "GET",
                            data: {
                                GetSn: GetSn
                            },


                            success: function(data) {
                                $('#cow_pregnancyDetail').html(data);
                                $('#pregnancyDataModal').modal('show');
                            }
                        });

                    });
                </script>
            </div>

        </div>
    </div>
    </div>
</body>

</html>