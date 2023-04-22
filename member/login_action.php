<?PHP
require_once("../SQLServer.php");
$acc=$_POST['username'];
$pw=$_POST['password'];
$pw=md5($pw);
$sql = "select * from user where username = '$acc' and password='$pw'";
$data=$pdo->query($sql)->fetch();
if(!empty($data)){
  session_start();
  $_SESSION['username'] = $acc;
  header("refresh:0;url=../home.php");
  exit;
}
else{
  echo "<script>
    alert('帳號或密碼填寫不完整');
    setTimeout(function(){window.location.href='../home.php'},0);
    </script>";
  mysqli_close($db_link);
}
?>