
<?php
date_default_timezone_set("Asia/Taipei");
$dsn="mysql:host=localhost;charset=utf8;dbname=cowmis";
$pdo=new PDO($dsn,'root','');

    $db_host = "localhost";
    $db_username = "root";
    $db_password = "";
    // $db_name = "test";
    $db_name="cowmis";
    $db_link = @new mysqli($db_host, $db_username, $db_password, $db_name);
    if ($db_link->connect_error != "") {
        echo "資料庫連結失敗！";
    }else{

        $db_link->query("SET NAMES 'utf8'");
    }

?>
