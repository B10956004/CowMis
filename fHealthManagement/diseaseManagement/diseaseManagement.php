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
          <a href="#diseaseManagement" class="nav-link active" data-toggle="tab">疾病管理</a>
        </li>
        <li class="nav-item">
          <a href="#addDiseaseManagement" class="nav-link" data-toggle="tab">新增疾病資料</a>
        </li>
      </ul>
      <div class="tab-pane active bg-white shadow-sm p-4" id="diseaseManagement">
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
                  <th>日期</th>
                  <th>疾病種類</th>
                  <th>藥品紀錄</th>
                  <th>備註</th>
                  <th>編輯</th>
                  <th>刪除</th>

                </tr>
              </thead>
              <tbody>
                <!-- 控制每頁的欄數 -->
                <?php
                $query = "SELECT * FROM disease_management ";
                $result = mysqli_query($db_link, $query);
                $num = mysqli_num_rows($result);
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
                while ($row = mysqli_fetch_assoc($result)) {
                  $sn = $row['sn']; //序列號
                  $id = $row['id']; //編號
                  $date = $row['date']; //日期
                  $disease = $row['disease']; //疾病種類
                  $drugs = $row['drugs']; //藥品紀錄
                  $remark = $row['remark']; //備註
                ?>
                  <tr>
                    <td width="90px"><?php echo $id ?></td>
                    <td width="104px"><?php echo $date ?></td>
                    <td width="130px"><?php echo $disease ?></td>
                    <td width="150px"><?php echo $drugs ?></td>
                    <td width="300px"><?php echo $remark ?></td>
                    <td><button class="view_data btn btn-primary" GetSn="<?php echo $sn; ?>">編輯</button></td>
                    <?php
                    echo "<td><button id=\"linkDel_$i\" onclick=\"#del\" class='btn btn-danger'>刪除</button></td>";
                    echo "
                    <script>
                      $(\"#linkDel_$i\").click(function(){
                        var yesDel = confirm(\"你確定要刪除\"+'$id'+'-'+'$date'+\"這筆資料嗎？，刪除後不可復原。\");
                          if (yesDel) {
                            $.post(\"./diseaseManagement_Delete.php\",{ Del: 1,postSn:$sn },function(result){
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
              <h4 class="modal-title font-weight-bold">修改疾病資料</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body" id="cow_detail">
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
            url: "diseaseManagement_Revise.php",
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
      <!-- 切換頁 新增 -->
      <div class="tab-pane fade bg-white shadow-sm p-4" id="addDiseaseManagement" style="border-radius:5px;">
        <div class="card">
          <div class="card-body">
            <form action="diseaseManagement_Insert.php" method="post">
              <div class="row">
                <div class="col-3">
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
                <div class="col-3">
                  <p>乳牛編號</p>
                  <select class="form-select" name="id" id="id" required>
                    <option value="">請選擇</option>
                  </select>
                </div>
                <div class="col-6">
                  <p>檢查日期</p>
                  <input type="date" class="form-control card-text" placeholder="請輸入日期" name="date" required>
                </div>
                <div class="col-4">
                  <p>疾病種類</p>
                  <select class="form-select" name="selectDisease" id="selectDisease" onchange="eventsChange(this)" required>
                    <option value="">請選擇</option>
                    <option value="乳房炎">乳房炎</option>
                    <option value="蹄病">蹄病</option>
                    <option value="子宮內膜炎">子宮內膜炎</option>
                    <option value="放射菌感染病">放射菌感染病</option>
                    <option value="下痢">下痢</option>
                    <option value="肺炎">肺炎</option>
                    <option value="感冒">感冒</option>
                    <option value="食滯">食滯</option>
                    <option value="其他疾病">其他</option>
                  </select>
                </div>
                <div class="col-4">
                  <p>藥品紀錄</p>
                  <select class="form-select" name="selectDrug" id="selectDrug" onchange="eventsChange(this)" required>
                    <option value="">請選擇</option>
                    <option value="新萬靈素軟膏">新萬靈素軟膏</option>
                    <option value="喜福安乾乳軟膏">喜福安乾乳軟膏</option>
                    <option value="泌乳樂(CEROXIM OINTMENT)">泌乳樂(CEROXIM OINTMENT)</option>
                    <option value="Povidone Iodine 2%">Povidone Iodine 2%</option>
                    <option value="長效72">長效72</option>
                    <option value="Oxytetracycline 20%">Oxytetrocycline 20%</option>
                    <option value="克倍寧LC(Cobactan LC)">克倍寧LC(Cobactan LC)</option>
                    <option value="拜有利 10% 注射液">拜有利 10% 注射液</option>
                    <option value="碩騰保久靈(TERRAMICINA/LA SOLUCAO INJETAVEL)">碩騰保久靈(TERRAMICINA/LA SOLUCAO INJETAVEL)</option>
                    <option value="其他藥品">其他</option>
                  </select>
                </div>
                <div class="col-4">
                  <p>備註</p>
                  <input type="text" class="form-control card-text" placeholder="請輸入備註" name="remark" id="remark">
                </div>
                <div class="col-4" hidden id="otherDisease">
                  <p>其他疾病</p>
                  <input type="text" class="form-control card-text" placeholder="請輸入其他疾病" name="otherDisease" id="textDisease">
                </div>
                <div class="col-4" hidden id="otherDrug">
                  <p>其他藥品</p>
                  <input type="text" class="form-control card-text" placeholder="請輸入其他藥品" name="otherDrug" id="textDrug">
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
</body>

<script>
  function eventsChange(ele) {
    if (ele.value == '其他疾病') {
      var other = document.getElementById('otherDisease');
      var textOther = document.getElementById('textDisease');
      other.hidden = false;
      textOther.setAttribute("required", "");
    } else if (ele.value == '其他藥品') {
      var other = document.getElementById('otherDrug');
      var textOther = document.getElementById('textDrug');
      other.hidden = false;
      textOther.setAttribute("required", "");
    } else {
      if (ele.id == 'selectDisease') {
        var other = document.getElementById('otherDisease');
        var textOther = document.getElementById('textDisease');
        other.hidden = true;
        textOther.removeAttribute("required");
      } else if (ele.id == 'selectDrug') {
        var other = document.getElementById('otherDrug');
        var textOther = document.getElementById('textDrug');
        other.hidden = true;
        textOther.removeAttribute("required");
      }
    }
  }
</script>

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
          $('#id').empty();
          $.each(data, function(key, value) {
            $('#id').append('<option value="' + value.id + '">' + value.id + '</option>');
          });
        }
      });
    } else {
      $('#id').empty();
    }
  };
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

</html>