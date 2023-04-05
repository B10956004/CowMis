<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
   
   

  <meta charset="UTF-8">
  <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
  <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.css" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js"></script>
  <script>
    $.getJSON('https://opendata.cwb.gov.tw/fileapi/v1/opendataapi/F-D0047-035?Authorization=CWB-178FCBE0-1BDD-44D1-918D-30FADBBCD5BF&downloadType=WEB&format=JSON')
  .done(function (re) { 
    console.log(re); 
    let kl = re.cwbopendata.dataset.locations.location[0]; //萬丹鄉
    let tp = re.cwbopendata.dataset.locations.location[1]; //霧台鄉
    let nt = re.cwbopendata.dataset.locations.location[2]; //新園鄉
    let tu = re.cwbopendata.dataset.locations.location[4]; //萬丹
let date_line = new Array();
let k = new Array(), t = new Array(), n = new Array(), u = new Array();

for (let i = 0; i < kl.weatherElement[1].time.length; i++) {
  /*write 時間軸*/
  date_line[i] = kl.weatherElement[1].time[i].startTime.substr(0, kl.weatherElement[1].time[i].startTime.length - 12);

  /*write 溫度資料*/
  k.push(kl.weatherElement[1].time[i].elementValue.value);
  t.push(tp.weatherElement[1].time[i].elementValue.value);
  n.push(nt.weatherElement[1].time[i].elementValue.value);
  u.push(tu.weatherElement[1].time[i].elementValue.value);
}
var ctx = document.getElementById('myChart');
var myChart = new Chart(ctx, {
  type: 'line',
  data: {
    labels: date_line,
    datasets: [{
      //keelung
      label: kl.locationName,
      data: k,
      backgroundColor: 'rgba(255, 99, 132, 0.1)',
      borderColor: 'rgba(255, 99, 132, 1)',
      borderWidth: 1
    }, {
      //taipei
      label: tp.locationName,
      data: t,
      backgroundColor: 'rgba(54, 162, 235, 0.1)',
      borderColor: 'rgba(54, 162, 235, 1)',
      borderWidth: 1
    }, {
      //newtaipei
      label: nt.locationName,
      data: n,
      backgroundColor: 'rgba(255, 206, 86, 0.1)',
      borderColor: 'rgba(255, 206, 86, 1)',
      borderWidth: 1
    }, {
      //taouang
      label: tu.locationName,
      data: u,
      backgroundColor: 'rgba(75, 192, 192, 0.1)',
      borderColor: 'rgba(75, 192, 192, 1)',
    }]
  }
});
  })
  .fail(function (w) { //失敗訊息
    alert("get this api fail so said!");
  });

  </script>
</head>
<body>


  <div class="col-md-12 ">
  <div id="container">
  <div class="bg-light shadow p-3 mt-2 ">
  <h5><i class="fab fa-bandcamp"></i>&nbsp;一周天氣溫度</h5>
    <canvas id="myChart" width="500" height="200"></canvas>
</div>
</div>
</div>
  </div>
</body>
</html>
