<?php
require_once("../../SQLServer.php");
?>
<!doctype html>
<html lang="zh-TW">

<head>
  <!-- 導入外觀 -->
  <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  <meta charset="UTF-8">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
  <script src="../../jquery-tablepage-1.0.js"></script>
  <link rel="stylesheet" href="../../css/text_box2.css">
  <link rel="stylesheet" href="../../css/indexcss.css">
  <title>智慧飼牛系統</title>


</head>

<body>
  <!-- 最外框架與主頁框架嵌合 -->
  <div name="content" style="width:100%; height: 100vh ;   padding:1.5rem  ;   ">
    <div class="tab-content">
      <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item">
          <a href="#predEstrus" class="nav-link active" data-toggle="tab">發情判斷</a>
        </li>
        <li class="nav-item">
          <a href="#pregnancyCheck" class="nav-link" data-toggle="tab">妊娠檢查</a>
        </li>
      </ul>
      <!-- 主頁 預測發情 -->
      <div class="tab-pane active shadow-sm p-4" id="predEstrus">
        <div class="row">
          <div class="col-md-3 p-2">
            <input type="search" class="search form-control" data-table="table table-hover" placeholder="搜尋關鍵字" style="width:100%;">
          </div>
        </div>
        <div class="card">
          <div class="card-body" id="estrusRecord">
            <table id="rule" class="table table-hover" width="50%" align="center" style="display: table-cell;vertical-align: middle;">
              <thead>
                <tr>
                  <th>乳牛編號</th>
                  <th>發情判斷</th>
                  <th>狀態填寫</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $query = "SELECT * FROM cows_information ";
                $result = mysqli_query($db_link, $query);
                // $num = mysqli_num_rows($result);
                // $per = 3; //每頁顯示項目數量
                // $pages = ceil($num / $per);
                // if ($pages == 0) {
                //   $pages = 1;
                // }
                // if (!isset($_GET["page"])) {
                //   $page = 1;
                // } else {
                //   $page = intval($_GET["page"]);
                // }
                // $start = ($page - 1) * $per;

                // $query .= "ORDER BY `id` DESC LIMIT $start,$per";

                // $result = mysqli_query($db_link, $query);
                // $i = 1;
                while ($row = mysqli_fetch_array($result)) {
                  echo "<tr>";
                  $id = $row['id'];
                  echo "<td>$id</td>";
                  echo "<td><img src=\"./發情.PNG\" width=\"75%\"></td>";
                  echo "<td><input type=\"button\" class=\"addEstrusDate btn-primary btn\" value=\"發情日期\" GetID=\"$id\"> <br><br> <input type=\"button\" class=\"addMatingDate btn-primary btn\" value=\"配種日期\" GetID=\"$id\"></td>";
                  echo "</tr>";
                  // $i += 1;
                }
                ?>
              </tbody>
            </table>
            <?php
            // echo "
            //                         <center><div class='row text-center'>
            //                             <div class='col-12 justify-content-center' style='display:flex;'>
            //                                     <nav aria-label='Page navigation example'>
            //                                         <ul class='pagination'>
            //                                             <li class='page-item'>
            //                                                 <a class='page-link' href='?page=1' aria-label='Previous'>
            //                                                     <span aria-hidden='true'>&laquo;</span>
            //                                                 </a>
            //                                             </li> ";

            // for ($i = 1; $i <= $pages; $i++) {
            //   if ($page - 5 < $i && $i < $page + 4) {
            //     if ($page == $i) {
            //       echo "<li class='page-item active'><a class='page-link' href=?page=" . $i . " >" . $i . "</a></li> ";
            //     } else {
            //       echo "<li class='page-item'><a class='page-link' href=?page=" . $i . " >" . $i . "</a></li> ";
            //     }
            //   }
            // }
            // echo "<li class='page-item'><a class='page-link' aria-label='Next' href=?page=" . $pages . " ><span aria-hidden='true'>&raquo;</span></a></li></ul>
            //                         </nav></div>";
            // echo "<div class=\"col-12\">第" . $page . "/" . $pages . "頁-共" . $num . "筆</div></center>";
            ?>
          </div>
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
          var GetID = $(this).attr("GetID");
          $.ajax({
            url: "addEstrusDate.php",
            method: "GET",
            data: {
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
          var GetID = $(this).attr("GetID");
          $.ajax({
            url: "addMatingDate.php",
            method: "GET",
            data: {
              GetID: GetID
            },


            success: function(data) {
              $('#addMatingDate').html(data);
              $('#addMatingDateModal').modal('show');
            }
          });

        });
      </script>
      <!-- 切換頁 檢查 -->
      <div class="tab-pane fade bg-white shadow-sm p-4" id="pregnancyCheck">
        <div class="row">
          <div class="col-md-3 p-2">
            <input type="search" class="search form-control" data-table="table table-hover" placeholder="搜尋關鍵字" style="width:100%;">
          </div>
        </div>
        <br>
        <div class="table-responsive" style="overflow-y: hidden;">
          <div id="cow_table" style="text-align:center;">

            <table id="rule" class="table table-hover">
              <thead>
                <tr class="table-active">
                  <th>乳牛編號</th>
                  <th>發情日期</th>
                  <th>配種日期</th>
                  <th>胎次(配種數)</th>
                  <th>間隔天數</th>
                  <th>檢查日期</th>
                  <th>測孕結果</th>
                  <th>分娩日期</th>
                  <th>事件</th>
                  <th>詳情</th>
                  <th>編輯</th>
                  <th>刪除</th>

                </tr>
              </thead>
              <tbody>
                <!-- 更新間隔天數 -->
                <?php
                $query = "SELECT * FROM pregnancy_check WHERE `events` IS NULL OR `events`='' ORDER BY `id` , `matingdate` ";
                $result = mysqli_query($db_link, $query);
                while ($row = mysqli_fetch_assoc($result)) {
                  $sn = $row['sn']; //序列號
                  $id = $row['id']; //編號
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
                  $updateQuery = "UPDATE `pregnancy_check` SET `intervaldays`='$intervaldays' WHERE `sn`='$sn' AND `id`='$id' ";
                  mysqli_query($db_link, $updateQuery);
                }
                ?>
                <!-- 控制每頁的欄數 -->
                <?php
                $query = "SELECT * FROM pregnancy_check WHERE `events` IS NULL OR `events`='' ORDER BY `intervaldays` DESC";
                // $result = mysqli_query($db_link, $query);
                // $num = mysqli_num_rows($result);
                // $per = 5; //每頁顯示項目數量
                // $pages = ceil($num / $per);
                // if ($pages == 0) {
                //   $pages = 1;
                // }
                // if (!isset($_GET["page"])) {
                //   $page = 1;
                // } else {
                //   $page = intval($_GET["page"]);
                // }
                // $start = ($page - 1) * $per;

                // $query .= "ORDER BY `intervaldays` DESC LIMIT $start,$per";

                $result = mysqli_query($db_link, $query);
                $i = 1;
                while ($row = mysqli_fetch_assoc($result)) {
                  $sn = $row['sn']; //序列號
                  $id = $row['id']; //編號
                  $estrusdate = $row['estrusdate']; //發情日期
                  $matingdate = $row['matingdate']; //配種日期
                  $intervaldays = $row['intervaldays']; //間隔天數
                  $pregnancydate = $row['pregnancydate']; //直腸檢查日期
                  $pregnancyresult = $row['pregnancyresult']; //測孕結果
                  $parturitiondate = $row['parturitiondate']; //分娩日期
                  if ($parturitiondate == '0000-00-00') {
                    $parturitiondate = '';
                  }
                  $birthparity = $row['birthparity']; //胎次
                  $events = $row['events']; //事件
                  $details = $row['details']; //詳情
                  $matingcount = $row['matingcount']; //配種次數
                ?>
                  <tr>
                    <td><?php echo $id ?></td>
                    <td><?php echo $estrusdate ?></td>
                    <td><?php echo $matingdate ?></td>
                    <td><?php echo $birthparity."({$matingcount})"; ?></td>
                    <td><?php echo $intervaldays ?></td>
                    <td><?php echo $pregnancydate ?></td>
                    <td><?php echo $pregnancyresult ?></td>
                    <td><?php echo $parturitiondate ?></td>
                    <td><?php echo $events ?></td>
                    <td><?php echo $details ?></td>
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
            // echo "
            //                         <center><div class='row text-center'>
            //                             <div class='col-12 justify-content-center' style='display:flex;'>
            //                                     <nav aria-label='Page navigation example'>
            //                                         <ul class='pagination'>
            //                                             <li class='page-item'>
            //                                                 <a class='page-link' href='?page=1' aria-label='Previous'>
            //                                                     <span aria-hidden='true'>&laquo;</span>
            //                                                 </a>
            //                                             </li> ";

            // for ($i = 1; $i <= $pages; $i++) {
            //   if ($page - 5 < $i && $i < $page + 4) {
            //     if ($page == $i) {
            //       echo "<li class='page-item active'><a class='page-link' href=?page=" . $i . " >" . $i . "</a></li> ";
            //     } else {
            //       echo "<li class='page-item'><a class='page-link' href=?page=" . $i . " >" . $i . "</a></li> ";
            //     }
            //   }
            // }
            // echo "<li class='page-item'><a class='page-link' aria-label='Next' href=?page=" . $pages . " ><span aria-hidden='true'>&raquo;</span></a></li></ul>
            //                         </nav></div>";
            // echo "<div class=\"col-12\">第" . $page . "/" . $pages . "頁-共" . $num . "筆</div></center>";
            ?>
          </div>
        </div>

      </div>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>
      <div id="dataModal" class="modal fade bd-example-modal-lg">
        <div class="modal-dialog  modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title font-weight-bold">修改妊娠資料</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body" id="cow_detail">
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
            url: "pregnancyCheck_Revise.php",
            method: "GET",
            data: {
              GetSn: GetSn
            },


            success: function(data) {
              $('#cow_detail').html(data);
              $('#dataModal').modal('show');
            }
          });

        });
      </script>
    </div>
  </div>
</body>

<!-- 查詢功能 -->
<script type="text/javascript">
  (function(document) {
    'use strict';


    var LightTableFilter = (function(Arr) {

      var _input;


      function _onInputEvent(e) {
        _input = e.target;
        var tables = document.getElementsByClassName(_input.getAttribute('data-table'));
        Arr.forEach.call(tables, function(table) {
          Arr.forEach.call(table.tBodies, function(tbody) {
            Arr.forEach.call(tbody.rows, _filter);
          });
        });
      }


      function _filter(row) {
        var text = row.textContent.toLowerCase(),
          val = _input.value.toLowerCase();
        row.style.display = text.indexOf(val) === -1 ? 'none' : 'table-row';
      }

      return {

        init: function() {
          var inputs = document.getElementsByClassName('search');
          Arr.forEach.call(inputs, function(input) {
            input.oninput = _onInputEvent;
          });
        }
      };
    })(Array.prototype);


    document.addEventListener('readystatechange', function() {
      if (document.readyState === 'complete') {
        LightTableFilter.init();
      }
    });

  })(document);
</script>

</html>