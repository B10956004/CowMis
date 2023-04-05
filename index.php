<?php
session_start();
// 檢查是否登入或執行登出功能
if (!isset($_SESSION['username']) || $_SESSION['username'] == "") {
    header("Refresh: 0; url=member/login.php");
    exit;
}
if (isset($_POST['Logout']) && $_POST['Logout'] == "true") {
    unset($_SESSION['username']);
    header("Refresh: 0; url=member/login.php");
    exit;
}
?>

<!doctype html>

<html lang="en">

<head>
    <!-- 導入js -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>
    <!-- 導入網頁的外觀 -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <link rel="icon" href="image/cow8bit.png">
    <link rel="stylesheet" href="css/sidebar2.css">
    <meta charset="UTF-8">
    <title>酪農智慧網—基於開放式感測網技術之乳牛飼養與健康管理資訊系統</title>
    <!-- 網頁外觀的基礎設定 -->
    <style>
        html {
            height: 100%;
            margin-bottom: 65px
        }

        body {


            background-color: #fff;
            margin: 0;
            min-height: 100%;
            display: grid;
            grid-template-rows: 1fr auto;
        }


        header {

            position: fixed;
            width: 100%;
            height: 100px;
            top: 0;
            left: 0;
            color: black;

            font-family: Arial, "華康中圓體";

        }

        #but {
            width: 960px;
            margin: 0 auto;
            overflow: hidden;
        }


        #text {

            width: calc((100% - 250px));
            padding: 0px 0px 0px 0px;
            min-height: 100vh;
            transition: all 0.3s;
            position: fixed;
            top: 100px;
            right: 0;
            overflow: auto;

        }

        #text p {
            text-indent: 50px;
            font-size: 15px;
            line-height: 1.7;
            padding: 0 30px;
            padding-bottom: 15px;

        }

        #text.active {
            width: 100%;
        }




        .footer {
            background-color: green;
            grid-row-start: 2;
            grid-row-end: 3;
            font-family: Arial, "華康中圓體";
            font-size: 10px;
        }

        .member {
            width: auto;
            height: 60px;
            float: right;
        }

        .member2 {

            width: auto;
            height: 60px;
            float: right;
        }




        #bottom {
            /*    position: fixed;*/
            left: 0;
            bottom: 0;
            /*    width: 100%;*/
            color: #D8D8D8;
            font-size: 10px;
            justify-content: flex-end;
        }

        #sidebar {
            width: 250px;
            position: fixed;
            top: 100px;
            left: 0;
            height: 100vh;
            z-index: 999;
            background: #FFEEDD;
            color: #000;
            transition: all 0.3s;
            font-family: Arial, "華康中圓體";
            font-size: 25px;
        }

        #sidebar.active {
            margin-left: -250px;
        }

        #sidebar .sidebar-header {
            padding: 20px;
            background: rgba(255, 255, 255, 0);
            /*background: #2E2E2E;*/
        }

        #sidebar ul.components {
            padding-top: 20px;
            border-bottom: 1px solid #FFEEDD;
        }

        #sidebar ul p {
            color: #000;
            padding: 10px;
        }

        #sidebar ul li a {
            padding: 10px;
            font-size: 1.1em;
            display: block;
        }

        #sidebar ul li a:hover {
            color: black;
            background: #fff;
        }

        #sidebar ul li.active>a,
        a[aria-expanded="true"] {
            color: #000;
            background: rgba(255, 255, 255, 0);
            /*background: #2E2E2E;*/
        }

        a[data-toggle="collapse"] {
            position: relative;
        }

        .dropdown-toggle::after {
            display: block;
            position: absolute;
            top: 50%;
            right: 15px;
            transform: translateY(-50%);
        }

        ul ul a {
            font-size: 0.9em !important;
            padding-left: 45px !important;
            /*background: #595D60;*/
            background: rgba(255, 255, 255, 0);
        }

        ul.CTAs {
            padding: 20px;
        }

        ul.CTAs a {
            text-align: center;
            font-size: 0.9em !important;
            display: block;
            border-radius: 5px;
            margin-bottom: 5px;
        }

        a.download {
            background: #fff;
            color: #2E2E2E;
        }

        a.article,
        a.article:hover {
            /* background: #6d7fcc !important; */
            background-image: url("./image/奶瓶-橫.png") !important;
            color: #fff !important;
        }

        #content {
            width: 100%;
            padding: 10px 20px 0px 0px;
            min-height: 100vh;
            transition: all 0.3s;
            position: absolute;
            top: 0;
            right: 0;
        }

        #bottom22 {
            /*    position: fixed;*/
            left: 0;
            bottom: 0;
            /*    width: 100%;*/
            color: #D8D8D8;
            font-size: 10px;
            justify-content: flex-end;
        }

        .navbar {
            padding: 15px 10px;
            background: #FFEEDD;
            border: none;
            border-radius: 0;
            margin-bottom: 20px;
            box-shadow: 1px 1px 3px rgba(0, 0, 0, 0.1);
        }

        .navbar-btn {
            box-shadow: none;
            outline: none !important;
            border: none;
        }

        .line {
            width: 100%;
            height: 1px;
            border-bottom: 1px dashed #ddd;
            margin: 40px 0;
        }

        @media (max-width: 768px) {
            #sidebar {
                margin-left: -250px;
            }

            #sidebar.active {
                margin-left: 0;
            }

            #text {
                width: 100%;
            }

            #text.active {
                width: calc(100% - 250px);

            }

            #sidebarCollapse span {
                display: none;
            }

        }
    </style>

    <script>
        // sidebar跳轉功能頁面
        //總覽
        function change_OverView() {
            document.getElementById("frame").src = "fOverView/overView.php"
        }
        //即將分娩 OLD
        // function change_Birth() {
        //     document.getElementById("frame").src = "fBirth/brith.php"
        // }
        //牛隻履歷
        function change_CowInformation() {
            document.getElementById("frame").src = "fCowId/cowInformation/cowInformation.php"
        }

        function change_MilkRecord() {
            document.getElementById("frame").src = "fCowId/milkRecord/milkRecord.php"
        }
        //OLD
        // function change_MilkQuality() {
        //     document.getElementById("frame").src = "fCowId/milkQuality_OLD/milkQuality.php"
        // }
        //健康管理 

        // function change_GrowthInformation() {
        //     document.getElementById("frame").src = "fHealthManagement/growthInformation/growthInformation.php"
        // }
        function change_DiseaseManagement() {
            document.getElementById("frame").src = "fHealthManagement/diseaseManagement/diseaseManagement.php"
        }

        function change_canBreeding() {
            document.getElementById("frame").src = "fHealthManagement/canBreeding/canBreeding.php"
        }

        function change_pregnancyCheck() {
            document.getElementById("frame").src = "fHealthManagement/pregnancyCheck/pregnancyCheck.php"
        }

        function change_parturitionHistory() {
            document.getElementById("frame").src = "fHealthManagement/parturitionHistory/parturitionHistory.php"
        }

        // function change_matingModule() {
        //     document.getElementById("frame").src = "fHealthManagement/matingModule/matingModule.php"
        // }
        
        // function change_matingRecord() {
        //     document.getElementById("frame").src = "fHealthManagement/matingRecord/matingRecord.php"
        // }

        // function change_EstrusRecord() {
        //     document.getElementById("frame").src = "fHealthManagement/estrusRecord/estrusRecord.php"
        // }

        // function change_RectalExamination() {
        //     document.getElementById("frame").src = "fHealthManagement/rectalExamination/rectalExamination.php"
        // }
        //環境感測
        function change_Sensor() {
            document.getElementById("frame").src = "fEnvironment/sensor/sensor.php"
        }

        function change_SensorCow() {
            document.getElementById("frame").src = "fEnvironment/sensor/sensorCow.php"
        }
        // function change_WeatherWeek() {
        //     document.getElementById("frame").src = "fEnvironment/weather/weatherWeek.php"
        // }

        //管理紀錄

        function change_CowActivity() {
            document.getElementById("frame").src = "fRecord/cowActivity/cowActivity.php"
        }

        function change_SensorManagement() {
            document.getElementById("frame").src = "fRecord/sensorManagement/sensorManagement.php"
        }

        // function change_CullModule() {
        //     document.getElementById("frame").src = "fRecord/cullModule/cullModule.php"
        // }

        // function change_FeedRecord() {
        //     document.getElementById("frame").src = "fRecord/feedRecord/feedRecord.php"
        // }
    </script>
