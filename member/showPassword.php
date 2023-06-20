<!-- 驗證答案後返還密碼的頁面 -->
<!-- 連結資料庫 -->
<?php
session_start();
if (isset($_SESSION['username'])) {
  header("Refresh: 0; url=../home.php");
  exit;
}

?>
<!-- 如果問題回答正卻將會從資料庫撈出密碼 -->
<?php
require_once("../SQLServer.php");
$lid = $_POST['username'];
$hintan = $_POST['answer'];
$email = $_POST['email'];
$query = "SELECT * FROM user WHERE username='$lid' AND email='$email'";
$result = mysqli_query($db_link, $query);
while ($row = mysqli_fetch_assoc($result)) {
  $hiian = $row['hintAns'];
  if ($hiian == $hintan) {
    $pass = $row['showPassword'];
  } else {
    echo "<script>
        alert('提示答案不正確!請重新輸入');
        setTimeout(function(){window.location.href='forgotPassword.php'},100);
        </script>";
  }
}
$subject = "酪農智慧網—基於開放式感測網技術之乳牛飼養與健康管理資訊系統密碼";
$message = "
<html>
<head>
  <title>酪農智慧網—基於開放式感測網技術之乳牛飼養與健康管理資訊系統密碼</title>
</head>
<body>
    <p>您的密碼為:{$pass} ，若您無發送此請求，請盡速聯繫本系統人員以修改密碼。</p>
</body>
</html>
";
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require("../PHPMailer/src/Exception.php");
require("../PHPMailer/src/PHPMailer.php");
require("../PHPMailer/src/SMTP.php");
$mail = new PHPMailer(true);

try {
  //Send using SMTP
  $mail->isSMTP();
  $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
  $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
  $mail->Username   = 'teamproject110.8@gmail.com';                     //SMTP username
  $mail->Password   = 'nbgtqflmkkjaeorq';                               //SMTP password
  $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
  $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

  //Recipients
  $mail->CharSet = 'UTF-8';
  $mail->ContentType = 'text/html; charset=UTF-8';
  $mail->setFrom('CowMis@gmail.com', 'CowMis_forgetPassword');               //Name is optional
  $mail->addAddress($email);


  //Content
  $mail->isHTML(true);                                  //Set email format to HTML

  $mail->Subject = $subject;
  $mail->Body    = $message;
  $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

  $mail->send();
} catch (Exception $e) {
  echo "<script>
            alert('發送失敗...錯誤原因:{$mail->ErrorInfo}，請再聯繫系統人員！');
           setTimeout(function(){window.location.href='forgotPassword.php'},100);
           </script>";
}
?>

<!DOCTYPE html>
<html lang="zh-TW">

<head>
  <link rel="stylesheet" href="../css/style.css">
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>酪農智慧網—基於開放式感測網技術之乳牛飼養與健康管理資訊系統</title>

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
  <link rel='stylesheet' href="../css/bg333.css">
  <link rel="icon" href="../image/LogoFinal.png">


  <!-- 基本的外觀設定 -->
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

    .footer {
      background-color: #fff;
      grid-row-start: 2;
      grid-row-end: 3;
      font-family: Arial, "標楷體";
      font-size: 10px;
    }
  </style>
</head>

<body>


  <!-- 中央的使用者操作區 -->
  <div class="fix_bg bg_final">

    <h2 class="vcenter" style="background-color: rgba(245,245,245,0.8);border-radius: 25px;">
      <a href="../home.php"><img height="100px" src="../image/LogoFinal.png"></a>
      <b><a href="../home.php" target="_self" style="color:#07A862;text-decoration: none;font-size: 35px;display: flex;align-items: center;padding-left:50px;padding-right:50px">酪農智慧網—基於開放式感測網技術之乳牛飼養與健康管理資訊系統</a></b>
      <br>
      <div style="border-radius:10px;background:rgba(255,255,255,0.7);padding:20px;margin-bottom:5px;width:580px;height:auto;margin:0 auto;text-align:center;">
        <?php echo "<p style=\"color:#07A862;bold;\">您的密碼已經寄到{$email}</p>"; ?>
        <button onclick="location.href='../home.php'" type="button" class="btton"> <span>回登入首頁</span></button></br>
      </div>
      <br>
    </h2>
  </div>




  </div>
  <script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

</body>

</html>