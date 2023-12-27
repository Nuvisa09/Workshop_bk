<?php

    //konfigurasi database

$host  = "localhost";
$username = "root";
$password = "";
$database = "db_rumahsakit";

$koneksi = mysqli_connect($host, $username, $password, $database);

// if($koneksi){
//     echo "database terhubung";
// }else{
//     echo "Database error";
// }