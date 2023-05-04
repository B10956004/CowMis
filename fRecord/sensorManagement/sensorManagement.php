<?php
require_once("../../SQLServer.php");
?>

<!DOCTYPE html>
<html lang="zh-TW">

<head>
  <!-- 導入外觀 -->
  <!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script> -->
  <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  <meta charset="UTF-8">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
  <script src="../../jquery-tablepage-1.0.js"></script>
  <link rel="stylesheet" href="../../css/text_box2.css">
  <link rel="stylesheet" href="../../css/indexcss.css">
  <link rel="stylesheet" TYPE="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
  <!-- <link rel="stylesheet" href="https://apps.bdimg.com/libs/jquerymobile/1.4.5/jquery.mobile-1.4.5.min.css">
  <script src="https://apps.bdimg.com/libs/jquerymobile/1.4.5/jquery.mobile-1.4.5.min.js"></script> -->
  <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
  <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">

  <title>乳牛飼養系統</title>

</head>

<body>
  <!-- 最外框架與主頁框架嵌合 -->


  <div name="content" style="width:100%; height: 100vh ;   padding:1.5rem  ;   ">
    <div class="tab-content">
      <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item">
          <a href="#sensorManagement" class="nav-link active" data-toggle="tab">感測器管理</a>
        </li>
        <li class="nav-item">
          <a href="#addSensorDevices" class="nav-link" data-toggle="tab">新增感測器</a>
        </li>
      </ul>
      <div class="tab-pane active bg-white shadow-sm p-4" id="sensorManagement">
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
                  <th>感測器編號(型號)</th>
                  <th>狀態</th>
                  <th>編輯</th>
                  <th>刪除</th>
                </tr>
              </thead>
              <tbody>
                <!-- 控制每頁的欄數 -->
                <?php
                $query = "SELECT * FROM sensor_management ";
                // $result = mysqli_query($db_link, $query);

                // $num = mysqli_num_rows($result);
                // if ($num != 0) {
                //   $per = 5; //每頁顯示項目數量
                //   $pages = ceil($num / $per);
                //   if ($pages == 0) {
                //     $pages = 1;
                //   }
                //   if (!isset($_GET["page"])) {
                //     $page = 1;
                //   } else {
                //     $page = intval($_GET["page"]);
                //   }
                //   $start = ($page - 1) * $per;

                $query .= "ORDER BY cid ";

                $result = mysqli_query($db_link, $query);
                $i = 1;
                while ($row = mysqli_fetch_array($result)) {
                  $cid = $row['cid']; //牛編號
                  $uuid = $row['uuid']; //感測器編號
                  $model = $row['model']; //型號
                  $states = $row['states']; //狀態
                ?>
                  <tr>
                    <td><?php echo $cid ?></td>
                    <td><?php echo $uuid . '(' . $model . ")" ?></td>
                    <td><?php
                        if ($states == '未連接') {
                          echo "<i class=\"fas fa-circle\" style=\"color: gray;\"></i>";
                        } elseif ($states == '正常') {
                          echo "<i class=\"fas fa-circle\" style=\"color: green;\"></i>";
                        } elseif ($states == '疑似發情' || $states == '發情') {
                          echo "<i class=\"fas fa-circle\" style=\"color: red;\"></i>";
                        } else {
                          echo "<i class=\"fas fa-circle\" style=\"color: gold;\"></i>";
                        }
                        echo $states ?></td>
                    <td><button class="view_data btn btn-primary" GetUuid="<?php echo $uuid;
                                                                            ?>">編輯</button></td>
                    <?php
                    echo "<td><button id=\"linkDel_$i\" onclick=\"#del\" class=\"btn btn-danger\">刪除</button></td>";
                    echo "
                    <script>
                      $(\"#linkDel_$i\").click(function(){
                        var yesDel = confirm(\"你確定要刪除\"+'$cid'+\"這筆資料嗎？，刪除後不可復原。\");
                          if (yesDel) {
                            $.post(\"./sensorManagement_Delete.php\",{ Del: 1,postUuid:'$uuid' },function(result){
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
                // }else{
                //   $page=1;
                //   $pages=1;
                // }
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
              <h4 class="modal-title font-weight-bold">修改感測器資料</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body" id="cow_detail">
              <!-- <input type="text" name="cow_ID" id="cow_ID" claass="form-control" readonly /> -->
              <!-- ajax取代 -->
              <br />
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">關閉</button>
            </div>
          </div>
        </div>
      </div>
      <script>
        $(document).on('click', '.view_data', function() {
          var GetUuid = $(this).attr("GetUuid");

          $.ajax({
            url: "sensorManagement_Revise.php",
            method: "GET",
            data: {
              GetUuid: GetUuid
            },


            success: function(data) {
              $('#cow_detail').html(data);
              $('#dataModal').modal('show');
            }
          });

        });
      </script>
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

      <!-- 切換頁 新增 -->
      <div class="tab-pane fade bg-white shadow-sm p-4" id="addSensorDevices" style="border-radius:5px;">
        <div class="card">
          <div class="card-body">
            <form action="sensorManagement_Insert.php" method="post">
              <div class="row">
                <div class="col-12">
                  <p>區域</p>
                  <select class="form-select" name="area" id="area" onchange="selectArea(this)" required>
                    <option value="">請選擇</option>
                    <option value="高乳">高乳</option>
                    <option value="低乳">低乳</option>
                    <option value="乾乳">乾乳</option>
                    <option value="已受孕">已受孕</option>
                    <option value="未受孕">未受孕</option>
                    <option value="小牛">小牛</option>
                  </select>
                </div>
                <div class="col-4">
                  <p>乳牛編號</p>
                  <select class="form-select" name="cid" id="cid" required>
                    <option value="">請選擇</option>
                  </select>
                </div>
                <div class="col-4">
                  <p>感測器編號</p>
                  <input type="text" name="uuid" id="uuid" class="form-control card-text" placeholder="請輸入感測器編號(uuid)" required>
                </div>
                <div class="col-4">
                  <p>感測器型號</p>
                  <select class="form-select" required name="model">
                    <option selected value="nRF52840">nRF52840</option>
                    <option value="BWT901CL">BWT901CL</option>
                    <option value="WT901BLECL5.0">WT901BLECL5.0</option>
                  </select>
                </div>
              </div>
              <br>
              <input type="submit" class="btn btn-primary" value="新增" name="submit"></input>
          </div>
          </form>
        </div>
      </div>
    </div>
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

</body>

</html>