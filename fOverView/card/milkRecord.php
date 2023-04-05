<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<?php
require_once("../../SQLServer.php");
$GetSn = $_GET['GetSn'];
$query = "SELECT * FROM cows_information WHERE isDel = 0 AND sn=$GetSn";
$result = mysqli_query($db_link, $query);
while ($row = mysqli_fetch_array($result)) {
    $GetID = $row['id']; //尋找ID
}
?>
<div class="card-body">
    <h5 class="card-title"><i class="fas fa-tint"></i>&nbsp;乳質資訊&nbsp;&nbsp;<a href="#milkQuality" GetID="<?php echo $GetID ?>" class="btn btn-info view_data">乳質檢測數據</a></h5>
    <div class="table-responsive">
        <div id="cow_table" style="text-align:center;">
            <table id="rule" class="table table-hover">
                <thead>
                    <tr class="table-active">
                        <th>日期</th>
                        <th>乳質</th>
                        <th>乳量</th>
                        <th>運輸紀錄</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = "SELECT * FROM milk_record WHERE isDel = 0 AND id='$GetID' ORDER BY `date` DESC LIMIT 0,2";
                    $result = mysqli_query($db_link, $query);
                    while ($row = mysqli_fetch_array($result)) {
                        $date = $row['date'];
                        $level = $row['level'];
                        $volume = $row['volume'];
                        $transportRecord = $row['transportRecord'];
                    ?>
                        <tr>
                            <td><?php echo $date ?></td>
                            <td><?php echo $level ?></td>
                            <td><?php echo $volume ?></td>
                            <td><?php echo $transportRecord ?></td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div id="dataModal" class="modal fade bd-example-modal-lg">
    <div class="modal-dialog  modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title font-weight-bold">乳質檢測數據</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body" id="milkQuality">
                <!-- <input type="text" name="cow_ID" id="cow_ID" claass="form-control" readonly /> -->
                <!-- ajax取代 -->
                <br />
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).on('click', '.view_data', function() {
        var GetID = $(this).attr("GetID");

        $.ajax({
            url: "./card/milkQuality.php",
            method: "GET",
            data: {
                GetID: GetID
            },

            success: function(data) {
                $('#milkQuality').html(data);
                $('#dataModal').modal('show');
            }
        });

    });
</script>