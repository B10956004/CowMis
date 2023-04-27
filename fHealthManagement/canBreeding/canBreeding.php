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
          <a href="#milksRecord" class="nav-link active" data-toggle="tab">待配種牛隻</a>
        </li>
        <!-- <li class="nav-item">
          <a href="#addMilksRecord" class="nav-link" data-toggle="tab">新增泌乳資料</a>
        </li> -->
      </ul>
      <div class="tab-pane active bg-white shadow-sm p-4" id="milksRecord">
        <div class="row">
          <div class="col-md-3 p-2">
            <input type="search" class="search form-control" data-table="table table-hover" placeholder="搜尋關鍵字" style="width:100%;">
          </div>
        </div>
        <br>


        <div class="table-responsive" style="overflow: hidden;">
          <div id="cow_table" style="text-align:center;">
            <table id="rule" class="table table-hover">
              <thead>
                <tr class="table-active">
                  <th>編號</th>
                  <th>目前區域</th>
                  <th>出生日期</th>
                  <th>分娩日期</th>
                  <th>母親牛編號</th>
                  <th>精液編號</th>
                </tr>
              </thead>
              <tbody>
                <!-- 控制每頁的欄數 -->
                <?php
                $query = "SELECT cows_information.id, cows_information.area, MAX(pregnancy_check.parturitiondate) AS latest_parturitiondate, cows_information.dob, cows_information.mid, cows_information.fid
                FROM cows_information
                LEFT JOIN pregnancy_check ON cows_information.id = pregnancy_check.id
                WHERE (cows_information.area = '低乳' OR cows_information.area = '高乳')
                AND pregnancy_check.parturitiondate < DATE_SUB(CURDATE(), INTERVAL 2 MONTH)
                GROUP BY cows_information.id, cows_information.area
                HAVING latest_parturitiondate IS NOT NULL
                
                UNION ALL
                
                SELECT cows_information.id, cows_information.area, NULL AS latest_parturitiondate, cows_information.dob, cows_information.mid, cows_information.fid
                FROM cows_information
                LEFT JOIN pregnancy_check ON cows_information.id = pregnancy_check.id
                WHERE (cows_information.area = '小牛' OR cows_information.area = '未受孕')
                AND cows_information.dob < DATE_SUB(CURDATE(), INTERVAL 14 MONTH)
                AND pregnancy_check.id IS NULL                           
                ";
                $result = mysqli_query($db_link, $query);

                // $num = mysqli_num_rows($result);
                // if ($num != 0) {
                //   $per = 6; //每頁顯示項目數量
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

                //   $query .= " LIMIT $start,$per";

                //   $result = mysqli_query($db_link, $query);
                //   $i = 1;
                while ($row = mysqli_fetch_array($result)) {
                  $id = $row['id']; //編號
                  $dob = $row['dob']; //出生日期
                  $mid = $row['mid']; //母牛編號
                  $fid = $row['fid']; //精液編號
                  $area = $row['area']; //目前區域
                  $latest_parturitiondate = $row['latest_parturitiondate']; //上次分娩日期
                ?>
                  <tr>
                    <td><?php echo "<a href=\"../../fCowId/cowInformation/cowInformation.php?GetID=$id\">$id</a> "; ?></td>
                    <td><?php echo $area ?></td>
                    <td><?php echo $dob ?></td>
                    <td><?php echo $latest_parturitiondate ?></td>
                    <td><?php echo $mid ?></td>
                    <td><?php echo $fid ?></td>
                  </tr>
                <?php
                  // $i += 1;
                }
                // } else {
                //   $page = 1;
                //   $pages = 1;
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
    </div>
  </div>
</body>

</html>