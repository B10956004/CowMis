<!-- 驗證答案後返還密碼的頁面 -->
<!-- 連結資料庫 -->
<?php
session_start();
if (isset($_SESSION['username']) ) {
    header("Refresh: 0; url=../index.php");
    exit;
}

?>
<!-- 如果問題回答正卻將會從資料庫撈出密碼 -->
	<?php
require_once("../SQLServer.php");
$lid = $_POST['username'];
$hintan = $_POST['answer'];
$query = "SELECT * FROM user WHERE username='".$lid."'";
$result = mysqli_query($db_link,$query);
while($row=mysqli_fetch_assoc($result)){
$hiian = $row['hintAns'];
if ($hiian == $hintan){
$pass = $row['password'];
}
}


?>
<!DOCTYPE html>
<html lang="zh-TW">

  <head>
	   <link rel="stylesheet" href="../css/style.css">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>酪農智慧網</title>
   
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
  integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel='stylesheet' href="../css/bg333.css">
    <link rel="icon" href="image/LOGO 小.png">
    
  
   <!-- 基本的外觀設定 -->
  <style>
  .btton {
  border-radius: 4px;
  background-color: #f4511e;
  border: none;
  color: #FFFFFF;
  text-align: center;
  font-size:16px;
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
    font-size:10px;
}
  </style>
  </head>

  <body>
  
  	
  <!-- 中央的使用者操作區 -->
  <div class="fix_bg bg_2">
			<h2 class="vcenter">
      <a href="../index.php"><img src="../image/wu.png"  width="500px" height="200px" ><br></a>
			<div style="border-radius:10px;background:rgba(255,255,255,0.7);padding:20px;margin-bottom:5px;width:380px;height:auto;margin:0 auto;text-align:center;">
            您的密碼是<?php echo "<p style=\"color:red;bold;\">$pass</p>";?>
            
            <button onclick="location.href='../index.php'"  type="button"  class="btton"> <span>回登入首頁</span></button></br>
		
     
		    </div>
           
			</h2>
    </div>
    
    
   

    </div>
    <script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    
  </body>
</html>

