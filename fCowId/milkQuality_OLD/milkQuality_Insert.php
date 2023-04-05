<?php
require_once("../../SQLServer.php");


if (isset($_POST['submit'])) {

    $id = $_POST['id'];//編號
    $date = $_POST['date'];//檢測日期
    $milkFatPrecentage = $_POST['milkFatPrecentage'];//乳脂率
    $milkProtein = $_POST['milkProtein'];//乳蛋白
    $somaticCellCount = $_POST['somaticCellCount'];//體細胞數
    $acidity = $_POST['acidity'];//酸度
    $bloodyMilk = $_POST['bloodyMilk'];//血乳
    $milkSolidsNotFat = $_POST['milkSolidsNotFat'];//無脂固形物
    $totalBacteria = $_POST['totalBacteria'];//生菌數

    $query = "INSERT INTO milk_quality (id,date, milkFatPrecentage, milkProtein, somaticCellCount, acidity, bloodyMilk, milkSolidsNotFat,totalBacteria) VALUES('$id','$date', '$milkFatPrecentage', '$milkProtein', '$somaticCellCount','$acidity' ,'$bloodyMilk','$milkSolidsNotFat','$totalBacteria')";
    $result = mysqli_query($db_link, $query);

    if ($result) {

        header("location:milkQuality.php");
    } else {
        echo 'Please check ur query';
    }
} else {
    header("location:milkQuality.php");
}
?>