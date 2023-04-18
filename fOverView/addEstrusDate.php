<div class="card">
    <div class="card-body">
        <form action="addEstrusDate.php" method="post">
            <div class="row">
                <div class="col-6">
                    <p><?php echo $_GET['GetID']?> 發情日期</p>
                    <input type="date" class="form-control card-text" placeholder="請輸入發情日期" name="estrusDate" required>
                </div>
            </div>
            <br>
            <input type="hidden" value="<?php echo $_GET['GetSn']; ?>" name="GetSn">
            <input type="hidden" value="<?php echo $_GET['GetID']; ?>" name="GetID">
            <input type="submit" class="btn btn-success" value="新增" name="submit"></input>
    </div>
    </form>
</div>
<?php
if (isset($_POST['estrusDate'])) {
    require("../SQLServer.php");
    $id = $_POST['GetID'];
    $estrusDate = $_POST['estrusDate'];
    $query = "SELECT * FROM `pregnancy_check` WHERE id='$id' AND pregnancyresult IS NULL OR pregnancyresult= '' ";
    $result = mysqli_query($db_link, $query);
    if (mysqli_num_rows($result) == 0) {
        $query = "INSERT INTO `pregnancy_check`(`id`, `estrusdate`) VALUES('$id','$estrusDate')";
        $result = mysqli_query($db_link, $query);
        if ($result) {
            header("location:overView.php");
        } else {
            echo 'Please Check Your Query';
        }
    } else {
        $row=mysqli_fetch_array($result);
        $sn=$row['sn'];
        $query = "UPDATE `pregnancy_check` SET `estrusdate`='$estrusDate' WHERE `sn`='$sn' AND `id`='$id'";
        $result = mysqli_query($db_link, $query);
        if ($result) {
            header("location:overView.php");
        } else {
            echo 'Please Check Your Query';
        }
    }
};
?>