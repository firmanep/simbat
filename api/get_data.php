<?php
    include('api/db_access.php'); 
    
    $sensor1 = array();
    $sensor2 = array();
    $sensor3 = array();
    $sensor4 = array();
    $waktu = array();

    $load = mysqli_query($conn, "SELECT * FROM pengukuran ORDER BY id_ukur DESC");
    
    while ($row = mysqli_fetch_array($load)){
        $sensor1[] = $row['sensor1'];
        $sensor2[] = $row['sensor2'];
        $sensor3[] = $row['sensor3'];
        $sensor4[] = $row['sensor4'];
        $waktu[] = $row['waktu'];
    }
    

?>