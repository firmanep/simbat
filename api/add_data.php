<?php
include('db_access.php');

function getTime($stamp){
    $date = new DateTime("now", new DateTimeZone('Asia/Makassar') );
    $waktu = $date->format('Y-m-d H:i:s');
    // $timestamp = date_timestamp_get($date);
    
    return $waktu;        
}





if(isset($_GET['s1']) && isset($_GET['s2']) && isset($_GET['s3']) && isset($_GET['s4'])){
    $sekarang = getTime(time());
    $sql = "INSERT INTO pengukuran (sensor1, sensor2, sensor3, sensor4, waktu) 
    VALUES (".$_GET['s1'].", ".$_GET['s2'].", ".$_GET['s3'].", ".$_GET['s4'].", '".$sekarang."')";
    $result = mysqli_query($conn, $sql);
    if(!($result)){
        echo 'Error query pengukuran';
    }else{
        echo 'Berhasil';
    }
    echo $sql;
}else{
    echo 'Data tidak lengkap';
}


?>