<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>即時動態圖表</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>

<body>
    <div style="width: 800px;height: 600px">
        <h1>加速度圖表</h1>
        <canvas id="chart"></canvas>
        <h1>角速度圖表</h1>
        <canvas id="chart2"></canvas>
        <h1>角度圖表</h1>
        <canvas id="chart3"></canvas>
    </div>
    <script>
        // 創建chart對象(加速)
        var chart = new Chart(document.getElementById('chart').getContext('2d'), {
            type: 'line',
            data: {
                labels: [], // X軸數據(時間)
                datasets: [{
                        label: 'ax', // 標籤名稱
                        borderColor: 'red', // 顏色
                        data: [], // Y軸數據(加速度ax)
                    },
                    {
                        label: 'ay',
                        borderColor: 'green',
                        data: [],
                    },
                    {
                        label: 'az',
                        borderColor: 'blue',
                        data: [],
                    }
                ]
            },
            options: {
                responsive: true,
                title: {
                    display: true,
                    text: '即時加速度圖表'
                },
                scales: {
                    xAxes: [{
                        type: 'time',
                        distribution: 'linear',
                        display: true,
                        scaleLabel: {
                            display: true,
                            labelString: '時間'
                        }
                    }],
                    yAxes: [{
                        display: true,
                        scaleLabel: {
                            display: true,
                            labelString: '加速度'
                        }
                    }]
                },
            }
        });
        // 創建chart對象(角加速)
        var chart2 = new Chart(document.getElementById('chart2').getContext('2d'), {
            type: 'line',
            data: {
                labels: [], // X軸數據(時間)
                datasets: [{
                        label: 'wx', // 標籤名稱
                        borderColor: 'red', // 顏色
                        data: [], // Y軸數據(角速度wx)
                    },
                    {
                        label: 'wy',
                        borderColor: 'green',
                        data: [],
                    },
                    {
                        label: 'wz',
                        borderColor: 'blue',
                        data: [],
                    }
                ]
            },
            options: {
                responsive: true,
                title: {
                    display: true,
                    text: '即時角速度圖表'
                },
                scales: {
                    xAxes: [{
                        type: 'time',
                        distribution: 'linear',
                        display: true,
                        scaleLabel: {
                            display: true,
                            labelString: '時間'
                        }
                    }],
                    yAxes: [{
                        display: true,
                        scaleLabel: {
                            display: true,
                            labelString: '角速度'
                        }
                    }]
                },
            }
        });
        // 創建chart對象(角度)
        var chart3 = new Chart(document.getElementById('chart3').getContext('2d'), {
            type: 'line',
            data: {
                labels: [], // X軸數據(時間)
                datasets: [{
                        label: 'X', // 標籤名稱
                        borderColor: 'red', // 顏色
                        data: [], // Y軸數據(角度X)
                    },
                    {
                        label: 'Y',
                        borderColor: 'green',
                        data: [],
                    },
                    {
                        label: 'Z',
                        borderColor: 'blue',
                        data: [],
                    }
                ]
            },
            options: {
                responsive: true,
                title: {
                    display: true,
                    text: '即時角度圖表'
                },
                scales: {
                    xAxes: [{
                        type: 'time',
                        distribution: 'linear',
                        display: true,
                        scaleLabel: {
                            display: true,
                            labelString: '時間'
                        }
                    }],
                    yAxes: [{
                        display: true,
                        scaleLabel: {
                            display: true,
                            labelString: '角度'
                        }
                    }]
                },
            }
        });

        function refreshFullAPI() {
            //先讀取SQL全資料中最新50筆
            $.ajax({
                url: '即時動態圖表fullAPI.php',
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    var datas = JSON.stringify(response); //將物件轉字串
                    var datas = JSON.parse(datas); //字串轉json
                    $.each(datas, function(index, data) {
                        // 遍歷處理整個json
                        chart.data.labels.push(data.Time);
                        chart.data.datasets[0].data.push(data.ax);
                        chart.data.datasets[1].data.push(data.ay);
                        chart.data.datasets[2].data.push(data.az);

                        chart2.data.labels.push(data.Time);
                        chart2.data.datasets[0].data.push(data.wx);
                        chart2.data.datasets[1].data.push(data.wy);
                        chart2.data.datasets[2].data.push(data.wz);

                        chart3.data.labels.push(data.Time);
                        chart3.data.datasets[0].data.push(data.X);
                        chart3.data.datasets[1].data.push(data.Y);
                        chart3.data.datasets[2].data.push(data.Z);
                    });
                    chart.update(); // 更新加速度圖表
                    chart2.update(); // 更新角速度圖表
                    chart3.update(); // 更新角度圖表
                },
                error: function(xhr, status, error) {
                    console.log('發生錯誤：' + error);
                }
            });
        }

        function refreshSingleAPI() {
            //設定自動更新
            setInterval(function() {
                var maxDataLength = 50; // 圖表最大長度
                if (chart.data.labels.length > maxDataLength) {
                    chart.data.labels.splice(0, chart.data.labels.length - maxDataLength); //從頭刪除 只留最新50筆
                    chart.data.datasets[0].data.splice(0, chart.data.datasets[0].data.length - maxDataLength); //從頭刪除 只留最新50筆
                    chart.data.datasets[1].data.splice(0, chart.data.datasets[1].data.length - maxDataLength); //從頭刪除 只留最新50筆
                    chart.data.datasets[2].data.splice(0, chart.data.datasets[2].data.length - maxDataLength); //從頭刪除 只留最新50筆
                }
                chart.update();

                if (chart2.data.labels.length > maxDataLength) {
                    chart2.data.labels.splice(0, chart2.data.labels.length - maxDataLength); //從頭刪除 只留最新50筆
                    chart2.data.datasets[0].data.splice(0, chart2.data.datasets[0].data.length - maxDataLength); //從頭刪除 只留最新50筆
                    chart2.data.datasets[1].data.splice(0, chart2.data.datasets[1].data.length - maxDataLength); //從頭刪除 只留最新50筆
                    chart2.data.datasets[2].data.splice(0, chart2.data.datasets[2].data.length - maxDataLength); //從頭刪除 只留最新50筆
                }
                chart2.update();

                if (chart3.data.labels.length > maxDataLength) {
                    chart3.data.labels.splice(0, chart3.data.labels.length - maxDataLength); //從頭刪除 只留最新50筆
                    chart3.data.datasets[0].data.splice(0, chart3.data.datasets[0].data.length - maxDataLength); //從頭刪除 只留最新50筆
                    chart3.data.datasets[1].data.splice(0, chart3.data.datasets[1].data.length - maxDataLength); //從頭刪除 只留最新50筆
                    chart3.data.datasets[2].data.splice(0, chart3.data.datasets[2].data.length - maxDataLength); //從頭刪除 只留最新50筆
                }
                chart3.update();

                $.ajax({
                    url: '即時動態圖表singleAPI.php',
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        var data = JSON.stringify(response); //將物件轉字串
                        var data = JSON.parse(data); //字串轉json
                        var timeLabel = data.Time;
                        if (!chart.data.labels.includes(timeLabel)) { //判斷資料庫有無最新一筆
                            chart.data.labels.push(data.Time); //
                            chart.data.datasets[0].data.push(data.ax);
                            chart.data.datasets[1].data.push(data.ay);
                            chart.data.datasets[2].data.push(data.az);
                            chart.update({
                                lazy: false
                            }); // 一筆就更新一次圖表 即時更新
                        } else {
                            // console.log(`標籤時間 "${timeLabel}" 已經存在`);
                        }

                        if (!chart2.data.labels.includes(timeLabel)) { //判斷資料庫有無最新一筆
                            chart2.data.labels.push(data.Time); //
                            chart2.data.datasets[0].data.push(data.wx);
                            chart2.data.datasets[1].data.push(data.wy);
                            chart2.data.datasets[2].data.push(data.wz);
                            chart2.update({
                                lazy: false
                            }); // 一筆就更新一次圖表 即時更新
                        } else {
                            // console.log(`標籤時間 "${timeLabel}" 已經存在`);
                        }

                        if (!chart3.data.labels.includes(timeLabel)) { //判斷資料庫有無最新一筆
                            chart3.data.labels.push(data.Time); //
                            chart3.data.datasets[0].data.push(data.X);
                            chart3.data.datasets[1].data.push(data.Y);
                            chart3.data.datasets[2].data.push(data.Z);
                            chart3.update({
                                lazy: false
                            }); // 一筆就更新一次圖表 即時更新
                        } else {
                            // console.log(`標籤時間 "${timeLabel}" 已經存在`);
                        }

                    },
                    error: function(xhr, status, error) {
                        console.log('發生錯誤：' + error);
                    }
                });
            }, 500); // 每0.5秒呼叫一次取得資料
        }
        refreshFullAPI();
        refreshSingleAPI();
    </script>



</body>

</html>