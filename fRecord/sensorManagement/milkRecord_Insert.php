<?php
require_once("../../SQLServer.php");


if (isset($_POST['submit'])) {
    $date = $_POST['date']; //日期
    $quality = $_POST['quality']; //乳質
    $volume = $_POST['volume']; //乳量
    $milkSolidsNotFat = $_POST['milkSolidsNotFat']; //無脂固形物
    $milkFatPrecentage = $_POST['milkFatPrecentage']; //乳脂率
    $milkProtein = $_POST['milkProtein']; //乳蛋白
    $somaticCellCount = $_POST['somaticCellCount'];//體細胞數
    $query = "INSERT INTO `milk_record`(`date`, `quality`, `volume`, `milkSolidsNotFat`, `milkFatPrecentage`, `milkProtein`, `somaticCellCount`) 
    VALUES ('$date','$quality','$volume','$milkSolidsNotFat','$milkFatPrecentage','$milkProtein','$somaticCellCount')";
    $result = mysqli_query($db_link, $query);
    if ($result) {
        header("location:milkRecord.php");
    } else {
        echo 'Please check ur query';
    }
} else {
    header("location:milkRecord.php");
}
