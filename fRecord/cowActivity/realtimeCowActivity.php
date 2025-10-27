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
    <link rel="stylesheet" href="../../css/indexcss.css">
    <script src="../../Gauge.js"></script>
    <script src="https://d3js.org/d3.v7.min.js"></script>
    <link rel="stylesheet" href="../../css/d3.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.js"></script>
    <style>
  body, #content {
    position: relative;
  }

  .tooltip {
  pointer-events: none;
  position: absolute;
  display: none;
  opacity: 0;
  background: white;
  border: 1px solid #ccc;
  padding: 6px;
  border-radius: 4px;
  font-size: 13px;
  z-index: 10000;
}


  svg { font: 12px sans-serif; }
  .axis path, .axis line {
    fill: none;
    stroke: #000;
    shape-rendering: crispEdges;
  }
  .line {
    fill: none;
    stroke: steelblue;
    stroke-width: 2px;
  }
  </style>
</head>
<?php
require("../../SQLServer.php");
?>

<body>
    <div id="content" style="width:100%; height:100% ;   padding:1.5rem  ;   ">
    <span class="col-6" style="font-weight:bold;font-size:25px;"><i class="fas fa-chart-area"></i>&nbsp;即時乳牛活動感知</span>
        <div class="container">
            <div class="row bg-light shadow p-3 mt-2">
                <div class="col-12">
                    <div class="collapse show" data-parent="#estrusRecord" id="cow_basic">
                        <div class="card-body" id="estrusRecord">
                            <table id="rule" class="table table-hover" width="100%" align="center" style="display: table-cell;vertical-align: middle;">
                                <thead>
                                    <tr>
                                        <th>乳牛編號</th>
                                        <th>活動量觀測</th>
                                        <th>狀態填寫</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    <?php
                                    $i = 1;
                                    if (isset($_GET['GetID'])) {
                                        $id = $_GET['GetID'];
                                        $query = "SELECT * FROM cows_information WHERE id='$id' ";
                                    } else {
                                        $query = "SELECT * FROM `cows_information` WHERE id in (SELECT cid FROM sensor_management)";
                                    }

                                    $result = mysqli_query($db_link, $query);
                                    while ($row = mysqli_fetch_array($result)) {
                                        if($i!=1){
                                            $i+=1; //unfix bug tr生成為1 3 5 7
                                        }
                                        echo "<tr>";
                                        $sn = $row['sn'];
                                        $id = $row['id'];
                                        echo "<td>$id</td>";
                                        echo "<td></td>";
                                        echo "<td><input type=\"button\" class=\"addEstrusDate btn-primary btn\" value=\"發情日期\" GetSn=\"$sn\" GetID=\"$id\"> <br><br> <input type=\"button\" class=\"addMatingDate btn-primary btn\" value=\"配種日期\" GetSn=\"$sn\" GetID=\"$id\"></td>";
                                        echo "</tr>";
                                        echo "<script>
(function drawChart$i() {
  fetch('realtimepedometerData.php?cid={$id}')
    .then(res => res.json())
    .then(function(data) {
      d3.select('tbody tr:nth-child($i) td:nth-child(2)').select('svg').remove();

      data.forEach(d => {
        d.timestamp = new Date(d.timestamp);
        d.step = +d.step;
      });

      const margin = { top: 30, right: 30, bottom: 30, left: 50 },
            width = 800 - margin.left - margin.right,
            height = 250 - margin.top - margin.bottom;

      const svg = d3.select('tbody tr:nth-child($i) td:nth-child(2)')
        .append('svg')
        .attr('width', width + margin.left + margin.right)
        .attr('height', height + margin.top + margin.bottom)
        .append('g')
        .attr('transform', 'translate(' + margin.left + ',' + margin.top + ')');

      const x = d3.scaleTime()
        .domain(d3.extent(data, d => d.timestamp))
        .range([0, width]);

      const y = d3.scaleLinear()
        .domain([0, d3.max(data, d => d.step)])
        .range([height, 0]);

      svg.append('g')
        .attr('transform', 'translate(0,' + height + ')')
        .call(d3.axisBottom(x).ticks(5));

      svg.append('g').call(d3.axisLeft(y));

      const line = d3.line()
        .x(d => x(d.timestamp))
        .y(d => y(d.step));

      svg.append('path')
        .datum(data)
        .attr('fill', 'none')
        .attr('stroke', 'steelblue')
        .attr('stroke-width', 2)
        .attr('d', line);

      // 定義 tooltip（全域保證可用）
      let tooltip = d3.select('#tooltip_$i');
      if (tooltip.empty()) {
        tooltip = d3.select('body')
          .append('div')
          .attr('id', 'tooltip_$i')
          .attr('class', 'tooltip')
          .style('position', 'absolute')
          .style('opacity', 0)
          .style('background', 'white')
          .style('border', '1px solid #ccc')
          .style('padding', '5px')
          .style('border-radius', '4px')
          .style('z-index', 10000);
      }

      svg.selectAll('circle')
        .data(data)
        .enter()
        .append('circle')
        .attr('cx', d => x(d.timestamp))
        .attr('cy', d => y(d.step))
        .attr('r', 3)
        .attr('fill', d => {
  switch (d.label) {
    case 'Restless(躁動)': return 'red';
    case 'Walking(行走)': return 'gold';
    case 'Stand_Up(站立)': return 'green';
    case 'Laying(躺臥)': return 'black';
    default: return 'gray';  // 未知狀態
  }
})
        .on('mouseover', function(event, d) {
          tooltip
            .html('🕒時間: ' + d.timestamp.toLocaleString() + '<br>步數: ' + d.step + '<br>姿態: ' + d.label)
            .style('left', (event.pageX + 10) + 'px')
            .style('top', (event.pageY - 30) + 'px')
            .style('opacity', 1)
            .style('display', 'block');
        })
        .on('mousemove', function(event) {
          tooltip
            .style('left', (event.pageX + 10) + 'px')
            .style('top', (event.pageY - 30) + 'px');
        })
        .on('mouseout', function() {
          tooltip.style('opacity', 0).style('display', 'none');
        });
    });
  setTimeout(drawChart$i, 1000);
})();
</script>";


                                        $i += 1;
                                    }
                                    ?>

                                </tbody>
                            </table>
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
                                url: "./addEstrusDate.php",
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
                                url: "./addMatingDate.php",
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

                <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
                <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
            </div>

        </div>
    </div>
</body>

</html>