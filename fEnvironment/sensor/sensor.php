<!DOCTYPE html>
<html lang="en">

<head>
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <meta charset="utf-8">
    <!--<meta http-equiv="refresh" content="60;url='http://140.127.22.165//豬隻V2.1/index.php'"/>-->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.js"></script>
    <link rel="stylesheet" href="../../css/indexcss.css">
    <script src="../../Gauge.js"></script>
    <script>
        //天氣預報
        $.getJSON('https://opendata.cwb.gov.tw/fileapi/v1/opendataapi/F-D0047-035?Authorization=CWB-178FCBE0-1BDD-44D1-918D-30FADBBCD5BF&downloadType=WEB&format=JSON')
            .done(function(re) {
                console.log(re);
                let kl = re.cwaopendata.dataset.locations.location[0]; //萬丹鄉
                let tp = re.cwaopendata.dataset.locations.location[1]; //霧台鄉
                let nt = re.cwaopendata.dataset.locations.location[2]; //新園鄉
                let tu = re.cwaopendata.dataset.locations.location[4]; //萬丹
                let date_line = new Array();
                let k = new Array(),
                    t = new Array(),
                    n = new Array(),
                    u = new Array();

                for (let i = 0; i < kl.weatherElement[1].time.length; i++) {
                    /*write 時間軸*/
                    date_line[i] = kl.weatherElement[1].time[i].startTime.substr(0, kl.weatherElement[1].time[i].startTime.length - 12);

                    /*write 溫度資料*/
                    k.push(kl.weatherElement[1].time[i].elementValue.value);
                    t.push(tp.weatherElement[1].time[i].elementValue.value);
                    n.push(nt.weatherElement[1].time[i].elementValue.value);
                    u.push(tu.weatherElement[1].time[i].elementValue.value);
                }
                var ctx = document.getElementById('weatherWeek');
                var myChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: date_line,
                        datasets: [{
                            //keelung
                            label: kl.locationName,
                            data: k,
                            backgroundColor: 'rgba(255, 99, 132, 0.1)',
                            borderColor: 'rgba(255, 99, 132, 1)',
                            borderWidth: 1
                        }, {
                            //taipei
                            label: tp.locationName,
                            data: t,
                            backgroundColor: 'rgba(54, 162, 235, 0.1)',
                            borderColor: 'rgba(54, 162, 235, 1)',
                            borderWidth: 1
                        }, {
                            //newtaipei
                            label: nt.locationName,
                            data: n,
                            backgroundColor: 'rgba(255, 206, 86, 0.1)',
                            borderColor: 'rgba(255, 206, 86, 1)',
                            borderWidth: 1
                        }, {
                            //taouang
                            label: tu.locationName,
                            data: u,
                            backgroundColor: 'rgba(75, 192, 192, 0.1)',
                            borderColor: 'rgba(75, 192, 192, 1)',
                        }]
                    }
                });
            })
            .fail(function(w) { //失敗訊息
                alert("get this api fail so said!");
            });
    </script>
    <style>
        #cameraContainer {
            width: 640px;
            /* 寬度 */
            height: 480px;
            /* 高度 */
            position: relative;
            overflow: hidden;
        }

        #cameraFrame {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }
    </style>
</head>

