<?php
include_once("../conf/koneksi_dua.php");
session_start();

if(isset($_SESSION['login'])){
    $_SESSION['login'] = true;
}else{
    echo"<meta http-equiv='refresh' content='0; url=..'>";
    die();
}
$id_pasien = $_SESSION['id'];
$no_rm = $_SESSION['no_rm'];
$nama = $_SESSION['username'];
// $akses = $_SESSION['akses'];

$url = $_SERVER['REQUEST_URI'];
$url = explode("/",$url);
$id_poli = $url[count($url)-1];

// if($akses != 'pasien'){
//     echo"<meta http-equiv='refresh' content='0; url=..'>";
//     die();
// }

?>

<?php
$title ='Poliklinik | Tambah Jadwal Periksa';

//Breadcrumb Section

ob_start();?>

?>