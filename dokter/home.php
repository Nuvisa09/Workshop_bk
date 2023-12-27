<?php

session_start();
if(!isset($_SESSION['nama']))
{
  header('location:../index.php');
}
if(isset($_GET['keluar'])){
  session_destroy();
  header('location:../index.php');
}
?>

<?php 

include '../template/topmenu.php';
include '../template/sidemenu.php';
include '../conf/koneksi_dua.php';

?>

<?php

error_reporting(0);
switch($_GET['page']){
  default:
      include 'dashboard.php';
      break;

  case 'list_periksa';
      include 'list_periksa.php';
      break;
  
  case 'riwayat_pasien';
      include 'riwayat_pasien.php';
      break;

  case 'detail_periksa';
      include 'detail_periksa.php';
      break;

  case 'edit_periksa';
      include 'edit_periksa.php';
      break;

}

?>

<?php
include '../template/footer.php';
?>
  