<?php
require("../../SQLServer.php");
/*
THI=9/5T+32-0.55*(1-RH)*(9/5T-26)
(T：氣溫°C、RH：相對濕度%)
*/
$temperature=$_GET['temperature'];
$humidity=$_GET['humidity'];
$humidityPrecent=$humidity/100;
$thi=9/5*$temperature+32-0.55*(1-$humidityPrecent)*(9/5*$temperature-26);
$temperature=number_format($temperature,1);
$humidity=number_format($humidity,1);
$thi=number_format($thi,1);

$query="INSERT INTO `dht`(`humidity`, `temperature`, `thi`) VALUES ($humidity,$temperature,$thi)";
$result=mysqli_query($db_link,$query);

if ($result) {
    header('Content-Type: text/plain');
    header('Content-Length: ' . strlen('DHT success'));
    echo 'DHT success';
} else {
    header('Content-Type: text/plain');
    header('Content-Length: ' . strlen('DHT fail'));
    echo 'DHT fail';
}
?>