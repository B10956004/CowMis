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

  <title>乳牛飼養系統</title>

</head>

<body>
  <!-- 最外框架與主頁框架嵌合 -->


  <div name="content" style="width:100%; height: 100vh ;   padding:1.5rem  ;   ">
    <div class="tab-content">
      <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item">
          <a href="#milksRecord" class="nav-link active" data-toggle="tab">泌乳性能</a>
        </li>
        <li class="nav-item">
          <a href="#addMilksRecord" class="nav-link" data-toggle="tab">新增泌乳資料</a>
        </li>
      </ul>
      <div class="tab-pane active bg-white shadow-sm p-4" id="milksRecord">
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
                  <th>擠乳日期</th>
                  <th>乳質品質</th>
                  <th>乳量(公斤)</th>
                  <th>無脂固形物</th>
                  <th>乳脂率</th>
                  <th>乳蛋白</th>
                  <th>體細胞數</th>
                  <th>編輯</th>
                  <th>刪除</th>
                </tr>
              </thead>
              <tbody>
                <!-- 控制每頁的欄數 -->
                <?php
                $query = "SELECT * FROM milk_record ";
                $result = mysqli_query($db_link, $query);

                $num = mysqli_num_rows($result);
                if ($num != 0) {
                  $per = 7; //每頁顯示項目數量
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

                  $query .= "ORDER BY date DESC LIMIT $start,$per";

                  $result = mysqli_query($db_link, $query);
                  $i = 1;
                  while ($row = mysqli_fetch_array($result)) {
                    $sn=$row['sn'];
                    $date = $row['date']; //日期
                    $quality = $row['quality']; //乳質
                    $volume = $row['volume']; //乳量
                    $milkSolidsNotFat = $row['milkSolidsNotFat']; //無脂固形物
                    $milkFatPrecentage = $row['milkFatPrecentage']; //乳脂率
                    $milkProtein = $row['milkProtein']; //乳蛋白
                    $somaticCellCount = $row['somaticCellCount']; //體細胞數
                ?>
                    <tr>
                      <td><?php echo $date ?></td>
                      <td><?php echo $quality ?>級</td>
                      <td><?php echo $volume ?>公斤</td>
                      <td><?php echo $milkSolidsNotFat ?>%</td>
                      <td><?php echo $milkFatPrecentage ?>%</td>
                      <td><?php echo $milkProtein ?>%</td>
                      <td><?php echo $somaticCellCount ?>萬</td>
                      <td><button class="view_data btn btn-primary" GetSn="<?php echo $sn; ?>">編輯</button></td>
                      <?php
                      echo "<td><button id=\"linkDel_$i\" onclick=\"#del\" class='btn btn-danger'>刪除</button></td>";
                      echo "
                    <script>
                      $(\"#linkDel_$i\").click(function(){
                        var yesDel = confirm(\"你確定要刪除\"+'$date'+\"這筆資料嗎？，刪除後不可復原。\");
                          if (yesDel) {
                            $.post(\"./milkRecord_Delete.php\",{ Del: 1,postSn:$sn },function(result){
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
                }else{
                  $page=1;
                  $pages=1;
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
              if ($page - 5 < $i && $i < $page + 4) {
                if ($page == $i) {
                  echo "<li class='page-item active'><a class='page-link' href=?page=" . $i . " >" . $i . "</a></li> ";
                } else {
                  echo "<li class='page-item'><a class='page-link' href=?page=" . $i . " >" . $i . "</a></li> ";
                }
              }
            }
            echo "<li class='page-item'><a class='page-link' aria-label='Next' href=?page=" . $pages . " ><span aria-hidden='true'>&raquo;</span></a></li></ul>
                                    </nav></div>";
            echo "<div class=\"col-12\">第" . $page . "/" . $pages . "頁-共" . $num . "筆</div></center>";

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
              <h4 class="modal-title font-weight-bold">修改泌乳資料</h4>
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
          var GetSn = $(this).attr("GetSn");

          $.ajax({
            url: "milkRecord_Revise.php",
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
      <div class="tab-pane fade bg-white shadow-sm p-4" id="addMilksRecord" style="border-radius:5px;">
        <div class="card">
          <div class="card-body">
            <form action="milkRecord_Insert.php" method="post">
              <div class="row">
                <div class="col-12">
                  <p>擠乳日期</p>
                  <input type="date" class="form-control card-text" placeholder="請輸入擠乳日期" name="date" required>
                  <br>
                </div>

                <div class="col-6">
                  <p>乳質品質</p>
                  <select class="form-select" required id="quality" name="quality" disabled>
                    <option value="">計算中...</option>
                    <option value="A">A級</option>
                    <option value="B">B級</option>
                    <option value="C">C級</option>
                    <option value="D">D級</option>
                    <option value="ERROR">ERROR</option>
                  </select>
                  <input type="hidden" id="quality_hidden" name="quality_hidden">
                </div>
                <div class="col-6">
                  <p>乳量(公斤)</p>
                  <input type="range" name="volume" id="volume_range" value="0" min="0" max="10000" class="form-range" oninput="updateMilkVolumn(this.value);">
                  <input type="number" step="0.01" name="volume" id="volume_text" class="form-control card-text" placeholder="請輸入乳量" onchange="updateMilkVolumn(this.value);">
                  <br>
                </div>
                <div class="col-3">
                  <p>無脂固形物(%)</p>
                  <input type="number" step="0.01" class="form-control card-text" placeholder="請輸入無脂固形物" name="milkSolidsNotFat" required>
                </div>
                <div class="col-2">
                  <p>乳脂率(%)</p>
                  <input type="number" step="0.01" class="form-control card-text" placeholder="請輸入乳脂率" name="milkFatPrecentage" required>
                </div>
                <div class="col-2">
                  <p>乳蛋白質(%)</p>
                  <input type="number" step="0.01" class="form-control card-text" placeholder="請輸入乳蛋白質" name="milkProtein" required>
                </div>
                <div class="col-3">
                  <p>體細胞數(萬/mL)</p>
                  <input type="number" step="0.01" class="form-control card-text" placeholder="請輸入體細胞數" id="somaticCellCount" name="somaticCellCount" onchange="qualityLevel(this.value,document.getElementById('totalBacteria').value);" required>
                </div>
                <div class="col-2">
                  <p>生菌數(萬/mL)</p>
                  <input type="number" step="0.01" class="form-control card-text" placeholder="請輸入生菌數" id="totalBacteria" name="totalBacteria" onchange="qualityLevel(document.getElementById('somaticCellCount').value,this.value);" required>
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
  <script>
    function updateMilkVolumn(val) {
      if (val == '') {
        val = 0;
      }
      document.getElementById('volume_text').value = val;
      document.getElementById('volume_range').value = val;
    }
    function qualityLevel(somaticCellCount,totalBacteria){
      if(somaticCellCount==''){
        document.getElementById('somaticCellCount').value=0;
      }
      if(totalBacteria==''){
        document.getElementById('totalBacteria').value=0;
      }
      // 前三個細項讓業主判斷是否調整配方
      // 體細胞數判斷品質高低(低於30萬：A。 30萬~50萬:B。 50萬~80萬:C。 80萬~100萬:D。 生菌數均每毫升低於10萬以下)
      // 品質會有價差
      if(somaticCellCount<30&&totalBacteria<10){
        document.getElementById('quality').value="A";
        document.getElementById('quality_hidden').value="A";
      }
      else if(somaticCellCount<50&&totalBacteria<10){
        document.getElementById('quality').value="B";
        document.getElementById('quality_hidden').value="B";
      }
      else if(somaticCellCount<80&&totalBacteria<10){
        document.getElementById('quality').value="C";
        document.getElementById('quality_hidden').value="C";
      }
      else if(somaticCellCount<100&&totalBacteria<10){
        document.getElementById('quality').value="D";
        document.getElementById('quality_hidden').value="D";
      }
      else{
        document.getElementById('quality').value="ERROR";
        document.getElementById('quality_hidden').value="ERROR";
      }
      console.log(document.getElementById('quality_hidden').value);
    }
  </script>


</body>

</html>