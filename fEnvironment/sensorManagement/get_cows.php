<?php
require_once("../../SQLServer.php");
$area = $_POST['area'];
$sql = "SELECT * FROM cows_information WHERE area = '$area'";
$result = mysqli_query($db_link, $sql);

$ids = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $ids[] = array('id' => $row['id']);
    }
}
echo json_encode($ids);
?>
