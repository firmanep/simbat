<?php 
include('partials/global.php'); 

 ?>

        
        
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include('partials/head.php'); ?>
        
        <title><?php echo $webname; ?> - Blank</title>        
    </head>
    <body>
        <?php include('partials/topbar.php'); ?>
        <div id="layoutSidenav">
            <?php include('partials/sidebar.php'); ?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Static Navigation</h1>                        
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
            var ctx = document.getElementById('myChart').getContext('2d');
            var myLineChart = new Chart(ctx, {
                type: 'line',
                    data: {
                    labels: [1500,1600,1700,1750,1800,1850,1900,1950,1999,2050],
                    datasets: [{ 
                        data: [86,114,106,106,107,111,133,221,783,2478],
                        label: "Africa",
                        borderColor: "#3e95cd",
                        fill: false
                    }, { 
                        data: [282,350,411,502,635,809,947,1402,3700,5267],
                        label: "Asia",
                        borderColor: "#8e5ea2",
                        fill: false
                    }, { 
                        data: [168,170,178,190,203,276,408,547,675,734],
                        label: "Europe",
                        borderColor: "#3cba9f",
                        fill: false
                    }, { 
                        data: [40,20,10,16,24,38,74,167,508,784],
                        label: "Latin America",
                        borderColor: "#e8c3b9",
                        fill: false
                    }
                    ]
                },
                options: {
                    title: {
                    display: true,
                    text: 'World population per region (in millions)'
                    }
                }
                
            });
        </script>
    </body>
</html>
