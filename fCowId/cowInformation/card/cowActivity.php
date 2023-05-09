<?php
require_once("../../../SQLServer.php");
$GetID = $_GET['GetID']; //選擇的牛隻
$query = "SELECT * FROM cows_information WHERE id='$GetID' ";
$result = mysqli_query($db_link, $query);
?>
<div class="card-body">
    <h5 class="card-title"><i class="fas fa-chart-area"></i>&nbsp;活動量圖<?php
                                                                        echo "&nbsp;&nbsp;&nbsp;&nbsp;編號:$GetID &nbsp;&nbsp;<a href=\"../../fRecord/cowActivity/cowActivity.php?GetID=$GetID\" class=\"btn btn-primary view_data\">查看</a>";
                                                                        ?></h5>
    <div id="svg"></div>
    <?php
    $row = mysqli_fetch_array($result);
    echo "<script>
        d3.json('card/pedometerData.php?id={$GetID}').then(function(data) {

    // SVG 尺寸
    var margin = {
            top: 30,
            right: 30,
            bottom: 50,
            left: 50
        },
        width = 550 - margin.left - margin.right,
        height = 300 - margin.top - margin.bottom;
    // 繪圖區域
    var svg = d3.select('#svg').append('svg')
        .attr('width', width + margin.left + margin.right)
        .attr('height', height + margin.top + margin.bottom)
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

    if (Array.isArray(data) && data.length == 1) {
        // 取得現在的日期時間
        var now = new Date();
        // 設定日期範圍為現在的日期時間往前推6天至現在的日期時間
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
    svg.append('g')
        .attr('class', 'x axis')
        .attr('transform', 'translate(0,' + height + ')')
        .call(xAxis);
    //繪製折線圖y軸
    svg.append('g')
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
    svg.append('path')
        .datum(data[0])
        .attr('class', 'line')
        .attr('d', line);

    // 繪製目前時間紅色直線
    svg.append('line')
        .attr('class', 'line-current')
        .attr('x1', x(new Date())) // 起始 x 座標
        .attr('y1', 0) // 起始 y 座標
        .attr('x2', x(new Date())) // 結束 x 座標
        .attr('y2', height); // 結束 y 座標
    // 目前時間紅色直線文字標示
    svg.append('text')
        .attr('class', 'text-current')
        .attr('x', x(new Date())) // x 座標
        .attr('y', 0) // y 座標
        .text(moment().format('HH:mm')) // 標示文字
        .attr('fill', 'red');

        // 繪製平均活動量黑色虛橫線
        svg.append('line')
            .attr('x1', 0) // 起始 x 座標
            .attr('y1', y(0)) // 起始 y 座標
            .attr('x2', width) // 結束 x 座標
            .attr('y2', y(0)) // 結束 y 座標
            .attr('stroke', 'black') // 線條顏色
            .attr('stroke-width', 1) // 線條粗細
            .attr('stroke-dasharray', '5,5'); // 線條樣式

        // 平均活動量黑色虛橫線文字標示 \"平均活動量\"
        svg.append('text')
            .attr('class', 'text-current')
            .attr('x', width - (width*0.22)) // x 座標
            .attr('y', y(-16)) // y 座標
            .text('平均活動量:') // 標示文字
            .attr('fill', 'black');
        svg.append('text')
            .attr('class', 'text-current')
            .attr('x', width - (width*0.02)) // x 座標
            .attr('y', y(-16)) // y 座標
            .text(avg) // 標示avg
            .attr('fill', 'black');


            //標示圖案說明
            svg.append('circle')
                .attr('class', 'dot-high-text')
                .attr('cx', width - (width*0.4)) // x 座標
                .attr('cy', y(-15)) // y 座標
                .attr('r', 5)
                .attr('fill', 'red');
            svg.append('text')
                .attr('class', 'dot-high-text')
                .attr('x', width - (width*0.4)+10) // x 座標
                .attr('y', y(-16)) // y 座標
                .text('疑似發情') // 標示avg
                .attr('fill', 'black');
            svg.append('circle')
                .attr('class', 'dot-low-text')
                .attr('cx', width - (width*0.6)) // x 座標
                .attr('cy', y(-15)) // y 座標
                .attr('r', 5)
                .attr('fill', 'gold');
            svg.append('text')
                .attr('class', 'dot-low-text')
                .attr('x', width - (width*0.6)+10) // x 座標
                .attr('y', y(-16)) // y 座標
                .text('活動量低') // 標示avg
                .attr('fill', 'black');


    // 繪製高係數的點標記
    svg.selectAll('.dot-high')
        .data(data[0].filter(function(d) {
            return d.value > 5;
        }))
        .enter().append('circle')
        .attr('class', 'dot-high')
        .attr('cx', function(d) {
            return x(new Date(d.date));
        })
        .attr('cy', function(d) {
            return y(d.value);
        })
        .attr('r', 5)
        .attr('fill', 'red');

    // 繪製低係數的點標記
    svg.selectAll('.dot-low')
        .data(data[0].filter(function(d) {
            return d.value < -1.5;
        }))
        .enter().append('circle')
        .attr('class', 'dot-low')
        .attr('cx', function(d) {
            return x(new Date(d.date));
        })
        .attr('cy', function(d) {
            return y(d.value);
        })
        .attr('r', 5)
        .attr('fill', 'gold');
        // 加上滑鼠事件
        svg.selectAll('.dot-low')
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
        svg.selectAll('.dot-high')
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
    ?>
</div>