</head>
<!-- 關閉主頁滾動條 -->

<body style="overflow: hidden;">

    <div>
        <!-- sidebar開關 logo 使用者登入資訊 區塊 -->
        <header style="z-index: 9999;">
            <nav class="navbar navbar-expand-md navbar-dark" style="border-radius:5px;margin-bottom:30px;">
                <!--sidebar開關-->
                <button type="button" id="sidebarCollapse" class="btn">
                    <i class="fas fa-bars"></i>
                </button>
                <!--主頁logo-->
                <a href="index.php" style="font-size:35px ;height:70px;padding-top:10px">
                    <!-- 酪農產業數位轉型之開放式協同平台 -->
                    <img src="image/LOGO/onlyLogo.png" width="auto" height="90px" style="padding-right:10px;">
                    酪農智慧網—基於開放式感測網技術之乳牛飼養與健康管理資訊系統
                    <!-- <img src="image/logo3.png" width="auto" height="70px" style="padding-right:10px;"> -->
                    <!-- <img src="image/LOGO/LOGO2re.png" width="100%" height="70px" style="padding-right:10px;"> -->
                </a>
                <!-- 使用者功能 -->
                <ul class="navbar-nav ml-auto">
                    <!--ml-auto靠右-->
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" style="font-size:15px;padding-right:40px;color:red;"><i class="fas fa-bell" style="width:25px;color:#212529;"></i>2</a>
                        <!-- .dropdown-menu 下拉選單內容 小鈴鐺(未實作) -->
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="#">
                                <div class="badge text-wrap">
                                    <a class="dropdown-item text-break" href="#" style="font-size:16px">通知:牛舍溫度偏高!</a>
                                </div>
                            </a>
                            <a class="dropdown-item" href="#">
                                <div class="badge text-wrap">
                                    <a class="dropdown-item text-break" href="#" style="font-size:16px">通知:牛隻編號:XXXX出現異常!</a>
                                </div>
                            </a>
                        </div>
                    </li>
                    <!-- UserLogin -->
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" style="font-size:15px;padding-right:40px;color:#212529;"><i class="fa fa-user" style="width:25px;color:#212529;"></i><?php echo $_SESSION['username']; ?>&nbsp;已登入</a>
                        <!-- .dropdown-menu 下拉選單內容 -->
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="member/logout_action.php">登出</a>
                        </div>
                    </li>
                </ul>
            </nav>
        </header>
        <!-- 左側的使用著操作欄 -->
        <nav id="sidebar" style="z-index: 9999;width:270px;">
            <!--設置z-index蓋過footer-->
            <ul class="list-unstyled components">
                <!-- 利用JS的功能做到網頁轉換不需要讀取額外的記憶體 -->
                <li><a class="sidebarSelect" onclick="change_OverView() ;">總覽</a></li>
                <!-- <li><a class="sidebarSelect" onclick="change_Birth() ;">即將分娩牛隻</a></li> OLD-->
                <!--牛隻履歷-->
                <li class="active">

                    <a href="#cowID" data-toggle="collapse" class="dropdown-toggle"><i style="padding-right:2px; width:30px"></i>飼養管理模組</a><!--牛隻履歷-->
                    <ul class="collapse list-unstyled" id="cowID">
                        <li>
                            <a class="sidebarSelect" onclick="change_CowInformation() ;">牛隻資料</a>
                        </li>
                        <li>
                            <a class="sidebarSelect" onclick="change_MilkRecord() ;">泌乳性能</a>
                        </li>
                        <!-- <li>
                            OLD<a class="sidebarSelect" onclick="change_MilkRecord() ;">乳質紀錄</a>
                        </li>
                        <li>
                            OLD<a class="sidebarSelect" onclick="change_MilkQuality() ;">乳質檢測</a>
                        </li> -->
                    </ul>
                </li>
                <!--健康管理-->
                <li class="active">
                    <a href="#healManagement" data-toggle="collapse" class="dropdown-toggle"><i style="padding-right:2px; width:30px"></i>健康/繁殖管理模組</a>
                    <ul class="collapse list-unstyled" id="healManagement">
                        <!-- <li>
                            <a class="sidebarSelect" onclick="change_GrowthInformation() ;">生長資訊</a> OLD
                        </li> -->
                        <li>
                            <a class="sidebarSelect" onclick="change_DiseaseManagement() ;">疾病管理</a>
                        </li>
                        <li>
                            <a class="sidebarSelect" onclick="change_canBreeding() ;">待配種乳牛</a>
                        </li>
                        <li>
                            <a class="sidebarSelect" onclick="change_pregnancyCheck() ;">妊娠檢查</a>
                        </li>
                        <li>
                            <a class="sidebarSelect" onclick="change_parturitionHistory() ;">牛隻歷史分娩紀錄</a>
                        </li>
                        <!-- <li>
                            OLD<a class="sidebarSelect" onclick="change_matingModule() ;">繁殖模組</a>
                        </li>
                        <li>
                            OLD<a class="sidebarSelect" onclick="change_EstrusRecord() ;">發情紀錄</a>
                        </li>
                        <li>
                            OLD<a class="sidebarSelect" onclick="change_matingRecord() ;">配種紀錄</a>
                        </li>
                        <li>
                            OLD <a class="sidebarSelect" onclick="change_RectalExamination() ;">直腸檢查</a>
                        </li> -->
                    </ul>
                </li>
                <!--環境管理-->
                <li class="active">

                    <a href="#enviroment" data-toggle="collapse" class="dropdown-toggle"><i style="padding-right:2px; width:30px"></i>物聯網監控模組</a><!--感測網服務管理-->
                    <ul class="collapse list-unstyled" id="enviroment">
                        <li>
                            <a class="sidebarSelect" onclick="change_Sensor() ;">牧場觀測服務</a>
                        </li>
                        <li>
                            <a class="sidebarSelect" onclick="change_SensorCow() ;">牛乳量測</a>
                        </li>
                        <!-- <li>
                            <a class="sidebarSelect" onclick="change_WeatherWeek() ;">一周天氣溫度</a>
                        </li> -->

                    </ul>
                </li>
                <!-- 裝置互操作性模組 -->
                <li class="active">
                    <a href="#sensor" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i style="padding-right:2px; width:30px"></i>活動感知模組</a><!--裝置互操作性模組-->
                    <ul class="collapse list-unstyled" id="sensor">
                        <li>
                            <a class="sidebarSelect" onclick="change_SensorManagement() ;"> 感測器管理</a>

                        </li>
                        <li>
                            <a class="sidebarSelect" onclick="change_CowActivity() ;"> 乳牛活動感知</a>
                        </li>
                    </ul>
                </li>
                <!--管理紀錄-->
                <!-- <li class="active">
                    <a href="#record" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i style="padding-right:2px; width:30px"></i>管理紀錄(待確認)</a>
                    <ul class="collapse list-unstyled" id="record">

                        <li>
                            <a class="sidebarSelect" onclick="change_CullModule() ;"> 淘汰模組(未完成)</a>

                        </li>
                        <li>
                            <a class="sidebarSelect" onclick="change_FeedRecord() ;"> 飼養管理紀錄</a>
                        </li>
                    </ul>
                </li> -->
                <!-- 登出功能 -->
                <li><a class="sidebarSelect" href="member/logout_action.php">登出</a></li>
            </ul>
        </nav>
        <!-- 放入iframe連接功能頁面 -->
        <div id="text">
            <!--因iframe與footer衝突 需修復打開modal無法按最下面的close -->
            <!-- 崁入模組頁面的框架 -->
            <div id="content">
                <center>
                    <iframe id="frame" src="fOverView/overView.php" style="border:0px solid black; width:100%; height:130vh;z-index: 2;" ></iframe>
                </center>
            </div>
        </div>

        <!-- malihu scrollbar script -->
        <script type="text/javascript">
            $(document).ready(function() {
                $("#sidebar").mCustomScrollbar({
                    set_height: "90vh", //側邊高度需設置否則滑動條無法到最底部。
                    // set_width:"280px",
                    theme: "minimal",
                    mouseWheelPixels: 200 //設置滑動速度
                });

                $('#sidebarCollapse').on('click', function() {
                    $('#sidebar, #text').toggleClass('active');
                    $('.collapse.in').toggleClass('in');
                    $('a[aria-expanded=true]').attr('aria-expanded', 'false');
                });
            });
        </script>

        <!-- 底標 -->
        <footer class="page-footer fixed-bottom text-center" style="z-index: 0;">
            <div class="footer-copyright" id="bottom">
                <p> © 屏東科技大學 資訊管理系 ◎未經授權．不得轉載</p>
            </div>
        </footer>
    </div>
</body>

</html>