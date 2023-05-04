<?php

require_once("../../SQLServer.php");
if (isset($_POST['update'])) {
    $GetSn = $_GET['GetSn'];
    $date = $_POST['date']; //日期
    $quality = $_POST['quality_hidden']; //乳質
    $volume = $_POST['volume']; //乳量
    $milkSolidsNotFat = $_POST['milkSolidsNotFat']; //無脂固形物
    $milkFatPrecentage = $_POST['milkFatPrecentage']; //乳脂率
    $milkProtein = $_POST['milkProtein']; //乳蛋白
    $somaticCellCount = $_POST['somaticCellCount']; //體細胞數
    $totalBacteria = $_POST['totalBacteria'];//生菌數
    $query = "UPDATE milk_Record SET date = '$date' , quality='$quality' , volume='$volume' , milkSolidsNotFat ='$milkSolidsNotFat', milkFatPrecentage ='$milkFatPrecentage', milkProtein ='$milkProtein', somaticCellCount ='$somaticCellCount', totalBacteria ='$totalBacteria'WHERE sn='$GetSn'";
    $result = mysqli_query($db_link, $query);

    if ($result) {
        header("location:milkRecord.php");
    } else {
        echo 'Please Check Your Query';
    }
} else {
    header("location:milkRecord.php");
}
