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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js"></script>
    <link rel="stylesheet" href="../css/indexcss.css">
    <script src="../../Gauge.js"></script>
</head>

<body>
    <div id="content" style="width:100%; height:100% ;   padding:1.5rem  ;   ">
        <span class="  col-6" style="font-weight:bold;font-size:25px;"><i class="fas fa-home"></i>&nbsp;牛乳相關監測</span>
        <div class="container">
            <div class="row bg-light shadow p-3 mt-2">
                <div class="col-6">
                    <h5 style="text-align: center;">總乳量L
                        <canvas id="milkVolume" width="auto" height="125"></canvas>
                    </h5>
                    <script>
                        var ctx = document.getElementById("milkVolume");
                        new Chart(ctx, {
                            type: "tsgauge",
                            data: {
                                datasets: [{
                                    backgroundColor: ["#FFED97", "#9D9D9D"],
                                    borderWidth: 0,
                                    gaugeData: {
                                        value: 30,
                                        valueColor: "#FFED97"
                                    },
                                    gaugeLimits: [0, 30, 100]
                                }]
                            },
                            options: {
                                events: [],
                                showMarkers: true
                            }
                        });
                    </script>
                </div>
                <div class="col-6">
                    <h5 style="text-align: center;">乳量流速L/min
                        <canvas id="milkFlowRate" width="auto" height="125"></canvas>
                    </h5>
                    <script>
                        var ctx = document.getElementById("milkFlowRate");
                        new Chart(ctx, {
                            type: "tsgauge",
                            data: {
                                datasets: [{
                                    backgroundColor: ["#FFED97", "#9D9D9D"],
                                    borderWidth: 0,
                                    gaugeData: {
                                        value: 1.2,
                                        valueColor: "#FFED97"
                                    },
                                    gaugeLimits: [0, 1.2, 10]
                                }]
                            },
                            options: {
                                events: [],
                                showMarkers: true,
                            }
                        });
                    </script>
                </div>
                <!-- <div class="col-12">
                    <br>
                    <br>
                    <h5 style="text-align: center;">牛隻剖面圖(移至疾病管理)</h5> -->
                    <!-- <canvas id="cowCrossSection" width="500" height="150"></canvas> -->
                    <!-- <center><img src="../../image/cowCrossSection.png" id="cowCrossSection" width="350px" height="250px"></center>
                </div> -->
            </div>
        </div>
    </div>
</body>

</html>