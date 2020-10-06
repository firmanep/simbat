<?php
include('db_access.php');

function getTime($stamp){
    $date = new DateTime("now", new DateTimeZone('Asia/Makassar') );
    $waktu = $date->format('Y-m-d H:i:s');
    // $timestamp = date_timestamp_get($date);
    
    return $waktu;        
}





if(isset($_POST['s1']) && isset($_POST['s2']) && isset($_POST['s3']) && isset($_POST['s4'])){
    $sekarang = getTime(time());
    $sql = "INSERT INTO pengukuran (sensor1, sensor2, sensor3, sensor4, waktu) 
    VALUES (".$_POST['s1'].", ".$_POST['s2'].", ".$_POST['s3'].", ".$_POST['s4'].", '".$sekarang."')";
    $result = mysqli_query($conn, $sql);
    if(!($result)){
        echo 'Error query pengukuran';
    }else{
        echo 'Berhasil';
    }
 
}else{
    echo 'Data tidak lengkap :  '.$_POST['s1'].' - '.$_POST['s2'].' - '.$_POST['s3'].' - '.$_POST['s4'];
}


?>