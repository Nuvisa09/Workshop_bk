<?php

    //konfigurasi database

$host  = "localhost";
$username = "root";
$password = "";
$database = "pasien_poli";

$koneksi = mysqli_connect($host, $username, $password, $database);

// if($koneksi){
//     echo "database terhubung";
// }else{
//     echo "Database error";
// }