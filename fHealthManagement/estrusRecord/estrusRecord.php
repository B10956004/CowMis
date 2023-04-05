<?php
require_once("../../SQLServer.php");
?>
<!doctype html>
<html lang="zh-TW">

<head>
  <!-- 導入外觀 -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  <meta charset="UTF-8">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
  <script src="../../jquery-tablepage-1.0.js"></script>
  <link rel="stylesheet" href="../../css/text_box2.css">

  <title>智慧飼牛系統</title>


</head>

<body>
  <!-- 最外框架與主頁框架嵌合 -->
  <div name="content" style="width:100%; height: 100vh ;   padding:1.5rem  ;   ">
    <div class="tab-content">
      <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item">
          <a href="#estrusRecord" class="nav-link active" data-toggle="tab">發情紀錄</a>
        </li>
        <li class="nav-item">
          <a href="#addEstrusRecord" class="nav-link" data-toggle="tab">新增資料</a>
        </li>
      </ul>
      <div class="tab-pane active bg-white shadow-sm p-4" id="estrusRecord">
        <div class="row">
          <div class="col-md-3 p-2">
            <input type="search" class="search form-control" data-table="table table-hover" placeholder="搜尋關鍵字" style="width:100%;">
          </div>
        </div>
        <br>
        <div class="table-responsive">
          <div id="cow_table" style="text-align:center;">

            <table id="rule" class="table table-hover">
              <thead>
                <tr class="table-active">
                  <th>編號</th>
                  <th>發情日期</th>
                  <th>間隔天數</th>
                  <th>是否配種</th>
                  <th>精液號碼</th>
                  <th>編輯</th>
                  <th>刪除</th>

                </tr>
              </thead>
              <tbody>
                <!-- 控制每頁的欄數 -->
                <?php
                $query = "SELECT * FROM estrus_record WHERE isDel=0 ";
                $result = mysqli_query($db_link, $query);

                $num = mysqli_num_rows($result);
                $per = 5; //每頁顯示項目數量
                $pages = ceil($num / $per);
                if($pages==0){
                  $pages=1;
                }
                if (!isset($_GET["page"])) {
                  $page = 1;
                } else {
                  $page = intval($_GET["page"]);
                }
                $start = ($page - 1) * $per;

                $query .= "ORDER BY id DESC LIMIT $start,$per";

                $result = mysqli_query($db_link, $query);
                $i=1;
                while ($row = mysqli_fetch_assoc($result)) {
                  $sn=$row['sn'];
                  $id = $row['id'];
                  $estrusDate = $row['estrusDate'];
                  $intervalDays = $row['intervalDays'];
                  $isMating = $row['isMating'];
                  $semenNumber = $row['semenNumber'];
                ?>
                  <tr>
                    <td><?php echo $id ?></td>
                    <td><?php echo $estrusDate ?></td>
                    <td><?php echo $intervalDays ?></td>
                    <td><?php echo $isMating ?></td>
                    <td><?php echo $semenNumber ?></td>
                    <td><a href="#" type="text" GetSn="<?php echo $sn; ?>" class="view_data">編輯</a></td>
                    <?php
                    echo "<td><a id=\"linkDel_$i\" href=\"#del\">刪除</a></td>";
                    echo "
                    <script>
                      $(\"#linkDel_$i\").click(function(){
                        var yesDel = confirm(\"你確定要刪除\"+'$id'+\"這筆資料嗎？，刪除後不可復原。\");
                          if (yesDel) {
                            $.post(\"./estrusRecord_Delete.php\",{ Del: 1,postSn:$sn },function(result){
                              location.reload();
                              });
                          }
                        });
                    </script>";
                    ?>
                  </tr>
                <?php
                $i+=1;
                }
                ?>
              </tbody>
            </table>
            <?php
            echo "
                                    <div class='col-11 ml-5 text-center'>
                                        <div class='row justify-content-center'>
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
            echo " 第" . $page . "/" . $pages . "頁-共" . $num . "筆</div>";

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
              <h4 class="modal-title font-weight-bold">修改牛隻基本資料</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body" id="cow_detail">
              <input type="text" name="cow_ID" id="cow_ID" claass="form-control" readonly />
              <br />
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>
      <script>
        $(document).on('click', '.view_data', function() {
          var GetSn = $(this).attr("GetSn");

          $.ajax({
            url: "estrusRecord_Revise.php",
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
      <div class="tab-pane fade bg-white shadow-sm p-4" id="addEstrusRecord" style="border-radius:5px;">
        <form action="estrusRecord_Insert.php" method="post">
          <div class="row">
            <div class="col-md-3 p-2">
              <input type="text" class="form-control " placeholder="請輸入編號" name="id" required>
            </div>
            <div class="col-md-3 p-2">
              <input type="date" class="form-control " placeholder="請輸入發情日期" name="estrusDate"required>
            </div>
            <div class="col-md-3 p-2">
              <input type="text" class="form-control " placeholder="請輸入間隔天數" name="intervalDays"required>
            </div>
            <div class="col-md-3 p-2">
              <input type="text" class="form-control " placeholder="是否配種" name="isMating"required>
            </div>
            <div class="col-md-3 p-2">
              <input type="text" class="form-control " placeholder="精液號碼" name="semenNumber"required>
            </div>
            <input type="submit" class="btn btn-info" value="新增" name="submit"required>

          </div>
          <form>
      </div>
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