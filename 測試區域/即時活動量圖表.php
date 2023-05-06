<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>乳牛活動量曲線圖 </title>
    <script src="https://d3js.org/d3.v7.min.js"></script>
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.css" /> -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> -->

    <!-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> -->
    <style>
        .axis text {
            font-family: sans-serif;
            font-size: 12px;
        }

        .axis path,
        .axis line {
            fill: none;
            stroke: #000;
            shape-rendering: crispEdges;
        }

        .line {
            fill: none;
            stroke: steelblue;
            stroke-width: 1.5px;
        }

        .line-current {
            fill: none;
            stroke: red;
            stroke-width: 1.5px;
        }
    </style>
</head>

<body>
    <script>
        // 資料
        var data = [{
                date: '2023-05-01 00:00:00',
                value: 0
            }, {
                date: '2023-05-01 6:00:00',
                value: 500
            }, {
                date: '2023-05-01 8:00:00',
                value: 850
            }, {
                date: '2023-05-01 12:00:00',
                value: 1000
            }, {
                date: '2023-05-02 00:00:00',
                value: 0
            },
            {
                date: '2023-05-02 12:15:17',
                value: 300
            },
            {
                date: '2023-05-03 12:15:17',
                value: 200
            },
            {
                date: '2023-05-04 12:15:17',
                value: 600
            },
            {
                date: '2023-05-05 12:15:17',
                value: 800
            },
            {
                date: '2023-05-06 12:15:17',
                value: 400
            },
            {
                date: '2023-05-07  02:15:17',
                value: 500
            }
        ];

        // SVG 尺寸
        var margin = {
                top: 30,
                right: 30,
                bottom: 50,
                left: 50
            },
            width = 600 - margin.left - margin.right,
            height = 400 - margin.top - margin.bottom;

        // 繪圖區域
        var svg = d3.select('body').append('svg')
            .attr('width', width + margin.left + margin.right)
            .attr('height', height + margin.top + margin.bottom)
            .append('g')
            .attr('transform', 'translate(' + margin.left + ',' + margin.top + ')');

        // 取得現在的日期時間
        var now = new Date();

        // 設定日期範圍為現在的日期時間往前推6天至現在的日期時間
        var startDate = new Date(now.getTime() - 6 * 24 * 60 * 60 * 1000);
        var endDate = now;

        // 將日期範圍傳遞到d3.scaleTime()的domain()方法中
        var x = d3.scaleTime()
            .range([0, width])
            .domain([startDate.setHours(0, 0, 0, 0), endDate.setHours(23, 59, 59, 999)]);

        var xAxis = d3.axisBottom(x)
            .tickFormat(d3.timeFormat('%m-%d'))
            .ticks(d3.timeDay.every(1));

        var y = d3.scaleLinear()
            .range([height, 0])
            .domain([0, d3.max(data, function(d) {
                return d.value;
            })]);

        var yAxis = d3.axisLeft(y);

        //繪製x軸
        svg.append('g')
            .attr('class', 'x axis')
            .attr('transform', 'translate(0,' + height + ')')
            .call(xAxis);
        //繪製y軸
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

        // 繪製活動量曲線
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

        // 現在紅色直線
        svg.append('line')
            .attr('class', 'line-current')
            .attr('x1', x(new Date())) // 起始 x 座標
            .attr('y1', 0) // 起始 y 座標
            .attr('x2', x(new Date())) // 結束 x 座標
            .attr('y2', height); // 結束 y 座標
        // 現在紅色直線文字
        svg.append('text')
            .attr('class', 'text-current')
            .attr('x', x(new Date()) + 5) // x 座標
            .attr('y', 10) // y 座標
            .text('現在') // 標示文字
            .attr('fill', 'red');


        // 繪製橫線
        svg.append('line')
            .attr('x1', 0) // 起始 x 座標
            .attr('y1', y(400)) // 起始 y 座標
            .attr('x2', width) // 結束 x 座標
            .attr('y2', y(400)) // 結束 y 座標
            .attr('stroke', 'black') // 線條顏色
            .attr('stroke-width', 1) // 線條粗細
            .attr('stroke-dasharray', '5,5'); // 線條樣式
        // 現在黑色虛橫線標示 "平均活動量"
        svg.append('text')
            .attr('class', 'text-current')
            .attr('x', width - 50) // x 座標
            .attr('y', y(350)) // y 座標
            .text('平均活動量') // 標示文字
            .attr('fill', 'black');

        // 繪製高於 400 的點標記
        svg.selectAll('.dot-high')
            .data(data.filter(function(d) {
                return d.value > 400;
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
            .attr('fill', 'gold');

        // 繪製低於 400 的點標記
        svg.selectAll('.dot-low')
            .data(data.filter(function(d) {
                return d.value < 400;
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
            .attr('fill', 'green');
    </script>
</body>


</html>