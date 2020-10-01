<?php 
include('partials/global.php'); 

 ?>

        
        
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include('partials/head.php'); ?>
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.22/r-2.2.6/datatables.min.css"/> 
 
        
        
        <title><?php echo $webname; ?> - Blank</title>        
    </head>
    <body>
        <?php include('partials/topbar.php'); ?>
        <div id="layoutSidenav">
            <?php include('partials/sidebar.php'); ?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Log</h1>                        
                        <div class="card mb-4">
                            <div class="card-body">
                               <div class="row">
                                   <div class="col-12">
                                       <div class="table-responsive">
                                        <table id="datatable" class="table table-striped table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>No.</th>
                                                        <th>Sensor 1</th>
                                                        <th>Sensor 2</th>
                                                        <th>Sensor 3</th>
                                                        <th>Sensor 4</th>
                                                        <th>Waktu</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                <?php 
                                                    include('api/db_access.php');                                
                                                    $load = mysqli_query($conn, "SELECT * FROM pengukuran ORDER BY id_ukur DESC");
                                                    $nomor = 1;
                                                    while ($row = mysqli_fetch_array($load)){
                                                        echo '<tr>';
                                                        echo '<td>'.$nomor.'</td>';
                                                        echo '<td>'.$row['sensor1'].'</td>';
                                                        echo '<td>'.$row['sensor2'].'</td>'; 
                                                        echo '<td>'.$row['sensor3'].'</td>'; 
                                                        echo '<td>'.$row['sensor4'].'</td>';
                                                        echo '<td>'.$row['waktu'].'</td>';                                                                                                                                                                                                             
                                                        echo '</tr>';
                                                        $nomor++;
                                                    }
                                                ?>
                                                </tbody>
                                            </table>
                                       </div>                                  
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
        <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.22/r-2.2.6/datatables.min.js"></script>
        <script>
            $(document).ready( function () {
                $('#datatable').DataTable({
                    "responsive" : true
                });
            } );
        </script>
    </body>
</html>
