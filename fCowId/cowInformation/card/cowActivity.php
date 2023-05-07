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
    if (Array.isArray(data) && data.length == 0) {
        // 取得現在的日期時間
        var now = new Date();
        // 設定日期範圍為現在的日期時間往前推6天至現在的日期時間
        var startDate = new Date(now.getTime() - 6 * 24 * 60 * 60 * 1000);
        var endDate = now;
        
        var y = d3.scaleLinear()
        .range([height, 0])
        .domain([0, 0]);

        var yAxis = d3.axisLeft(y);
    }else{
        // 將日期字串轉成日期物件
        var parseTime = d3.timeParse('%Y-%m-%d %H:%M:%S.%L');
        data.forEach(function(d) {
            d.date = parseTime(d.date)
        });
        // 取得日期範圍
        var extent = d3.extent(data, function(d) {
            return d.date;
        });
        var startDate = extent[0];
        var endDate = extent[1];

        var y = d3.scaleLinear()
        .range([height, 0])
        .domain([0, d3.max(data, function(d) {
            return d.value;
        })]);

        var yAxis = d3.axisLeft(y);
    }

    //計算平均
    var sum=0;
    var count=0;
    data.forEach(function(d){
        sum=sum+d.value;
        count+=1;
    });
    var avg=Math.round(sum/count);

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
        .datum(data)
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
        .attr('y', height-10) // y 座標
        .text('現在') // 標示文字
        .attr('fill', 'red');

        // 繪製平均活動量黑色虛橫線
        svg.append('line')
            .attr('x1', 0) // 起始 x 座標
            .attr('y1', y(avg)) // 起始 y 座標
            .attr('x2', width) // 結束 x 座標
            .attr('y2', y(avg)) // 結束 y 座標
            .attr('stroke', 'black') // 線條顏色
            .attr('stroke-width', 1) // 線條粗細
            .attr('stroke-dasharray', '5,5'); // 線條樣式

        // 平均活動量黑色虛橫線文字標示 \"平均活動量\"
        svg.append('text')
            .attr('class', 'text-current')
            .attr('x', width - 50) // x 座標
            .attr('y', y(avg-50)) // y 座標
            .text('平均活動量') // 標示文字
            .attr('fill', 'black');
        svg.append('text')
            .attr('class', 'text-current')
            .attr('x', width - 50) // x 座標
            .attr('y', y(avg-150)) // y 座標
            .text(avg) // 標示avg
            .attr('fill', 'black');

    // 繪製高於 平均 的點標記
    svg.selectAll('.dot-high')
        .data(data.filter(function(d) {
            return d.value > avg;
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

    // 繪製低於 平均 的點標記
    svg.selectAll('.dot-low')
        .data(data.filter(function(d) {
            return d.value < avg;
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
    svg.selectAll('circle')
    .style('cursor', 'pointer')
    .on('mouseover', function(event, d) {
        tooltip
        .html('日期:'+ moment(d.date).format('YYYY-MM-DD HH:mm:ss')+'<br>活動量:' + d.value )
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