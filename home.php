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
require_once("SQLServer.php"); //注入SQL檔
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- css連結 -->
    <link rel="stylesheet" href="./css/styleNew.css">
    <!--bootstrap插件-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <link rel="icon" href="image/LOGO 小.png">
    <title>酪農智慧網—基於開放式感測網技術之乳牛飼養與健康管理資訊系統</title>
    <script>
        // sidebar跳轉功能頁面
        //總覽
        function change_OverView() {
            document.getElementById("frame").src = "fOverView/overView.php"
        }
        //牛隻履歷
        function change_CowInformation() {
            document.getElementById("frame").src = "fCowId/cowInformation/cowInformation.php"
        }

        function change_MilkRecord() {
            document.getElementById("frame").src = "fCowId/milkRecord/milkRecord.php"
        }
        //健康管理 
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
        //環境感測
        function change_Sensor() {
            document.getElementById("frame").src = "fEnvironment/sensor/sensor.php"
        }

        function change_SensorCow() {
            document.getElementById("frame").src = "fEnvironment/sensor/sensorCow.php"
        }

        //管理紀錄

        function change_CowActivity() {
            document.getElementById("frame").src = "fRecord/cowActivity/cowActivity.php"
        }

        function change_SensorManagement() {
            document.getElementById("frame").src = "fRecord/sensorManagement/sensorManagement.php"
        }
    </script>
</head>

<body>
    <div>
        <header>
            <div class="container-all" style="background-color:#F5F5F5;">
                <!-----設定LOGO與名稱----->
                <div class="col-sm-10 d-none d-sm-block" style="padding: 10px 25px;">
                    <b><a href="./home.php" target="_self" style="color:#07A862;text-decoration: none;font-size: 35px;height: 60px;display: flex;align-items: center;">
                            <img src="./image/LOGO 小.png" style="width: 60px;margin-right: 15px;">酪農智慧網—基於開放式感測網技術之乳牛飼養與健康管理資訊系統
                        </a></b>
                </div>
                <!-- for phone screen -->
                <div class="col-sm-10 d-sm-none d-sm-block d-print-block" style="padding: 10px 25px;">
                    <b><a href="./home.php" target="_self" style="color:#07A862;text-decoration: none;font-size: 34px;height: 60px;display: flex;align-items: center;">
                            <img src="./image/LOGO 小.png" style="width: 80px;margin-right: 80px;">
                        </a></b>
                </div>
                <!----------登出鍵------------>
                <div class="col-sm-2" style="background-image:url(./image/Login底圖.png);background-color:#F5F5F5; background-size: Cover;">
                    <ul class="navbar-nav" style="padding-top:20px">
                        <li class="nav-item dropdown" style="padding-left:35px;">
                            <button class="btn dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" style="color:white;font-size: 20px;">
                                <i class="fa fa-user" style="width:25px;color:#212529;"></i><?php echo $_SESSION['username']; ?>&nbsp;已登入
                            </button>
                            <ul class="dropdown-menu dropdown-menu">
                                <li><a class="dropdown-item" href="member/logout_action.php">登出</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
            <!----------Navbar--------->
            <div class="container-bar">
                <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDarkDropdown" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="container-fluid">
                        <div class="collapse navbar-collapse" id="navbarNavDarkDropdown">
                            <ul class="navbar-nav mx-auto">
                                <li class="nav-item dropdown text-center">
                                    <button class="btn btn-dark" data-bs-toggle="dropdown" aria-expanded="false">
                                        <a class="dropdown-item" onclick="change_OverView() ;">牛舍總覽</a>
                                    </button>
                                </li>
                                <li class="nav-item dropdown text-center">
                                    <button class="btn btn-dark dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                        牛隻履歷
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-dark text-center">
                                        <li><a class="dropdown-item" onclick="change_CowInformation() ;">牛隻資料</a></li>
                                        <li><a class="dropdown-item" onclick="change_MilkRecord() ;">泌乳性能</a></li>
                                    </ul>
                                </li>
                                <li class="nav-item dropdown text-center">
                                    <button class="btn btn-dark dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                        健康管理
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-dark text-center">
                                        <li><a class="dropdown-item" onclick="change_DiseaseManagement() ;">疾病管理</a></li>
                                        <li><a class="dropdown-item" onclick="change_canBreeding() ;">待配種乳牛</a></li>
                                        <li><a class="dropdown-item" onclick="change_pregnancyCheck() ;">妊娠檢查</a></li>
                                        <li><a class="dropdown-item" onclick="change_parturitionHistory() ;">牛隻歷史分娩紀錄</a></li>
                                    </ul>
                                </li>
                                <li class="nav-item dropdown text-center">
                                    <button class="btn btn-dark dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                        感測網服務管理
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-dark text-center">
                                        <li><a class="dropdown-item" onclick="change_Sensor() ;">牧場觀測服務</a></li>
                                        <!-- <li><a class="dropdown-item" onclick="change_SensorCow() ;">牛乳測量</a></li> -->
                                    </ul>
                                </li>
                                <li class="nav-item dropdown text-center">
                                    <button class="btn btn-dark dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                        裝置互操作性模組
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-dark text-center">
                                        <li><a class="dropdown-item" onclick="change_SensorManagement() ;">感測器管理</a></li>
                                        <li><a class="dropdown-item" onclick="change_CowActivity() ;">乳牛姿態感知</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
        </header>
        <!-------網頁內文---------->
        <div class="container-all " style="background-color:#F5F5F5">
            <div class="col-sm-2 d-none d-sm-block">
                <div class="container-list" style="background-color:white;border:2px gray solid;height:100vh;margin: 30px;box-shadow: 0px 0px 5px  gray;">
                    <center>
                        <iframe name="CowFrame" id="CowFrame" src="fOverView/cowStates.php" style="overflow-y: scroll; overflow-x: hidden;display: block;border:none; width:100%; height:100vh;"></iframe>
                    </center>
                </div>
            </div>
            <div class="col-12 col-sm-10 d-sm-block" style="background-color:#F5F5F5; ">
                <div class="container-list" style="background-color:white;border:2px gray solid;height:100vh;margin: 30px;box-shadow: 0px 0px 5px  gray;">
                    <center>
                        <iframe name="frame" id="frame" src="fOverView/Overview.php" style="overflow-y: scroll; overflow-x: hidden;display: block;border:none; width:100%; height:100vh;"></iframe>
                    </center>
                </div>
            </div>
        </div>
        <!-- 底標 -->
        <center style="background-color:#F5F5F5; ">
            © 屏東科技大學 資訊管理系 ◎未經授權．不得轉載
        </center>
    </div>

</body>

</html>