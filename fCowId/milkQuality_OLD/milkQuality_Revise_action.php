<?php

require_once("../../SQLServer.php");
if (isset($_POST['update'])) {
    $GetSn=$_GET['GetSn'];//序列號
    $id = $_POST['id'];//編號
    $date = $_POST['date'];//檢測日期
    $milkFatPrecentage = $_POST['milkFatPrecentage']; //乳脂率
    $milkProtein = $_POST['milkProtein']; //乳蛋白
    $somaticCellCount = $_POST['somaticCellCount']; //體細胞數
    $acidity = $_POST['acidity']; //酸度
    $bloodyMilk = $_POST['bloodyMilk']; //血乳
    $milkSolidsNotFat = $_POST['milkSolidsNotFat']; //無脂固形物
    $totalBacteria = $_POST['totalBacteria']; //生菌數
    $query = "UPDATE milk_quality SET date='$date',milkFatPrecentage='$milkFatPrecentage',milkProtein='$milkProtein',somaticCellCount='$somaticCellCount',acidity='$acidity',bloodyMilk='$bloodyMilk',milkSolidsNotFat='$milkSolidsNotFat',totalBacteria='$totalBacteria' WHERE sn='$GetSn'";
    $result = mysqli_query($db_link, $query);

    if ($result) {
        header("location:milkQuality.php");
    } else {
        echo 'Please Check Your Query';
    }
} else {
    header("location:milkQuality.php");
}
