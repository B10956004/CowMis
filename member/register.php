<?php
session_start();
if (isset($_SESSION['username'])) {
  header("Refresh: 0; url=../index.php");
  exit;
}

?>
<!DOCTYPE html>
<html lang="zh-TW">

<head>
  <link rel="stylesheet" href="../css/style.css">
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>酪農智慧網—基於開放式感測網技術之乳牛飼養與健康管理資訊系統</title>


  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
  <link rel='stylesheet' href="../css/bg333.css">
  <link rel="icon" href="../image/LOGO 小.png">


  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <style>
    .btton {
      border-radius: 4px;
      background-color: #f4511e;
      border: none;
      color: #FFFFFF;
      text-align: center;
      font-size: 16px;
      padding: 20px;
      width: 200px;
      transition: all 0.5s;
      cursor: pointer;
      margin: 5px;
    }

    .btton span {
      cursor: pointer;
      display: inline-block;
      position: relative;
      transition: 0.5s;
    }

    .btton span:after {
      content: '\00bb';
      position: absolute;
      opacity: 0;
      top: 0;
      right: -20px;
      transition: 0.5s;
    }

    .btton:hover span {
      padding-right: 25px;
    }

    .btton:hover span:after {
      opacity: 1;
      right: 0;
    }
  </style>
</head>

<body>

  <div class="fix_bg bg_2">
    <h2 class="vcenter">
      <img src="../image/LOGO 小.png">
      <b><a href="../home.php" target="_self" style="color:#07A862;text-decoration: none;font-size: 35px;display: flex;align-items: center;padding-left:50px;padding-right:50px">酪農智慧網—基於開放式感測網技術之乳牛飼養與健康管理資訊系統</a></b>
      <br>
      <div style="border-radius:10px;background:rgba(255,255,255,0.7);padding:20px;margin-bottom:5px;width:380px;height:auto;margin:0 auto;text-align:center;">
        <form action="" method="post" name="formAdd" id="formAdd">
          <input type="text" name="username" id="username" placeholder="帳號" required class="form-control">
          <input type="text" name="password" id="password" placeholder="密碼" required class="form-control"><br>
          <input type="text" name="hint" id="hint" placeholder="密碼提示問題" required class="form-control">
          <input type="text" name="hintAns" id="hintAns" placeholder="密碼提示答案" required class="form-control"><br>
          <input type="hidden" name="action" value="add">
          <button type="submit" value="Submit" class="btton"> <span>註冊</span></button></br>
        </form>
        <?php
        if (isset($_POST["action"]) && ($_POST["action"] == "add")) {
          require_once("../SQLServer.php");
          $cusnm = $_POST['username'];
          $cpswd = $_POST['password'];
          $password=$cpswd;
          $cpswd = md5($cpswd);
          $hi = $_POST['hint'];
          $hian = $_POST['hintAns'];
          $sql_query = "INSERT INTO user (username,password,hint,hintAns,showPassword) VALUES ('$cusnm','$cpswd','$hi','$hian','$password')";
          mysqli_query($db_link, $sql_query);
          header("Location: ../index.php");
        }
        ?>
        <a href="../index.php" class="reg">回登入首頁</a> <a href="forgotPassword.php" class="reg">忘記密碼</a>

      </div>


    </h2>
  </div>
  <script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
</body>

</html>