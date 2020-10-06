<?php 
include('partials/global.php'); 

 ?>

        
        
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include('partials/head.php'); ?>
        
        <title><?php echo $webname; ?> - Grafik </title>        
    </head>
    <body>
        <?php include('partials/topbar.php'); ?>
        <div id="layoutSidenav">
            <?php include('partials/sidebar.php'); ?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Grafik Tegangan 4 Sensor</h1>                        
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <canvas id="myChart" width="400" height="400"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>                       
                    </div>
                </main>
                <?php include('partials/footer.php'); ?>
            </div>
        </div>
        <?php include('partials/scripts.php'); ?>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script>
            <?php
                include('api/db_access.php'); 
                 $sensor1 = array();
                 $sensor2 = array();
                 $sensor3 = array();
                 $sensor4 = array();
                 $waktu = array();


                 
             
                 $load = mysqli_query($conn, "SELECT * FROM pengukuran ORDER BY id_ukur DESC LIMIT 50");
                 $nomor = 1;
                 while ($row = mysqli_fetch_array($load)){
                     $sensor1[] = $row['sensor1'];
                     $sensor2[] = $row['sensor2'];
                     $sensor3[] = $row['sensor3'];
                     $sensor4[] = $row['sensor4'];
                    //  $waktu[] = $row['waktu'];
                    $waktu[] = $nomor;
                    $nomor++;
                 }
            ?>
            var sensor1 = <?php echo json_encode($sensor1); ?>;
            var sensor2 = <?php echo json_encode($sensor2); ?>;
            var sensor3 = <?php echo json_encode($sensor3); ?>;
            var sensor4 = <?php echo json_encode($sensor4); ?>;
            var waktu = <?php echo json_encode($waktu); ?>;
            var ctx = document.getElementById('myChart').getContext('2d');
            var myLineChart = new Chart(ctx, {
                type: 'line',
                    data: {
                    labels: waktu,
                    datasets: [{ 
                        data: sensor1.reverse(),
                        label: "Sensor 1",
                        borderColor: "#3e95cd",
                        fill: false
                    }, { 
                        data: sensor2.reverse(),
                        label: "Sensor 2",
                        borderColor: "#8e5ea2",
                        fill: false
                    }, { 
                        data: sensor3.reverse(),
                        label: "Sensor 3",
                        borderColor: "#3cba9f",
                        fill: false
                    }, { 
                        data: sensor4.reverse(),
                        label: "Sensor 4",
                        borderColor: "#e8c3b9",
                        fill: false
                    }
                    ]
                },
                options: {
                scales: {
                xAxes: [{
                    time: {
                    unit: 'date'
                    },
                    gridLines: {
                    display: false
                    },                    
                }],
                yAxes: [{
                    ticks: {
                    min: 0,                                        
                    },
                    gridLines: {
                    color: "rgba(0, 0, 0, .125)",
                    }
                }],
                },
                legend: {
                display: true
                }
            }
                
            });
        </script>
    </body>
</html>
