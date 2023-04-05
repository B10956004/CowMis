<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <meta charset="utf-8">
    <!--<meta http-equiv="refresh" content="60;url='http://140.127.22.165//豬隻V2.1/index.php'"/>-->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js"></script>
    <link rel="stylesheet" href="../css/indexcss.css">

</head>

<body>
    <button type="button" class="btn btn-primary" id="liveToastBtn">Show live toast</button>

    <div class="toast-container">
        <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-autohide="false">
            <div class="toast-header">
                <!-- <img src="..." class="rounded me-2" alt="..."> -->
                <strong class="me-auto">Bootstrap</strong>
                <small class="text-muted">just now</small>
                <button type="button" class="btn-close" data-dismiss="toast" aria-label="Close">&times;</button>
            </div>
            <div class="toast-body">
                See? Just like this.
            </div>
        </div>

        <div id="liveToast2" class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-autohide="false">
            <div class="toast-header">
                <!-- <img src="..." class="rounded me-2" alt="..."> -->
                <strong class="me-auto">Bootstrap</strong>
                <small class="text-muted">2 seconds ago</small>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close">&times;</button>
            </div>
            <div class="toast-body">
                Heads up, toasts will stack automatically
            </div>
        </div>
    </div>

    <canvas id="dashboardChart" width="400" height="400"></canvas>
    <script>
        var ctx = document.getElementById("dashboardChart");
        var dashboardChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ["Red", "Orange", "Green"],
                datasets: [{
                    label: '# of Votes',
                    data: [33, 33, 33],
                    backgroundColor: [
                        'rgba(231, 76, 60, 1)',
                        'rgba(255, 164, 46, 1)',
                        'rgba(46, 204, 113, 1)'
                    ],
                    borderColor: [
                        'rgba(255, 255, 255 ,1)',
                        'rgba(255, 255, 255 ,1)',
                        'rgba(255, 255, 255 ,1)'
                    ],
                    borderWidth: 5
                }]

            },
            options: {
                rotation: 1 * Math.PI,
                circumference: 1 * Math.PI,
                legend: {
                    display: false
                },
                tooltip: {
                    enabled: false
                },
                cutoutPercentage: 95
            }
        });
    </script>
    <!-- <div class="col-lg-6 col-md-6">
        <canvas class="box box-warning" id="myChart4" width="400" height="400"></canvas>
    </div>

    <div class="col-lg-6 col-md-6">
        <canvas class="box box-warning" id="myChart5" width="400" height="400"></canvas>
    </div>
    <script>
        //////////////////////////////////////////////
        // Chart Polar
        //////////////////////////////////////////////

        var ctx = document.getElementById("myChart4");

        new Chart(ctx, {
            type: 'polarArea',
            data: {
                labels: [
                    "Red",
                    "Blue",
                    "Yellow"
                ],
                datasets: [{
                    data: [300, 50, 100],
                    backgroundColor: [
                        "#FF6384",
                        "#36A2EB",
                        "#FFCE56"
                    ],
                    hoverBackgroundColor: [
                        "#FF6384",
                        "#36A2EB",
                        "#FFCE56"
                    ]
                }]
            },
            options: {
                cutoutPercentage: 50,
                animation: {
                    animateScale: false
                }
            }
        });

        //////////////////////////////////////////////
        // Radar
        //////////////////////////////////////////////

        var ctx = document.getElementById("myChart5");


        var scatterChart = new Chart(ctx, {
            type: 'radar',
            data: data = {

                labels: ["Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi", "Dimanche", ],
                datasets: [{
                    label: 'the first dataset',
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgba(255,99,132,1)',
                    data: [10, 34, 50, 34, 56, 65, 43]
                }, {
                    label: 'the second dataset',

                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',

                    data: [54, 72, 100, 36, 76, 23, 21]
                }]
            },
            options: {
                scales: {
                    xAxes: [{
                        type: 'linear',
                        position: 'bottom'
                    }]
                }
            }
        });
    </script> -->
</body>
<script>
    var toastTrigger = document.getElementById('liveToastBtn')
    var toastLiveExample = document.getElementById('liveToast')
    var toastLiveExample2 = document.getElementById('liveToast2')
    var test1 = 0
    var test2 = 1
    if (test2 > test1) {
        var toast = new bootstrap.Toast(toastLiveExample)
        var toast2 = new bootstrap.Toast(toastLiveExample2)
        toast.show()
        toast2.show()
    }
    if (toastTrigger) {
        toastTrigger.addEventListener('click', function() {
            var toast = new bootstrap.Toast(toastLiveExample)
            var toast2 = new bootstrap.Toast(toastLiveExample2)
            toast.show()
            toast2.show()
        })
    }
</script>

</html>