<body>
    <div id="content" style="width:100%; height:100% ;   padding:1.5rem  ;   ">
        <span class="col-6" id='topic' style="font-weight:bold;font-size:25px;"><i class="fas fa-home"></i>&nbsp;牧場觀測服務</span>
        <script>
            var topic = document.getElementById("topic");

            function updateTime() {
                var xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function() {
                    if (xhr.readyState == XMLHttpRequest.DONE) {
                        if (xhr.status == 200) {
                            // 更新數據
                            var time = xhr.responseText;
                            if (time == ' ') {
                                time = moment().add(-10, 'second');
                            } else {
                                var time = moment(time).format('YYYY-MM-DD HH:mm:ss');
                            }
                            var timeNow = moment();
                            if (timeNow.diff(time, 'second') >= 10) { //接受10秒誤差
                                topic.innerHTML = "<i class=\"fas fa-home\"></i>&nbsp;牧場觀測服務 目前時間:錯誤，請檢查環境感測器!";
                            } else {
                                topic.innerHTML = "<i class=\"fas fa-home\"></i>&nbsp;牧場觀測服務 目前時間:" + timeNow.format("YYYY-MM-DD HH:mm:ss");
                            }
                        } else {
                            console.log("Error: " + xhr.status);
                        }
                    }
                };
                xhr.open("GET", "../dht/getTimeData.php", true);
                xhr.send();
            }

            // 每0.1秒更新一次數據
            setInterval(updateTime, 100);
        </script>
        <div class="container">
            <div class="row bg-light shadow p-3 mt-2">
                <div class="col-12 col-sm-4">
                    <h5 style="text-align: center;">溫度°C
                        <canvas id="temperatureChart" width="auto" height="180"></canvas>
                    </h5>
                    <script>
                        var ctxTemp = document.getElementById("temperatureChart");
                        var temperatureChart = new Chart(ctxTemp, {
                            type: "tsgauge",
                            data: {
                                datasets: [{
                                    backgroundColor: ["#2894FF", "#0fdc63", "#FFD306", "#EA0000"],
                                    borderWidth: 0,
                                    gaugeData: {
                                        value: 'loading',
                                        valueColor: "#2894FF"
                                    },
                                    gaugeLimits: [0, 15, 30, 40, 50]
                                }]
                            },
                            options: {
                                events: [],
                                showMarkers: true
                            }
                        });

                        function updateTemperature() {
                            var xhr = new XMLHttpRequest();
                            xhr.onreadystatechange = function() {
                                if (xhr.readyState == XMLHttpRequest.DONE) {
                                    if (xhr.status == 200) {
                                        // 更新數據
                                        var temperature = parseFloat(xhr.responseText);
                                        if (temperatureChart.data.datasets[0].gaugeData.value != temperature) {
                                            if (temperature >= 40) {
                                                var valueColor = "#EA0000";
                                            } else if (temperature >= 30) {
                                                var valueColor = "#FFD306";
                                            } else if (temperature >= 15) {
                                                var valueColor = "#0fdc63";
                                            } else {
                                                var valueColor = "#2894FF";
                                            }
                                            temperatureChart.data.datasets[0].gaugeData.value = temperature;
                                            temperatureChart.data.datasets[0].gaugeData.valueColor = valueColor;
                                            temperatureChart.update();
                                        }
                                    } else {
                                        console.log("Error: " + xhr.status);
                                    }
                                }
                            };
                            xhr.open("GET", "../dht/getTemperatureData.php", true);
                            xhr.send();
                        }

                        // 每1秒更新一次數據
                        setInterval(updateTemperature, 1000);
                    </script>
                </div>
                <div class="col-12 col-sm-4">
                    <h5 style="text-align: center;">相對濕度%
                        <canvas id="humidityChart" width="auto" height="180"></canvas>
                    </h5>
                    <script>
                        var ctxHumi = document.getElementById("humidityChart");
                        var humidityChart = new Chart(ctxHumi, {
                            type: "tsgauge",
                            data: {
                                datasets: [{
                                    backgroundColor: ["#00E3E3", "#0080FF", "#0066CC", "#000093"],
                                    borderWidth: 0,
                                    gaugeData: {
                                        value: 'loading',
                                        valueColor: "#00E3E3"
                                    },
                                    gaugeLimits: [20, 40, 60, 80, 100]
                                }]
                            },
                            options: {
                                events: [],
                                showMarkers: true,
                            }
                        });

                        function updateHumidity() {
                            var xhr = new XMLHttpRequest();
                            xhr.onreadystatechange = function() {
                                if (xhr.readyState == XMLHttpRequest.DONE) {
                                    if (xhr.status == 200) {
                                        // 更新數據
                                        var humidity = parseFloat(xhr.responseText);
                                        if (humidityChart.data.datasets[0].gaugeData.value != humidity) {
                                            if (humidity >= 80) {
                                                var valueColor = "#000093";
                                            } else if (humidity >= 60) {
                                                var valueColor = "#0066CC";
                                            } else if (humidity >= 40) {
                                                var valueColor = "#0080FF";
                                            } else {
                                                var valueColor = "#00E3E3";
                                            }
                                            humidityChart.data.datasets[0].gaugeData.value = humidity;
                                            humidityChart.data.datasets[0].gaugeData.valueColor = valueColor;
                                            humidityChart.update();
                                        }
                                    } else {
                                        console.log("Error: " + xhr.status);
                                    }
                                }
                            };
                            xhr.open("GET", "../dht/getHumidityData.php", true);
                            xhr.send();
                        }

                        // 每1秒更新一次數據
                        setInterval(updateHumidity, 1000);
                    </script>
                </div>
                <div class="col-12 col-sm-4">
                    <h5 style="text-align: center;">熱緊迫指數THI
                        <canvas id="THIChart" width="auto" height="180"></canvas>
                    </h5>
                    <script>
                        var ctxTHI = document.getElementById("THIChart");
                        var THIChart = new Chart(ctxTHI, {
                            type: "tsgauge",
                            data: {
                                datasets: [{
                                    backgroundColor: ["#9D9D9D", "#FFD306", "#FF8000", "#EA0000", "#750075"],
                                    borderWidth: 0,
                                    gaugeData: {
                                        value: 'loading',
                                        valueColor: "#9D9D9D"
                                    },
                                    gaugeLimits: [50, 68, 72, 78, 89, 99]
                                }]
                            },
                            options: {
                                events: [],
                                showMarkers: true,
                            }
                        });

                        function updateTHI() {
                            var xhr = new XMLHttpRequest();
                            xhr.onreadystatechange = function() {
                                if (xhr.readyState == XMLHttpRequest.DONE) {
                                    if (xhr.status == 200) {
                                        // 更新數據
                                        var THI = parseFloat(xhr.responseText);
                                        if (THIChart.data.datasets[0].gaugeData.value != THI) {
                                            if (THI >= 89) {
                                                var valueColor = "#750075";
                                            } else if (THI >= 78) {
                                                var valueColor = "#EA0000";
                                            } else if (THI >= 72) {
                                                var valueColor = "#FF8000";
                                            } else if (THI >= 68) {
                                                var valueColor = "#FFD306";
                                            } else {
                                                var valueColor = "#9D9D9D";
                                            }
                                            THIChart.data.datasets[0].gaugeData.value = THI;
                                            THIChart.data.datasets[0].gaugeData.valueColor = valueColor;
                                            THIChart.update();
                                        }
                                    } else {
                                        console.log("Error: " + xhr.status);
                                    }
                                }
                            };
                            xhr.open("GET", "../dht/getTHIData.php", true);
                            xhr.send();
                        }

                        // 每1秒更新一次數據
                        setInterval(updateTHI, 1000);
                    </script>
                </div>
                
                <center>
                    <div class="col-2">
                        <br>
                        <h5 style="text-align: center;">牧場即時觀測</h5>
                        <label for="cameraSelect">切換鏡頭:</label>
                        <select class="form-select" id="cameraSelect">
                            <option selected value="camera1">鏡頭1</option>
                            <option value="camera2">鏡頭2</option>
                        </select>
                    </div>
                    <div id="cameraContainer">
                        <div id="cameraFrame"></div>
                    </div>
                </center>
                <script src="CamScript.js"></script>

                <div class="col-12">
                    <h5 style="text-align: center;">一週天氣預報</h5>
                    <canvas id="weatherWeek" width="500" height="150"></canvas>
                </div>
            </div>
        </div>
    </div>
    </div>
</body>

</html>