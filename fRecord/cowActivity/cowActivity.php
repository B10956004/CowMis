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
</head>
<?php
require("../../SQLServer.php");
?>

<body>
    <div id="content" style="width:100%; height:100% ;   padding:1.5rem  ;   ">
        <span class="col-6" style="font-weight:bold;font-size:25px;"><i class="fas fa-chart-area"></i>&nbsp;乳牛活動感知</span>
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
                                <script>
                                    // 創建tooltip
                                    const tooltip = d3.select('body')
                                        .append('div')
                                        .style('opacity', 0)
                                        .style('position', 'absolute')
                                        .attr('class', 'tooltip')
                                        .style('background-color', 'white')
                                        .style('border', 'solid')
                                        .style('border-width', '2px')
                                        .style('border-radius', '5px')
                                        .style('padding', '5px');
                                </script>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    if (isset($_GET['GetID'])) {
                                        $id = $_GET['GetID'];
                                        $query = "SELECT * FROM cows_information WHERE id='$id' ";
                                    } else {
                                        $query = "SELECT * FROM cows_information LIMIT 3";
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
                                        d3.json('pedometerData.php?id={$id}').then(function(data) {

                                    // SVG 尺寸
                                    var margin = {
                                            top: 30,
                                            right: 30,
                                            bottom: 50,
                                            left: 50
                                        },
                                        width = 900 - margin.left - margin.right,
                                        height = 250 - margin.top - margin.bottom;
                                    // 繪圖區域
                                    var svg{$i} = d3.select('tbody tr:nth-child($i) td:nth-child(2)').append('svg')
                                        .attr('width', width + margin.left + margin.right)
                                        .attr('height', height + margin.top + margin.bottom)
                                        .attr('id','svg$i')
                                        .append('g')
                                        .attr('transform', 'translate(' + margin.left + ',' + margin.top + ')');
                                    var endDate = moment();  // 創建一個新的 Moment 對象
                                    endDate.hour(23);        // 設置小時為 23
                                    endDate.minute(59);      // 設置分鐘為 59
                                    endDate.second(59);      // 設置秒數為 59

                                    var y = d3.scaleLinear()
                                    .range([height, 0])
                                    .domain([-10, 30]);

                                    var yAxis = d3.axisLeft(y);
                                    
                                    if (Array.isArray(data) && data.length==1) {
                                        // 設定日期範圍為現在的日期時間往前推6天至現在的日期時間
                                        now=new Date();
                                        var startDate = new Date(now.getTime() - 6 * 24 * 60 * 60 * 1000);
                                    }else{

                                        var result=[]
                                        for(let i=0;i<data[1].length;i++){
                                            var avgData = data[1][i];
                                            var avg = avgData.avg;
                                            var std_dev = avgData.std_dev;
                                            var day = avgData.day;
                                            for (let j = 0; j < data[0].length; j++) {
                                                const obj = data[0][j];
                                                const date = obj.date;
                                                const value = obj.value;
                                                if (date.substring(0, 10) === day) {
                                                const computedValue = Math.round((value - avg) / std_dev * 100) / 100;
                                                result.push(computedValue);
                                                }
                                            }
                                        }
                                              
                                        // 算總平均數
                                        var avg = Math.round(data[0].reduce((sum, d) => sum + d.value, 0) / data[0].length);
                                        if(Number.isNaN(avg)){avg=0;}

                                        //轉換資料
                                        data[0] = data[0].map((item, index) => {
                                            return {
                                                date:item.date,
                                                value: result[index]
                                            };
                                        }); 

                                        // 將日期字串轉成日期物件
                                        var parseTime = d3.timeParse('%Y-%m-%d %H:%M:%S.%L');
                                        data[0].forEach(function(d) {
                                            d.date = parseTime(d.date)
                                        });
                                        // 取得日期範圍
                                        var extent = d3.extent(data[0], function(d) {
                                            return d.date;
                                        });
                                        var startDate = extent[0];
                                    }

                                    // 將日期範圍傳遞到d3.scaleTime()的domain()方法中
                                    var x = d3.scaleTime()
                                        .range([0, width])
                                        .domain([startDate, endDate]);

                                    var xAxis = d3.axisBottom(x)
                                        .tickFormat(d3.timeFormat('%m-%d'))
                                        .ticks(d3.timeDay.every(1));

                                    //繪製折線圖x軸
                                    svg{$i}.append('g')
                                        .attr('class', 'x axis')
                                        .attr('transform', 'translate(0,' + height + ')')
                                        .call(xAxis);
                                    //繪製折線圖y軸
                                    svg{$i}.append('g')
                                        .attr('class', 'y axis')
                                        .call(yAxis)
                                        .append('text')
                                        .attr('class', 'label')
                                        .attr('transform', 'rotate(-90)')
                                        .attr('y', 6)
                                        .attr('dy', '.71em')
                                        .style('text-anchor', 'end')
                                        .text('步數');

                                    // 繪製活動量折線
                                    var line = d3.line()
                                        .x(function(d) {
                                            return x(new Date(d.date));
                                        })
                                        .y(function(d) {
                                            return y(d.value);
                                        })
                                        .curve(d3.curveLinear);
                                    svg{$i}.append('path')
                                        .datum(data[0])
                                        .attr('class', 'line')
                                        .attr('d', line);

                                    // 繪製目前時間紅色直線
                                    svg{$i}.append('line')
                                        .attr('class', 'line-current')
                                        .attr('x1', x(new Date())) // 起始 x 座標
                                        .attr('y1', 0) // 起始 y 座標
                                        .attr('x2', x(new Date())) // 結束 x 座標
                                        .attr('y2', height); // 結束 y 座標
                                    // 目前時間紅色直線文字標示
                                    svg{$i}.append('text')
                                        .attr('class', 'text-current')
                                        .attr('x', x(new Date())) // x 座標
                                        .attr('y', 0) // y 座標
                                        .text(moment().format('HH:mm')) // 標示文字
                                        .attr('fill', 'red');

                                    // 繪製平均活動量黑色虛橫線
                                    svg{$i}.append('line')
                                        .attr('x1', 0) // 起始 x 座標
                                        .attr('y1', y(0)) // 起始 y 座標
                                        .attr('x2', width) // 結束 x 座標
                                        .attr('y2', y(0)) // 結束 y 座標
                                        .attr('stroke', 'black') // 線條顏色
                                        .attr('stroke-width', 1) // 線條粗細
                                        .attr('stroke-dasharray', '5,5'); // 線條樣式

                                    // 平均活動量黑色虛橫線文字標示 \"平均活動量\"
                                    svg{$i}.append('text')
                                        .attr('class', 'text-current')
                                        .attr('x', width - (width*0.15)) // x 座標
                                        .attr('y', y(-20)) // y 座標
                                        .text('平均活動量:') // 標示文字
                                        .attr('fill', 'black');
                                    svg{$i}.append('text')
                                        .attr('class', 'text-current')
                                        .attr('x', width - (width*0.02)) // x 座標
                                        .attr('y', y(-20)) // y 座標
                                        .text(avg) // 標示avg
                                        .attr('fill', 'black');

                                    //標示圖案說明
                                    svg{$i}.append('circle')
                                        .attr('class', 'dot-high-text')
                                        .attr('cx', width - (width*0.28)) // x 座標
                                        .attr('cy', y(-19)) // y 座標
                                        .attr('r', 5)
                                        .attr('fill', 'red');
                                    svg{$i}.append('text')
                                        .attr('class', 'dot-high-text')
                                        .attr('x', width - (width*0.28)+10) // x 座標
                                        .attr('y', y(-20)) // y 座標
                                        .text('疑似發情') // 標示avg
                                        .attr('fill', 'black');
                                    svg{$i}.append('circle')
                                        .attr('class', 'dot-low-text')
                                        .attr('cx', width - (width*0.4)) // x 座標
                                        .attr('cy', y(-19)) // y 座標
                                        .attr('r', 5)
                                        .attr('fill', 'gold');
                                    svg{$i}.append('text')
                                        .attr('class', 'dot-low-text')
                                        .attr('x', width - (width*0.4)+10) // x 座標
                                        .attr('y', y(-20)) // y 座標
                                        .text('活動量低') // 標示avg
                                        .attr('fill', 'black');


                                    // 繪製高係數的點標記
                                    svg{$i}.selectAll('.dot-high{$i}')
                                        .data(data[0].filter(function(d) {
                                            return d.value > 5;
                                        }))
                                        .enter().append('circle')
                                        .attr('class', 'dot-high{$i}')
                                        .attr('cx', function(d) {
                                            return x(new Date(d.date));
                                        })
                                        .attr('cy', function(d) {
                                            return y(d.value);
                                        })
                                        .attr('r', 5)
                                        .attr('fill', 'red');

                                    // 繪製低係數的點標記
                                    svg{$i}.selectAll('.dot-low{$i}')
                                        .data(data[0].filter(function(d) {
                                            return d.value < -1.5;
                                        }))
                                        .enter().append('circle')
                                        .attr('class', 'dot-low{$i}')
                                        .attr('cx', function(d) {
                                            return x(new Date(d.date));
                                        })
                                        .attr('cy', function(d) {
                                            return y(d.value);
                                        })
                                        .attr('r', 5)
                                        .attr('fill', 'gold');
                                    // 加上滑鼠事件
                                    svg{$i}.selectAll('.dot-low{$i}')
                                        .style('cursor', 'pointer')
                                        .on('mouseover', function(event, d) {
                                            tooltip
                                            .html('日期:'+ moment(d.date).format('YYYY-MM-DD HH:mm:ss')+'<br>低係數:' + d.value )
                                            .style('left', event.pageX + 10 + 'px')
                                            .style('top', event.pageY + 'px')
                                            .style('opacity', 1);
                                        })
                                        .on('mousemove', function(event) {
                                            tooltip
                                            .style('left', event.pageX + 10 + 'px')
                                            .style('top', event.pageY + 'px');
                                        })
                                        .on('mouseleave', function() {
                                            tooltip.style('opacity', 0);
                                        });
                                    svg{$i}.selectAll('.dot-high{$i}')
                                        .style('cursor', 'pointer')
                                        .on('mouseover', function(event, d) {
                                            tooltip
                                            .html('日期:'+ moment(d.date).format('YYYY-MM-DD HH:mm:ss')+'<br>高係數:' + d.value )
                                            .style('left', event.pageX + 10 + 'px')
                                            .style('top', event.pageY + 'px')
                                            .style('opacity', 1);
                                        })
                                        .on('mousemove', function(event) {
                                            tooltip
                                            .style('left', event.pageX + 10 + 'px')
                                            .style('top', event.pageY + 'px');
                                        })
                                        .on('mouseleave', function() {
                                            tooltip.style('opacity', 0);
                                        });
                                    }); 
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
    </div>
</body>

</html>